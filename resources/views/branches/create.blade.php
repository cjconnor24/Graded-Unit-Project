@extends('layouts.admin_master')
@section('content')
    <h1><span class="fi-shop fi-shop-shop"></span> Add New Branch</h1>

    @include('includes.errors')
    {!! Form::open(['action' => 'Admin\BranchController@store']) !!}



   @include('branches._form')
            {!! Form::submit('Add New Branch',['class'=>'btn btn-success']) !!}







    {!! Form::close() !!}

@endsection