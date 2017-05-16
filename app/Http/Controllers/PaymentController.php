<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{


    public function index(Order $order)
    {
        $order->load('customer','address');
        return view('userviews.payment.view')->with('order',$order);
    }

    public function checkout(Order $order, Request $request)
    {
        $order->load('customer','address');
        $customer = $order->customer;

        $address = $order->address->toArray();

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
                'phone' => $customer->telephone,
                'email' => $customer->email
            ],
            'billing'=> [
                'firstName' => $request->billing_first_name,
                'lastName' => $request->billing_last_name,
                'streetAddress' => $request->billing_address1,
                'postalCode' => $request->billing_postcode
            ],
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        $transaction = $result->transaction;

        // LOG TO FILE FOR TESTING PURPOSES
        Log::info([
            'transactionData'=>$transaction,
            'result'=>$result
        ]);


        if($result->success){

            $order->payments()->create([
                'customer_id'=>$customer->id,
                'transaction_id'=>$transaction->id,
                'payment_type'=>$transaction->paymentInstrumentType,
                'amount'=>$transaction->amount,
                'success'=>$result->success,
            ]);

            $status = OrderStatus::where('name','LIKE','%Artworker%')->first();
            $order->orderStatus()->associate($status);
            $order->save();

            return response()->json($result);

        } else {

            return response()->json($result);

        }

    }

}
