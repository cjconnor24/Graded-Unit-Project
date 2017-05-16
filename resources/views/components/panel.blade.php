<div class="panel panel-{{(isset($colour) ? ($colour=='warning' || $colour=='danger' ? $colour : 'default') : 'default')}} hidden-print">

    <div class="panel-heading">
        {{$title}}
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