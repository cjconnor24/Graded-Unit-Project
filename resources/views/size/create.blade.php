@extends('layouts.admin_master')

@section('content')

    <h1><span class="fi-misc-layers fi-misc"></span> Add New Size</h1>
    <p>Please enter the details of the new size below.</p>

    <form action="{{ action('Admin\SizesController@store') }}" method="post" role="form">

        {{csrf_field()}}

        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Size name" required>
        </div>

        <div class="form-group">
            <label for="width">Width</label>
            <input type="text" class="form-control" id="width" name="width" placeholder="Enter width" required>
        </div>

        <div class="form-group">
            <label for="height">Height</label>
            <input type="text" class="form-control" id="height" name="height" placeholder="Enter height" required>
        </div>

        <div class="form-group">

            <button type="submit" class="btn btn-success" name="submit">Add Size</button>

        </div>

    </form>
@include('includes.errors')
@endsection