<?php

use Illuminate\Http\Request;
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

Route::post('login', 'Auth\LoginController@login')->name('api-login');

Route::middleware('auth:api')->group(function () {

    Route::post('firework/broadcast', 'FireworkController@broadcast')->name('firework-api-broadcast');

    Route::post('pusher/auth', 'PusherController@auth')->name('pusher-api-auth');

});
