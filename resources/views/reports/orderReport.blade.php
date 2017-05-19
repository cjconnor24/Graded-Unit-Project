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

    <h1><span class="fi-man-line-graph fi-man"></span>Search Orders</h1>
    <p>To search orders and download an order report, please select you parameters below.</p>
    <div class="col-md-6">
    @component('components.panel')
    @slot('title')

        <span class="fi-man-search fi-man"></span> Export Orders Report
        @endslot
    {!! Form::open(['action' => 'Admin\ReportsController@ordersPost']) !!}
        <div class="row">

            <div class="col-md-6">

                <div class="form-group">
                    {!! Form::label('start_date',"Start Date") !!}
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                    {!! Form::text('start_date',\Carbon\Carbon::now()->subDays(14)->format('d-m-Y'),['class'=>'form-control']) !!}
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('end_date',"End Date") !!}
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></div>
                    {!! Form::text('end_date',\Carbon\Carbon::now()->format('d-m-Y'),['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

                <div class="col-md-6">

                        <div class="form-group">
                            {!! Form::label('state_id',"Order Type") !!}
                            {!! Form::select('state_id',$states,null,['class'=>'form-control','placeholder'=>'Order Type']) !!}
                        </div>

                </div>

            <div class="col-md-6">

                <div class="form-group">
                    {!! Form::label('status_id',"Order Status") !!}
                    {!! Form::select('status_id',$statuses,null,['class'=>'form-control','placeholder'=>'Order Status']) !!}
                </div>

            </div>

        </div>

    <div class="row">

        <div class="col-md-6">

            <div class="form-group">
                {!! Form::label('customer_name',"Customer Name") !!}
                {!! Form::text('customer_name',null,['class'=>'form-control']) !!}
                <p class="help-block">Please enter first or last name</p>
            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group">

                {!! Form::label('report_type',"Report Type") !!}

                <div class="btn-group report-selector" data-toggle="buttons">

                    <label class="btn btn-success btn-lg active">
                        <input type="radio" name="report_type" id="option1" autocomplete="off" value="csv" checked="checked" title="CSV Report">
                        <span class="flaticon-form-txt fi-form"></span>
                    </label>

                    <label class="btn btn-success btn-lg">
                        <input type="radio" name="report_type" id="option2" autocomplete="off" value="pdf" title="PDF Report">
                        <span class="flaticon-form-pdf fi-form"></span>

                    </label>

                </div>

            </div>


        </div>

    </div>

        <button type="submit" class="btn btn-lg btn-success"><span class="fi-misc-download fi-misc"></span> Export Report</button>
    {!! Form::close() !!}


    @endcomponent
    </div>

@endsection