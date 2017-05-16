@extends('layouts.user_master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

    @include('includes.errors')

<a href="{{action('UserOrderController@index')}}" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Return to Orders</a>



    <div class="row">

    <h1>{{$quotation->order_number}}</h1>

    </div>


    <div class="row row-eq-height">

        <div class="col-sm-4">
            @component('components.panel',['colour'=>$quotation->orderStatus->colour])
                @slot('title')
                    <span class="glyphicon glyphicon-shopping-cart"></span> Order Information
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
                    <span class="glyphicon glyphicon-credit-card"></span> Payments
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

            @component('components.panel')
            @slot('title')
            <span class="glyphicon glyphicon-user"></span> Customer Information
            @endslot
            <h4>{{$quotation->customer->first_name.' '.$quotation->customer->last_name}}</h4>
            <p>{!! str_replace(', ',',<br />',$quotation->address->full_address) !!}</p>
            @endcomponent

        </div>

        <div class="col-sm-4 stretch">

        @component('components.panel')

            @slot('title')
            <span class="flaticon-groceries-store"></span> Branch Information <i class="flaticon-airplane49"></i>
                <span class="flaticon-banknote"></span>
            @endslot

            <h4>Spectrum Contact</h4>
            <p>{{$quotation->staff->full_name}}<br /> <a class="btn btn-sm btn-info" href="mailto:{{$quotation->staff->email}}"><span class="glyphicon glyphicon-envelope"></span> E-Mail {{$quotation->staff->first_name}} </a></p>

            <h4>{{$quotation->branch->name}}</h4>
            <p>{!! str_replace(', ',',<br />',$quotation->branch->full_address) !!}</p>
            <p><a href="mailto:{{$quotation->branch->email}}">{{$quotation->branch->email}}</a><br />{{$quotation->branch->telephone}}</p>

        @endcomponent

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
        <tfoot>
        <tr>
            <td><strong>Payment Due</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Sub Total</strong></td>
            <td>£{{$quotation->order_total}}</td>
        </tr>
        </tfoot>
        <tbody>
        @foreach($quotation->OrderProducts as $line)
        <tr>
            <td>{{$line->product->name}}</td>
            <td>{{$line->paper->name}}</td>
            <td>{{$line->size->name}} <em>({{$line->size->height.' x '.$line->size->width}}mm)</em></td>
            <td>£{{$line->product->price}}</td>
            <td>{{$line->qty}}</td>
            <td>£{{$line->line_total}}</td>
        </tr>
        @endforeach
        </tbody>

    </table>


@endsection