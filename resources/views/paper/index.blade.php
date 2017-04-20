@extends('layouts.admin_master')
@section('content')
    <h1>Manage Paper Stocks</h1>

<p><a href="{{action('PaperController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Add Paper</a></p>
    <p>Below are a list of papers</p>
    <table class="table table-responsive">
        <thead>
        <tr>
            <th>Name</th>
            <th>Manufacturer</th>
            <th>Weight</th>
            <th>Stock Level</th>
            <th>Edit</th>
        </tr>
        </thead>
    <tbody>
    @foreach($papers as $paper)
        <tr>
        <td>{{$paper->name}}</td>
        <td>{{$paper->manufacturer}}</td>
        <td>{{$paper->weight}}</td>
        <td>*still to code*</td>
            <td><a href="{{action('PaperController@edit',['paper'=>$paper->id])}}"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
        </tr>
    @endforeach
    </tbody>
    </table>

    {{ $papers->links() }}

@endsection