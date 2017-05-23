@extends('layouts.user_master')
@section('content')
    <h1><span class="fi-shop fi-shop-shopping-cart"></span> Quotations</h1>

    @if(count($quotations)>0)

    <p>Please find a list of quotationss below</p>

    @include('includes.errors')

    <div class="table-responsive">
    <table class="table table-hover">

        <thead>
        <tr>
            <th>Quote Reference</th>
            <th class="hidden-xs hidden-sm">Created</th>
            <th class="hidden-xs ">Expiry Date</th>
            <th>Status</th>
            <th>Quote Total</th>
            <th>View</th>
        </tr>
        </thead>

        <tbody>
        @foreach($quotations as $quotation)
            <tr>
                <td>{{$quotation->quote_number}}</td>
                <td class="hidden-xs hidden-sm">{{$quotation->created_at->diffForHumans()}}</td>
                <td class="hidden-xs">{{$quotation->created_at->addWeeks(4)->diffForHumans()}}</td>
                <td>{{$quotation->state->name}}</td>
                <td>£{{money_format('%.2n',$quotation->order_total)}}</td>
                <td><a class="btn btn-success" href="{{action('UserQuotationController@show',['quotation'=>$quotation->id])}}">View</a> </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    {{$quotations->links()}}

    @else

        <p><em>You don't have any outstanding quotations at the moment, {{Sentinel::getUser()->first_name}}.</em></p>

    @endif

@endsection