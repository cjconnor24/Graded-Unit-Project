@extends('layouts.admin_master')
@section('content')
    <h1><span class="fi-man-bar-graph fi-man"></span> Reports</h1>
    <p>Below are a list of reports</p>

    <ul>
        <li><a href="{{action('Admin\ReportsController@customer')}}">Customer List</a> | <a
                    href="{{action('Admin\ReportsController@downloadPDF')}}">PDF</a></li>
    </ul>
@endsection