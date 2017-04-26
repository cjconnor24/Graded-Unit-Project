@extends('layouts.admin_master')
@section('content')
    <h1>Edit {{$branch->name}} Branch</h1>

    {!! Form::model($branch,['action' => ['Admin\BranchController@update','branch'=>$branch->id],'method'=>'PATCH']) !!}

    @include('branches._form')

    {!! Form::submit('Update Branch',['class'=>'btn btn-']) !!}


    {!! Form::close() !!}

@endsection