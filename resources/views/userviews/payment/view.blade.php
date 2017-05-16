@extends('layouts.user_master')
@section('scripts')
    <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
    <script>
        {{--braintree.setup("@braintreeClientToken", "<integration>", options);--}}

        braintree.setup("@braintreeClientToken", "dropin", {
            container: "payment-form"
        });

    </script>
    @endsection
@section('content')

    @include('includes.errors')

    <a href="{{action('UserOrderController@show',['order'=>$order->id])}}" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Return to Order View</a>

    <h1>Payment for Order {{$order->order_number}}</h1>

    <p>Please enter your details below to complete the payment for {{$order->order_number}}</p>



    <form id="checkout" method="post" action="">
        {!! Form::model($order,['action' => ['PaymentController@checkout','order'=>$order->id]]) !!}


        <div class="row row-eq-height">

        <div class="col-md-4 stretch">
        @component('components.panel')
            @slot('title')
                <span class="glyphicon-home glyphicon"></span> Delivery Address
                @endslot

                <div class="form-group">
                    {!! Form::label('first_name',"First Name") !!}
                    {!! Form::text('first_name',$order->customer->first_name,['class'=>'form-control','disabled']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('last_name',"Last Name") !!}
                    {!! Form::text('last_name',$order->customer->last_name,['class'=>'form-control','disabled']) !!}
                </div>


                {{--LOOP THROUGH ADDRESS LINES--}}
                @for($i=1; $i<=4; $i++)

                    <div class="form-group">
                        {!! Form::label('address'.$i,"Address ".$i) !!}
                        {!! Form::text('address'.$i,data_get($order,"address.address".$i),['class'=>'form-control','disabled','placeholder'=>'Address Line '.$i]) !!}
                    </div>

                @endfor

                <div class="form-group">
                    {!! Form::label('postcode',"Postcode") !!}
                    {!! Form::text('postcode',$order->address->postcode,['class'=>'form-control','disabled','placeholder'=>'Postcode ']) !!}
                </div>
            
            
            
            @endcomponent
        </div>

        <div class="col-md-4 stretch">
            @component('components.panel')
                @slot('title')
                   <span class="glyphicon glyphicon-usd"></span> Billing Address
                @endslot

                    <div class="form-group">
                        {!! Form::label('billing_first_name',"First Name") !!}
                        {!! Form::text('billing_first_name',$order->customer->first_name,['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('billing_last_name',"Last Name") !!}
                        {!! Form::text('billing_last_name',$order->customer->last_name,['class'=>'form-control']) !!}
                    </div>

                    {{--LOOP THROUGH ADDRESS LINES--}}
                    @for($i=1; $i<=4; $i++)

                        <div class="form-group">
                            {!! Form::label('billing_address'.$i,"Address ".$i) !!}
                            {!! Form::text('billing_address'.$i,data_get($order,"address.address".$i),['class'=>'form-control','placeholder'=>'Address Line '.$i]) !!}
                        </div>

                    @endfor

                    <div class="form-group">
                        {!! Form::label('billing_postcode',"Postcode") !!}
                        {!! Form::text('billing_postcode',$order->address->postcode,['class'=>'form-control','placeholder'=>'Postcode']) !!}
                    </div>



                @endcomponent
        </div>

            <div class="col-md-4 stretch">


                @component('components.panel')

                    @slot('title')
                        <span class="glyphicon-credit-card glyphicon"></span> Payment Details
                    @endslot

                <p>Please enter your payment details below, or select PayPal.</p>

                    <div id="payment-form"></div>

                @endcomponent

            </div>


        {{--<input type="submit" class="btn btn-large btn-success" value="Pay Balance">--}}
    </div>
        <button type="submit" class="btn btn-lg btn-success"><span class="glyphicon-credit-card glyphicon"></span> Pay £{{$order->order_total}} now.</button>
        <a href="{{action('UserOrderController@show',['order'=>$order->id])}}" class="btn btn-lg btn-default">Return to Order</a>

    {!! Form::close() !!}



@endsection