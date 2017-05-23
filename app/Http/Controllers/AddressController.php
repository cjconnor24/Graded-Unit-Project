<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Sentinel;

/**
 * Address Controller
 *
 * Management of customer addresses within the application
 * @package App\Http\Controllers
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class AddressController extends Controller
{
    /**
     * View addresses associated with the logged in user
     *
     * @return $this
     */
    public function index()
    {
        $user = Sentinel::getUser();
        $addresses = $user->addresses;

        return view('user.addresses')->with(['user'=>$user,'addresses'=>$addresses]);
    }



    /**
     * Display form to create new address
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('user.createAddress');
    }

    /**
     * Process the form and store the address in relation to the user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
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

        /**
         * GET USER AND SAVE ADDRESS TO DB
         */
        $user = Sentinel::getUser();
        $user->addresses()->create($request->all());

        return redirect()->action('AddressController@index')->with('success','Your address was added successfully.');

    }

    /**
     * Display the form to edit the address
     *
     * @param Address $address address to edit
     * @return $this
     */
    public function edit(Address $address)
    {
        return view('user.editAddress')->with('address',$address);
    }


    /**
     * Update the address in the database
     *
     * @param Request $request form data
     * @param Address $address Address to update
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Address $address)
    {

        $this->validate($request,[
            'name'=>[
                'required',
                // MAKE SURE ADDRESS NAME IS UNIQUE TO USER BUT IGNORE IF SAME RESOURCE
                Rule::unique('addresses')->where(function($query) use($address){
                    $query->where('user_id','=',Sentinel::getUser()->id);
                    $query->where('id','<>',$address->id);
                })
            ],
            'address1'=>'required',
            'postcode'=>'required',
        ]);

        $address->update($request->all());

        return redirect()->action('AddressController@index')->with('success','Address successfully updated.');
    }

    /**
     * Remove the specified address from storage.
     *
     * @param  Address $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {

    }
}
