@extends('master')
@section('content')
<h1>Sizes {{$size->name}}</h1>

<p><a href="/sizes">Return to sizing menu</a></p>
    <p>Below are the details for this size</p>

    <p>{{$size->name}}<br />
    {{$size->width}} x {{$size->height}}</p>


@endsection