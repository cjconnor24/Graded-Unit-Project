@extends('layouts.admin_master')
@section('content')
    <h1><span class="fi-misc-file fi-misc"></span> Add New Paper</h1>
    <p>Please add the new paper stock below</p>
@include('includes.errors')
    {!! Form::open(['action' => 'Admin\PaperController@store']) !!}

        @include('paper.form')

    {!! Form::submit('Add Paper Stock',['class'=>'btn btn-success']) !!}

    {!! Form::close() !!}
@endsection