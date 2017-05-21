<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Category Controller
 *
 * Controller for managing product categories.
 * @author Chris Connor <chris@chrisconnor.co.uk>
 * @package App\Http\Controllers\Admin
 */
class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
//        $this->middleware('authenticate');
    }

    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDATE THE REQUEST
        $this->validate($request, [
            'name' => 'required|unique:categories|min:4'
        ]);

        Category::create([
            'name'=>$request->input('name')
        ]);

        return redirect()->action('Admin\CategoryController@index');

    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit')->with('category',$category);
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            'name'=> [
                'required',
                Rule::unique('categories')->ignore($category->id),
            ]
        ]);
        $category->update(['name'=>$request->input('name')]);
        return redirect()->action('Admin\CategoryController@index');
    }

}
