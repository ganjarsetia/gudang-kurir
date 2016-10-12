<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});


Auth::routes();

Route::group([ 'middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index');
	
	Route::group(['middleware' => 'role:gudang'], function() {
		Route::get('/home_gudang', 'orderController@index');
		Route::resource('orders', 'orderController');
	});

	Route::group(['middleware' => 'role:kurir'], function() {
		//Route::resource('orders', 'orderController');
		Route::get('/home_kurir', ['as' => 'list_new', 'uses' => 'orderController@list_new']);
		Route::get('list-new-order', ['as' => 'list_new', 'uses' => 'orderController@list_new']);
		Route::post('pick-order', ['as' => 'pick_order', 'uses' => 'orderController@pick_order']);
		Route::put('finish-order/{id}', ['as' => 'finish_order', 'uses' => 'orderController@finish_order']);
	});
});
