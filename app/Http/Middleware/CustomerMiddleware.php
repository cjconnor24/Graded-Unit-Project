<?php

namespace App\Http\Middleware;

use Sentinel;
use Closure;

/**
 * Middleware to restrict access to customer pages. User must have customer role to access.
 * @package App\Http\Middleware
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
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
            return redirect()->action('Admin\AdminController@index')->with(['error'=>'You cannot access this section.','notification'=>'true']);
        }

    }
}
