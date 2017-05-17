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

        dd($order);

        return $next($request);
    }
}
