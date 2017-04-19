<?php

namespace App\Http\Controllers;

use \App\Paper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaperController extends Controller
{
    /**
     * Display a listing of all paper.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $papers = Paper::all();
        return view('paper.index')->with('papers',$papers);
    }

    /**
     * Show the form for creating a new paper stock.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paper.create');
    }

    /**
     * Store a newly created paper stock in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:papers',
            'manufacturer'=>'required',
            'weight'=>'required|numeric|min:20|max:1500'
        ]);

        // CREATE AND STORE
        $paper = new Paper;
        $paper->name = $request->name;
        $paper->manufacturer = $request->manufacturer;
        $paper->weight = $request->weight;
        $paper->save();

        return redirect()->action('PaperController@index');

    }

    /**
     * Display the specified paper.
     *
     * @param  \App\Paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function show(Paper $paper)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function edit(Paper $paper)
    {
        return view('paper.edit')->with('paper',$paper);
    }

    /**
     * Update the specified paper stock in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paper $paper)
    {
        $this->validate($request,[
            'name'=>[
                'required',
                Rule::unique('papers')->ignore($paper->id),
            ],
            'manufacturer'=>'required',
            'weight'=>'required|numeric|min:20|max:1500'
        ]);

        $paper->update($request->only(['name','manufacturer','weight']));

        return redirect()->action('PaperController@index');
    }

    /**
     * Remove the specified paper stock from storage.
     *
     * @param  \App\Paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paper $paper)
    {
        //
    }
}
