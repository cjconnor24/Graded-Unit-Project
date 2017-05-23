@extends('layouts.admin_master')
@section('content')

    <a href="{{action('AddressController@index')}}" class="btn btn-default"><span class="fi-misc-return fi-misc"></span> Return to Addresses</a>

    <h1><span class="fi-shop-placeholder fi-shop"></span> Update Address</h1>
    <p>Please enter the details below to add the new address</p>

    <div class="col-md-8 col-md-offset-2">

        @component('components.panel')
            @slot('title')
                <span class="fi-shop-placeholder fi-shop"></span>Edit Address
                @endslot
    {!! Form::model($address,['action'=>['AddressController@update','address'=>$address],'method'=>'PATCH']) !!}
        @include('user._form')
    {!! Form::submit('Edit Address',['class'=>'btn btn-success']) !!}
    {!! Form::close() !!}
            @endcomponent

    </div>

@endsection