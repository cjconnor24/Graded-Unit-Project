@extends('layouts.user_master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#confirmReject').click(function () {

                console.log('this triggers');
//                event.preventDefault();

                var postData = {
                    reason: $('#rejectReason').val(),
                    order_id: $('#order_id').val()
                }

                console.log(postData);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                data:postData,
                url:'/quotations/reject/'+postData.order_id,
                success: function(response) {
                    console.log(response);
                    window.location.href = response.redirect;
                },
                error: function(response){
                    var errorString = '';
                    $.each(response.responseJSON,function(i,v){
                        errorString+=('<p>'+v[0]+'</p>');
                    });

                    $('.alert-danger').html(errorString).slideDown();
                }
            })

            });
        });



    </script>
    @endsection
@section('content')



    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModelLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Reject Quotation {{$quotation->quote_number}}</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <p>Are you sure you want to reject quote {{$quotation->quote_number}}?</p>
                    </div>

                    <p>Please let us know the main reason:</p>

                    <textarea class="form-control" rows="3" id="rejectReason" name="rejectReason"></textarea>
                    <input type="hidden" name="order_id" id="order_id" value="{{$quotation->id}}" />

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="confirmReject">Confirm Reject</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
    <div class="panel panel-default hidden-print">

        <div class="panel-heading">
            <h3 class="panel-title">{{$quotation->quote_number}} Quote Management</h3>
        </div>
        <div class="panel-body">



                <a href="{{action('UserQuotationController@approveQuotation',['quotation'=>$quotation->QuoteApprovals->first()->order_id,'token'=>$quotation->QuoteApprovals->first()->token])}}" class="btn btn-success btn-block"><span class="glyphicon glyphicon-ok"></span> Approve Quote</a>
                <button data-toggle="modal" data-target="#rejectModal" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span> Reject Quote</button>


        </div>
    </div>
        </div>
    </div>


    <div class="row">
    <h1>{{$quotation->quote_number}}</h1>

    </div>





    <div class="row">

        <div class="col-sm-6">
<h3>Customer</h3>
    <h4>{{$quotation->customer->first_name.' '.$quotation->customer->last_name}}</h4>
    <p>{!! str_replace(', ',',<br />',$quotation->address->full_address) !!}</p>

        </div>

        <div class="col-sm-6 text-right">

            <h3>Branch Details</h3>
            <h4>{{$quotation->branch->name}}</h4>
            <p>{!! str_replace(', ',',<br />',$quotation->branch->full_address) !!}</p>

        </div>


    </div>

    <table class="table table-responsive">
        <thead>
        <tr>
            <th>Name</th>
            <th>Paper</th>
            <th>Size</th>
            <th>Cost</th>
            <th>Qty</th>
            <th>Line Total</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td><strong>Payment Due</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Sub Total</strong></td>
            <td>£{{$quotation->order_total}}</td>
        </tr>
        </tfoot>
        <tbody>
        @foreach($quotation->OrderProducts as $line)
        <tr>
            <td>{{$line->product->name}}</td>
            <td>{{$line->paper->name}}</td>
            <td>{{$line->size->name}} <em>({{$line->size->height.' x '.$line->size->width}}mm)</em></td>
            <td>£{{$line->product->price}}</td>
            <td>{{$line->qty}}</td>
            <td>£{{$line->line_total}}</td>
        </tr>
        @endforeach
        </tbody>

    </table>


@endsection