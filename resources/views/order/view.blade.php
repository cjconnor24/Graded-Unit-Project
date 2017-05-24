@extends('layouts.admin_master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function() {

            $('#successModal, #errorModal').on('hidden.bs.modal', function () {
                window.location.reload();
            })

            $('#status_id').on('change',function(e){

                console.log($(this).val());

                var postData = {
                    'order_id':window.location.pathname.split('/')[3],
                    'status_id':$(this).val()
                };

                console.log(postData);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'POST',
                    data:postData,
                    url:'/admin/orders/'+postData.order_id+'/status/'+postData.status_id,
                    success: function(response){
                        console.log(response);
                        $('#successModal').modal('show');
                    },
                    error: function(response){
                        $('#errorModal').modal('show');
                    }
                })


            });

        });
    </script>
@endsection
@section('content')

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content panel-success">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Success</h4>
                </div>
                <div class="modal-body text-center">

                    <span class="fi-shop-like fi-shop" style="font-size:6em;"></span>
                    <p class="lead">Status Successfully Updated</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content panel-danger">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Error</h4>
                </div>
                <div class="modal-body text-center">

                    <span class="fi-man-info fi-man" style="font-size:6em;color:"></span>
                    <p class="lead">This order has already been completed.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <a href="{{action('Admin\OrderController@index')}}" class="btn btn-default"><span class="fi-misc-return fi-misc"></span> Return to Orders</a>
    
    <h1><span class="fi-shop-online-shop-1 fi-shop"></span> Order {{$order->order_number}}</h1>

    <div class="row row-eq-height">



        <div class="col-lg-4 stretch">

            @include('userviews.components._customer',['customer'=>$order->customer,'address'=>$order->address])

        </div>

        <div class="col-lg-4 stretch">
            @include('userviews.components._branch',['branch'=>$order->branch,'staff'=>$order->staff])
        </div>

        <div class="col-lg-4 stretch col-flex">


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

    </div>



    <h3><span class="fi-shop-shopping-basket fi-shop"></span> Order Details</h3>
    @include('userviews.components._ordertable',['order'=>$order])

    <div class="col-md-8 col-md-offset-2">

@include('userviews.components._notes',['order'=>$order])

    </div>

@endsection