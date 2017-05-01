{{--
OUTPUT NOTIFICATIONS IF AVAILABLE
--}}

@if(count($errors)>0)
    <div class="alert alert-danger">

        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach

    </div>
    @endif
@if(session('success'))
    <div class="alert alert-success {{session('notification') ? 'notification' : ''}}">
        {{session('success')}}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning">
        {{session('warning')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif

@section('scripts')
@if(session('notification'))
    <script type="text/javascript">
        $( document ).ready(function() {
            $('.notification').delay(3000).fadeOut();
        });
    </script>
@endif
@endsection

