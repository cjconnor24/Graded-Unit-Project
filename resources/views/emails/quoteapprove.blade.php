@component('mail::message')
# Spectrum Digital Print - Quote For Approval

Hi {{$user->first_name}},

We are delighted to provide you with the following quotation.

You are almost there, we just need to verify your email address.


@component('mail::table')
Product | Options | Qty | Cost
--- | --- | :---: | :---:
@foreach($quotation->OrderProducts as $item)
{{$item->product->name}} | *{{$item->paper->name}}  _{{$item->size->name}}_* | {{$item->qty}} | £{{$item->line_total}}
@endforeach
    |   |   |
    |   | **_Sub-Total_** | £350.00
    |   |   | **_Total_** | £350.00
@endcomponent

@php ($approvalurl = action('UserQuotationController@approveQuotation',['quotation'=>$quotation->id,'token'=>$approval->token]))
@component('mail::button', ['url' => $approvalurl, 'color' => 'green'])
Approve Quotation
@endcomponent

@php ($rejectionurl = route('reject',['quotation'=>$quotation->id,'token'=>$approval->token]))
@component('mail::button', ['url' => $rejectionurl, 'color' => 'red'])
    Reject Quotation
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
