@extends('layouts.admin_master')
@section('scripts')
    <script>
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