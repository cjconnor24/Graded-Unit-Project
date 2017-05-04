@extends('layouts.admin_master')
@section('content')
    <h1>Manage Quotations</h1>
    <p>Below are a list of quotations</p>

    @include('includes.errors')

    <p><a href="{{action('Admin\QuotationController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Create Quote</a></p>

    {{$quotations->links()}}

    <p>Showing {{count($quotations)}} of {{$quotations->total()}} Quotess</p>

    <table class="table table-responsive">
        <thead>
        <tr>
            <th>Quote Reference</th>
            <th class="hidden-xs">Customer</th>
            <th class="hidden-xs">Created</th>
            <th>Due Date</th>
            <th>Quote Total</th>
            <th>View</th>
        </tr>
        </thead>
        <tbody>
        @foreach($quotations as $quote)
        <tr>
            <td>{{$quote->quote_number}}</td>
            <td class="hidden-xs"><a href="{{action('Admin\CustomerController@show',['customer'=>$quote->customer->id])}}">{{$quote->customer->full_name}}</a></td>
            <td class="hidden-xs">{{$quote->created_at->diffForHumans()}}</td>
            <td>{{date('D d M Y',strtotime($quote->due_date))}}</td>
            <td>£{{money_format('%.2n',$quote->order_total)}}</td>
            <td><a href="{{action('Admin\QuotationController@show',['quotation'=>$quote->id])}}" class="btn btn-sm btn-default">View {{$quote->quote_number}}</a></td>
        </tr>
            @endforeach

        </tbody>
    </table>

    {{$quotations->links()}}
@endsection