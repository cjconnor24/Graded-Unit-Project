<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBranch;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Controller for managing branches
 * @package App\Http\Controllers\Admin
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @date 11th May 2017
 */
class BranchController extends Controller
{
    /**
     * Display a list of branches
     *
     * Retrieves a list of branches then displays them in the branch index view.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::all();
        return view('branches.index')->with('branches',$branches);
    }

    /**
     * Show the form for creating a new branch
     *
     * Outputs the create new branch view
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branches.create');
    }


    /**
     * Stores a new branch in the database
     *
     * Takes the details from the create branch view form and builds and stores a new branch
     * @param StoreBranch $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBranch $request)
    {

        Branch::create([
            'name'=>$request->name,
            'address1'=>$request->address1,
            'address2'=>$request->address2,
            'address3'=>$request->address3,
            'address4'=>$request->address4,
            'postcode'=>$request->postcode,
            'telephone'=>$request->telephone,
            'email'=>$request->email
            ]);

        return redirect()->action('Admin\BranchController@index')->with('success','The branch was successfully added');

    }

    /**
     * Show the form for editing the branch
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        return view('branches.edit')->with('branch',$branch);
    }

    /**
     * Update the Branch and store.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch Branch to update
     * @return \Illuminate\Http\Response Redirect with success message
     */
    public function update(Request $request, Branch $branch)
    {
        $this->validate($request,[
            'name'=>'required',
            'address1'=>'required',
            'postcode'=>'required',
            'telephone'=>'required',
            'email'=>'required|email'
        ]);

        $branch->update($request->all());

        return redirect()->action('Admin\BranchController@index')->with('success','The branch was updated successfully');

    }

}
