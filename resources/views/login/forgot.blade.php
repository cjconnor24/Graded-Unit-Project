@extends('layouts.master')
@section('content')

    <h1>Forgot Password</h1>
    <p>Please enter your email address below to reset your password.</p>

    @include('includes.errors')


{{Form::open(['action' => 'ForgotPasswordController@postForgotPassword'])}}

<div class="form-group">
    {!! Form::label('email',"Email Address") !!}
    {!! Form::text('email',null,['class'=>'form-control']) !!}
</div>



{!! Form::submit('Reset Login',['class'=>'btn btn-success']) !!}


{{Form::close()}}



@endsection