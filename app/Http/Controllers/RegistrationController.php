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
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class RegistrationController extends Controller
{


    /**
     * Show the signup form to register for application access.
     *
     * @return \illuminate\http\response
     */
    public function create()
    {
        return view('register.create');
    }

    /**
     * Create a new registered user
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
            'password'=>'required|confirmed|min:6|regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/'
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

//        // TRY AND SEND CONFIRMATION TO USER
        try {

            Mail::to($user->email)->send(new UserRegistered($user, $activation->code));

        }
        // MAIL SENDING FAILED - USUALLY BECAUSE OF COLLEGE BLOCKING - INSTEAD LOG
        catch (\Swift_TransportException $e){

            // LOG DETAILS
            \Log::error('MAIL SENDING FAILED.',['user'=>$user,'activation'=>$activation->code." See logs for activation details."]);

            // ABORT WITH 504
            abort(504,$e->getMessage()."\n See logs for activation details.");

        }

        // REDIRECT TO LOGIN
        return redirect()->action('LoginController@loginForm')->with('success','You have succesfully registered. Please verify your email');

    }

}
