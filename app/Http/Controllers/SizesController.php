<?php

namespace App\Http\Controllers;

use App\Size;
use Illuminate\Http\Request;

class SizesController extends Controller
{
    /**
     * Display a listing of the sizes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::all()->sortBy('name');
        return view('size.index',compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('size.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDATE THE INPUT
        $this->validate($request,[
            'name' => 'bail|required|unique:sizes',
            'height' => 'required|Numeric',
            'width' => 'required|Numeric'
        ]);

        Size::create([
            'name'=>$request->input('name'),
            'height'=>$request->input('height'),
            'width'=>$request->input('width')
        ]);

        return redirect('/sizes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        return view('size.show',compact('size'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        //
    }
}
