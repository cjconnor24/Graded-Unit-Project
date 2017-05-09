<?php

namespace App\Http\Middleware;

use App\Order;
use Sentinel;
use Closure;

class QuoteOwner
{
    /**
     * Ensure that the resource belongs to the logged in user
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $order = $request->route('quotation');

        $user = Sentinel::getUser();

        if($order->customer->id !== $user->id){

                        return redirect()
                ->action('UserProfileController@viewAddresses')
                ->with('error','You do not have permission to access this resource.');

        }

        // SUCCESS RETURN NORMAL ROUTE
        return $next($request);

    }
}
