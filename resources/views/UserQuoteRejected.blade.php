@component('mail::message')
# Quote Rejected

Hi {{$quote->customer->first_name}}

This is to confirm that your quotation {{$quote->quote_number}} has been rejected.

## Reason
{{$quote->rejection->reason}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
