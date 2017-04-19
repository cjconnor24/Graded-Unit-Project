@component('mail::message')
# Password Reset

Hi {{$user->first_name}}

It looks like you are having some issues logging in.

To reset your password, click the link below
@php($url = action('ResetPasswordController@resetPassword',['email'=>$user->email,'resetCode'=>$resetCode]))
@component('mail::button', ['url' => $url])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
