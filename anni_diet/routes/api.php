<?php

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

    Route::get('firework/all-not-triggered', 'FireworkController@allFireworksNotTriggered')
        ->name('firework-api-all-not-triggered');

    Route::post('pusher/auth', 'PusherController@auth')->name('pusher-api-auth');

    Route::get('protected-resource-test', 'CheckApiController@checkApiAccess')
        ->name('login-check-api-access');

});
