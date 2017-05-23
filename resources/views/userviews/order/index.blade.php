@extends('layouts.user_master')
@section('content')

    <h1><span class="fi-shop fi-shop-online-shop-1"></span> Orders</h1>
    <p>Please find a list of your current orders below.</p>

    @if(count($orders)>0)
    <div class="table-responsive">
    <table class="table table-responsive">
        <thead>
        <tr>
            <th>Order Number</th>
            <th class="hidden-xs hidden-sm">Created</th>
            <th class="hidden-xs">Due Date</th>
            <th>Order Status</th>
            <th>Order Total</th>
            <th>View</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
        <tr class="{{$order->orderStatus->colour=='danger' ? 'danger' : ''}}">
            <td>{{$order->order_number}}</td>
            <td class="hidden-xs hidden-sm">{{$order->created_at}}</td>
            <td  class="hidden-xs">{{$order->due_date}}</td>
            <td><span class="label label-{{$order->orderStatus->colour}}">{{$order->orderStatus->name}}</span></td>
            <td>£{{money_format('%.2n',$order->order_total)}}</td>
            <td><a href="{{action('UserOrderController@show',['order'=>$order->id])}}" class="btn btn-success">View</a></td>
        </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    @else
    <p>You have no active orders currently</p>
    @endif
@endsection