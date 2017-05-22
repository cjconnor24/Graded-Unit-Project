<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Forgot Password Controller
 *
 * Allow users to reset their forgotten password via email.
 * @package App\Http\Controllers
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class ForgotPasswordController extends Controller
{
    /**
     * Display the form to reset the password
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function forgotPassword()
    {
        return view('login.forgot');
    }

    /**
     * Check the email address and, if exists and not already reset, create a reminder in sentinel.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postForgotPassword(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email'
        ]);

        $user = User::whereEmail($request->email)->first();

        // NO USER FOUND BUT DON'T UPDATE USER FOR SECURITY REASONS - DON'T WANT PEOPLE GUESSING
        if(count($user)==0){
            return redirect()->back()->with('success','Your password reset has been sent.');
        }

            $reminder = Reminder::exists($user) ?: Reminder::create($user);

        // EMAIL THE USER THE RESET
        Mail::to($user->email)->send(new PasswordReset($user,$reminder->code));

        return redirect()->back()->with('success','Your password reset has been sent.');

    }
}
