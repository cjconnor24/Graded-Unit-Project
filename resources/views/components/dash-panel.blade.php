<div class="panel panel-{{$colour}} dash">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-6">
                <i class="lg-icon {{$icon}}"></i>
            </div>
            <div class="col-xs-6 text-right">
                <p class="announcement-heading">{{(isset($count) ? $count : '')}}</p>
                <p class="announcement-text">{{$name}}</p>
            </div>
        </div>
    </div>
    <a href="{{$link}}">
        <div class="panel-footer announcement-bottom">
            <div class="row">
                <div class="col-xs-6">View</div>
                <div class="col-xs-6 text-right">
                    <i class="glyphicon glyphicon-circle-arrow-right"></i>
                </div>
            </div>
        </div>
    </a>
</div>
