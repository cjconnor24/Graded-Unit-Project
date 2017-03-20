@extends('master')
@section('content')

    <form action="/update" method="post" role="form">
        {{csrf_field()}}

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
        </div>



    </form>

@endsection