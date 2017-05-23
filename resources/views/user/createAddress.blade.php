@extends('layouts.user_master')
@section('content')

    <a href="{{action('AddressController@index')}}" class="btn btn-default"><span class="fi-misc-return fi-misc"></span> Return to Addresses</a>

    <h1><span class="fi-shop-placeholder fi-shop"></span>  Add New Address</h1>
    <p>Please enter the details below to add the new address</p>
    {!! Form::open(['action' => 'AddressController@store']) !!}

    <div class="col-md-8 col-md-offset-2">


@include('includes.errors')
        @component('components.panel')
            @slot('title')
               <span class="fi-shop-placeholder fi-shop"></span> Add New Address
            @endslot

                @include('user._form')


    <div class="form-group">
    {!! Form::submit('Add Address',['class'=>'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}

            @endcomponent

    </div>
@endsection