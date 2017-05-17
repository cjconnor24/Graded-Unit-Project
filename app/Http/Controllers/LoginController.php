<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Sentinel;
use Illuminate\Http\Request;

/**
 * Class LoginController
 * Management of logins in application
 * @package App\Http\Controllers
 */
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

        try {

            if(Sentinel::authenticate($credentials)) {

                $user = Sentinel::getUser();

                if($request->session()->exists('redirect')){

                    $uri = $request->session()->get('redirect');
                    $request->session()->forget('redirect');

                    return redirect($uri);

                } else {

                    return redirect()->intended(action('UserProfileController@view'))->with('success', 'Welcome back ')->with('notification', 'true');

                }

//                return redirect()->action('UserProfileController@view')->with('success','Welcome back ')->with('notification','true');

            } else {

                return redirect()->back()->withErrors(['msg'=>'Your username and/or password are incorrect.']);

            }

        } catch (ThrottlingException $e){

            $timeout = $e->getDelay();
            return redirect()->back()->withErrors(['msg'=>'Due to suspicious activity, you have been blocked for '.$timeout.' seconds.']);

        } catch (NotActivatedException $e){

            return redirect()->back()->withErrors(['msg'=>'Your account has not been activated yet. Please check your inbox for further details.']);

        }


    }

    /**
     * Logout current logged in user and redirect to login page/
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Sentinel::logout(null,true);
//        session()->flash(['success'=>'You have been successfully logged out.']);
        return redirect()->action('LoginController@loginForm')->with('success','You have been logged out.');
    }

}
