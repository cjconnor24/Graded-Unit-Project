@extends('layouts.admin_master')
@section('content')

    <h1>{{$user->first_name}} {{$user->last_name}}</h1>
    <p>{{$user->email}}</p>

        <div class="row">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="glyphicon glyphicon-bookmark"></span> Quick Shortcuts</h3>
                    </div>
                    <div class="panel-body">
                        <a href="{{action('UserProfileController@viewAddresses')}}" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-home"></span> <br/>Addresses</a>
                        <a href="#" class="btn btn-warning btn-lg" role="button"><span class="glyphicon glyphicon glyphicon-shopping-cart"></span> <br/>Orders</a>
                        <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>User Profile</a>
                        <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-comment"></span> <br/>Comments</a>
                    </div>
                </div>
            </div>



@endsection