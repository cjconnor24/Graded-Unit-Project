@extends('layouts.admin_master')
@section('content')
    <h1>Manage Quotations</h1>
    <p>Below are a list of quotations</p>

    @if(count($quotations)==0)
        <p><em>There are currently no quotations</em></p>
    @else

        @foreach($quotations as $quote)
            <p>{{$quote->id}}</p>
        @endforeach

    @endif
@endsection