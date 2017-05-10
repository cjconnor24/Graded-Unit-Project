<?php

namespace App\Http\Controllers;

use Sentinel;
use Illuminate\Http\Request;

class HistoryController extends Controller
{

    public function index()
    {

        $orders = Sentinel::getUser()->orders;


        return view('userviews.history.index')->with('orders',$orders);

    }

}
