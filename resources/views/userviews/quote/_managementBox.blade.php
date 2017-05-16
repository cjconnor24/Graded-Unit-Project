@component('components.panel')

    @slot('title')
    <span class="fi-misc fi-misc-settings-1"></span> {{$quotation->quote_number}} Quote Management
    @endslot

    <a href="{{action('UserQuotationController@approveQuotation',['quotation'=>$quotation->QuoteApprovals->first()->order_id,'token'=>$quotation->QuoteApprovals->first()->token])}}" class="btn btn-success btn-block"><span class="glyphicon glyphicon-ok"></span> Approve Quote</a>
    <button data-toggle="modal" data-target="#rejectModal" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span> Reject Quote</button>

@endcomponent