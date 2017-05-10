<?php

namespace App\Http\Middleware;

use Sentinel;
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request and ensure that user has an admin role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            if(Sentinel::inRole('admin')) {

                return $next($request);

            } else {

            return redirect()->back()->with('error','You do not have permission to carry out this task.')
                ->with('notification','true');

        }    }
}
