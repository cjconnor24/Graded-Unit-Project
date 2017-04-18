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

/**
 * REGISTRATION ROUTES
 */
Route::get('/register','RegistrationController@index');
Route::post('/register','RegistrationController@store');
Route::get('/activate/{email}/{activationCode}','ActivationController@activate');

/**
 * LOGIN ROUTES
 */
Route::get('/login','LoginController@loginForm');
Route::post('/login','LoginController@login');
Route::get('/logout','LoginController@logout');

Route::get('/forgot','ForgotPasswordController@forgotPassword');
Route::post('/forgot','ForgotPasswordController@postForgotPassword');

Route::get('/reset/{user}/{resetCode}','ResetPasswordController@resetPassword');
Route::post('/reset/{user}/{resetCode}','ResetPasswordController@postResetPassword');



Route::get('/home', 'HomeController@index');

Route::resource('categories','CategoryController');
Route::resource('products','ProductsController');
Route::resource('sizes','SizesController');
Route::resource('papers','PaperController');