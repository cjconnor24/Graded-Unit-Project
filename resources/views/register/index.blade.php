@extends('master')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">Register</div>
        <div class="panel-body">
    {!! Form::open(['action' => 'RegistrationController@store']) !!}

    <div class="form-group">
        {!! Form::label('first_name',"First Name") !!}
        {!! Form::text('first_name',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('last_name',"Last Name") !!}
        {!! Form::text('last_name',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email',"Email Address") !!}
        {!! Form::text('email',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password',"Password") !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password_confirmation',"Confirm Password") !!}
        {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
    </div>

    <div class="form-group">

                {!! Form::submit('Complete Registration',['class'=>'btn btn-success']) !!}
            </div>

{!! Form::close() !!}

            @include('includes.errors')
        </div></div>
        </div></div>
@endsection