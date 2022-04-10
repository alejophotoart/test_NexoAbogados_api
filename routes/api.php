<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PriceController;
use App\Http\Controllers\API\SubscriptionController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    
    Route::resource('/suscripcion', SubscriptionController::class);

    Route::get('/precios', [PriceController::class, 'index']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
