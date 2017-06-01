@extends('layouts.user_master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('scripts')
    <script type="text/javascript">
        $("#cancel-button").on("click", function (event) {
            if ($(this).hasClass("disabled")) {

                event.stopPropagation();
            } else {
//                $('#confirm-cancel').modal("show");
            }
        });
    </script>
@endsection
@section('content')

    <div class="modal fade" id="confirm-cancel" tabindex="-1" role="dialog" aria-labelledby="rejectModelLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Cancel Order</h4>
                </div>
                <div class="modal-body text-center">
                    <p><span class="glyphicon glyphicon-warning-sign" style="font-size:5em;color:#F00;"></span></p>

                    <p class="lead">Are you sure you want to cancel this order?</p>



                    <p><strong>Note:</strong> This cannot be un-done.</p>


                </div>
                <div class="modal-footer">
                    {!! Form::open(['action'=>['UserOrderController@cancellation','order'=>$quotation->id]]) !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger"><span class="glyphicon-warning-sign glyphicon"></span> Cancel Order</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    @include('includes.errors')

<a href="{{action('UserOrderController@index')}}" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Return to Orders</a>


    <div class="row">

    <h1><span class="fi-shop-online-shop-1 fi-shop"></span> {{$quotation->order_number}}</h1>

    </div>


    <div class="row row-eq-height">

        <div class="col-sm-4 stretch col-flex">
            @component('components.panel',['colour'=>$quotation->orderStatus->colour])
                @slot('title')
                    <span class="fi-shop fi-shop-shopping-cart"></span> Order Information
                @endslot

                <table class="table">
                    <tr>
                        <td><strong>Date Approved</strong></td>
                        <td>{{$quotation->quoteApprovals->first()->updated_at}}</td>
                    </tr>

                    <tr>
                        <td><strong>Due Date</strong></td>
                        <td>{{$quotation->due_date}}</td>
                    </tr>
                    <tr>

                        <td><strong>Order Status</strong></td>
                        <td><span class="label label-{{$quotation->orderStatus->colour}}">{{$quotation->orderStatus->name}}</span><br />

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-{{$quotation->orderStatus->colour}} active" role="progressbar" aria-valuenow="{{$quotation->order_progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$quotation->order_progress}}%">
                                    <span class="sr-only">{{$quotation->orderStatus->name}}</span>
                                </div>
                            </div></td>
                    </tr>
                </table>

            @endcomponent

            @php
            // MAKE SURE ORDER IS ALLOWED TO BE CANCELLED
                $accepted = [
                'Awaiting Payment',
                'With Artworker',
                'Awaiting Proof Approval'
            ];
            if(in_array($quotation->orderStatus->name,$accepted)){
                $cancel = "";
            } else {
                $cancel = "disabled";
            }
            @endphp

                @component('components.panel',['colour'=>'danger'])
                    @slot('title')
                        <span class="fi-misc-trash fi-misc"></span> Cancellations
                    @endslot

                    <p>To cancel and order, please click the cancellation button below.</p>



                    <button type="button" class="btn btn-lg btn-danger btn-block {{$cancel}}" id="cancel-button" data-toggle="modal" data-target="#confirm-cancel"><span class="glyphicon-warning-sign glyphicon"></span> Cancel Order</button>


                @endcomponent





        </div>

        <div class="col-sm-4 col-flex stretch">

            @include('userviews.components._customer',['customer'=>$quotation->customer,'address'=>$quotation->address])

            @component('components.panel',['colour'=>$quotation->orderStatus->colour])
                @slot('title')
                    <span class="fi-shop fi-shop-credit-card"></span> Payments
                @endslot

                @if(count($quotation->payments)>0)

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Payment Type</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($quotation->payments as $payment)
                            <tr>
                                <td>{{$payment->created_at}}</td>
                                <td>£{{$payment->amount}}</td>
                                <td>{{ title_case(str_replace('_',' ',$payment->payment_type))}}</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>

                @else
                    <p class="text-center"><em>You haven't made any payments yet</em></p>
                    <p class="text-center"><a href="{{action('PaymentController@index',['order'=>$quotation->id])}}" class="btn btn-success"><span class="glyphicon glyphicon-credit-card"></span> Make Payment</a></p>
                @endif

            @endcomponent

        </div>

        <div class="col-sm-4 col-flex stretch">

            @include('userviews.components._branch',['staff'=>$quotation->staff,'branch'=>$quotation->branch])

        </div>

    </div>


    <h2><span class="fi-shop fi-shop-shopping-basket"></span> Order Details</h2>
    @include('userviews.components._ordertable',['order'=>$quotation])




@endsection