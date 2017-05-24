@extends('layouts.admin_master')
@section('content')
    <h1><span class="fi-misc-file fi-misc"></span> Add New Paper</h1>
    <p>Please add the new paper stock below</p>
@include('includes.errors')

    <div class="col-md-8 col-md-offset-2">
    @component('components.panel')
        @slot('title')
            Add New Paper
            @endslot
    {!! Form::open(['action' => 'Admin\PaperController@store']) !!}

        @include('paper.form')

    <div class="form-group">
    {!! Form::submit('Add Paper Stock',['class'=>'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}
    @endcomponent
    </div>
@endsection