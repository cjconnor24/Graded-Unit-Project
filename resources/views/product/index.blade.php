@extends('layouts.admin_master')
@section('content')
    <h1>Manage Products</h1>

    <p>Below are a list of products</p>

    <p><a href="{{ action('Admin\ProductsController@create') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> New Product</a></p>

    @if(count($products)>0)

        <table class="table table-hover">
            <thead>
            <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Sizes</th>
                <th>Papers</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
            <tr>
                <td><a href="{{ action('Admin\ProductsController@edit',['id'=>$product->id]) }}">{{$product->name}}</a></td>
                <td><span class="label label-primary">{{$product->category->name}}</span></td>
                <td>
                    @foreach($product->sizes as $size)
                        <span class="label label-success">{{$size->name}}</span>
                        @endforeach
                </td>
                <td>
                    @foreach($product->papers as $paper)
                        <span class="label label-success">{{$paper->name}}</span>
                    @endforeach
                </td>
                <td>{{$product->price}}</td>
            </tr>
                @endforeach
            </tbody>
        </table>

    @else
        <p>There are currently no products</p>
    @endif
@endsection