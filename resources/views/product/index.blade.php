@extends('master')
@section('content')
    <h1>Manage Products</h1>

    <p>Below are a list of products</p>

    @if(count($products)>0)

        <table class="table table-hover">
            <thead>
            <tr>
                <th>Product</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{$product->name}}</td>
            </tr>
                @endforeach
            </tbody>
        </table>

    @else
        <p>There are currently no products</p>
    @endif
@endsection