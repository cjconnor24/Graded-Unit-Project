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
//Route::get('/register','RegistrationController@index');
Route::resource('registration','RegistrationController');
Route::get('/home', 'HomeController@index');

Route::resource('categories','CategoryController');
Route::resource('products','ProductsController');
Route::resource('sizes','SizesController');
Route::resource('papers','PaperController');