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
        $sentinelUser = Sentinel::findById($user->id);

        if(Activation::complete($sentinelUser,$activationCode)){
            return redirect()->action('LoginController@loginForm');
        } else {

        }
    }
}
