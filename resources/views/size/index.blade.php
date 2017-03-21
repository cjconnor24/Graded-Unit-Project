@extends('master')
@section('content')
<h1>Sizes</h1>
    <p>Below are a list of sizes</p>

<p><a href="/sizes/create" class="btn btn-success">Add New</a></p>

@if(count($sizes)>0)

<div class="col-md-6">
<table class="table table-responsive table-hover table-bordered">
<thead>
<tr>
    <th>Name</th>
    <th>Dimensions</th>
    <th>Edit</th>
    <th>Delete</th>
</tr>
</thead>
    <tbody>
@foreach ($sizes as $size)
    <tr>
        <td>{{$size->name}}</td>
        <td>{{$size->height}} x {{$size->width}}</td>
        <td><a href="/sizes/{{$size->id}}/edit"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
        <td><a href="#">Delete</a></td>
    </tr>

@endforeach
    </tbody>
</table>
</div>
    @else

    <p>There are no sizes added yet.</p>

    @endif

@endsection
