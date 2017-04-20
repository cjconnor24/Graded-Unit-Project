<?php

namespace App\Http\Middleware;

use Sentinel;
use Closure;

class AdminMiddleware
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
            if(Sentinel::getUser()->roles()->first()->slug=='admin') {

                return $next($request);

            } else {

            return redirect()
                ->action('LoginController@loginForm')
                ->withErrors(['msg' => 'You must has have elevated access.']);

        }    }
}
