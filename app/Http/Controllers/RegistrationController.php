<?php

namespace App\Http\Controllers;

use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;

class registrationcontroller extends controller
{
    /**
     * display a listing of the resource.
     *
     * @return \illuminate\http\response
     */
    public function index()
    {
        return view('register.index');
    }

    /**
     * show the form for creating a new resource.
     *
     * @return \illuminate\http\response
     */
    public function create()
    {
        //
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
        $activationCode = $activation->code;


        // SEND CONFIRMATION TO USER
        Mail::to($user->email)->send(new UserRegistered($user,$activationCode));

        // temp to test
        return redirect('/categories');
    }

    /**
     * display the specified resource.
     *
     * @param  int  $id
     * @return \illuminate\http\response
     */
    public function show($id)
    {
        //
    }

    /**
     * Verify email address and activate user account
     * @param User $user User
     */
    public function verification(User $user,$activation)
    {

        if(Activation::complete($user,$activation)){
            return redirect('/login');
        } else {
            return 'already complete';
        }
    }

    /**
     * show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \illuminate\http\response
     */
    public function edit($id)
    {
        //
    }

    /**
     * update the specified resource in storage.
     *
     * @param  \illuminate\http\request  $request
     * @param  int  $id
     * @return \illuminate\http\response
     */
    public function update(request $request, $id)
    {
        //
    }

    /**
     * remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \illuminate\http\response
     */
    public function destroy($id)
    {
        //
    }
}
