<div class="panel panel-default hidden-print">

    <div class="panel-heading">
        <h3 class="panel-title">{{$title}}</h3>
    </div>

    <div class="panel-body">

        {{$slot}}

    </div>

    @if(isset($footer))
        <div class="panel-footer">
            {{$footer}}
        </div>
        @endif

</div>