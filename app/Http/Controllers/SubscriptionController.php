<?php

namespace App\Http\Controllers;

use App\Events\Subscriptions\SubscriptionCreate;
use App\Http\Requests\SubscriptionRequest;
use App\Models\PriceSubscription;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function getPriceSubs()
    {

        $prices = PriceSubscription::where('active', 1)->select('id','price')->orderBy('price', 'asc')->get();
        return response(array('prices' => $prices));

    }

    public function create(SubscriptionRequest $request)
    {
        // dd($request->all());
        $validate = $request->validated();

        if( $validate == true ){
            $now = Carbon::now();
            $subscription = Subscription::create([
                'price_id'          => $request->subscriptionPrice,
                'confirmed'         => false,
                'date_subscription' =>  $now,
                'user_id'           => $request->id
            ]);
            
            event(new SubscriptionCreate($subscription));

            return redirect()->route('users.index')->with('warning','En un plazo de 30 min se enviara un email a '. $request->nameUser .' para confirmar la suscripcion.');
        }
    }

    public function index()
    {
        $subscriptions = Subscription::with(['user', 'price_subs'])->get();

        // dd($subscriptions);

        return view('subscriptions.index')->with('subscriptions', $subscriptions);
        
    }

    public function getDetaill($id)
    {
        $detaill = Subscription::where('id', $id)->with(['user', 'price_subs'])->first();

        return response(array('detaill' => $detaill));

    }

    public function destroy(Request $request)
    {
        Subscription::where('id', $request->id)->delete();

        return redirect()->route('subscriptions.index')->with('danger','La suscripcion de '. $request->name .' ha sido cancelada');

    }
}
