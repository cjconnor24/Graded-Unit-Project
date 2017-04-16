<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Sentinel;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display login form for user to login
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginForm()
    {
        return view('login.form');
    }

    public function login(Request $request)
    {
//        $this->validate($request,[
//            'email'=>'required|email',
//            'password'=>'required'
//        ]);

//        $credentials = [
//            'email'=>$request->email,
//            'password'=>$request->password
//        ];

       // Sentinel::authenticate($request->all());
        return Sentinel::check();

//
//        session()->flash('message',['type'=>'warning','content'=>'You have successfully logged in.']);
//        return redirect('/categories');
    }

}
