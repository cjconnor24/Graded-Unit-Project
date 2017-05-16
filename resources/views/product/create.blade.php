@extends('layouts.admin_master')
@section('content')
    <h1><span class="fi-man-business-card fi-man"></span> Create New Product</h1>
    <p>Create new product below</p>

    @include('includes.errors')

    {!! Form::open(['action'=>'Admin\ProductsController@store']) !!}

@include('product.form')

    <div class="form-group">
        {!! Form::submit('Create Product',['class'=>'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}

@endsection