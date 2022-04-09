<?php

namespace App\Listeners\Subscriptions;

use App\Models\Subscription;
use App\Events\Subscriptions\SubscriptionCreate;
use App\Models\User;
use App\Notifications\SubscriptionAttorney;
use Illuminate\Contracts\Queue\ShouldQueue;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Notification;

class SubscriptionEmailNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SubscriptionCreate $event)
    {
        $subscription = $event->subscription;
        
        $faker = Faker::create();

        Subscription::where('id', $subscription->id)->update([ //Random bool consiste en actualizar el campo confirmed para informarle al cliente que fue aprobada o rechazada
            'confirmed' => $faker->boolean()
        ]);

        $subs = Subscription::where('id', $subscription->id)->with(['user', 'price_subs'])->first();
      
        $user = User::where('id', $subscription->user->id)->first();

        
        
        $delay = now()->addMinutes(30);
        $user->notify((new SubscriptionAttorney($subs))->delay($delay));
    }
}
