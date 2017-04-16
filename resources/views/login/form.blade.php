@extends('master')
@section('content')

{{Form::open(['action' => 'LoginController@login'])}}

<div class="form-group">
    {!! Form::label('email',"Email Address") !!}
    {!! Form::text('email',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('password',"Password") !!}
    {!! Form::text('password',null,['class'=>'form-control']) !!}
</div>

{!! Form::submit('Login',['class'=>'btn btn-success']) !!}


{{Form::close()}}
@include('includes.errors')

@endsection