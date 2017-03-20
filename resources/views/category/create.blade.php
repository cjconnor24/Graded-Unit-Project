@extends('master')
@section('content')

    <h1>Create Category</h1>

    <form action="/categories" method="post" role="form">
        {{csrf_field()}}

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
        </div>

        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success">Add Category</button>
        </div>

    </form>
@include('includes.errors')
@endsection