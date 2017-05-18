@extends('layouts.admin_master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('scripts')
    <script src="{{asset('js/quote.js')}}"></script>
    <script type="text/javascript">
        $(function() {
            $( "#due_date" ).datepicker({ minDate: 0 });
        });
    </script>
@endsection
@section('content')

    <h1><span class="fi-shop-shopping-cart fi-shop"></span> Create New Quote</h1>
    <p>Please select details below</p>

    <div class="alert alert-danger" style="display:none;"></div>

    <form id="quote_form" method="POST" action="{{action('Admin\QuotationController@store')}}">
        {{csrf_field()}}

    @include('includes.errors')

    <div class="row">

        <div class="col-md-6 col-lg-6">
            <h3>Customer Details</h3>

            <div class="form-group">
                <label for="customer_id">Choose Customer</label>
            {!! Form::select('customer_id', $customers, null, ['id'=>'customer_id','placeholder' => 'Choose customer','class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                <label for="address_id">Choose Address</label>
            {!! Form::select('address_id', [], null, ['id'=>'address_id','placeholder' => 'Please select a customer','class'=>'form-control input-sm']) !!}
            </div>


            <h3>Customer Address</h3>
            <p id="customer_address"></p>


        </div>

        <div class="col-md-6 col-lg-6">
            <h3>Order Details</h3>

            <div class="form-group">
                <label for="branch_id">Choose Branch</label>
                {!! Form::select('branch_id', $branches,null, ['id'=>'branch_id','placeholder' => 'Please select a branch','class'=>'form-control input-sm']) !!}
            </div>

            <div class="form-group">
                <label for="inputID">Order Date</label>
            <input type="date" name="date" id="inputID" class="form-control" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" title="" required="required" disabled>
            </div>

            <div class="form-group">
                {!! Form::label('due_date',"Due Date") !!}
                {!! Form::text('due_date',null,['class'=>'form-control']) !!}
            </div>


            <h3>Branch Address</h3>
            {{--<div class="form-group">--}}
                {{--<input type="datetime-local" name="due_date" class="form-control" value="{{\Carbon\Carbon::tomorrow()}}" required="required">--}}
            {{--</div>--}}


        </div>

    </div>


<h3>Order Details</h3>

<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#product_modal"><span class="glyphicon glyphicon-plus"></span> Add Product</button>


@include('quote._invoicetable')



    {!! Form::submit('Create Quotation',['class'=>'btn btn-success']) !!}
    
</form>
@include('quote._productmodal')

@endsection
