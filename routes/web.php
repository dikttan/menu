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

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('dashboard')->group(function() {
        Route::get('/','DashboardController@index')->name('dashboard.home');
        Route::get('/search', 'DashboardController@search')->name('dashboard.search');
        
        
    });

    Route::prefix('food')->group( function() {
        Route::get('/', 'FoodController@index')->name('food.dashboard');
        Route::get('/add_product', 'FoodController@add')->name('food.add');
        Route::post('/add_product/store', 'FoodController@store')->name('food.store');
        Route::get('/delete/{id}','FoodController@delete');
        Route::get('/edit/{id}','FoodController@edit');
        Route::put('/update/{id}','FoodController@update');
    });

    Route::prefix('drink')->group( function() {
        Route::get('/', 'DrinkController@index')->name('drink.dashboard');
        Route::get('/add_product', 'DrinkController@add')->name('drink.add');
        Route::post('/add_product/store', 'DrinkController@store')->name('drink.store');
        Route::get('/delete/{id}','DrinkController@delete');
        Route::get('/edit/{id}','DrinkController@edit');
        Route::put('/update/{id}','DrinkController@update');
    });
    
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

