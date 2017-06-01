<?php

namespace App\Http\Controllers;

use App\Order;
use App\State;
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
        })->orderBy('created_at','desc')->with('orderStatus')->get();

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
            $query->where('completed',true)->firstOrFail();
        }]);



        return view('userviews.order.view')->with('quotation',$order);

    }

    /**
     * Cancel order passed through. Only if meets cancellation criteria
     *
     * @param Order $order The order to cancel
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse Redirect to main list
     */
    public function cancellation(Order $order, Request $request)
    {
        $accepted = [
            'Awaiting Payment',
            'With Artworker',
            'Awaiting Proof Approval'
        ];

        // IF AT ACCEPTABLE STAGE, CANCEL ORDER
        if(in_array($order->state->name,$accepted)){

        $state = State::where('name', 'cancelled')->first();
        $order->state()->associate($state);

        $order->save();

        return redirect()->action('PagesController@dashboard')->with('success', 'The order was cancelled');
    } else {
        return redirect()->back()->with('error', 'Your order has already progressed and cannot be cancelled.');
    }

    }

}
