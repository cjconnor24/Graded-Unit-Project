@extends('layouts.admin_master')
@section('content')
    <h1>Edit Category</h1>
    <p>Please edit the category below</p>

    {!! Form::model($category, ['action' => ['Admin\CategoryController@update', $category->id],'method'=>'PATCH']) !!}
    <div class="form-group">
    {!! Form::label('name',"Category Name") !!}
    {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
    {!! Form::submit('Update Category',['class'=>'btn btn-success']) !!}
    {!! Form::close() !!}
    @include('includes.errors')
@endsection