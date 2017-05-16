@extends('layouts.admin_master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('scripts')
    <script src="{{asset('js/quote.js')}}"></script>
@endsection
@section('content')

    <a class="btn btn-default" href="{{action('Admin\QuotationController@show',['quotation'=>$quotation->id])}}"><span class="fi-misc fi-misc-return"></span> Return to Quote</a>

    <h1>Edit Quote {{$quotation->quote_number}}</h1>
    <p>Please select details below</p>

    <div class="alert alert-danger" style="display:none;"></div>

        {!! Form::model($quotation,['action' => ['Admin\QuotationController@update',$quotation->id],'method'=>'PATCH','id'=>'quote_edit_form']) !!}




    @include('includes.errors')

    <div class="row">

        <div class="col-md-6 col-lg-6">
            <h3>Customer Details</h3>

            <div class="form-group">
                <label for="customer_id">Choose Customer</label>
            {!! Form::select('customer_id', $customers, $quotation->customer->id, ['id'=>'customer_id','placeholder' => 'Choose customer','class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                <label for="address_id">Choose Address</label>
            {!! Form::select('address_id', $quotation->customer->addresses->pluck('name','id'), $quotation->address->id, ['id'=>'address_id','placeholder' => 'Please select a customer','class'=>'form-control input-sm']) !!}
            </div>


            <h3>Customer Address</h3>
            <p id="customer_address">
                {!! str_replace(', ',',<br />',$quotation->address->full_address)!!}

            </p>


        </div>

        <div class="col-md-6 col-lg-6">
            <h3>Order Details</h3>

            <div class="form-group">
                <label for="branch_id">Choose Branch</label>
                {!! Form::select('branch_id', $branches,$quotation->branch->id, ['id'=>'branch_id','placeholder' => 'Please select a branch','class'=>'form-control input-sm']) !!}
            </div>

            <h3>Staff</h3>
            {!! Form::select('staff_id', $staff,null, ['id'=>'staff_id','placeholder' => 'Please select a staff member','class'=>'form-control input-sm']) !!}

            <div class="form-group">
                <label for="inputID">Order Date</label>
            
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



    {!! Form::submit('Update Quotation',['class'=>'btn btn-success']) !!}

{!! Form::close() !!}
@include('quote._productmodal')

@endsection
