@extends('layouts.user_master')
@section('content')

    @include('includes.errors')

    <h1><span class="fi-shop-placeholder fi-shop"></span> Manage Addresses</h1>


    <p><a href="{{action('AddressController@create')}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add New Address</a></p>

    @if(count($addresses)>0)
    @include('user._addresses')
    @else
        <p><em>You haven't added any addresses to your account yet. Click 'Add New Address' above to get started.</em></p>
    @endif
@endsection