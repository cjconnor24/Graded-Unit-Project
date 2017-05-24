@extends('layouts.user_master')
@section('content')

    <a href="{{action('UserProfileController@view')}}" class="btn btn-default"><span class="fi-misc-return fi-misc"></span> Return to Account Dashboard</a>
    
    <h1><span class="fi-man-job fi-man"></span> Update Profile Information</h1>
    <p>To update your profile, please amend the fields below</p>

    @include('includes.errors')

    <div class="col-md-8 col-md-offset-2">
    @component('components.panel')
        @slot('title')
                <span class="fi-man-job fi-man"></span> Update Profile
            @endslot

    {!! Form::model($user,['action'=>['UserProfileController@update'],'method'=>'PATCH']) !!}

        <fieldset>

            <legend><span class="fi-man-id-card fi-man"></span> Personal Information</legend>

        <div class="row">
            <div class="col-md-6">
                
                <div class="form-group">
                    {!! Form::label('first_name',"First Name") !!}
                    {!! Form::text('first_name',null,['class'=>'form-control']) !!}
                </div>
                
            </div>

            <div class="col-md-6">

                <div class="form-group">
                    {!! Form::label('last_name',"Last Name") !!}
                    {!! Form::text('last_name',null,['class'=>'form-control']) !!}
                </div>
                
        </div>
            
        </div>

        </fieldset>

    <div class="form-group">
        {!! Form::label('email',"Email Address") !!}
        {!! Form::text('email',null,['class'=>'form-control','disabled']) !!}
    </div>

        <fieldset>

            <legend><span class="fi-misc-padlock fi-misc"></span> Password Update</legend>

            <div class="form-group">
                {!! Form::label('password',"Password") !!}
                {!! Form::text('password','',['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password_confirmation',"Cofirm Password") !!}
                {!! Form::text('password_confirmation','',['class'=>'form-control']) !!}
            </div>

        </fieldset>


            <div class="form-group">
            {!! Form::submit('Update Details',['class'=>'btn btn-success']) !!}
            </div>



            {!! Form::close() !!}

    @endcomponent
    </div>

@endsection