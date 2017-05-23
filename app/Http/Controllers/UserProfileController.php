<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Validation\Rule;
use Sentinel;
use Illuminate\Http\Request;

/**
 * User profile controller
 * Allows user to manage their profile include add addresses
 *
 * @package App\Http\Controllers
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class UserProfileController extends Controller
{

    /**
     * Display the users dashboard include orders, quotes etc.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('user.dash');
    }

    /**
     * Display a profile control panel to the user
     * @return $this
     */
    public function view()
    {
        $user = Sentinel::getUser();

        $totals['orders'] = \DB::table('orders')->where('state_id',2)->where('customer_id',$user->id)->count();
        $totals['quotes'] = \DB::table('orders')->where('state_id',1)->where('customer_id',$user->id)->count();

        return view('user.profile')->with([
            'user'=>$user,
            'totals'=>$totals
        ]);
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
     * Display the form to edit the address
     * @param Address $address
     * @return $this
     */
    public function editAddress(Address $address)
    {
        return view('user.editAddress')->with('address',$address);
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
            'name'=>[
                'required',
                Rule::unique('addresses')->where('user_id',Sentinel::getUser()->id)
            ],
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

        return redirect()->action('UserProfileController@viewAddresses')->with('success','Your address was added successfully.');

    }

}
