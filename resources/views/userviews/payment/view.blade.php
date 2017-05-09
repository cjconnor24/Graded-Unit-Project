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
    <h1>Payment {{$order->order_number}}</h1>

    <p><strong>Total Due:</strong> {{$order->order_total}}</p>

    <form id="checkout" method="post" action="">
        <div id="payment-form"></div>
        <input type="submit" value="Pay £{{$order->order_total}}">
    </form>

@endsection