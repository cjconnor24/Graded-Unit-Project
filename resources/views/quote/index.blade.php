@extends('layouts.admin_master')
@section('content')
    <h1>Manage Quotations</h1>
    <p>Below are a list of quotations</p>

    <p><a href="{{action('Admin\QuotationController@create')}}" class="btn btn-sm btn-success">Create Quote</a></p>

    @if(count($quotations)==0)
        <p><em>There are currently no quotations</em></p>
    @else

        @foreach($quotations as $quote)
            <p>{{$quote->id}}</p>
        @endforeach

    @endif
@endsection