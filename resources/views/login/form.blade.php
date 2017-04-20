@extends('layouts.admin_master')
@section('content')

    <h1>Login</h1>
    <p>Please login using the form below</p>

    @include('includes.errors')

{{Form::open(['action' => 'LoginController@login'])}}

<div class="form-group">
    {!! Form::label('email',"Email Address") !!}
    {!! Form::text('email',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('password',"Password") !!}
    {!! Form::password('password',['class'=>'form-control']) !!}
</div>

    <div class="form-group">
        <a href="{{ action('ForgotPasswordController@forgotPassword') }}">Forgot your password?</a>
    </div>

{!! Form::submit('Login',['class'=>'btn btn-success']) !!}


{{Form::close()}}



@endsection