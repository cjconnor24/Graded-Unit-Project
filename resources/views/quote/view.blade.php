@extends('layouts.admin_master')
@section('content')

    <div class="row">

        <div class="col-md-6">
        <h1>{{$quotation->quote_number}}</h1>
            <a class="btn btn-sm btn-default" href="{{action('Admin\QuotationController@index')}}">Return to Quotes</a> <a href="{{action('Admin\QuotationController@edit',['quotation'=>$quotation->id])}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-edit"></span> Edit Quotation</a>
        </div>

        <div class="col-md-6">
        <h2></h2>
        </div>

    </div>


    <div class="row">


    <div class="col-md-6">

        <h2>Customer Information</h2>
        <p>Below are the customer details</p>

        <h3>{{$quotation->customer->full_name}}</h3>
        <p><strong>{{$quotation->address->name}}</strong></p>
        <p>{{$quotation->address->address1}}<br>
        {{$quotation->address->address2}}<br>
        {{$quotation->address->address3}}<br>
        {{$quotation->address->address4}}<br>
        {{$quotation->address->postcode}}</p>

    </div>

        <div class="col-md-6">
            <h2>Branch Information</h2>
            <h3>{{$quotation->staff->full_name}}</h3>
            <p>{!! str_replace(',',',<br />',$quotation->branch->full_address)!!}</p>
        </div>

    </div>

    @include('quote._invoicetable')

    <div class="col-md-4 pull-right">
    <table class="table table-hover">
        <tr>
            <td><strong>Sub-Total</strong></td>
            <td>£00.00</td>
        </tr>
        <tr>
            <td><strong>Total</strong></td>
            <td>£{{$quotation->order_total}}</td>
        </tr>
    </table>
    </div>
@endsection