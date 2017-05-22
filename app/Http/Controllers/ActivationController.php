<?php

namespace App\Http\Controllers;

use App\User;
use Activation;
use Sentinel;
use Illuminate\Http\Request;

/**
 * Activation Controller
 *
 * Controller used to handle all account activations. Once a user has registered, they must first verify their
 * email address before the will be allowed to login.
 *
 * @package App\Http\Controllers
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class ActivationController extends Controller
{
    /**
     * Activate Account
     *
     * Users will click the link provided in the email which will set an activation
     * @param string $email The users email addres
     * @param string $activationCode The activation code sent to them
     * @return \Illuminate\Http\RedirectResponse
     */
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
