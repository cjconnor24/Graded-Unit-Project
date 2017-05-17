@extends('layouts.admin_master')
@section('content')
    <h1><span class="fi-misc-users fi-misc"></span> Manage Staff</h1>

    <p>Below are a list of current staff</p>

    <table class="table table-responsive">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Roles</th>
            <th>View</th>
        </tr>
        </thead>
        <tbody>
        @foreach($staff as $member)
        <tr>
            <td>{{$member->full_name}}</td>
            <td>{{$member->email}}</td>
            <td>{{$member->telephone}}</td>
            <td>
                @foreach($member->roles as $role)
                    <span class="label">{{$role->name}}</span>
                    @endforeach
            </td>
            <td><a href="{{action('Admin\StaffController@show',['staff'=>$member->id])}}" class="btn btn-success">View</a></td>
        </tr>
            @endforeach
        </tbody>
    </table>

@endsection