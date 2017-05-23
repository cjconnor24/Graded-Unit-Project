@extends('layouts.admin_master')

@section('scripts')
    <script type="text/javascript">
        $( function() {
            $( "#start_date" ).datepicker({dateFormat:'dd-mm-yy'});
            $( "#end_date" ).datepicker({dateFormat:'dd-mm-yy',maxDate:0});
        } );
    </script>
@endsection
@section('content')

    <a href="{{action('Admin\ReportsController@index')}}" class="btn btn-default"><span class="fi-misc-return fi-misc"></span> Return to Reports</a>

    <h1><span class="fi-man-line-graph fi-man"></span>Search Orders</h1>
    <p>To search orders and download an order report, please select you parameters below.</p>
    <div class="col-md-6 col-md-offset-3">
    @component('components.panel')
    @slot('title')

        <span class="fi-man-search fi-man"></span> Export Orders Report
        @endslot

        @include('reports._order_form')


    @endcomponent
    </div>

@endsection