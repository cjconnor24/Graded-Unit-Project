@extends('layouts.admin_master')
@section('content')

    <h1><span class="fi-shop-online-shop-1 fi-shop"></span> Current Orders</h1>

    @if(count($orders)>0)

        <div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Order Number</th>
            <th>Customer</th>
            <th>Created</th>
            <th>Due Date</th>
            <th>Order Total</th>
            <th>Status</th>
            <th>view</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{$order->order_number}}</td>
            <td>{{$order->customer->full_name}}</td>
            <td>{{$order->created_at->diffForHumans()}}</td>
            <td>{{$order->due_date}}</td>
            <td>{{$order->order_total}}</td>
            <td><span class="label label-{{($order->orderStatus->colour)}}">{{$order->orderStatus->name}}</span></td>
            <td><a href="{{action('Admin\OrderController@show',['order'=>$order->id])}}">View</a></td>
        </tr>
            @endforeach
        </tbody>
    </table>
        </div>
    {{$orders->links()}}

    @else
    <p><em>There are currently no orders</em></p>
    @endif

@endsection