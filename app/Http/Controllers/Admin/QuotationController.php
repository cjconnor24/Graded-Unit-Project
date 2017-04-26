<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Display a list of quotations
     * @return $this
     */
    public function index()
    {
        $quotations = Order::whereHas('state',function($query){
            $query->where('name','quote');
        })->get();

        return view('quote.index')->with('quotations',$quotations);
    }

    /**
     * Create new quotation
     * @return $this
     */
    public function create()
    {
        $customers= User::whereHas('roles',function($query){
            $query->where('slug','customer');
        })->get()->pluck('full_name','id');
        $categories = Category::has('products')->get()->pluck('name','id');

        return view('quote.create')->with(['customers'=>$customers,'categories'=>$categories]);
    }

    public function store(Request $request)
    {
     dd($request->all());
    }

}
