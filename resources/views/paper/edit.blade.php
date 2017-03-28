@extends('master')
@section('content')
    <h1>Add New Paper</h1>
    <p>Please add the new paper stock below</p>
@include('includes.errors')
    {!! Form::model($paper,['action' => ['PaperController@update',$paper->id],'method'=>'PATCH']) !!}

        @include('paper.form')

    {!! Form::submit('Update Paper Stock',['class'=>'btn btn-success']) !!}

    {!! Form::close() !!}
@endsection