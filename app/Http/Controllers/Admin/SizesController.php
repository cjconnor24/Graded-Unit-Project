<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Class SizesController
 * Management of paper sizes within application
 * @package App\Http\Controllers
 */
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
     * Show the form for creating a new size.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('size.create');
    }

    /**
     * Store a newly created size in storage.
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

        return redirect()->action('Admin\SizesController@index');
    }

    /**
     * Display the details of the passed size
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {

        return view('size.show',compact('size'));
    }

    /**
     * Show the form for to edit the size and display existing information
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
//        dd($size);
        return view('size.edit',compact('size'));
    }

    /**
     * Update the size
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size)
    {
        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('sizes')->ignore($size->id),
            ],
            'height' => 'required',
            'width' => 'required'
        ]);
        $size->update($request->all());
        return redirect()->action('Admin\SizesController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        // NOT CODED AS YET
    }
}
