<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModelLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Reject Quotation {{$quotation->quote_number}}</h4>
            </div>
            <div class="modal-body text-center">



                <p><span class="glyphicon glyphicon-warning-sign" style="font-size:5em;color:#F00;"></span></p>

                    <p class="lead">Are you sure you want to reject quote {{$quotation->quote_number}}?</p>



                <p>Please let us know the main reason:</p>

                <textarea class="form-control" rows="3" id="rejectReason" name="rejectReason"></textarea>
                <input type="hidden" name="order_id" id="order_id" value="{{$quotation->id}}" />

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="confirmReject">Confirm Reject</button>
            </div>
        </div>
    </div>
</div>