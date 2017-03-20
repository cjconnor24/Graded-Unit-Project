@extends('master')

@section('content')

    <form action="/sizes/create" method="post" role="form">
        {{csrf_field()}}
        <legend>Add New Size</legend>

        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Size name">
        </div>

        <div class="form-group">
            <label for="Length">Length</label>
            <input type="text" class="form-control" name="length" id="length" placeholder="Enter Length">
        </div>

        <div class="form-group">
            <label for="Width">Width</label>
            <input type="text" class="form-control" name="width" id="width" placeholder="Enter Width">
        </div>

        <div class="form-group">

                <button type="submit" class="btn btn-default" name="submit">Add Size</button>

        </div>

    </form>
@include('includes.errors')
@endsection