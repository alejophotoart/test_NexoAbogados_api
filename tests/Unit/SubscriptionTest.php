<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SubscriptionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_view_all_user()
    {
        $this->withoutExceptionHandling();

        $user = User::where('id', 12)->first();

        $this->assertAuthenticatedAs($user, $guard = null);

        $response = $this->get(route('users.index'));

        $response->assertStatus(200);
    }
}
