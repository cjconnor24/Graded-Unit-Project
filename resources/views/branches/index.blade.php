@extends('layouts.admin_master')
@section('content')
    <h1>Manage Branches</h1>

    <a href="{{action('Admin\BranchController@create')}}">Add Branch</a>

    @include('includes.errors')

    @if(count($branches)>0)

    <table class="table table-hover table-responsive">
        <thead>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($branches as $branch)
        <tr>
            <td>{{$branch->name}}</td>
            <td>{{$branch->address1}}</td>
            <td>{{$branch->email}}</td>
            <td>{{$branch->telephone}}</td>
            <td><a href="{{action('Admin\BranchController@edit',['id'=>$branch->id])}}" class="btn btn-sm btn-success">Edit</a> </td>
        </tr>
         @endforeach
        </tbody>
    </table>

    @else
    <p>Sorry, there aren't any branches yet</p>
    @endif

@endsection