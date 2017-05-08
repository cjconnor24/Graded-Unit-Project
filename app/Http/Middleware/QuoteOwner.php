<?php

namespace App\Http\Middleware;

use App\Order;
use Sentinel;
use Closure;

class QuoteOwner
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
        $id = $request->route('quotation');


        $order = Order::findOrFail($id);
        $user = Sentinel::getUser();




        if($order->customer->id !== $user->id){

                        return redirect()
                ->action('UserProfileController@viewAddresses')
                ->with('error','You do not have permission to access this resource.');

        } else {
            return $next($request);
        }

//
//        return $id;
//        dd($id);



        // CHECK AUTHENTICATED USER IS THE OWNER
//        if($address->user_id == $user->id)
//        {



//        } else {
//
//            return redirect()
//                ->action('UserProfileController@viewAddresses')
//                ->with('error','You do not have permission to access this resource.');
//
//        }
    }
}
