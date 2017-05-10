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
//    return view('welcome');
    return redirect()->action('LoginController@loginForm');
});

Route::get('/home', 'HomeController@index');

Route::get('/dashboard','PagesController@dashboard');
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

    // USER QUOTATION CONTROLLER
    Route::get('/quotations/approve/{quotation}/{token}','UserQuotationController@approveQuotation')->middleware('quote.owner');
    Route::post('/quotations/reject/{quotation}','UserQuotationController@rejectQuotation')->middleware('quote.owner');
    Route::get('/quotations','UserQuotationController@index');
    Route::get('/quotations/{quotation}','UserQuotationController@show')->middleware('quote.owner');;

    // HISTORY
    Route::get('/history','HistoryController@index');

    // ORDERS
    Route::get('/orders','UserOrderController@index');
    Route::get('/orders/{order}','UserOrderController@show');

    Route::get('/payments/{order}','PaymentController@index');
    Route::post('/payments/{order}','PaymentController@checkout');

});

/**
 * Adminisrator Routes
 */

Route::group(['namespace'=>'Admin','prefix' => 'admin','middleware'=>['authenticate','admin']], function () {

    Route::get('/','AdminController@index');

    Route::get('quotations','QuotationController@index');
    Route::get('quotations/create','QuotationController@create');
    Route::post('quotations/','QuotationController@store');
    Route::get('quotations/{quotation}','QuotationController@show');

    Route::get('orders/','OrderController@index');

    Route::get('ajax-address/{user}',function(\App\User $user, \Illuminate\Http\Request $request)
    {

        if($request->ajax()) {
            $addresses = $user->addresses;
            return Response::json($addresses);
        } else {
            abort(500);
        }

    });

    Route::get('ajax-product/{category}',function(\App\Category $category, \Illuminate\Http\Request $request)
    {
        if($request->ajax()) {
            $products = $category->products;
            return Response::json($products);
        } else {
            abort(500);
        }
    });

    Route::get('ajax-product-options/{product}',function(\App\Product $product, \Illuminate\Http\Request $request)
    {
        if($request->ajax()) {
        $papers = $product->papers->pluck('name','id');
        $sizes = $product->sizes->pluck('name','id');
        $price = $product->price;
        return Response::json(['papers'=>$papers,'sizes'=>$sizes,'price'=>$price]);
        } else {
            abort(500);
        }
    });

    Route::resource('orders','OrderController');

    Route::resource('categories','CategoryController');
    Route::resource('products','ProductsController');
    Route::resource('sizes','SizesController');
    Route::resource('papers','PaperController');
    route::resource('customers','CustomerController');
    Route::resource('branches','BranchController');

});