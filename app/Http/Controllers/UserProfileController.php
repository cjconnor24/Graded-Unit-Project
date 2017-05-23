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


}
