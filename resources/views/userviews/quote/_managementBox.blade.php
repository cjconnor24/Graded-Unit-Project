
    <div class="panel panel-default hidden-print">

        <div class="panel-heading">
            <h3 class="panel-title">{{$quotation->quote_number}} Quote Management</h3>
        </div>

        <div class="panel-body">

            <a href="{{action('UserQuotationController@approveQuotation',['quotation'=>$quotation->QuoteApprovals->first()->order_id,'token'=>$quotation->QuoteApprovals->first()->token])}}" class="btn btn-success btn-block"><span class="glyphicon glyphicon-ok"></span> Approve Quote</a>
            <button data-toggle="modal" data-target="#rejectModal" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span> Reject Quote</button>

        </div>

    </div>

