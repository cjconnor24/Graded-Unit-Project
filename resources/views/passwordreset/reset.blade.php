@extends('layouts.admin_master')
@section('content')

    <h1><span class="fi-misc-padlock fi-misc"></span> Password Reset</h1>
    <p>To reset your password, please enter the new password below.</p>

    <div class="row">


        @include('includes.errors')

        <div class="col-md-8 col-md-offset-2">
            @component('components.panel')
                @slot('title')
                    <span class="fi-misc-reload fi-misc"></span> Reset Password
                @endslot
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
                @endcomponent
        </div>
    </div>

@endsection