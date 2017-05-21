<?php

namespace App\Http\Middleware;

use Sentinel;
use Closure;

/**
 * Middleware for restricting access to users with a Staff role
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @package App\Http\Middleware
 */
class StaffMiddleware
{
    /**
     * Handle an incoming request and ensure that user has a staff role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            if(Sentinel::inRole('staff')) {

                return $next($request);

            } else {

            return redirect()
                ->action('LoginController@loginForm')
                ->withErrors(['msg' => 'You must have elevated access.']);

        }    }
}
