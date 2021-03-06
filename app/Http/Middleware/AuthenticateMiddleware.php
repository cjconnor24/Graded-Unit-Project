<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

/**
 * Middleware to restrict access to authenticated users only.
 * @package App\Http\Middleware
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class AuthenticateMiddleware
{
    /**
     * Handle an incoming request and check if the user is authenticated with Sentinel before proceeding.
     *
     * @param $request
     * @param Closure $next
     * @return $this|mixed
     */
    public function handle($request, Closure $next)
    {

        if(Sentinel::check()) {

            return $next($request);

        } else {

            // SET A REDIRECT
            session(['redirect'=>$request->path()]);

            return redirect()
                ->action('LoginController@loginForm')
                ->withErrors(['msg' => 'You must login to access this section.']);

        }

    }
}
