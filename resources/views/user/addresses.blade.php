@extends('layouts.admin_master')
@section('content')

    <h1>{{$user->first_name}} {{$user->last_name}}</h1>
    <p>{{$user->email}}</p>

    <p><a href="{{action('UserProfileController@createAddress')}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add New Address</a></p>

    @if(count($addresses)>0)
    @include('user._addresses')
    @else
        <p><em>You haven't added any addresses to your account yet. Click 'Add New Address' above to get started.</em></p>
    @endif
@endsection