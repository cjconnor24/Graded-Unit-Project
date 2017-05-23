@extends('layouts.user_master')
@section('content')

    @include('includes.errors')

    <h1><span class="fi-man-line-graph-1 fi-man"></span> Dashboard</h1>

    <div class="row row-eq-height">

        <div class="col-md-6 stretch">

            @component('components.panel',['colour'=>'warning'])
                @slot('title')
                   <span class="fi-shop fi-shop-shopping-cart"></span> Current Quotations
                @endslot

            @if($quotes->count()>0)
                <table class="table table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>Quotation Number</th>
                        <th class="hidden-sm">Placed on</th>
                        <th>Due</th>
                        <th>Total</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quotes as $quote)
                    <tr>
                        <td>{{$quote->quote_number}}</td>
                        <td class="hidden-sm">{{$quote->created_at->diffForHumans()}}</td>
                        <td>{{ \Carbon\Carbon::parse($quote->due_date)->format('d-m-Y')}}</td>
                        <td>£{{$quote->order_total}}</td>
                        <td><a class="btn btn-sm btn-info" href="{{action('UserQuotationController@show',['quotation'=>$quote->id])}}">View</a></td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                    @else
                <p><em>There are no recent quotations</em></p>
                @endif

                @endcomponent

        </div>

        <div class="col-md-6 stretch">

            @component('components.panel',['colour'=>'info'])
                @slot('title')
                    <span class="fi-shop fi-shop-online-shop-1"></span> Current Orders
                @endslot

            @if($orders->count()>0)
                <table class="table table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>Order Number</th>
                        <th class="hidden-sm">Placed on</th>
                        <th class="hidden-sm">Due</th>
                        <th class="hidden-sm">Total</th>
                        <th>Status</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $quote)
                        <tr>
                            <td>{{$quote->order_number}}</td>
                            <td class="hidden-sm">{{$quote->created_at->diffForHumans()}}</td>
                            <td>{{ \Carbon\Carbon::parse($quote->due_date)->format('d-m-Y')}}</td>
                            <td class="hidden-sm">£{{$quote->order_total}}</td>
                            <td><span class="label label-{{$quote->orderStatus->colour}}">{{$quote->orderStatus->name}}</span></td>
                            <td><a class="btn btn-sm btn-info" href="{{action('UserOrderController@show',['quotation'=>$quote->id])}}">View</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    @else
                <p><em>You have no current orders</em></p>
                    @endif

            @endcomponent

        </div>

    </div>




@endsection