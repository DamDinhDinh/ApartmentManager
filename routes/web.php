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

    return redirect()->route('home');
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

    Route::get('/usingService/create', 'UsingServiceController@create')->name('usingService.create');
    Route::resource('usingService', 'UsingServiceController');

    Route::prefix('/usingService/{usingService}')->group(function (){
        Route::resource('/useData', 'UseDataController');
    });

    // Route::get('/dataTable/apartment', 'AJAX\ApartmentController@index')->name('ajax.apartment.index');
    Route::resource('/notification', 'NotificationController');

    Route::get('/bill/{bill}/payment', 'BillController@payment')->name('bill.payment');
    Route::put('/bill/{bill}/payment', 'BillController@paid')->name('bill.paid');
    Route::resource('/bill', 'BillController');


});

Auth::routes();
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
