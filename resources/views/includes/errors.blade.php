@if(count($errors)>0)
    <div class="alert alert-danger">
        <h3>There were some errors</h3>
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
    @endif

