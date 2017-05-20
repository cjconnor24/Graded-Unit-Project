<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function index()
    {

        $totals = \DB::table('orders')
            ->join('states','states.id','orders.state_id')
        ->selectRaw('states.name AS state, COUNT(*) as total')
            ->groupBy('orders.state_id')->get();
        $customers = User::whereHas('roles',function($query){
            $query->where('slug','customer');
        })->count();





        return view('admin.dash')->with(['totals'=>$totals,'customers'=>$customers]);
    }
}
