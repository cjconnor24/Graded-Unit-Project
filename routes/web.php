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
Route::group(['middleware'=>['authenticate','customer']], function(){

    Route::get('/profile','UserProfileController@view');
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

    Route::get('/payments/{order}','PaymentController@index')->middleware(['quote.owner','payment']);
    Route::post('/payments/{order}','PaymentController@checkout')->middleware('quote.owner');

});

/**
 * Adminisrator Routes
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
     * AJAX REPONSE FOR GETTING ADDRESSES
     */
    Route::get('ajax-address/{user}',function(\App\User $user, \Illuminate\Http\Request $request)
    {

        if($request->ajax()) {
            $addresses = $user->addresses;
            return Response::json($addresses);
        } else {
            abort(500);
        }

    });

    /**
     * AJAX REPONSE FOR GETTING CATEGORIES
     */
    Route::get('ajax-product/{category}',function(\App\Category $category, \Illuminate\Http\Request $request)
    {
        if($request->ajax()) {
            $products = $category->products;
            return Response::json($products);
        } else {
            abort(500);
        }
    });

    /**
     * AJAX RESPONSE FOR GETTING PRODUCTS
     */
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
    Route::post('orders/{order}/notes/add','OrderController@addNote');
    Route::post('orders/{order}/status/{status}','OrderController@updateStatus')->middleware('restrict.status.update');

    Route::resource('categories','CategoryController');
    Route::resource('products','ProductsController');
    Route::resource('sizes','SizesController');
    Route::resource('papers','PaperController');
    route::resource('customers','CustomerController');
    Route::resource('branches','BranchController');
    Route::resource('staff','StaffController');
    Route::post('staff/disable','StaffController@disabledUser');
    Route::post('staff/enable','StaffController@enableUser');
    Route::post('staff/role','StaffController@toggleRole');


    Route::get('reports/','ReportsController@index');
    Route::get('reports/customer','ReportsController@customer');
    Route::get('reports/pdf','ReportsController@downloadPDF');
    Route::get('reports/show','ReportsController@show');

    Route::get('reports/orders','ReportsController@orders');
    Route::post('reports/orders','ReportsController@ordersPost');

    Route::get('reports/customers','ReportsController@customers');
    Route::post('reports/customers','ReportsController@customersPost');

});