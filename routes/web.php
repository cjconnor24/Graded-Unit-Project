<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| ALL ROUTES TO APPLICATION ARE REGISTERED HERE
|
*/

Route::get('/', function () {
    return redirect()->action('LoginController@loginForm');
});

Route::group(['middleware'=>'guest'], function() {

    /**
     * REGISTRATION ROUTES
     */
    Route::get('/register', 'RegistrationController@create');
    Route::post('/register', 'RegistrationController@store');
    Route::get('/activate/{email}/{activationCode}', 'ActivationController@activate');

    /**
     * LOGIN ROUTES
     */
    Route::get('/login', 'LoginController@loginForm');
    Route::post('/login', 'LoginController@login');

    /**
     * FORGOTTEN PASSWORD AND RESET ROUTES
     */
    Route::post('/forgot', 'ForgotPasswordController@postForgotPassword');
    Route::get('/forgot', 'ForgotPasswordController@forgotPassword');
    Route::get('/reset/{user}/{resetCode}', 'ResetPasswordController@resetPassword');
    Route::post('/reset/{user}/{resetCode}', 'ResetPasswordController@postResetPassword');

});

Route::get('/logout', 'LoginController@logout');

/*
 * CUSTOMER ROUTES
 */
Route::group(['middleware'=>['authenticate','customer']], function(){

    Route::get('/dashboard','PagesController@dashboard');

    Route::get('/profile','UserProfileController@view');
    Route::get('/profile/edit','UserProfileController@edit');
    Route::patch('profile/edit','UserProfileController@update');

    Route::resource('/addresses','AddressController');

    Route::get('/profile/addresses','UserProfileController@viewAddresses');
    Route::get('/profile/addresses/{address}/edit','UserProfileController@editAddress')->middleware('address.owner');
    Route::get('/profile/addresses/create','UserProfileController@createAddress');
    Route::post('/profile/addresses/create','UserProfileController@storeAddress');

    // USER QUOTATION CONTROLLER
    Route::get('/quotations/approve/{quotation}/{token}','UserQuotationController@approveQuotation')->middleware('quote.owner');
    Route::get('/quotations/reject/{quotation}/{token}','UserQuotationController@show')->middleware('quote.owner')->name('reject');
    Route::post('/quotations/reject/{quotation}','UserQuotationController@rejectQuotation')->middleware('quote.owner');
    Route::get('/quotations','UserQuotationController@index');
    Route::get('/quotations/{quotation}','UserQuotationController@show')->middleware('quote.owner');;

    // HISTORY
    Route::get('/history','HistoryController@index');

    // ORDERS
    Route::get('/orders','UserOrderController@index');
    Route::get('/orders/{order}','UserOrderController@show')->middleware('quote.owner');
    Route::post('/orders/{order}/cancel','UserOrderController@cancellation')->middleware('quote.owner');

    Route::get('/payments','PaymentController@list');
    Route::get('/payments/{order}','PaymentController@index')->middleware(['quote.owner','payment']);
    Route::post('/payments/{order}','PaymentController@checkout')->middleware('quote.owner');

});

/**
 * STAFF ROUTES
 */

Route::group(['namespace'=>'Admin','prefix' => 'admin','middleware'=>['authenticate','staff']], function () {

    Route::get('/','AdminController@index');

    Route::get('quotations','QuotationController@index');
    Route::get('quotations/create','QuotationController@create');
    Route::post('quotations/','QuotationController@store');
    Route::get('quotations/{quotation}','QuotationController@show');
    Route::get('quotations/{quotation}/edit','QuotationController@edit');

    Route::patch('quotations/{quotation}/edit','QuotationController@update');

    Route::get('orders/','OrderController@index');

    /**
     ** AJAX ROUTES FOR QUOTE BUILDER **
     */
    Route::get('customers/{user}/addresses','CustomerController@getAddresses');
    Route::get('categories/{category}/products','CategoryController@getProducts');
    Route::get('products/{product}/options','ProductsController@getOptions');


    // ORDER NOTE LOGIC
    Route::post('orders/{order}/notes/add','OrderController@addNote');
    Route::post('orders/{order}/status/{status}','OrderController@updateStatus')->middleware('restrict.status.update');

    // RESOURCE CONTROLLERS
    Route::resource('orders','OrderController');
    Route::resource('categories','CategoryController');
    Route::resource('products','ProductsController');
    Route::resource('sizes','SizesController');
    Route::resource('papers','PaperController');
    route::resource('customers','CustomerController');
    Route::resource('branches','BranchController');




    // RESTRICT REPORTING TO ADMIN ROLE ONLY
    Route::group(['middleware'=>['admin']], function ()
    {

        // STAFF LOGIC
        Route::resource('staff','StaffController');
        Route::post('staff/disable','StaffController@disabledUser');
        Route::post('staff/enable','StaffController@enableUser');
        Route::post('staff/role','StaffController@toggleRole');

        // REPORTING LOGIC
        Route::get('reports/', 'ReportsController@index');
        Route::get('reports/customer', 'ReportsController@customer');
        Route::get('reports/pdf', 'ReportsController@downloadPDF');
        Route::get('reports/show', 'ReportsController@show');
        Route::get('reports/orders', 'ReportsController@orders');
        Route::post('reports/orders', 'ReportsController@ordersPost');

        Route::get('reports/customers', 'ReportsController@customers');
        Route::post('reports/customers', 'ReportsController@customersPost');

    });

});