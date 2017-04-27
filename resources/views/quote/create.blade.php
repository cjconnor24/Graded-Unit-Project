@extends('layouts.admin_master')
@section('scripts')
    <script>

        //add_product
        $( "#add_product" ).click(function() {


            $( "#product_builder" ).find( "select" ).each(function(i, data){
                console.log($(this).find("option:selected").val());
                console.log($(this).find("option:selected").text());
            });

        });



        /**
         *
         */
        $('#category_id').on('change', function(e) {

            var category_id = e.target.value;

            // SEND REQUET
            $.get('/admin/ajax-product/' + category_id, function(data) {

                // CLEAR DROPDOWN
                $('#product_id').empty();
                $('#paper_id').empty();
                $('#size_id').empty();


                $('#product_id').append($('<option></option>').attr("value","").text('-- Select Product --'));

                $.each(data, function(i,item){
                console.log(item);
                    $('#product_id').append($('<option>', {
                        value: item.id,
                        text : item.name
                    }));

                });

            });
        });

        $('#product_id').on('change', function(e) {

            var product_id = e.target.value;

            // SEND REQUET
            $.get('/admin/ajax-product-options/' + product_id, function(data) {

                // CLEAR DROPDOWN
                $('#paper_id').empty();
                $('#size_id').empty();

                console.log(data);

                $('#paper_id').append($('<option></option>').attr("value","").text('-- Select Paper --'));
                $('#size_id').append($('<option></option>').attr("value","").text('-- Select Size --'));

                $.each(data.sizes, function(i,item){
                    console.log(item);
                    $('#size_id').append($('<option>', {
                        value: i,
                        text : item
                    }));

                });

                $.each(data.papers, function(i,item){
                    console.log(item);
                    $('#paper_id').append($('<option>', {
                        value: i,
                        text : item
                    }));

                });

            });
        });


//        console.log('HELLO');
        $('#customer_id').on('change', function(e) {

//            console.log(e);

            var customer_id = e.target.value;
//            console.log(customer_id);

            // SEND REQUET
            $.get('/admin/ajax-address/' + customer_id, function(data) {

                // CLEAR DROPDOWN
                $('#address_id').empty();
                $('#customer_address_line').empty();

                $('#customer_address_line').append(
//                    add.join(', ')
                );

                $.each(data, function(i,item){

                    $('#address_id').append($('<option>', {
                        value: item.id,
                        text : item.name
                    }));

                });

            });
        });

$('#address_id').on('change', function(e) {
    console.log('Address'+e.target.value+'was clicked');
});



    </script>
@endsection
@section('content')
    <h1>Create New Quote</h1>
    <p>Please select details below</p>

    {!! Form::open(['action' => 'Admin\QuotationController@store']) !!}

    <div class="row">

        <div class="col-md-6 col-lg-6">
            <h2>Customer</h2>

            <div class="form-group">
            {!! Form::select('customer_id', $customers, null, ['id'=>'customer_id','placeholder' => 'Choose customer','class'=>'form-control']) !!}
            </div>

            <div class="form-group">
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

            <div class="form-group">{!! Form::select('category_id', $categories, null, ['id'=>'category_id','placeholder' => 'Choose a category customer','class'=>'form-control']) !!}</div>

                <div class="form-group"><select id="product_id" class="form-control"></select></div>
                <div class="form-group"><select id="paper_id" class="form-control"></select></div>
                <div class="form-group"><select id="size_id" class="form-control"></select></div>

            <button type="button" class="btn-sm btn btn-success" id="add_product">Add Product to Quotation</button>

            </div>

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
@for($i =1; $i <= 3; $i++)
<tr>
    <td>{!! Form::text("order[$i][product_id]",null,['class'=>'form-control']) !!}</td>
    <td>{!! Form::text("order[$i][paper_id]",null,['class'=>'form-control']) !!}</td>
    <td>{!! Form::text("order[$i][size_id]",null,['class'=>'form-control']) !!}</td>
    <td>{!! Form::text("order[$i][qty]",null,['class'=>'form-control']) !!}</td>
    <td>Price</td>
</tr>
@endfor
</tbody>
        </table>

    <a href="#" class="btn btn-sm btn-success">Add Product</a>

    {!! Form::submit('Create Quotation',['class'=>'btn btn-success']) !!}
    
    {!! Form::close() !!}

@endsection