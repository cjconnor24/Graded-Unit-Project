@extends('layouts.master')
@section('content')

    <h1>Password Reset</h1>
    <p>To reset your password, please enter the new password below.</p>

    <div class="row">
    <div class="col-md-6">

        @include('includes.errors')
{{--    {!! Form::open(['url' => '']) !!}--}}
        <form method="POST" action="">
            {{csrf_field()}}

    <div class="form-group">
        {!! Form::label('password',"New Password") !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password_confirmation',"Confirm New Password") !!}
        {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
    </div>

        <div class="form-group">
            {!! Form::submit('Reset Password',['class'=>'btn btn-success']) !!}
        </div>
    
    
    {!! Form::close() !!}
    </div>
    </div>

@endsection