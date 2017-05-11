<table class="table table-responsive table-hover" id="invoice_table">
    <thead>
    <tr>
        <th>Product</th>
        <th>Paper</th>
        <th>Size</th>
        <th class="col-sm-1">Qty</th>
        <th>Note</th>
        <th class="col-sm-1">Price</th>
        <th class="col-sm-1">&nbsp;</th>

    </tr>
    </thead>

    <tbody>
    <tr>
        <td><input type="hidden"></td>
        <td><input type="hidden"></td>
        <td><input type="hidden"></td>
        <td><input type="text" class="form-control"></td>
        <td><input type="text" class="form-control"></td>
        <td></td>
        <td><a href="#" class="remove-row">Remove</a></td>
    </tr>

    @if(isset($quotation))

        @foreach($quotation->OrderProducts as $key=>$line)

            <tr>
                <td><input name="order[{{$key+1}}][product_id]" value="{{$line->product->id}}" type="hidden">{{$line->product->name}}</td>
                <td><input name="order[{{$key+1}}][paper_id]" value="{{$line->paper->id}}" type="hidden">{{$line->paper->name}}</td>
                <td><input name="order[{{$key+1}}][size_id]" value="{{$line->size->id}}" type="hidden">{{$line->size->name}}</td>
                <td><input name="order[{{$key+1}}][qty]" type="text" placeholder="Qty" class="form-control" value="{{$line->qty}}"></td>
                <td><input name="order[{{$key+1}}][description]" type="text" class="form-control" placeholder="Item notes" value="{{$line->description}}"></td>
                <td>£{{$line->line_total}}</td>
                <td><a href="#" class="remove-row">Remove</a></td>
            </tr>

        @endforeach
    @endif
    </tbody>
</table>