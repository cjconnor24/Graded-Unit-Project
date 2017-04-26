@extends('layouts.admin_master')
@section('content')

    <h1>Create Category</h1>
<p>Please add the category below</p>
    {!! Form::open(['action' => 'Admin\CategoryController@store']) !!}
    <div class="form-group">
        {!! Form::label('name',"Category Name") !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
    {!! Form::submit('Add Category',['class'=>'btn btn-success']) !!}
    {!! Form::close() !!}

    </form>
@include('includes.errors')
@endsection