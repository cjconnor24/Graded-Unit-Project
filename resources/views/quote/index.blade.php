@extends('layouts.admin_master')
@section('content')
    <h1>Manage Quotations</h1>
    <p>Below are a list of quotations</p>

    @include('includes.errors')

    <p><a href="{{action('Admin\QuotationController@create')}}" class="btn btn-sm btn-success">Create Quote</a></p>

    <table class="table table-responsive">
        <thead>
        <tr>
            <th>Order Number</th>
            <th>Customer</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($quotations as $quote)
        <tr>
            <td>{{$quote->id}}</td>
            <td>{{$quote->customer->full_name}}</td>
            <td>{{$quote->created_at->diffForHumans()}}</td>
            <td>{{$quote->due_date}}</td>
        </tr>
            @endforeach

        </tbody>
    </table>

@endsection