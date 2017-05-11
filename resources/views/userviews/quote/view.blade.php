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
//                error: function(response){
//                    var errorString = '';
//                    $.each(response.responseJSON,function(i,v){
//                        errorString+=('<p>'+v[0]+'</p>');
//                    });
//
//                    $('.alert-danger').html(errorString).slideDown();
//                }
            })

            });
        });



    </script>
    @endsection
@section('content')

@include('userviews.quote._rejectModal')


    <div class="row">
    <h1>{{$quotation->quote_number}}</h1>

    </div>

    <div class="row">

        <div class="col-sm-6">
    <h4>{{$quotation->customer->first_name.' '.$quotation->customer->last_name}}</h4>
    <p>{!! str_replace(', ',',<br />',$quotation->address->full_address) !!}</p>

        </div>

        <div class="col-sm-6 text-right">

            <div class="col-sm-6">@include('userviews.quote._managementBox')</div>

            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">





            <h4>Spectrum Contact</h4>
            <p>{{$quotation->staff->full_name}} / {{$quotation->staff->email}}</p>

            <h4>{{$quotation->branch->name}}</h4>
            <p>{!! str_replace(', ',',<br />',$quotation->branch->full_address) !!}</p>
            <p><a href="mailto:{{$quotation->branch->email}}">{{$quotation->branch->email}}</a><br />{{$quotation->branch->telephone}}</p>
            </div>


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