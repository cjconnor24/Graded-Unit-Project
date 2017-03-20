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

Route::get('/home', 'HomeController@index');

/**
 * SIZE ROUTES
 */
Route::get('/sizes', 'SizesController@index');
Route::get('/sizes/create', 'SizesController@create');
Route::post('/sizes/create', 'SizesController@store');
Route::get('/sizes/{size}', 'SizesController@show.');