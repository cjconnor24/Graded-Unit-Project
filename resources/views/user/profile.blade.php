@extends('layouts.user_master')
@section('content')

    <h1>{{$user->first_name}} {{$user->last_name}}</h1>
    <p>{{$user->email}}</p>

    @include('includes.errors')

    <div class="row">

        <div class="col-md-3">
            @component('components.dash-panel',[
            'colour'=>'danger',
            'icon'=>'fi-man fi-man-job',
            'count'=>'&nbsp;',
            'name'=>'User Profile',
            'link'=>action('UserProfileController@edit')])
            @endcomponent
        </div>

        <div class="col-md-3">
            @component('components.dash-panel',[
            'colour'=>'warning',
            'icon'=>'fi-shop fi-shop-shopping-cart',
            'count'=>$totals['quotes'],
            'name'=>'Quotations',
            'link'=>action('UserQuotationController@index')])
            @endcomponent
        </div>

        <div class="col-md-3">
            @component('components.dash-panel',[
            'colour'=>'info',
            'icon'=>'fi-shop-online-shop-1 fi-shop',
            'count'=>$totals['orders'],
            'name'=>'Orders',
            'link'=>action('UserOrderController@index')])
            @endcomponent
        </div>

        <div class="col-md-3">
            @component('components.dash-panel',[
            'colour'=>'primary',
            'icon'=>'fi-shop-placeholder fi-shop',
            'count'=>$user->addresses->count(),
            'name'=>'Addresses',
            'link'=>action('AddressController@index')])
            @endcomponent
        </div>
    </div>



@endsection