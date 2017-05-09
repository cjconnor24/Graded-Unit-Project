<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function index(Order $order)
    {

        return view('userviews.payment.view')->with('order',$order);
    }

    public function checkout(Order $order, Request $request)
    {
        $nonceFromTheClient = $request->payment_method_nonce;


        $result = \Braintree_Transaction::sale([
            'amount' => $order->order_total,
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        return response()->json($result);
    }

}
