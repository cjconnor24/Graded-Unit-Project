<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\State;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Admin controller for handling generic admin logic.
 * Displays dashboard etc.
 * @package App\Http\Controllers\Admin
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class AdminController extends Controller
{

    /**
     * Display dashboard with quote and order totals
     * @return $this
     */
    public function index()
    {

        $totals['quotes'] = \DB::table('orders')->where('state_id',1)->count();
        $totals['orders'] = \DB::table('orders')->where('state_id',2)->count();

        $customers = User::whereHas('roles',function($query){
            $query->where('slug','customer');
        })->count();

        return view('admin.dash')->with(['totals'=>$totals,'customers'=>$customers]);
    }
}
