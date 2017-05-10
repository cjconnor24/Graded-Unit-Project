<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
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
        $orders = Order::whereHas('state',function($query){
            $query->where('name','order');
        })->with(['customer'=>function($query) {
            $query->select('id','first_name','last_name');
        },'orderStatus'=>function($query){
            $query->select('id','name');
        }])->paginate();

//        dd($orders);
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

    public function show(Order $order)
    {
        $order->load('branch','staff','state','customer','orderProducts.product','orderProducts.paper','orderProducts.size','address','payments');
//return $order;
        return view('order.view')->with('order',$order);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
//    public function destroy(Order $order)
//    {
//        //
//    }
}
