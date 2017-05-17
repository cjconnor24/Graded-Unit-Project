<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Activation;
use Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    /**
     * Display a listing of all staff.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Sentinel::findRoleBySlug('staff')->users;
        $staff->load('roles');

        return view('staff.index')->with('staff',$staff);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $staff)
    {

        $roles = Sentinel::getRoleRepository()->where('slug','<>','customer')->orderBy('name','asc')->get();
        $staff->load(['roles','stafforders','activations']);

//        return $staff;
        

        return view('staff.show')->with(['staff'=>$staff,'roles'=>$roles]);


    }

    /**
     * Disable user so they can't login
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function disabledUser(Request $request)
    {

        $user = User::findOrFail($request->user_id);

        Activation::remove($user);
        return response()->json(['success'=>'User has been disabled'],200);

    }

    public function enableUser(Request $request)
    {

        $user = User::findOrFail($request->user_id);

        $activation = Activation::create($user);
        Activation::complete($user,$activation->code);

        return response()->json(['success'=>'User has been re-activated'],200);

    }

    public function toggleRole(Request $request)
    {
        $user = User::find($request->user_id);
        $role = Sentinel::findRoleById($request->role_id);

        if(!$user->inRole($role->slug)){


            $role->users()->attach($user);
            return response()->json(['success'=>'user was added'],200);

        } else {
            $role->users()->detach($user);
            return response()->json(['success'=>'user was removed'],200);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
