@extends('layouts.admin_master')
@section('meta')

@endsection
@section('scripts')
    <script type="text/javascript">
        $(function() {

            $('#status_id').on('change',function(e){

                console.log($(this).val());

                var postData = {
                    'order_id':window.location.pathname.split('/')[3],
                    'status_id':$(this).val()
                };

                console.log(postData);

//                $.ajax({
//                    type:'POST',
//                    data:postData,
//                    url:'/admin/quotations',
//                    success: function(response){
//
//                        window.location.href = response.redirect;
//                    },
//                    error: function(response){
//                        var errorString = '';
//                        $.each(response.responseJSON,function(i,v){
//                            errorString+=('<p>'+v[0]+'</p>');
//                        });
//
//                        $('.alert-danger').html(errorString).slideDown();
//
//                        $('html, body').animate({
//                            scrollTop: $(".alert-danger").offset().top
//                        }, 500);
//
//                    }
//                })


            });

        });
    </script>
@endsection
@section('content')

    <a href="{{action('Admin\OrderController@index')}}" class="btn btn-default"><span class="fi-misc-return fi-misc"></span> Return to Orders</a>
    
    <h1><span class="fi-shop-online-shop-1 fi-shop"></span> Order {{$order->order_number}}</h1>

    <div class="row row-eq-height">



        <div class="col-lg-3 stretch">

            @include('userviews.components._customer',['customer'=>$order->customer,'address'=>$order->address])

        </div>

        <div class="col-lg-3 stretch">
            @include('userviews.components._branch',['branch'=>$order->branch,'staff'=>$order->staff])
        </div>

        <div class="col-lg-3 stretch col-flex">


            <div class="panel panel-default">

                <div class="panel-heading"><span class="fi-shop-online-shop-1 fi-shop"></span> Order Information</div>
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::label('status_id',"Order Status") !!}
                        {!! Form::select('status_id',$statuses,$order->orderStatus->id,['class'=>'form-control']) !!}
                    </div>


                    <p><strong>Staff Member:</strong>
                        {!! Form::select('staff_id',$staff,$order->staff->id,['class'=>'form-control']) !!}
                    </p>
                    <p><strong>Order Place:</strong> {{$order->created_at->diffForHumans()}}</p>
                    <p><strong>Due Date:</strong> {{$order->due_date}}</p>
                    <p><strong>Status:</strong> {{$order->orderStatus->name}}</p>
                </div>

            </div>

            @component('components.panel',['colour'=>$order->orderStatus->colour])
                @slot('title')
                    <span class="fi-shop fi-shop-credit-card"></span> Payments
                @endslot

                @if(count($order->payments)>0)

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Payment Type</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($order->payments as $payment)
                            <tr>
                                <td>{{$payment->created_at}}</td>
                                <td>£{{$payment->amount}}</td>
                                <td>{{ title_case(str_replace('_',' ',$payment->payment_type))}}</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
@else
                    <p class="text-center"><em>There are currently no payments.</em></p>
                @endif

            @endcomponent

        </div>

        <div class="col-md-3">



        </div>

    </div>



    <h3><span class="fi-shop-shopping-basket fi-shop"></span> Order Details</h3>
    @include('userviews.components._ordertable',['order'=>$order])

    <div class="col-md-8 col-md-offset-2">

@include('userviews.components._notes',['order'=>$order])

    </div>

@endsection