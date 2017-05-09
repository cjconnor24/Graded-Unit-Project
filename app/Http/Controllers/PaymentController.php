<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function index(Order $order)
    {
        $order->load('customer','address');

//        return $order->address->toArray();
//        return response()->json($order);
        return view('userviews.payment.view')->with('order',$order);
    }

    public function checkout(Order $order, Request $request)
    {
        $order->load('customer','address');
        $customer = $order->customer;

        $address = $order->address->toArray();

//        dd($address);

        $nonceFromTheClient = $request->payment_method_nonce;


        $result = \Braintree_Transaction::sale([
            'amount' => $order->order_total,
            'orderId'=> "$order->id",
            'merchantAccountId' => 'gbp_account',
//            'customerId'=>$order->customer->id,
            'paymentMethodNonce' => $nonceFromTheClient,
            'customer' => [
                'firstName' => $customer->first_name,
                'lastName' => $customer->last_name,
                'phone' => '312-555-1234',
                'fax' => '312-555-1235',
                'email' => $customer->email
            ],
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

//        dd($result);
        $transaction = $result->transaction;
//        dd([$result,$transaction]);






        if($result->success){
            $order->payments()->create([
                'customer_id'=>$customer->id,
                'transaction_id'=>$transaction->id,
                'amount'=>$transaction->amount,
                'success'=>$result->success,
            ]);
            return response()->json($result);

        } else {

            return response()->json($result);

        }


    }

}
