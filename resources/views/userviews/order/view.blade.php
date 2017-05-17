@extends('layouts.user_master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

    @include('includes.errors')

<a href="{{action('UserOrderController@index')}}" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Return to Orders</a>



    <div class="row">

    <h1><span class="fi-shop-online-shop-1 fi-shop"></span> {{$quotation->order_number}}</h1>

    </div>


    <div class="row row-eq-height">

        <div class="col-sm-4 stretch col-flex">
            @component('components.panel',['colour'=>$quotation->orderStatus->colour])
                @slot('title')
                    <span class="fi-shop fi-shop-shopping-cart"></span> Order Information
                @endslot

                <table class="table">
                    <tr>
                        <td><strong>Date Approved</strong></td>
                        <td>{{$quotation->quoteApprovals->first()->updated_at}}</td>
                    </tr>

                    <tr>
                        <td><strong>Due Date</strong></td>
                        <td>{{$quotation->due_date}}</td>
                    </tr>
                    <tr>

                        <td><strong>Order Status</strong></td>
                        <td><span class="label label-{{$quotation->orderStatus->colour}}">{{$quotation->orderStatus->name}}</span><br />

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="progress">
                                <div class="progress-bar progress-bar-{{$quotation->orderStatus->colour}}" role="progressbar" aria-valuenow="{{$quotation->order_progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$quotation->order_progress}}%">
                                    <span class="sr-only">{{$quotation->orderStatus->name}}</span>
                                </div>
                            </div></td>
                    </tr>
                </table>

            @endcomponent


            @component('components.panel',['colour'=>$quotation->orderStatus->colour])
                @slot('title')
                    <span class="fi-shop fi-shop-credit-card"></span> Payments
                @endslot

                @if(count($quotation->payments)>0)

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Payment Type</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($quotation->payments as $payment)
                            <tr>
                                <td>{{$payment->created_at}}</td>
                                <td>£{{$payment->amount}}</td>
                                <td>{{ title_case(str_replace('_',' ',$payment->payment_type))}}</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>

                @else
                    <p class="text-center"><em>You haven't made any payments yet</em></p>
                    <p class="text-center"><a href="{{action('PaymentController@index',['order'=>$quotation->id])}}" class="btn btn-success"><span class="glyphicon glyphicon-credit-card"></span> Make Payment</a></p>
                @endif

            @endcomponent


        </div>

        <div class="col-sm-4 stretch">

            @include('userviews.components._customer',['customer'=>$quotation->customer,'address'=>$quotation->address])

        </div>

        <div class="col-sm-4 stretch">

            @include('userviews.components._branch',['staff'=>$quotation->staff,'branch'=>$quotation->branch])

        </div>

    </div>



    @include('userviews.components._ordertable',['order'=>$quotation])


@endsection