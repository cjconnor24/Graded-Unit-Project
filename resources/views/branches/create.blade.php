@extends('layouts.admin_master')
@section('content')
    <h1>Add New Branch</h1>

    @include('includes.errors')
    {!! Form::open(['action' => 'Admin\BranchController@store']) !!}

   @include('branches._form')


    {!! Form::submit('Add New Branch',['class'=>'btn btn-success']) !!}


    {!! Form::close() !!}

@endsection