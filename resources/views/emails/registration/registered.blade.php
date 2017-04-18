@component('mail::message')
# Welcome to Spectrum Digital Print

Hi {{$user->first_name}},

Thank you for registering with Spectrum Digital Print Solutions!

You are almost there, we just need to verify your email address.

@php ($url = action('ActivationController@activate',['email'=>$user->email,'activationCode'=>$activation]))

<p><a href="{{ $url }}">Verify Email Address</a>

@component('mail::button', ['url' => $url])
Verify Email Address
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
