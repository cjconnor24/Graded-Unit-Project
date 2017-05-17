<?php

namespace App\Http\Middleware;

use Sentinel;
use Closure;

class CustomerMiddleware
{
    /**
     * Check to see if logged in user is a customer, if not, redirect.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(Sentinel::inRole('customer')) {
            return $next($request);
        } else {
            return redirect()->action('Admin\AdminController@index');
        }

    }
}