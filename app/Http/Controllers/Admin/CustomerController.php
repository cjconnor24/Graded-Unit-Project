<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;

use Sentinel;
use Illuminate\Http\Request;

/**
 * Customer Controller for Managing Customers
 * @package App\Http\Controllers\Admin
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class CustomerController extends Controller
{
    /**
     * Display a listing of customers.
     *
     * @return \Illuminate\Http\Response Customer Index View
     */
    public function index(Request $request)
    {

        $customers = User::whereHas('roles', function ($query) {
            $query->where('slug', 'customer');
        })->paginate();


        return view('customer.index')->with('customers',$customers);
    }

    /**
     * Display the customer details
     * @param User $customer The customer to view
     * @return $this Customer Show View
     */
    public function show(User $customer)
    {

        return view('customer.show')->with('customer',$customer);
    }


    /**
     * Retrive customer addresses based on the passed user.
     * @param User $user The user to query
     * @param Request $request
     * @return mixed
     */
    public function getAddresses(Request $request, User $user)
    {
        if($request->ajax()) {
            $addresses = $user->addresses;
            return \Response::json($addresses);
        } else {
            abort(500);
        }
    }


}
