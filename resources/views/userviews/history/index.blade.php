@extends('layouts.user_master')
@section('content')


    <h1>Order History</h1>

    <p>Below is your order history</p>

    @if(count($orders)>0)

    <div class="table-responsive">
    <table class="table table-responsive">
        <thead>
        <tr>
            <th>Order</th>
            <th>Placed</th>
            <th>Type</th>
            {{--<th>Status</th>--}}
            <th>total</th>
        </tr>
        </thead>
        <tbody>

        @foreach($orders as $order)
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->created_at->diffForHumans()}}</td>
            <td>{{$order->state->name}}</td>
            <td>£{{$order->order_total}}</td>

        </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    @else
    <p><em>You don't currently have any past orders.</em></p>
    @endif

@endsection