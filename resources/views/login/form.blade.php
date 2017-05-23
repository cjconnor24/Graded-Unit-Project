@extends('layouts.admin_master')
@section('content')

<h1><span class="fi-misc-padlock-1 fi-misc"></span>Login</h1>
<p>To continue to use the application, please login below using your credentials.</p>
<p>If you are not registered to use the application, you can click <a
            href="{{action('RegistrationController@create')}}">here</a> to register.</p>

    <div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">Login</div>
        <div class="panel-body">

{{Form::open(['action' => 'LoginController@login'])}}
            @include('includes.errors')
<div class="form-group">
    {!! Form::label('email',"Email Address") !!}
    {!! Form::email('email',null,['class'=>'form-control','required']) !!}
</div>

<div class="form-group">
    {!! Form::label('password',"Password") !!}
    {!! Form::password('password',['class'=>'form-control','required']) !!}
</div>

    <div class="form-group">
        <a href="{{ action('ForgotPasswordController@forgotPassword') }}">Forgot your password?</a>
    </div>

{!! Form::submit('Login',['class'=>'btn btn-success']) !!}


{{Form::close()}}

        </div>
    </div>
    </div>

@endsection