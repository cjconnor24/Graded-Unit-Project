@extends('layouts.admin_master')
@section('scripts')
    <script>

        $( document ).ready(function() {

            jQuery('#quote_form').bind('submit',function(e){

                if($('#form-check').val()!==""){
                    alert('ok');
                } else {
                    alert('not ok');
                    e.preventDefault();
                }

            });

            //add_product
//            $("#add_product").click(function () {
//
//
//                $("#product_builder").find("select").each(function (i, data) {
////                    console.log($(this).find("option:selected").val());
////                    console.log($(this).find("option:selected").text());
//                });
//
//            });

            $('#add_product').click(function () {

                // COPY THE INVOICE LINE
                $('#invoice_table tbody').append($('#invoice_table tbody tr:first').clone());

                console.log('clones');

//                var newRow = $('#invoice_table tbody tr:last');

                // REMOVE THE FIRST LINE TEMPLATE
//                if($('#invoice_table tbody tr:first').find('input')[0].name.indexOf(1)==-1){
//                    $('#invoice_table tbody tr:first').remove();
//                }


                var product_builder = getInvoiceLine();

                var hiddeninputs = $('#invoice_table tbody tr:last').find('input[type="hidden"]');
                var qty = $('#invoice_table tbody tr:last').find('input[type="text"]');

                console.log(qty);


//                    var hiddeninputs = $(this).find('input[type="text"]');
                var count = $('#invoice_table tbody tr').length;
//
                    hiddeninputs.eq(0).attr({
                        name: 'order[' + count + '][product_id]',
                        value: product_builder[1].id
                    }).parent().append(product_builder[1].value);

                    hiddeninputs.eq(1).attr({
                        name: 'order[' + count + '][paper_id]',
                        value: product_builder[2].id
                    }).parent().append(product_builder[2].value);
                    hiddeninputs.eq(2).attr({
                        name: 'order[' + count + '][size_id]',
                        value: product_builder[3].id
                    }).parent().append(product_builder[3].value);

                $('#invoice_table tbody tr td:last').html('£'+product_builder[4].price);

                    qty.attr({
                    name: 'order[' + count + '][qty]',
                    value: 1
                });

                clearDropDown();
                $('#form-check').val('test');

            });


            /**
             *
             */
            $('#category_id').on('change', function (e) {

                var category_id = e.target.value;

                // SEND REQUET
                $.get('/admin/ajax-product/' + category_id, function (data) {

                    // CLEAR DROPDOWN
                    $('#product_id').empty();
                    $('#paper_id').empty();
                    $('#size_id').empty();


                    $('#product_id').append($('<option></option>').attr("value", "").text('-- Select Product --'));

                    $.each(data, function (i, item) {
//                        console.log(item);
                        $('#product_id').append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));

                    });

                });
            });

            $('#product_id').on('change', function (e) {

                var product_id = e.target.value;

                // SEND REQUET
                $.get('/admin/ajax-product-options/' + product_id, function (data) {

                    // CLEAR DROPDOWN
                    $('#paper_id').empty();
                    $('#size_id').empty();

                    console.log(data);

                    $('#product_price').attr('value',data.price);

                    $('#paper_id').append($('<option></option>').attr("value", "").text('-- Select Paper --'));
                    $('#size_id').append($('<option></option>').attr("value", "").text('-- Select Size --'));

                    $.each(data.sizes, function (i, item) {
//                        console.log(item);
                        $('#size_id').append($('<option>', {
                            value: i,
                            text: item
                        }));

                    });

                    $.each(data.papers, function (i, item) {
//                        console.log(item);
                        $('#paper_id').append($('<option>', {
                            value: i,
                            text: item
                        }));

                    });

                });
            });


            /**
             * GET THE CUSTOMER ID AND LOAD THEIR ADDRESSES INTO THE DROP DOWN
             */
            $('#customer_id').on('change', function (e) {

                var customer_id = e.target.value;

                // SEND THE REQUEST TO GET TEH DADRESSES
                $.get('/admin/ajax-address/' + customer_id, function (data) {

                    // CLEAR DROPDOWNS
                    $('#address_id').empty();

                    // LOOP THROUGH RESULTS AND ADD THE OPTIONS
                    $.each(data, function (i, item) {

                        $('#address_id').append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));

                    });

                });
            });

            // FOR DEBUGGING
            $('#address_id').on('change', function (e) {
//                console.log('Address' + e.target.value + 'was clicked');
            });



        });



        function getInvoiceLine(){

            var data = [];
            var success = true;

            $('#product_builder').find('select option:selected').each(function(i,item){
                data[i] = {id : item.value, value : item.innerHTML};
            });

            data.push({price: $('#product_price').val()});
            console.log(data);
            return data;
        }

        /**
         * Clear the product builder form
         * @returns {boolean}
         */
        function clearDropDown(){
            $('#product_builder').find('select').each(function(item){
            $(this).prop('selectedIndex',0);
            if(item>1){
                $(this).empty();
            }
            });
            return true;
        }

    </script>
@endsection
@section('content')
    <button class="btn" type="button">BUTTON</button>
    <h1>Create New Quote</h1>
    <p>Please select details below</p>

    {!! Form::open(['action' => 'Admin\QuotationController@store','id'=>'quote_form']) !!}

    <div class="row">

        <div class="col-md-6 col-lg-6">
            <h2>Customer Details</h2>

            <div class="form-group">
                <label for="customer_id">Choose Customer</label>
            {!! Form::select('customer_id', $customers, null, ['id'=>'customer_id','placeholder' => 'Choose customer','class'=>'form-control','required']) !!}
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

            <div id="product_builder">

            <div class="form-group">{!! Form::select('', $categories, null, ['id'=>'category_id','placeholder' => 'Choose a category customer','class'=>'form-control']) !!}</div>

                <div class="form-group"><select id="product_id" class="form-control"></select></div>
                <div class="form-group"><select id="paper_id" class="form-control"></select></div>
                <div class="form-group"><select id="size_id" class="form-control"></select></div>
                <input type="hidden" id="product_price">

            <button type="button" class="btn-sm btn btn-success" id="add_product">Add Product to Quotation</button>

            </div>

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

    <a href="#" class="btn btn-sm btn-success">Add Product</a>

    {!! Form::submit('Create Quotation',['class'=>'btn btn-success']) !!}
    
    {!! Form::close() !!}

@endsection