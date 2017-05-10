<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function dashboard()
    {
        $quotes = Order::whereHas('state',function($query){
            $query->where('name','quote');
        })->get();

        $orders = Order::whereHas('state',function($query){
            $query->where('name','order');
        })->get();


        return [$orders,$quotes];

        return view('userviews.pages.dash');
    }

}
