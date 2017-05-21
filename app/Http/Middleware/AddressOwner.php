<?php

namespace App\Http\Middleware;

use App\Address;
use Sentinel;
use Closure;

/**
 * Middleware to ensure the the address belongs to the logged in user before allow them access
 * @package App\Http\Middleware
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class AddressOwner
{
    /**
     * Check that the address the user is trying to access belongs to the user. If not, respond with authorised headers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $id = $request->route('address')->id;
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
