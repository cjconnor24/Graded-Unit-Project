<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Middleware to restrict when changing the status of an order.
 *
 * The status may not be updated if the order is already set as completed.
 * @package App\Http\Middleware
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class RestrictOrderStatus
{
    /**
     * Handle an incoming request and ensure that order isn't already complete.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // GET ORDER AND EAGER LOAD THE STATUS
        $order = $request->route('order');
        $order->load('orderStatus');

        $currentStatus = $order->orderStatus;
        $newStatus = $request->route('status');

        // CHECK ISN"T COMPLETE
        if($currentStatus->name=='Completed'){
            return response()->json(['error'=>'Order is already complete'],500);
        } else {
            return $next($request);
        }

    }
}
