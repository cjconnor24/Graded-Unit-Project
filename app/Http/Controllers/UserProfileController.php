<?php

namespace App\Http\Controllers;

use App\Address;
use Sentinel;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{

    /**
     * Display the information for the current logged in user
     * @return $this
     */
    public function view()
    {
        $user = Sentinel::getUser();
        return view('user.profile')->with('user',$user);
    }

    /**
     * View addresses associated with the logged in user
     * @return $this
     */
    public function viewAddresses()
    {
        $user = Sentinel::getUser();
        $addresses = $user->addresses;

        return view('user.addresses')->with(['user'=>$user,'addresses'=>$addresses]);
    }

    /**
     * Display form to create new address
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createAddress()
    {
        return view('user.createAddress');
    }

    /**
     * Process the form and store the address in relation to the user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAddress(Request $request)
    {
        /**
         * VALIDATE INPUT
         */
        $this->validate($request,[
            'name'=>'required',
            'address1'=>'required',
            'postcode'=>'required',
        ]);

        $address = new Address;
        $address->name = $request->input('name');
        $address->address1 = $request->input('address1');
        $address->address2 = $request->input('address2');
        $address->address3 = $request->input('address3');
        $address->address4 = $request->input('address4');
        $address->postcode = $request->input('postcode');

        /**
         * GET USER AND SAVE ADDRESS
         */
        $user = Sentinel::getUser();
        $user->addresses()->save($address);

        return redirect()->action('UserProfileController@view')->with('success','Your address was added successfully.');


    }

}
