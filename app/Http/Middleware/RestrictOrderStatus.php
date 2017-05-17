<?php

namespace App\Http\Middleware;

use Closure;

class RestrictOrderStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $order = $request->route('order');
        $order->load('orderStatus');

        $currentStatus = $order->orderStatus;
        $newStatus = $request->route('status');

        if($currentStatus->name=='Completed'){
            return response()->json(['error'=>'Order is already complete'],500);
        } else {
            return $next($request);
        }

    }
}
