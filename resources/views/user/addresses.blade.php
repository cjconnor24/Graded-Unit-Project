@extends('layouts.master')
@section('content')

    <h1>{{$user->first_name}} {{$user->last_name}}</h1>
    <p>{{$user->email}}</p>

    <p><a href="{{action('UserProfileController@createAddress')}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add New Address</a></p>

    <div class="panel-group">
    @foreach($addresses as $address)
        <div class="panel panel-default">

            <div class="panel-heading">
            {{$address->name}}
            </div>

            <div class="panel-body">
                <p>{{$address->address1}}<br />
                    {!!$address->address2 ?: '' !!}
                    {!!$address->address3 ?: '' !!}
                    {!!$address->address4 ?: '' !!}
                    {!!$address->postcode ?: '' !!}</p>
            </div>

            <div class="panel-footer">Panel Footer</div>

        </div>
    @endforeach
    </div>
@endsection