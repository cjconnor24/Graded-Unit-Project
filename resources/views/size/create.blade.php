@extends('master')

@section('content')

    <form action="/sizes/create" method="post" role="form">
        {{csrf_field()}}
        <legend>Add New Size</legend>

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

                <button type="submit" class="btn btn-default" name="submit">Add Size</button>

        </div>

    </form>
@include('includes.errors')
@endsection