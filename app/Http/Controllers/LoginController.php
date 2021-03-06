<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Sentinel;
use Illuminate\Http\Request;

/**
 * Login controller for management of authentication in application
 *
 * @package App\Http\Controllers
 * @author Chris Connor <chris@chrisconnor.co.uk>
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

            /**
             * TRY TO AUTHENTICATE IN SENTINEL
             */
            if(Sentinel::authenticate($credentials)) {

                $user = Sentinel::getUser();

                if($request->session()->exists('redirect')){

                    $uri = $request->session()->get('redirect');
                    $request->session()->forget('redirect');

                    return redirect($uri);

                } else {

                    if(Sentinel::inRole('customer')){
                        return redirect()->action('PagesController@dashboard')->with('success', 'Welcome back, '.$user->first_name)->with('notification', 'true');
                    } else {

                        return redirect()->intended(action('Admin\AdminController@index'))->with('success', 'Welcome back '.$user->first_name)->with('notification', 'true');

                    }



                }

            } else {

                return redirect()->back()->withErrors(['msg'=>'Your username and/or password are incorrect.']);

            }

            /**
             * CATCH POSSIBLE ERRORS
             */
        } catch (ThrottlingException $e){

            $timeout = $e->getDelay();
            return redirect()->back()->withErrors(['msg'=>'Due to suspicious activity, you have been blocked for '.$timeout.' seconds.']);

        } catch (NotActivatedException $e){

            return redirect()->back()->withErrors(['msg'=>'Your account has not been activated yet. Please check your inbox for further details.']);

        }


    }

    /**
     * Logout current logged in user and redirect to login page.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Sentinel::logout(null,true);
        return redirect()->action('LoginController@loginForm')->with('success','You have been logged out.');
    }

}
