<?php

namespace App\Http\Controllers;

use Sentinel;
use Illuminate\Http\Request;

/**
 * History Controller
 *
 * Used to view old cancelled / complete orders
 * @package App\Http\Controllers
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class HistoryController extends Controller
{

    /**
     * Show list of orders
     * @return $this Index view
     */
    public function index()
    {

        $orders = Sentinel::getUser()->orders->where('id','>',15);
        $orders->load('state','orderStatus');

        $temp = $orders->filter(function($order){
            if($order->state->name!=='quote'){
                return $order;
            }
        });

        $sorted = $temp->sortByDesc('updated_at');



//        dd($orders);

        return view('userviews.history.index')->with('orders',$sorted->values()->all());

    }

}
