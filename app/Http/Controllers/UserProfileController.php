<?php

namespace App\Http\Controllers;

use App\Address;
use Sentinel;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{

    public function view()
    {
        $user = Sentinel::getUser();

        return view('user.profile')->with('user',$user);
    }

    public function viewAddresses()
    {
        $user = Sentinel::getUser();
        $addresses = $user->addresses;

        return view('user.addresses')->with(['user'=>$user,'addresses'=>$addresses]);
    }

    public function createAddress()
    {
        return view('user.createAddress');
    }

    public function storeAddress(Request $request)
    {
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

        $user = Sentinel::getUser();
        $user->addresses()->save($address);

        return redirect()->action('UserProfileController@view')->with('success','Your address was added successfully.');


    }


}
