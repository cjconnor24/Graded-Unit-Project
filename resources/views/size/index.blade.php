@extends('master')
@section('content')
<h1>Sizes</h1>
    <p>Below are a list of sizes</p>

<p><a href="/sizes/create" class="btn btn-success">Add New</a></p>

<ul>

@foreach ($sizes as $size)
        <li><a href="/sizes/{{$size->id}}">{{$size->name}}</a></li>
@endforeach
</ul>
@endsection