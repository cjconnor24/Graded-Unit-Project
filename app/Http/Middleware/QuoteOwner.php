<?php

namespace App\Http\Middleware;

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
        $id = $request->route('quotation')->id;

        dd($id);

        $address = Address::findOrFail($id);
        $user = Sentinel::getUser();

        // CHECK AUTHENTICATED USER IS THE OWNER
        if($address->user_id == $user->id)
        {

            return $next($request);

        } else {

            return redirect()
                ->action('UserProfileController@viewAddresses')
                ->with('error','You do not have permission to access this resource.');

        }
    }
}
