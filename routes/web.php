<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return 'on aime jean paul';
});


// Generate login, logout, password forgotten, ... routes
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/websocket', 'WebSocketController@getPage')->name('websocket-get-page');
});


