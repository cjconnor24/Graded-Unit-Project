@extends('layouts.admin_master')
@section('content')
    <h1>Administration Home</h1>
<style type="text/css">
    #admin_menu {
        list-style: none;
        padding:0;
        margin:0;
    }
    #admin_menu li {
        display:inline-block;
    }
    #admin_menu li a {
        background:#0a6ebd!important;
        display:block;
        padding:3em;
        margin:0 1em 0 0;
        color:#FFF;
    }
    #admin_menu li a span {
        font-size:3em;
    }
</style>
    <ul id="admin_menu">
        <li><a href="{{action('Admin\AdminController@index')}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="{{action('Admin\QuotationController@index')}}"><span class="glyphicon glyphicon-list-alt"></span> Quotations</a></li>
        <li><a href="{{action('Admin\OrderController@index')}}"><span class="glyphicon glyphicon-list-alt"></span> Orders</a></li>
    </ul>
@endsection