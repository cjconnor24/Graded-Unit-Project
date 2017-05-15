@extends('layouts.admin_master')
@section('content')
    <h1>{{$order->order_number}}</h1>

    <div class="row">



        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-home"></span> Customer Details</div>
                <div class="panel-body">
            <h3>{{$order->customer->full_name}}</h3>
            <p>{!! str_replace(', ',',<br />',$order->address->full_address) !!}</p>
                </div>
            </div>

        </div>

        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Branch Details</div>
                <div class="panel-body">
            <h3>{{$order->branch->name}}</h3>
            <p>{!! str_replace(', ',',<br />',$order->branch->full_address) !!}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">


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

        <div class="col-md-3">

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

    <table class="table table-responsive">

        <thead>
        <tr>
            <th>Product</th>
            <th>Paper</th>
            <th>Size</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Line Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->orderProducts as $line)
        <tr>
            <td>{{$line->product->name}}</td>
            <td>{{$line->paper->name}}</td>
            <td>{{$line->size->name}} <em></em></td>
            <td>{{$line->qty}}</td>
            <td>£{{$line->product->price}}</td>
            <td>£{{$line->line_total}}</td>
        </tr>
            @endforeach
        </tbody>

    </table>



@endsection