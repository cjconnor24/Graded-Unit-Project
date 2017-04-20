@extends('layouts.admin_master')
@section('content')

    <h1>{{$customer->full_name}}</h1>
    <p>Registered {{$customer->created_at->diffForHumans() }}</p>
    <p><a href="mailto:{{$customer->email}}">{{$customer->email}}</a></p>

    <h2>{{$customer->full_name}}'s Addresses</h2>
    <p><a href="#" class="btn btn-sm btn-success"><span class="glyphicon-plus glyphicon"></span> Add New Address</a></p>

    @php($addresses = $customer->addresses)
    @if(count($addresses)>0)
    <div class="row">
    @include('user._addresses')
    </div>
    @else
        <p>{{$customer->first_name}} hasn't added any addresses yet.</p>
    @endif
@endsection