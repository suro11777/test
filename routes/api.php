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

Route::post('login', 'Api\AuthController@login')->name('login');
Route::post('register', 'Api\AuthController@register')->name('register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'middleware' => ['admin'],
    'namespace' => "Api\Admin",
    'prefix' => 'admin'
], function () {
    Route::get('events', 'EventController@getAllEvents');

    Route::get('users', 'UserController@getAllUsers');
    Route::post('user/store', 'UserController@store');
    Route::put('user/update/{id}', 'UserController@update');
    Route::get('user/{id}', 'UserController@show');
    Route::delete('user/delete/{id}', 'UserController@delete');
});
