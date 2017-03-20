@if(count($errors))
    <div class="alert alert-danger">
        <h3>There were some errors</h3>
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
    @endif
    </div>
