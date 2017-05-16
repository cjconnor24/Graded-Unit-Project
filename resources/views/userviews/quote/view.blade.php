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

<a href="{{action('UserQuotationController@index')}}" class="btn btn-default"><span class="fi-misc fi-misc-return"></span> Return to Quotes</a>

    <h1><span class="fi-shop fi-shop-shopping-cart"></span> Quotation {{$quotation->quote_number}}</h1>

<div class="row row-eq-height">


        <div class="col-sm-5">
            @include('userviews.quote._managementBox')
            @include('userviews.components._customer',['customer'=>$quotation->customer,'address'=>$quotation->address])
        </div>



        <div class="col-sm-7 stretch">

            @include('userviews.components._branch',['staff'=>$quotation->staff,'branch'=>$quotation->branch])

        </div>

</div>

<h2><span class="fi-shop fi-shop-shopping-basket"></span> Quotation Details</h2>

@include('userviews.components._ordertable',['order'=>$quotation])


@endsection