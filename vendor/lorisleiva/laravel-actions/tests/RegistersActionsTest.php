<?php

namespace Lorisleiva\Actions\Tests;

use Illuminate\Support\Str;
use Lorisleiva\Actions\ActionManager;
use Lorisleiva\Actions\Facades\Actions;
use Lorisleiva\Actions\Tests\Actions\SimpleCalculator;
use ReflectionClass;

class RegistersActionsTest extends TestCase
{
    const ACTION_COUNT = 11;

    protected function getEnvironmentSetUp($app)
    {
        $app->instance(ActionManager::class, new class() extends ActionManager {
            protected function getClassnameFromPathname(string $pathname): string
            {
                return 'Lorisleiva\\Actions\\Tests\\' . str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($pathname, realpath(__DIR__).DIRECTORY_SEPARATOR)
                );
            }
        });
    }

    /** @test */
    public function it_can_register_all_actions_within_a_directory()
    {
        Actions::paths(__DIR__ . '/Actions');
        Actions::registerAllPaths();

        $this->assertCount(static::ACTION_COUNT, Actions::getRegisteredActions());
    }

    /** @test */
    public function it_only_register_actions_once()
    {
        Actions::paths(__DIR__ . '/Actions');
        Actions::registerAllPaths();
        Actions::registerAllPaths();

        $this->assertCount(static::ACTION_COUNT, Actions::getRegisteredActions());
    }

    /** @test */
    public function it_can_force_not_to_register_any_paths()
    {
        Actions::paths(__DIR__ . '/Actions');
        Actions::dontRegister();
        Actions::registerAllPaths();

        $this->assertCount(0, Actions::getRegisteredActions());
    }

    /** @test */
    public function it_can_register_one_specific_action()
    {
        Actions::register(new SimpleCalculator);

        $registeredActions = Actions::getRegisteredActions();
        $this->assertCount(1, $registeredActions);
        $this->assertContains(SimpleCalculator::class, $registeredActions);
    }

    /** @test */
    public function it_can_register_one_specific_action_with_its_classname()
    {
        Actions::register(SimpleCalculator::class);

        $registeredActions = Actions::getRegisteredActions();
        $this->assertCount(1, $registeredActions);
        $this->assertContains(SimpleCalculator::class, $registeredActions);
    }

    /** @test */
    public function it_cannnot_register_the_same_action_twice()
    {
        Actions::register(SimpleCalculator::class);
        Actions::register(SimpleCalculator::class);

        $registeredActions = Actions::getRegisteredActions();
        $this->assertCount(1, $registeredActions);
        $this->assertContains(SimpleCalculator::class, $registeredActions);
    }

    /** @test */
    public function it_calls_the_registered_static_method_when_an_action_is_registered_at_most_once()
    {
        $action = new class extends SimpleCalculator {
            public static $registeredCounter = 0;

            public static function registered() 
            {
                static::$registeredCounter++;
            }
        };
        
        $this->assertEquals(0, $action::$registeredCounter);
        Actions::register($action);
        Actions::register($action);
        $this->assertEquals(1, $action::$registeredCounter);
    }

    /** @test */
    public function it_calls_the_initialized_method_when_an_action_is_instantiated()
    {
        $action = new class() extends SimpleCalculator {
            public static $initializedCalled = false;

            public function initialized() 
            {
                static::$initializedCalled = true;
            }
        };
        
        $this->assertTrue($action::$initializedCalled);
    }

    /** @test */
    public function it_knows_how_to_transform_a_filename_in_the_app_directory_into_a_classname()
    {
        $pathname = app_path('Actions/MyDummyAction.php');

        // Call protected method ActionManager::getClassnameFromPathname.
        $reflection = new ReflectionClass(ActionManager::class);
        $method = $reflection->getMethod('getClassnameFromPathname');
        $method->setAccessible(true);
        $classname = $method->invoke(new ActionManager, $pathname);

        $this->assertEquals('App\\Actions\\MyDummyAction', $classname);
    }
}
