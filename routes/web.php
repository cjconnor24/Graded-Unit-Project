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
Route::get('/sizes/{size}/edit', 'SizesController@edit');
Route::get('/sizes/{size}', 'SizesController@show');
Route::patch('/sizes/{size}', 'SizesController@update');
Route::get('/sizes/{size}/remove', 'SizesController@delete');

/**
 * CATEGORY ROUTES
 */
Route::get('/categories','CategoryController@index');
Route::get('/categories/create','CategoryController@create');
Route::post('/categories','CategoryController@store');
Route::post('/categories/{category}','CategoryController@show');
