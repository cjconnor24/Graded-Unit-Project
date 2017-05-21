<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Activation;
use Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Staff controller allows the management of all staff and their roles
 * @package App\Http\Controllers\Admin
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class StaffController extends Controller
{
    /**
     * Display a listing of all staff.
     *
     * @return \Illuminate\Http\Response Staff listing view
     */
    public function index()
    {
        $staff = Sentinel::findRoleBySlug('staff')->users;
        $staff->load('roles');

        return view('staff.index')->with('staff',$staff);
    }


    /**
     * Display the staff member view
     * @param User $staff The user to be viewed
     * @return $this Show view
     */
    public function show(User $staff)
    {

        $roles = Sentinel::getRoleRepository()->where('slug','<>','customer')->orderBy('name','asc')->get();
        $staff->load(['roles','stafforders','activations']);

        return view('staff.show')->with(['staff'=>$staff,'roles'=>$roles]);

    }

    /**
     * Disable user so they can't login
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function disabledUser(Request $request)
    {
        if($request->ajax()) {
            $user = User::findOrFail($request->user_id);
            Activation::remove($user);
            return response()->json(['success' => 'User has been disabled'], 200);
        }

    }


    /**
     * Re-enable the user so they can login again
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function enableUser(Request $request)
    {

        if($request->ajax()) {
            $user = User::findOrFail($request->user_id);
            $activation = Activation::create($user);
            Activation::complete($user, $activation->code);
            return response()->json(['success' => 'User has been re-activated'], 200);
        }

    }

    /**
     * Take the role and, if already added to user, remove. If it doesn't already exists - add it.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleRole(Request $request)
    {
        if($request->ajax()) {
            $user = User::find($request->user_id);
            $role = Sentinel::findRoleById($request->role_id);

            if (!$user->inRole($role->slug)) {

                $role->users()->attach($user);
                return response()->json(['success' => 'user was added'], 200);

            } else {

                $role->users()->detach($user);
                return response()->json(['success' => 'user was removed'], 200);

            }
        }

    }

}
