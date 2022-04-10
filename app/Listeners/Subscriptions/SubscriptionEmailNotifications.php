<?php

namespace App\Listeners\Subscriptions;

use App\Models\Subscription;
use App\Events\Subscriptions\SubscriptionCreate;
use App\Models\Recurrent;
use App\Models\SubscriptionRecurrentTrie;
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
    public function handle(SubscriptionCreate $event) // se recibe un evento con toda la informacion
    {
        $subscription = $event->subscription; // se setea la informacion a una variable
        $faker = Faker::create(); // se importa faker para usar el random de bools

        $subs = Subscription::where('id', $subscription->id)->with(['user', 'price_subs'])->first(); // se consulta la tabla con relaciones
        $subs->confirmed = $faker->boolean(); //random de confirmacion de pago
        $subs->update(); //se actualiza el estado del pago

        $user = User::where('id', $subscription->user->id)->first(); //se trae la informacion del usuario al que se le enviara el correo

        $recurrent = Recurrent::create([ //se crea la recurrencia
            'date_recurrent'    => now()->addMinutes(30),
            'subscription_id'    => $subscription->id,
        ]);
        
        if( $subs->confirmed == 0 ){ //se valida si dio false el random
            $tries = 0;            //se setea contador de intentos
            foreach (range(1,4) as $index) { // se establece un ciclo para realizar los intentos
                $tries++; //contador de intentos
                if( $tries <= 3 ){ //entrara aqui siempre y cuando los intentos sean 3 o menores de 3

                    $subs_recu_trie = new SubscriptionRecurrentTrie(); // se crea el intento de la DB
                    $subs_recu_trie->tries = $tries;
                    $subs_recu_trie->subscription_id = $subscription->id;
                    $subs_recu_trie->recurrent_id = $recurrent->id;
                    $subs_recu_trie->save();
    
                    $subs->confirmed = $faker->boolean(50); //vuelve a consultarse la confirmacion de pago
                    $subs->update(); //se actualiza
    
                    
                    if( $subs->confirmed == 1 ){ // si despues del random es un true se procede a enviar el email a el usuario

                        $user->subscribed = true; // se setea el estado de suscripcion en true
                        $user->update();

                        $delay = now()->addMinutes(30); // se establece la hora del envio del correo
                        $user->notify((new SubscriptionAttorney($subs))->delay($delay)); // envia la informacion a el notification para el envio del email
                        break; // una vez sea true el estado se termina el ciclo para no consumir mas memoria y no registrar mas intentos
                    }                
                } else { // si se sepera los 3 intentos entra aqui para cancelar la suscripcion

                    SubscriptionRecurrentTrie::where('subscription_id', $subscription->id)->delete(); // se borran los intentos
                    Recurrent::where('subscription_id', $subscription->id)->delete(); // se borra la recurrencia y la la suscripcion queda en false
                    
                    $user->subscribed = false; //el estado de suscripcion queda en false para que el cliente se suscriba manualmente
                    $user->update();

                    $delay = now()->addMinutes(30); // se establece la hora del envio del correo
                    $user->notify((new SubscriptionAttorney($subs))->delay($delay)); // envia la informacion a el notification para el envio del email
                    break;
                }
            }
        } else if( $subs->confirmed == 1 ){ // si a la primera el estado de suscripcion en true entra aqui

            $user->subscribed = true; // se setea el estado de suscripcion en true
            $user->update();

            $delay = now()->addMinutes(30); // se establece la hora del envio del correo
            $user->notify((new SubscriptionAttorney($subs))->delay($delay)); // envia la informacion a el notification para el envio del email

        }

        
    }
}
