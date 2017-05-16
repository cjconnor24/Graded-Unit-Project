@extends('layouts.admin_master')
@section('content')
    <h1>{{$order->order_number}}</h1>

    <div class="row row-eq-height">



        <div class="col-lg-3 col-md-6 stretch">

            @include('userviews.components._customer',['customer'=>$order->customer,'address'=>$order->address])

        </div>

        <div class="col-lg-3 col-md-6 ">
            @include('userviews.components._branch',['branch'=>$order->branch,'staff'=>$order->staff])
        </div>

        <div class="col-lg-3 col-md-6 stretch">


            <div class="panel panel-default">

                <div class="panel-heading">Order Information</div>
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::label('status_id',"Order Status") !!}
                        {!! Form::select('status_id',$statuses,$order->orderStatus->id,['class'=>'form-control']) !!}
                    </div>


                    <p><strong>Staff Member:</strong> {{$order->staff->full_name}}</p>
                    <p><strong>Order Place:</strong> {{$order->created_at->diffForHumans()}}</p>
                    <p><strong>Due Date:</strong> {{$order->due_date}}</p>
                    <p><strong>Status:</strong> {{$order->orderStatus->name}}</p>
                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 stretch">

            @component('components.panel',['colour'=>$order->orderStatus->colour])
                @slot('title')
                    <span class="fi-shop fi-shop-credit-card"></span> Payments
                @endslot

                @if(count($order->payments)>0)

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Payment Type</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($order->payments as $payment)
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

    </div>

    <h3>Order Details</h3>
    @include('userviews.components._ordertable',['order'=>$order])


@endsection