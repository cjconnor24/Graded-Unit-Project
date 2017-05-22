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

        $orders = Sentinel::getUser()->orders;
        $orders->load('state','orderStatus');

        dd($orders);

        return view('userviews.history.index')->with('orders',$orders);

    }

}
