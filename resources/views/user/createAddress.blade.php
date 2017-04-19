@extends('layouts.master')
@section('content')

    <h1>Add New Address</h1>
    <p>Please enter the details below to add the new address</p>
    {!! Form::open(['action' => 'UserProfileController@storeAddress']) !!}
        @include('user._form')
    {!! Form::submit('Add Address',['class'=>'btn btn-success']) !!}
    {!! Form::close() !!}

@endsection