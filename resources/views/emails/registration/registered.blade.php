@component('mail::message')
# Welcome to Spectrum Digital Print

Hi {{$user->first_name}},

Thank you for registering with Spectrum Digital Print Solutions!

You are almost there, we just need to verify your email address.

<p><a href="#">{{$activation}}</a>

@component('mail::button', ['url' => ''])
Verify Email Address
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
