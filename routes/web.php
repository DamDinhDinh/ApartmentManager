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
        Route::prefix('/add')->group(function (){
            Route::post('/resident', 'ResidentController@store')->name('resident.store');
            Route::post('/usingService', 'UsingServiceController@store')->name('usingService.store');
        });

        Route::prefix('/delete')->group(function (){
            Route::delete('/resident', 'ResidentController@destroy')->name('resident.destroy');
            Route::delete('/usingService', 'UsingServiceController@destroy')->name('usingService.destroy');
        });
    });

    Route::get('/user/search', 'UserController@search')->name('user.search');
    Route::resource('user', 'UserController');
    
    Route::get('/service/search', 'ServiceController@search')->name('service.search');
    Route::resource('service', 'ServiceController');

    Route::get('/usingService', 'UsingServiceController@index')->name('usingService.index');
    Route::get('/usingService/show/{id}', 'UsingServiceController@show')->name('usingService.show');
    Route::get('/usingService/create', 'UsingServiceController@create')->name('usingService.create');
    Route::post('/usingService', 'UsingServiceController@store')->name('usingService.store1');
    
});

Auth::routes();