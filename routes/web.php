<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'], function(){
    Route::get('/apartment/search', 'ApartmentController@search')->name('apartment.search');
    Route::resource('apartment', 'ApartmentController');
    
    Route::prefix('/apartment/{apartment}')->group(function(){
        Route::get('/usingService/create', 'UsingServiceController@create')->name('usingService.create');
        Route::post('/usingService/{usingService}', 'UsingServiceController@store')->name('usingService.store');
        Route::delete('/usingService/{usingService}', 'UsingServiceController@destroy')->name('usingService.destroy');
    
        Route::post('/add/resident', 'ResidentController@store')->name('resident.store');
        Route::delete('/delete/resident', 'ResidentController@destroy')->name('resident.destroy');
    });

    

    Route::resource('user', 'UserController');

    Route::resource('service', 'ServiceController');
    
});

Auth::routes();