<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Home Controller
 *
 * Manage some semi-static pages
 * @package App\Http\Controllers
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response Dash View
     */
    public function index()
    {
        return view('home');
    }
}
