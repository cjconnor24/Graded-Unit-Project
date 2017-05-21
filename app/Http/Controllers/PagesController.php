<?php

namespace App\Http\Controllers;

use App\Order;
use Sentinel;
use Illuminate\Http\Request;

/**
 * Generic pages controller
 *
 * Handles non-model specific actions and logic
 * @package App\Http\Controllers
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class PagesController extends Controller
{

    /**
     * Builds and outputs dashboard with a list of recent quotations and orders
     * @return $this
     */
    public function dashboard()
    {

        $quotes = Order::take(5)->whereHas('state',function($query){
            $query->where('name','quote');
        })->where('customer_id',Sentinel::getUser()->id)->orderBy('id','desc')->get();

        $orders = Order::take(5)->whereHas('state',function($query){
            $query->where('name','order');
        })->with('orderStatus')->where('customer_id',Sentinel::getUser()->id)->orderBy('id','desc')->get();

        return view('userviews.pages.dash')->with([
            'quotes'=>$quotes,
            'orders'=>$orders
        ]);
    }

}
