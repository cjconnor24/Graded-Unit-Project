@extends('layouts.admin_master')
@section('content')

    <a class="btn btn-default" href="{{action('Admin\QuotationController@index')}}"><span class="fi-misc fi-misc-return"></span> Return to Quotes</a>


        <h1><span class="fi-shop-shopping-cart fi-shop"></span> Quotation {{$quotation->quote_number}}</h1>

    <div class="row row-eq-height">


    <div class="col-md-6 stretch col-flex">

        @include('userviews.components._customer',['customer'=>$quotation->customer,'address'=>$quotation->address])

        @component('components.panel')
            @slot('title')
                <span class="fi-misc fi-misc-settings"></span> Quote Management
                @endslot

                <a href="{{action('Admin\QuotationController@edit',['quotation'=>$quotation->id])}}" class="btn btn-lg btn-success btn-block"><span class="glyphicon glyphicon-edit"></span> Edit Quotation</a>
                <a href="#" class="btn btn-danger btn-group-sm btn-block"><span class="fi-misc-trash fi-misc"></span> Cancel Quotation</a>

        @endcomponent

    </div>

        <div class="col-md-6">

            @include('userviews.components._branch',['branch'=>$quotation->branch,'staff'=>$quotation->staff])

        </div>

    </div>

        @include('userviews.components._ordertable',['order'=>$quotation])



    <div class="col-md-6 col-md-offset-3">
        @include('userviews.components._notes',['order'=>$quotation])
    </div>

@endsection