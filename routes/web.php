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

    Route::get('/register','RegistrationController@create');
    Route::post('/register','RegistrationController@store');
    Route::get('/activate/{email}/{activationCode}','ActivationController@activate');

    /**
     * LOGIN ROUTES
     */
    Route::get('/login','LoginController@loginForm');
    Route::post('/login','LoginController@login');
    Route::get('/logout','LoginController@logout');

//Route::get('/forgot','ForgotPasswordController@forgotPassword');
    Route::post('/forgot','ForgotPasswordController@postForgotPassword');
    Route::get('/forgot','ForgotPasswordController@forgotPassword');

    Route::get('/reset/{user}/{resetCode}','ResetPasswordController@resetPassword');
    Route::post('/reset/{user}/{resetCode}','ResetPasswordController@postResetPassword');

Route::get('/home', 'HomeController@index');

/*
 * ADMIN ROUTES
 */
Route::get('/profile','UserProfileController@view')->middleware('authenticate');
Route::get('/profile/addresses','UserProfileController@viewAddresses')->middleware('authenticate');
Route::get('/profile/addresses/create','UserProfileController@createAddress')->middleware('authenticate');
Route::post('/profile/addresses/create','UserProfileController@storeAddress')->middleware('authenticate');

Route::group(['prefix' => 'admin','middleware'=>['authenticate']], function () {

    Route::resource('categories','CategoryController');
    Route::resource('products','ProductsController');
    Route::resource('sizes','SizesController');
    Route::resource('papers','PaperController');
    Route::resource('customers','CustomerController');

});