@extends('layouts.admin_master')
@section('scripts')
    <script type="text/javascript">
        $(function() {
            // DATE PICKERS
            $( "#start_date" ).datepicker({dateFormat:'dd-mm-yy'});
            $( "#end_date" ).datepicker({ maxDate: 0, dateFormat:'dd-mm-yy' });

            var availableTags = [
                "ActionScript",
                "AppleScript",
                "Asp",
                "BASIC",
                "C",
                "C++",
                "Clojure",
                "COBOL",
                "ColdFusion",
                "Erlang",
                "Fortran",
                "Groovy",
                "Haskell",
                "Java",
                "JavaScript",
                "Lisp",
                "Perl",
                "PHP",
                "Python",
                "Ruby",
                "Scala",
                "Scheme"
            ];
            $( "#customer_name" ).autocomplete({
                source: availableTags
            });

        });
    </script>
@endsection

@section('content')

    <h1><span class="fi-man-line-graph fi-man"></span>Search Orders</h1>
    <p>To search orders and download an order report, please select you parameters below.</p>
    <div class="col-md-6">
    @component('components.panel')
    @slot('title')

        <span class="fi-man-search fi-man"></span> Search Orders
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

    </div>

        <button type="submit" class="btn btn-lg btn-success"><span class="glyphicon-search glyphicon"></span> Search</button>
    {!! Form::close() !!}
    @endcomponent
    </div>

@endsection