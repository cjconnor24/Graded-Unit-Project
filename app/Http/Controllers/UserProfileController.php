<?php

namespace App\Http\Controllers;

use Sentinel;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{

    public function view()
    {
        $user = Sentinel::getUser();

        return view('profile');
    }


}
