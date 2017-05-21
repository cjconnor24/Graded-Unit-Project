<?php

namespace App\Http\Middleware;

use App\Order;
use Sentinel;
use Closure;

/**
 * Middleware to ensure that the person requesting a quotation is actually the owner of the quotation. If they're not,
 * redirect and update with relevant error message.
 *
 * @package App\Http\Middleware
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
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


        if($request->route('quotation')!==null) {
            $order = $request->route('quotation');
        } else {
            $order = $request->route('order');
        }

        $user = Sentinel::getUser();

        if($order->customer->id !== $user->id){

                        return redirect()
                ->action('PagesController@dashboard')
                ->with('error','You do not have permission to access this resource.');

        }

        // SUCCESS RETURN NORMAL ROUTE
        return $next($request);

    }
}
