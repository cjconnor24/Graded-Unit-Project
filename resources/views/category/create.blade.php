@extends('layouts.admin_master')
@section('content')

    <h1><span class="fi-misc-inbox fi-misc"></span> Create Category</h1>
<p>Please add the category below</p>
    {!! Form::open(['action' => 'Admin\CategoryController@store']) !!}
    <div class="form-group">
        {!! Form::label('name',"Category Name") !!}
        {!! Form::text('name',null,['class'=>'form-control','required']) !!}
    </div>
    {!! Form::submit('Add Category',['class'=>'btn btn-success']) !!}
    {!! Form::close() !!}

    </form>
@include('includes.errors')
@endsection