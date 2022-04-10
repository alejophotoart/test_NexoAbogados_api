<?php

use App\Http\Controllers\RecurrentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/', function () {
    if (Auth::check()) { //valida si el usuario esta en auth
        return redirect('/abogados');
    }else{
        return view('auth.login');
    }
});


Route::middleware(['auth'])->group(function () { //definimos el middleware de auth para que todo usuario que no este autenticado no le permita el ingreso asi ya conozca las url
    
    Route::get('/abogados', [UserController::class, 'index'])->name('users.index'); //Llama a la tabla de abogados

    Route::get('/suscripciones', [SubscriptionController::class, 'index'])->name('subscriptions.index'); //Llama a la tabla de suscripciones

    Route::get('/getPriceSubs', [SubscriptionController::class, 'getPriceSubs']); //Trae los precios de las suscripciones

    Route::get('/getDetaills/subscriptions/{id}', [SubscriptionController::class, 'getDetaill']); //Muestra el detalle de cada suscripcion

    Route::post('/suscribir', [SubscriptionController::class, 'create'])->name('subscribed.user'); //Guardar la suscripcion

    Route::delete('/suscripcion/eleminar', [SubscriptionController::class, 'destroy'])->name('subscription.delete'); //Elimina la suscripcion


    Route::get('/recurrencias', [RecurrentController::class, 'index'])->name('recurrents.index'); //trae informacion de recurrencias


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});