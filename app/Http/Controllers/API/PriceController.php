<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PriceResource;
use App\Models\PriceSubscription;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $prices = PriceSubscription::where('active', 1)->select('id','price')->orderBy('price', 'asc')->get(); //Se consultan los precios de suscripciones

        return response()->json([PriceResource::collection($prices), 'Esto son los precios de suscripcion']);

    }
}
