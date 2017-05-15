@extends('layouts.user_master')
@section('content')
    <h1>Orders</h1>

    @if(count($orders)>0)

    <table class="table table-responsive">
        <thead>
        <tr>
            <th>Order Number</th>
            <th>Created</th>
            <th>Due Date</th>
            <th>Order Status</th>
            <th>Order Total</th>
            <th>View</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{$order->order_number}}</td>
            <td>{{$order->created_at}}</td>
            <td>{{$order->due_date}}</td>
            <td><span class="label label-{{$order->orderStatus->colour}}">{{$order->orderStatus->name}}</span></td>
            <td>£{{money_format('%.2n',$order->order_total)}}</td>
            <td><a href="{{action('UserOrderController@show',['order'=>$order->id])}}" class="btn btn-success">View</a></td>
        </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>You have no active orders currently</p>
    @endif
@endsection