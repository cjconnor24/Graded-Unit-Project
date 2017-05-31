<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Illuminate\Http\Request;
use App\User;

/**
 * Reset Password controller
 *
 * Management of user password resets
 * @package App\Http\Controllers
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class ResetPasswordController extends Controller
{
    /**
     * Display password reset form as long as the relevant info is matching with the DB
     * @param $email
     * @param $code
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function resetPassword($email, $code)
    {
        $user = User::whereEmail($email)->first();

        if (count($user) == 0)
            return redirect()->action('LoginController@loginForm')->with('error', 'There was an issue with your password reset.');

        $reminder = Reminder::exists($user);

        if ($reminder->code != $code)
            return redirect()->action('LoginController@loginForm')->with('error', 'There was an issue with your password reset.');


        return view('passwordreset.reset');

    }

    /**
     * Process the new password and make sure they match.
     * @param Request $request
     * @param $email
     * @param $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postResetPassword(Request $request, $email, $code)
    {

        $this->validate($request, [
            'password'=>'required|confirmed|min:6|regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/',
            'password_confirmation' => 'required'
        ]);

        $user = User::whereEmail($email)->first();

        if(count($user)==0)
            return redirect()->action('LoginController@loginForm')->with('error','There was an issue with your password reset.');

        $reminder = Reminder::exists($user);

        if($reminder->code != $code)
            return redirect()->action('LoginController@loginForm')->with('error','There was an issue with your password reset.');

        if(Reminder::complete($user,$code,$request->password)){
            return redirect()->action('LoginController@loginForm')->with('success','Please login with your new password.');
        } else {
            return redirect()->action('LoginController@loginForm')->with('error','There was an issue resetting your password.');
        }

    }
}