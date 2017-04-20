@extends('layouts.admin_master')
@section('content')

    <form action="/sizes/{{$size->id}}" method="post" role="form">
        {{csrf_field()}}
        {{method_field('PATCH')}}
        <h1>TEST</h1>
        <h1>{{$size->name}}</h1>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$size->name}}" placeholder="Enter name">
        </div>

        <div class="form-group">
            <label for="height">Height</label>
            <input type="text" class="form-control" id="height" name="height" value="{{$size->height}}" placeholder="Enter height">
        </div>

        <div class="form-group">
            <label for="width">Width</label>
            <input type="text" class="form-control" id="width" name="width" value="{{$size->width}}" placeholder="Enter width">
        </div>

        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success">Update Size</button>
        </div>

    </form>
@include('includes.errors')
@endsection