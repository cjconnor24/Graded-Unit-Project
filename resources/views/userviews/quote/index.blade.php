@extends('layouts.user_master')
@section('content')
    <h1>Quotations</h1>

    @if(count($quotations)>0)

    <p>Please find a list of quotations below</p>

    @include('includes.errors')

    <table class="table table-responsive">
        <thead>
        <tr>
            <th>Quote Reference</th>
            <th>Created</th>
            <th>Expiry Date</th>
            <th>Status</th>
            <th>Quote Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($quotations as $quotation)
            <tr>
                <td>{{$quotation->quote_number}}</td>
                <td>{{$quotation->created_at->diffForHumans()}}</td>
                <td>{{$quotation->created_at->addWeeks(4)->diffForHumans()}}</td>
                <td>{{$quotation->state->name}}</td>
                <td>£{{money_format('%.2n',$quotation->order_total)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{$quotations->links()}}

    @else

        <p><em>You don't have any outstanding quotations at the moment, {{Sentinel::getUser()->first_name}}.</em></p>

    @endif

@endsection