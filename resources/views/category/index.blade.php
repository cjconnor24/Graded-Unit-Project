@extends('layouts.admin_master')
@section('content')
    <h1><span class="fi-misc-inbox fi-misc"></span> Manage Categories</h1>
<p><a href="{{action('Admin\CategoryController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Create Category</a></p>
    <p>Manage categories below</p>

@if(count($categories)>0)
<div class="col-md-6">

    <div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Category Name</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{$category->name}}</td>
            <td><a href="{{action('Admin\CategoryController@edit',['category'=>$category->id])}}">Edit</a></td>
        </tr>
            @endforeach
        </tbody>
    </table>
    </div>

</div>
@else
<p>No categories added yet</p>
@endif


@endsection