<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::pluck('name', 'id');
        $sizes = \App\Size::pluck('name','id');

        return view('product.create')->with(['categories'=>$categories,'sizes'=>$sizes]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDATE FORM INPUT
        $this->validate($request,[
            'name'=>'required|unique:products',
            'description'=>'required',
            'price'=>'required|numeric',
            'sizes'=>'required|array|min:1',
            'category'=>'required'
        ]);

        // CREATE PRODUCT
        $product = new \App\Product([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'price' => $request->input('price')
        ]);

        // FIND CATEGORY AND SAVE
       $category = \App\Category::find($request->input('category'));
       $category->products()->save($product);

       // ATTACH MANY TO MANY SIZES
       $product->sizes()->attach($request->input('sizes'));

       return redirect('/products');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
