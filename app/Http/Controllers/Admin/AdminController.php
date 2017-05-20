<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\State;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function index()
    {

//        $totals = \DB::table('orders')
//            ->join('states','states.id','orders.state_id')
//        ->selectRaw('states.name AS state, COUNT(*) as total')
//            ->groupBy('orders.state_id')->get();

        $totals['quotes'] = \DB::table('orders')->where('state_id',1)->count();
        $totals['orders'] = \DB::table('orders')->where('state_id',2)->count();

        $customers = User::whereHas('roles',function($query){
            $query->where('slug','customer');
        })->count();





        return view('admin.dash')->with(['totals'=>$totals,'customers'=>$customers]);
    }
}
