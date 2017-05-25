<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderStatus;
use Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Payment controller to manage payments within application
 * @package App\Http\Controllers
 * @author Chris Connor <chris@chrisconnor.co.uk>
 *
 * @todo Build refund functionality
 */
class PaymentController extends Controller
{

    /**
     * Get payment list for logged in user.
     *
     * @return $payments
     */
    public function list()
    {
        $payments = Sentinel::getUser()->payments;
        return $payments;
    }

    /**
     * Display the payment window
     *
     * Get the billing and delivery addresses to be process. Also gets the Braintree Payment Nonce
     * @param Order $order
     * @return $this
     */
    public function index(Order $order)
    {
        $order->load('customer','address');
        return view('userviews.payment.view')->with('order',$order);
    }

    /**
     * Process the payment and details
     *
     * Takes the address and customer information and passes this all through to Braintree
     * as a sales transaction
     * @param Order $order
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkout(Order $order, Request $request)
    {
        $this->validate($request, [
            'billing_first_name'=>'required',
            'billing_last_name'=>'required',
            'billing_address1'=>'required',
            'billing_postcode'=>'required'
        ]);

        $order->load('customer','address');
        $customer = $order->customer;

        $address = $order->address->toArray();

        $nonceFromTheClient = $request->payment_method_nonce;


        /**
         * BUILD THE BRAINTREE TRANSACTION
         */
        $result = \Braintree_Transaction::sale([
            'amount' => $order->order_total,
            'orderId'=> "$order->id",
            'merchantAccountId' => 'gbp_account',
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


        // CHECK TO SEE IF THE RESULT WAS SUCCESSFUL
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

            return redirect()->action('UserOrderController@show',['order'=>$order->id])->with(['success'=>'Your payment was accepted','notification'=>true]);

        } else {

            return back()->with('error',$result->message);

        }

    }

}
