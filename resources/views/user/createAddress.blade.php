@extends('layouts.user_master')
@section('content')

    <h1>Add New Address</h1>
    <p>Please enter the details below to add the new address</p>
    {!! Form::open(['action' => 'UserProfileController@storeAddress']) !!}
        @include('user._form')
    <div class="form-group">
    {!! Form::submit('Add Address',['class'=>'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}

@endsection