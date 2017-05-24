<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

/**
 * Guest Middleware to restrict access to pages which do not require a login
 *
 * @package App\Http\Middleware
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class GuestMiddleware
{
    /**
     * Handle an incoming and redirect if already logged in.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // IF THERE IS A LOGGED IN USER, REDIRECT TO HOME
        if(Sentinel::guest()){

            return $next($request);

        } else {


            return redirect()->action('PagesController@dashboard');

        }
    }
}
