<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Display a list of quotations
     * @return $this
     */
    public function index()
    {
        $quotations = Order::where('state','quotation')->get();
        return view('quote.index')->with('quotations',$quotations);
    }

}
