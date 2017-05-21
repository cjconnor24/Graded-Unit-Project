<?php

namespace App\Http\Controllers;

use App\Order;
use Sentinel;
use Illuminate\Http\Request;

/**
 * Class UserOrderController
 * Controller to manage user order interactions
 * @package App\Http\Controllers
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class UserOrderController extends Controller
{
    /**
     * Display all orders belonging to the user
     * @return mixed
     */
    public function index()
    {
        $orders = Order::whereHas('state',function($query){
            $query->where('name','order');
            })->whereHas('customer',function($query){
            $query->where('id',Sentinel::getUser()->id);
        })->with('orderStatus')->get();

        return view('userviews.order.index')->with('orders',$orders);

    }

    /**
     * Display the order and details to the user
     * @param Order $order The order to be displayed
     * @return $this
     */
    public function show(Order $order)
    {
        $order->load(['customer','OrderProducts.product','payments','orderStatus','quoteApprovals'=>function($query){
            $query->where('completed',true)->first();
        }]);

        return view('userviews.order.view')->with('quotation',$order);

    }

}
