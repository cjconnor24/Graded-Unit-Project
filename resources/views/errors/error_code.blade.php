@extends('layouts.admin_master')
@section('content')

    <div class="error-page">
    <div class="row row-eq-height">

        <div class="col-sm-4 robot-column">
            <h1>{{($code!=="" || $code!==null ? $code : '404')}}</h1>
            <img src="{{asset('img/spectrum-robot.svg')}}" class="robot" alt="Spectrum Robot">
        </div>

        <div class="col-sm-8 text-column col-flex">

            <h1>Beep Bap Boop...</h1>
            <p>Uh Oh, Something isn't quite right...</p>

            @if($exception->getMessage()!=="")
            <pre>{{$exception->getMessage()}}</pre>
            @endif
            <p><a href="#" class="btn btn-info"><span class="fi-misc-home fi-misc"></span> Go Home</a></p>

        </div>
    </div>

    </div>
@endsection