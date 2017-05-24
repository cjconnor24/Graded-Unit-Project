@extends('layouts.admin_master')
@section('content')
    <h1>Edit Category</h1>
    <p>Please edit the category below</p>

    <div class="col-md-8 col-md-offset-2">
        @component('components.panel')
            @slot('title')
                Edit Category
            @endslot

    {!! Form::model($category, ['action' => ['Admin\CategoryController@update', $category->id],'method'=>'PATCH']) !!}
    <div class="form-group">
    {!! Form::label('name',"Category Name") !!}
    {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
    {!! Form::submit('Update Category',['class'=>'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}
    @endcomponent
    </div>
{{--    @include('includes.errors')--}}
@endsection