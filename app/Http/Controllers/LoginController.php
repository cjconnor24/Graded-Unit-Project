<?php

namespace App\Http\Controllers;

use Sentinel;
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

    /**
     * Attempt to login user then redirect
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $credentials = [
            'email'=>$request->email,
            'password'=>$request->password
        ];

       Sentinel::authenticate($credentials);

       return redirect('/categories');

    }

    /**
     * Logout current logged in user and redirect to login page/
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Sentinel::logout(null,true);
        return redirect('/login');
    }

}
