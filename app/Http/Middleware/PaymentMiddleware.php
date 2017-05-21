<?php

namespace App\Http\Middleware;

use App\Order;
use Closure;

/**
 * Middleware to restrict access to the payment page if order is already paid.
 * Prevent overpaying.
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @package App\Http\Middleware
 */
class PaymentMiddleware
{
    /**
     * Handle an incoming request to ensure order isn't already paid
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $order = $request->route('order');
        $order->load('payments');

        if($order->payment_total == $order->order_total){

            return redirect()->action('UserOrderController@show',['order'=>$order->id])->with('success','Your order has already been paid.');

        } else {

            return $next($request);

        }



//        dd($order->payment_total);



    }
}
