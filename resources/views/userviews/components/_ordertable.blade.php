<table class="table table-responsive">
    <thead>
    <tr>
        <th>Product</th>
        <th>Paper</th>
        <th>Size</th>
        <th>Cost</th>
        <th>Qty</th>
        <th>Line Total</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><strong>Sub Total</strong></td>
        <td>£{{$order->order_total}}</td>
    </tr>
    </tfoot>
    <tbody>
    @foreach($order->OrderProducts as $line)
        <tr>
            <td>{{$line->product->name}}<br />
            <em>{{$line->description}}</em></td>
            <td>{{$line->paper->name}}</td>
            <td>{{$line->size->name}} <em>({{$line->size->height.' x '.$line->size->width}}mm)</em></td>
            <td>£{{$line->product->price}}</td>
            <td>{{$line->qty}}</td>
            <td>£{{$line->line_total}}</td>
        </tr>
    @endforeach
    </tbody>
</table>