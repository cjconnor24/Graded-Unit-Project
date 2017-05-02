@extends('layouts.admin_master')
@section('content')

    <div class="row">

        <div class="col-md-6">
        <h1>{{$quotation->invoice_number}}</h1>
        </div>

        <div class="col-md-6">
        <div class="visible-print">
            <img src="{{asset('img/spectrum-logo.svg')}}" alt="" style="width:100%" />
            <p>Spectrum Digital Print Solutions <br>
            DIFC <br>
            Dubai <br>
            PO Box 482043</p>
        </div>
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
            <td>£00.00</td>
        </tr>
    </table>
    </div>
@endsection