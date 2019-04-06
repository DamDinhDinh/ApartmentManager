<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/login', 'API\UserController@login')->name('api.user.login');

Route::middleware('auth:api')->name('api.')->group(function (){
    Route::get('/user/index', 'API\UserController@index')->name('user.index');
    // Route::get('/user/{user}', 'API\UserController@show')->name('user.show');
    Route::post('/user', 'API\UserController@update')->name('user.update');
    Route::post('/user/logout', 'API\UserController@logout')->name('user.logout');
    Route::apiResource('apartment', 'API\ApartmentController');
});

