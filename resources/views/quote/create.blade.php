@extends('layouts.admin_master')
@section('scripts')
    <script src="{{asset('js/quote.js')}}"></script>
@endsection
@section('content')

    <h1>Create New Quote</h1>
    <p>Please select details below</p>

    {!! Form::open(['action' => 'Admin\QuotationController@store','id'=>'quote_form']) !!}

    @include('includes.errors')
    <div class="row">

        <div class="col-md-6 col-lg-6">
            <h2>Customer Details</h2>

            <div class="form-group">
                <label for="customer_id">Choose Customer</label>
            {!! Form::select('customer_id', $customers, null, ['id'=>'customer_id','placeholder' => 'Choose customer','class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                <label for="address_id">Choose Address</label>
            {!! Form::select('address_id', [], null, ['id'=>'address_id','placeholder' => 'Please select a customer','class'=>'form-control input-sm']) !!}
            </div>


            <h2>Customer Address</h2>
            <p id="customer_address_line">12 Linn Gdns,<br />Craiglinn,<br>Cumbernauld, <br>G68 9AN</p>

        </div>

        <div class="col-md-6 col-lg-6">
            <h2>Quotation Date</h2>
            <input type="date" name="date" id="inputID" class="form-control" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" title="" required="required" disabled>

            <h2>Add Product</h2>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#product_modal">Add Product</button>

        </div>

    </div>


<h2>Order Details</h2>

<style type="text/css">
    #invoice_table tbody tr:first-child{
        display:none;
    }
</style>
        <table class="table table-responsive table-hover" id="invoice_table">
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
    <td><input type="hidden"></td>
    <td><input type="hidden"></td>
    <td><input type="hidden"></td>
    <td><input type="text"></td>
    <td>Price</td>
</tr>
</tbody>
        </table>

    <input type="hidden" id="form-check" value="">

    {!! Form::submit('Create Quotation',['class'=>'btn btn-success']) !!}
    
    {!! Form::close() !!}

    <!-- Modal -->
    <div id="product_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Product to Quotation</h4>
                </div>
                <div class="modal-body">

                    <div id="product_builder">

                        <div class="form-group"><label for="category_id">Product Category</label>{!! Form::select('', $categories, null, ['id'=>'category_id','placeholder' => 'Choose a product','class'=>'form-control']) !!}</div>

                        <div class="form-group"><label for="product-id">Product</label><select id="product_id" class="form-control"></select></div>
                        <div class="form-group"><label for="paper_id">Paper Stock</label><select id="paper_id" class="form-control"></select></div>
                        <div class="form-group"><label for="size_id">Size Option</label><select id="size_id" class="form-control"></select></div>
                        <input type="hidden" id="product_price">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="add_product">Add Product</button>

                    <button type="button" class="btn btn-default" data-dismiss="modal">Finished</button>
                </div>
            </div>

        </div>
    </div>

@endsection
