@extends('layouts.admin_master')
@section('content')

    <h1><span class="fi-shop fi-shop-shopping-cart"></span> Manage Quotations</h1>
    <p>Below are a list of quotations</p>

    @include('includes.errors')

    <p><a href="{{action('Admin\QuotationController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Create Quote</a></p>

    @if($quotations->total()>0)

    {{$quotations->links()}}

    <p>Showing {{count($quotations)}} of {{$quotations->total()}} Quotess</p>

        @include('quote._quotelist')

    {{$quotations->links()}}

    @else

    <p><em>There are no quotations</em></p>

    @endif
@endsection