@component('mail::message')
# Password Reset

Hi {{$user->first_name}}

It looks like you are having some issues logging in.

To reset your password, click the link below

@component('mail::button', ['url' => env('APP_URL').'/activate/'.$user->email.'/'.$resetCode])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
