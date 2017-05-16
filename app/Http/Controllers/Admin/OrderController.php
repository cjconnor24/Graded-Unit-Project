<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderStatus;
use App\User;
use Sentinel;
use Illuminate\Http\Request;

/**
 * Class OrderController
 * Management of quotes / orders within application
 * @package App\Http\Controllers
 */
class OrderController extends Controller
{

    /**
     * Show a list of all active orders
     * @return mixed
     */
    public function index()
    {
        $orders = Order::wherehas('state',function($query){
            $query->where('name','order');
        })->with(['customer'=>function($query) {
            $query->select('id','first_name','last_name');
        },'orderstatus'=>function($query){
            $query->select('id','name');
        }])->paginate();

        return view('order.index')->with('orders',$orders);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
//    {
//        //
//    }

    /**
     * Display the order and allow the admin to update the status of the order
     * @param Order $order
     * @return $this
     */
    public function show(Order $order)
    {
        $order->load('branch','staff','state','customer','orderProducts.product','orderProducts.paper','orderProducts.size','address','payments');

        $statuses = OrderStatus::pluck('name','id');
        $staff = Sentinel::findRoleBySlug('staff')->users->pluck('id','full_name');

        return view('order.view')->with([
            'order'=>$order,
            'statuses'=>$statuses
        ]);
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }




}
