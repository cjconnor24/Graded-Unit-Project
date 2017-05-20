<?php

namespace App\Http\Controllers;

use App\Order;
use Sentinel;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function dashboard()
    {



        $quotes = Order::take(5)->whereHas('state',function($query){
            $query->where('name','quote');
        })->where('customer_id',Sentinel::getUser()->id)->orderBy('id','desc')->get();

        $orders = Order::take(5)->whereHas('state',function($query){
            $query->where('name','order');
        })->with('orderStatus')->where('customer_id',Sentinel::getUser()->id)->orderBy('id','desc')->get();


//        return [$orders,$quotes];

        return view('userviews.pages.dash')->with([
            'quotes'=>$quotes,
            'orders'=>$orders
        ]);
    }

}
