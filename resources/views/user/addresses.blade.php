@extends('layouts.master')
@section('content')

    <h1>{{$user->first_name}} {{$user->last_name}}</h1>
    <p>{{$user->email}}</p>

    <p><a href="{{action('UserProfileController@createAddress')}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add New Address</a></p>

    @include('user._addresses')

@endsection