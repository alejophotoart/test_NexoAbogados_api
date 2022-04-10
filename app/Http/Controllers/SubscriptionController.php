<?php

namespace App\Http\Controllers;

use App\Events\Subscriptions\SubscriptionCreate;
use App\Http\Requests\SubscriptionRequest;
use App\Models\PriceSubscription;
use App\Models\Recurrent;
use App\Models\Subscription;
use App\Models\SubscriptionRecurrentTrie;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function getPriceSubs()
    {

        $prices = PriceSubscription::where('active', 1)->select('id','price')->orderBy('price', 'asc')->get(); //Se consultan los precios de suscripciones
        return response(array('prices' => $prices)); //enviar la informacion de la consulta a la vista atravez de ajax

    }

    public function create(SubscriptionRequest $request)
    {
        // dd($request->all());
        $validate = $request->validated(); //Validaciones de creacion de suscripcion

        if( $validate == true ){
            $now = Carbon::now(); //Se establece con la libreria carbon la fecha de hoy
            $subscription = Subscription::create([ //Se crea la suscripcion y se guarda en la DB
                'price_id'          => $request->subscriptionPrice,
                'confirmed'         => false,
                'date_subscription' =>  $now,
                'user_id'           => $request->id
            ]);
            
            event(new SubscriptionCreate($subscription)); //Se envia a el evento para que ejecute el listener y haga el envio de los correos

            //Se envia un mensaje a la vista con informacion para el usuario
            return redirect()->route('users.index')->with('warning','En un plazo de 30 min se enviara un email a '. $request->nameUser .' para confirmar la suscripcion.');
        }
    }

    public function index()
    {
        $subscriptions = Subscription::with(['user', 'recurrent', 'price_subs', 'subs_rec_trie'])->get(); // se consulta la tabla suscripciones

        // dd($subscriptions);

        return view('subscriptions.index')->with('subscriptions', $subscriptions); //enviar la informacion de la consulta a la vista
        
    }

    public function getDetaill($id)
    {
        $detaill = Subscription::where('id', $id)->with(['user', 'price_subs'])->first(); //Se consultan los detalle de cada suscripcion

        return response(array('detaill' => $detaill)); ////enviar la informacion de la consulta a la vista a travez de ajax

    }

    public function destroy(Request $request)
    {
        SubscriptionRecurrentTrie::where('subscription_id', $request->id)->delete(); // se eliminan los intentos de suscripcion del usuario escogido
        Recurrent::where('subscription_id', $request->id)->delete(); //se eliminan las recurrencias del usuario escogido
        Subscription::where('id', $request->id)->delete(); //se elimina a el usuario de la suscripcion

        

        return redirect()->route('subscriptions.index')->with('danger','La suscripcion de '. $request->name .' ha sido cancelada'); //Se envia un mensaje a la vista con informacion para el usuario

    }
}
