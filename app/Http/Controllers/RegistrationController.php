<?php

namespace App\Http\Controllers;

use App\User;
use Activation;
use Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;

/**
 * Class RegistrationController
 * Management of user registrations and activations
 * @package App\Http\Controllers
 */
class RegistrationController extends Controller
{


    /**
     * show the form for creating a new resource.
     *
     * @return \illuminate\http\response
     */
    public function create()
    {
        return view('register.create');
    }

    /**
     * create a new registered user
     *
     * @param  \illuminate\http\request  $request
     * @return \illuminate\http\response
     */
    public function store(request $request)
    {
        $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'bail|required|email|unique:users',
            'password'=>'required|confirmed|min:6'
        ]);

        $user = Sentinel::register([
            'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'password'=>$request->password
            ]);

        $activation = Activation::create($user);

        // ASSIGN USER TO CUSTOMER
        $role = Sentinel::findRoleBySlug('customer');
        $role->users()->attach($user);

//        // SEND CONFIRMATION TO USER
        Mail::to($user->email)->send(new UserRegistered($user,$activation->code));

        return redirect()->action('LoginController@loginForm')->with('success','You have succesfully registered. Please verify your email');

    }

}
