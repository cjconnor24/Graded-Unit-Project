@extends('master')
@section('content')
    
    <h1>Remove {{$size->name}}?</h1>

    <div class="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Are you sure?</strong> Are you sure you want to delete?
    </div>

@endsection