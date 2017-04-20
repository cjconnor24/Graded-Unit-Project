@extends('layouts.admin_master')
@section('content')

    <h1>Update Address</h1>
    <p>Please enter the details below to add the new address</p>
    {!! Form::model($address) !!}
        @include('user._form')
    {!! Form::submit('Add Address',['class'=>'btn btn-success']) !!}
    {!! Form::close() !!}

@endsection