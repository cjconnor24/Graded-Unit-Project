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

Route::get('/home', 'HomeController@index');

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

/**
 * FORGOTTEN PASSWORD AND RESET ROUTES
 */
    Route::post('/forgot','ForgotPasswordController@postForgotPassword');
    Route::get('/forgot','ForgotPasswordController@forgotPassword');
    Route::get('/reset/{user}/{resetCode}','ResetPasswordController@resetPassword');
    Route::post('/reset/{user}/{resetCode}','ResetPasswordController@postResetPassword');

/*
 * ADMIN ROUTES
 */
Route::group(['middleware'=>'authenticate'], function(){

    Route::get('/profile','UserProfileController@view');
    Route::get('/profile/addresses','UserProfileController@viewAddresses');
    Route::get('/profile/addresses/{address}/edit','UserProfileController@editAddress')->middleware('address.owner');
    Route::get('/profile/addresses/create','UserProfileController@createAddress');
    Route::post('/profile/addresses/create','UserProfileController@storeAddress');

});

/**
 * Adminisrator Routes
 */

Route::group(['namespace'=>'Admin','prefix' => 'admin','middleware'=>['authenticate','admin']], function () {

    Route::get('quotations','QuotationController@index');
    Route::get('quotations/create','QuotationController@create');

    Route::get('ajax-address/{user}',function(\App\User $user, \Illuminate\Http\Request $request)
    {
        if($request->ajax()) {
            $addresses = $user->addresses;
            return Response::json($addresses);
        } else {
            abort(500);
        }
    });

    Route::resource('categories','CategoryController');
    Route::resource('products','ProductsController');
    Route::resource('sizes','SizesController');
    Route::resource('papers','PaperController');
    route::resource('customers','CustomerController');
    Route::resource('branches','BranchController');

});