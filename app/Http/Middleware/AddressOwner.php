<?php

namespace App\Http\Middleware;

use App\Address;
use Sentinel;
use Closure;

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

        $id = $request->route('address')->id; // For example, the current URL is: /posts/1/edit

        $address = Address::findOrFail($id); // Fetch the address
        $user = Sentinel::getUser();

//        dd([$address->user_id,$user->id]);
        if($address->user_id == $user->id)
        {
            return $next($request); // They're the owner, lets continue...
        } else {
//        abort(403);
            return redirect()->action('UserProfileController@viewAddresses')->with('error','You do not have permission to access this resource.');
        }


    }
}
