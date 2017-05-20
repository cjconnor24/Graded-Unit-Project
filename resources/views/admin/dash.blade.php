@extends('layouts.admin_master')
@section('content')
    <h1><span class="fi-man fi-man-folders"></span> Administration Home</h1>


    <div class="row">

        <div class="col-md-3">
            @component('components.dash-panel',[
'colour'=>'warning',
'icon'=>'fi-shop fi-shop-shopping-cart',
'count'=>$totals['quotes'],
'name'=>'Quotations',
'link'=>action('Admin\QuotationController@index')])
            @endcomponent
        </div>

        <div class="col-md-3">
            @component('components.dash-panel',[
'colour'=>'info',
'icon'=>'fi-shop-online-shop-1 fi-shop',
'count'=>$totals['orders'],
'name'=>'Orders',
'link'=>action('Admin\OrderController@index')])
            @endcomponent
        </div>

        <div class="col-md-3">
            @component('components.dash-panel',[
'colour'=>'danger',
'icon'=>'fi-misc-users fi-misc',
'count'=>$customers,
'name'=>'Customers',
'link'=>action('Admin\CustomerController@index')])
            @endcomponent
        </div>

    </div>


@endsection