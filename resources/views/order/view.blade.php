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

            <div class="panel panel-default">

                <div class="panel-heading">Payments</div>

                <div class="panel-body">

                    @if(count($order->payments)>0)

                        <h3>Payments</h3>

                        @foreach($order->payments as $payment )

                            <p>{{$order->created_at->diffForHumans()}} {{$payment->amount}} {{$payment->payment_type}}</p>

                            @endforeach

                        @endif

                </div>

            </div>

        </div>

    </div>

    <h3>Order Details</h3>
    @include('userviews.components._ordertable',['order'=>$order])


@endsection