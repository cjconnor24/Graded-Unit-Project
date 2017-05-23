@extends('layouts.admin_master')
@section('content')

    <h1>Forgot Password</h1>
    <p>Please enter your email address below to reset your password.</p>

    @include('includes.errors')


{{Form::open(['action' => 'ForgotPasswordController@postForgotPassword'])}}

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            @component('components.panel')
                @slot('title')
                    <span class="fi-misc-padlock fi-misc"></span> Password Reset
                @endslot

<div class="form-group">
    {!! Form::label('email',"Email Address") !!}
    {!! Form::text('email',null,['class'=>'form-control']) !!}
</div>


<div class="form-group">
{!! Form::submit('Reset Login',['class'=>'btn btn-success']) !!}
</div>

                @endcomponent

        </div>

    </div>


{{Form::close()}}



@endsection