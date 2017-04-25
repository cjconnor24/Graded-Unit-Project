<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Display a list of quotations
     * @return $this
     */
    public function index()
    {
        $quotations = Order::whereHas('state',function($query){
            $query->where('name','quote');
        })->get();

        return view('quote.index')->with('quotations',$quotations);
    }

    public function create()
    {
        $customers= User::whereHas('roles',function($query){
            $query->where('slug','customer');
        })->get()->pluck('full_name','id');

        return view('quote.create')->with('customers',$customers);
    }

}
