@extends('layouts.admin_master')
@section('content')
    <h1>Create New Product</h1>
    <p>Create new product below</p>

    @include('includes.errors')

    {!! Form::open(['action'=>'ProductsController@store']) !!}
@include('product.form')

    <div class="form-group">
        {!! Form::submit('Create Product',['class'=>'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}

    {{--<form action="/products" method="post" role="form">--}}

        {{--{{csrf_field()}}--}}

        {{--<div class="form-group">--}}
            {{--<label for="name">Name</label>--}}
            {{--<input type="text" class="form-control" id="name" name="name" value="" placeholder="Enter name">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="description">Description</label>--}}
            {{--<textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Please enter product description"></textarea>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--<label for="price">Price</label>--}}
            {{--<input type="text" class="form-control" id="price" name="price" placeholder="Enter price">--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--<label for="sizes" class="control-label">Sizes</label>--}}

                {{--<select class="form-control" id="sizes" name="sizes[]" multiple>--}}
                    {{--@foreach($sizes as $sid=>$size)--}}
                    {{--<option value="{{$sid}}">{{$size}}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}

        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--<label for="category" class="control-label">Category</label>--}}

                {{--<select class="form-control" name="category" id="category">--}}
                    {{--@foreach($categories as $cid=>$category)--}}
                        {{--<option value="{{$cid}}">{{$category}}</option>--}}
                        {{--@endforeach--}}
                {{--</select>--}}

        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<button type="submit" name="submit" class="btn btn-success">Add Product</button>--}}
        {{--</div>--}}

    {{--</form>--}}


@endsection