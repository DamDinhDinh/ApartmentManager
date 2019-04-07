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
    Route::resource('apartment', 'ApartmentController');
    Route::delete('/apartment/{apartment}/remove/resident/{user}', 'ApartmentController@removeResident')->name('apartment.removeResident');
    Route::get('/apartment/{apartment}/add/service', 'ApartmentController@addResident')->name('apartment.addResident');
    Route::get('/apartment/{apartment}/add/resident', 'ApartmentController@addService')->name('apartment.addService');
    Route::delete('/apartment/{apartment}/remove/service/{service}', 'ApartmentController@removeService')->name('apartment.removeService');


    Route::resource('user', 'UserController');

    Route::resource('service', 'ServiceController');
    
});

Auth::routes();