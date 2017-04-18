<?php

namespace App\Http\Controllers;

use App\User;
use Activation;
use Sentinel;
use Illuminate\Http\Request;


class ActivationController extends Controller
{
    public function activate($email, $activationCode)
    {
        $user = User::whereEmail($email)->first();

        if(count($user)==0)
            abort(404);

        if(Activation::complete($user,$activationCode)){
            return redirect()->action('LoginController@loginForm')->with('success','Your account has been successfully activated. Please login.');
        } else {
            return redirect()->action('LoginController@loginForm')->with('error','There was an issue activating your account.');
        }
    }
}
