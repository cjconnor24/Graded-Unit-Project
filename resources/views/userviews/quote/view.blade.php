@extends('layouts.user_master')
@section('content')

    {{--@include('quote.create')--}}
    <h1>{{$quotation->quote_number}}</h1>

    <div class="row">

        <div class="col-md-6">
<h3>Customer</h3>
    <h4>{{$quotation->customer->first_name.' '.$quotation->customer->last_name}}</h4>
    <p>{!! str_replace(', ',',<br />',$quotation->address->full_address) !!}</p>

        </div>

        <div class="col-md-6">

            <h3>Branch Details</h3>
            <h4>{{$quotation->branch->name}}</h4>
            <p>{!! str_replace(', ',',<br />',$quotation->branch->full_address) !!}</p>

        </div>


    </div>

    <table class="table table-responsive">
        <thead>
        <tr>
            <th>Name</th>
            <th>Paper</th>
            <th>Size</th>
            <th>Cost</th>
            <th>Qty</th>
            <th>Line Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($quotation->OrderProducts as $line)
        <tr>
            <td>{{$line->product->name}}</td>
            <td>{{$line->paper->name}}</td>
            <td>{{$line->size->name}} <em>({{$line->size->height.' x '.$line->size->width}}mm)</em></td>
            <td>{{$line->product->price}}</td>
            <td>{{$line->qty}}</td>
            <td>{{$line->line_total}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>


@endsection