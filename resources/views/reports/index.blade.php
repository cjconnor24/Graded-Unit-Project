@extends('layouts.admin_master')
@section('content')
    <h1><span class="fi-man-bar-graph fi-man"></span> Reports</h1>
    <p>Below are a list of reports</p>

    <div class="row">

        <div class="col-md-4">

            @component('components.dash-panel',[
            'colour'=>'success',
            'icon'=>'fi-man fi-man-search',
            'name'=>'Orders',
            'link'=>action('Admin\ReportsController@orders')])
            @endcomponent
        </div>

    </div>
    
@endsection