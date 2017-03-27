@extends('master')
@section('content')

    <h1>Create Category</h1>
<p>Please add the category below</p>
    {!! Form::open(['action' => 'CategoryController@store']) !!}
    <div class="form-group">
        {!! Form::label('name',"Category Name") !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
    {!! Form::submit('Add Category',['class'=>'btn btn-success']) !!}
    {!! Form::close() !!}

    {{--<form action="/categories" method="post" role="form">--}}
        {{--{{csrf_field()}}--}}

        {{--<div class="form-group">--}}
            {{--<label for="name">Name</label>--}}
            {{--<input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--<button type="submit" name="submit" class="btn btn-success">Add Category</button>--}}
        {{--</div>--}}

    </form>
@include('includes.errors')
@endsection