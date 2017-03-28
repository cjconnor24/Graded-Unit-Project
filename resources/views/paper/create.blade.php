@extends('master')
@section('content')
    <h1>Add New Paper</h1>
    <p>Please add the new paper stock below</p>
@include('includes.errors')
    {!! Form::open(['action' => 'PaperController@store']) !!}

        @include('paper.form')

    {!! Form::submit('Add Paper Stock',['class'=>'btn btn-success']) !!}

    {!! Form::close() !!}
@endsection