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
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{$order->order_number}}</td>
            <td>{{$order->created_at}}</td>
            <td>{{$order->due_date}}</td>
            <td>{{$order->orderStatus->name}}</td>
            <td>£{{money_format('%.2n',$order->order_total)}}</td>
        </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>You have no active orders currently</p>
    @endif
@endsection