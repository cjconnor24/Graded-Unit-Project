<?php

namespace App\Http\Controllers;

use Sentinel;
use Illuminate\Http\Request;

class HistoryController extends Controller
{

    public function index()
    {

        $orders = Sentinel::getUser()->orders;
        $orders->load('state','quoteApprovals');

        return $orders;

    }

}
