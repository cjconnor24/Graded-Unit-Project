@extends('layouts.master')
@section('content')
    <h1>Manage Customers</h1>
    <p>Please find list of customers below</p>

    <p class="text-right"><em>Displaying {{count($customers)}} of {{$customers->total()}} customers</em></p>

    {{$customers->links()}}

    <table class="table table-responsive">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email Address</th>
            <th>Buttons</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $customer)
            <tr>
                <td>{{$customer->first_name}} {{$customer->last_name}}</td>
                <td>{{$customer->email}}</td>
                <td><a href="{{action('CustomerController@show',['customer'=>$customer->id])}}" class="btn btn-sm btn-success">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{$customers->links()}}


@endsection