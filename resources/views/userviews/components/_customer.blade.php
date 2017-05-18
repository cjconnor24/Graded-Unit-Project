@component('components.panel')
    @slot('title')
        <span class="fi-misc fi-misc-user-1"></span> Customer Information
    @endslot
    <h4>{{$customer->first_name.' '.$customer->last_name}}</h4>
    <address>{!! str_replace(', ',',<br />',$address->full_address) !!}</address>
@endcomponent