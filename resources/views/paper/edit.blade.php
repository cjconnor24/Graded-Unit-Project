@extends('layouts.admin_master')
@section('content')
    <h1>Update Paper</h1>
    <p>Please update the paper stock below</p>
@include('includes.errors')

    <div class="col-md-8 col-md-offset-2">
        @component('components.panel')
            @slot('title')
                Update Paper
            @endslot

    {!! Form::model($paper,['action' => ['Admin\PaperController@update',$paper->id],'method'=>'PATCH']) !!}

        @include('paper.form')

    <div class="form-group">

    {!! Form::submit('Update Paper Stock',['class'=>'btn btn-success']) !!}
    </div>



    {!! Form::close() !!}
    @endcomponent
    </div>
@endsection