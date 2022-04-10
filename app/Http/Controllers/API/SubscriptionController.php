<?php

namespace App\Http\Controllers\API;

use App\Events\Subscriptions\SubscriptionCreate;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Recurrent;
use App\Models\Subscription;
use App\Models\SubscriptionRecurrentTrie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::where('user_id', Auth::user()->id)->with(['user', 'recurrent', 'price_subs', 'subs_rec_trie'])->first(); // se consulta la tabla suscripciones
        // dd($subscriptions);
        return response()->json([SubscriptionResource::make($subscriptions), 'Suscripcion de '.Auth::user()->name]);
    }

    public function store(SubscriptionRequest $request)
    {
        $validate = $request->validated(); //Validaciones de creacion de suscripcion

        if( $validate == true ){
            $now = Carbon::now(); //Se establece con la libreria carbon la fecha de hoy
            $subscription = Subscription::create([ //Se crea la suscripcion y se guarda en la DB
                'price_id'          => $request->subscriptionPrice,
                'confirmed'         => false,
                'date_subscription' => $now,
                'user_id'           => Auth::user()->id
            ]);
            
            event(new SubscriptionCreate($subscription)); //Se envia a el evento para que ejecute el listener y haga el envio de los correos

            //Se envia un mensaje a la vista con informacion para el usuario
            return response()->json(['Suscripcion creada exitosamente, te llegara un correo confirmando la suscripcion.', new SubscriptionResource($subscription)]);    
        }
    }

    public function destroy($subscription_id)
    {
        SubscriptionRecurrentTrie::where('subscription_id', $subscription_id)->delete(); // se eliminan los intentos de suscripcion del usuario escogido
        Recurrent::where('subscription_id', $subscription_id)->delete(); //se eliminan las recurrencias del usuario escogido
        Subscription::where('id', $subscription_id)->delete(); //se elimina a el usuario de la suscripcion

        return response()->json(['La suscripcion se elimino exitosamente, graicas por preferirnos.']);    

    }
}

