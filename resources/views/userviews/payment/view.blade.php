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
    <h1>Payment for Order {{$order->order_number}}</h1>

    <p>Please enter your details below to complete the payment for {{$order->order_number}}</p>

    <form id="checkout" method="post" action="">



        <div class="panel panel-default">
            <div class="panel-heading">Payment Details Details</div>
            <div class="panel-body">

                <div id="payment-form"></div>

            </div>
        </div>

<button type="submit" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-gbp"></span> Pay Balance</button>
        {{--<input type="submit" class="btn btn-large btn-success" value="Pay Balance">--}}

    </form>

@endsection