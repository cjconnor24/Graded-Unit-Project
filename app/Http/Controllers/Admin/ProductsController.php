<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Class ProductsController
 * Management of products within application
 * @package App\Http\Controllers
 */
class ProductsController extends Controller
{
    /**
     * Display a listing of products
     * @return $this
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new product.
     * Pass through Categories, Sizes and Papers
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::pluck('name', 'id');
        $sizes = \App\Size::pluck('name','id');
        $papers = \App\Paper::pluck('name','id');

        return view('product.create')->with(['categories'=>$categories,'sizes'=>$sizes,'papers'=>$papers]);

    }

    /**
     * Store a newly created Product with the relevant relationships.
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
            'papers'=>'required|array|min:1',
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

        // ATTACH TO MANY PAPERS
        $product->papers()->attach($request->input('papers'));

        return redirect()->action('Admin\ProductsController@index');

    }

    /**
     * Display the specified product.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the product.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // TEST FILE BACKSUPS
        $categories = \App\Category::pluck('name', 'id');
        $sizes = \App\Size::pluck('name','id');
        $papers = \App\Paper::pluck('name','id');
        return view('product.edit')->with(['product'=>$product,'sizes'=>$sizes,'categories'=>$categories,'papers'=>$papers]);
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // VALIDATE FORM INPUT
        $this->validate($request,[
            'name'=>[
                'required',
                Rule::unique('sizes')->ignore($product->id),
            ],
            'description'=>'required',
            'price'=>'required|numeric',
            'sizes'=>'required|array|min:1',
            'papers'=>'required|array|min:1',
            'category'=>'required'
        ]);

        // CREATE PRODUCT
        $product->update($request->only(['name','description','price']));

        // FIND CATEGORY AND UPDATE
        $category = \App\Category::find($request->input('category'));
        $product->category()->associate($category);

        // ATTACH MANY TO MANY SIZES AND PAPERS
        $product->sizes()->sync($request->input('sizes'));
        $product->papers()->sync($request->input('papers'));

        $product->update();




        return redirect()->action('Admin\ProductsController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // NOT CODED YET
    }
}