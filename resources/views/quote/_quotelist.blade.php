<div class="table-responsive">
<table class="table">
    <thead>
    <tr>
        <th>Quote Reference</th>
        <th class="hidden-xs">Customer</th>
        <th class="hidden-xs">Created</th>
        <th>Due Date</th>
        <th>Quote Total</th>
        <th>View</th>
    </tr>
    </thead>
    <tbody>
    @foreach($quotations as $quote)
        <tr>
            <td>{{$quote->quote_number}}</td>
            <td class="hidden-xs"><a href="{{action('Admin\CustomerController@show',['customer'=>$quote->customer->id])}}">{{$quote->customer->full_name}}</a></td>
            <td class="hidden-xs">{{$quote->created_at->diffForHumans()}}</td>
            <td>{{date('D d M Y',strtotime($quote->due_date))}}</td>
            <td>£{{money_format('%.2n',$quote->order_total)}}</td>
            <td><a href="{{action('Admin\QuotationController@show',['quotation'=>$quote->id])}}" class="btn btn-sm btn-default"><span class="fi-misc-file fi-misc"></span> View {{$quote->quote_number}}</a></td>
        </tr>
    @endforeach

    </tbody>
</table>
</div>