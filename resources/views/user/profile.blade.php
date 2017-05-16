@extends('layouts.user_master')
@section('content')

    <h1>{{$user->first_name}} {{$user->last_name}}</h1>
    <p>{{$user->email}}</p>

    @include('includes.errors')

    @component('components.panel')
        @slot('title')
            Title
            @endslot

        <a href="#" class="btn btn-primary btn-lg btn-square" role="button"><span class="glyphicon glyphicon-user"></span> <br/>User Profile</a>
        <a href="#" class="btn btn-primary btn-lg btn-square" role="button"><span class="glyphicon glyphicon-user"></span> <br/>User Profile</a>
        <a href="#" class="btn btn-primary btn-lg btn-square" role="button"><span class="glyphicon glyphicon-user"></span> <br/>User Profile</a>
        <a href="#" class="btn btn-primary btn-lg btn-square" role="button"><span class="glyphicon glyphicon-user"></span> <br/>User Profile</a>
        <a href="#" class="btn btn-primary btn-lg btn-square" role="button"><span class="glyphicon glyphicon-user"></span> <br/>User Profile</a>

        @endcomponent



        <div class="row">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="glyphicon glyphicon-bookmark"></span> Quick Shortcuts</h3>
                    </div>
                    <div class="panel-body">
                        <a href="{{action('UserProfileController@viewAddresses')}}" class="btn btn-danger btn-lg btn-square" role="button"><span class="glyphicon glyphicon-home"></span> <br/>Addresses</a>
                        <a href="{{action('UserQuotationController@index')}}" class="btn btn-warning btn-lg btn-square" role="button"><span class="glyphicon glyphicon glyphicon-shopping-cart"></span> <br/>Orders</a>
                        <a href="#" class="btn btn-primary btn-lg btn-square" role="button"><span class="glyphicon glyphicon-user"></span> <br/>User Profile</a>
                        <a href="#" class="btn btn-primary btn-lg btn-square" role="button"><span class="glyphicon glyphicon-comment"></span> <br/>Comments</a>
                        <a href="#" class="btn btn-primary btn-lg btn-square" role="button"><span class="glyphicon glyphicon-comment"></span> <br/>Comments</a>
                    </div>
                </div>
            </div>



@endsection