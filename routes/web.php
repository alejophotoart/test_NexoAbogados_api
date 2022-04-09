<?php

use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});


Route::get('/abogados', [UserController::class, 'index'])->name('users.index'); //Llama a la tabla de abogados

Route::get('/suscripciones', [SubscriptionController::class, 'index'])->name('subscriptions.index'); //Llama a la tabla de suscripciones

Route::get('/getPriceSubs', [SubscriptionController::class, 'getPriceSubs']); //Trae los precios de las suscripciones

Route::get('/getDetaills/subscriptions/{id}', [SubscriptionController::class, 'getDetaill']); //Muestra el detalle de cada suscripcion

Route::post('/suscribir', [SubscriptionController::class, 'create'])->name('subscribed.user'); //Guardar la suscripcion

Route::delete('/suscripcion/eleminar', [SubscriptionController::class, 'destroy'])->name('subscription.delete'); //Guardar la suscripcion


Route::get('/recurrencias', function () {
    return view('recurrents/index');
})->name('recurrents.index');
