@extends('layouts.admin_master')
@section('content')
    <h1>Create New Quote</h1>
    <p>Please select details below</p>

    <div class="row">

        <div class="col-md-6 col-lg-6">
            <h2>Customer</h2>

            {!! Form::select('customer', $customers, null, ['placeholder' => 'Choose customer','class'=>'form-control']) !!}

            <h2>Customer Address</h2>
            <p>12 Linn Gdns,<br />Craiglinn,<br>Cumbernauld, <br>G68 9AN</p>

        </div>

        <div class="col-md-6 col-lg-6">
            <h2>Quotation Date</h2>
            <input type="date" name="date" id="inputID" class="form-control" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" title="" required="required" disabled>

        </div>

    </div>


<h2>Order Details</h2>


        <table class="table table-responsive table-hover">
            <thead>
            <tr>
                <th>Product</th>
                <th>Paper</th>
                <th>Size</th>
                <th>Qty</th>
                <th>Price</th>
            </tr>
            </thead>

<tbody>
<tr>
    <td>Product</td>
    <td>Paper</td>
    <td>Size</td>
    <td>Qty</td>
    <td>Price</td>
</tr>
</tbody>
        </table>

    <a href="#" class="btn btn-sm btn-success">Add Product</a>


@endsection