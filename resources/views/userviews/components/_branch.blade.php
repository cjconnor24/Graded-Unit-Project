@component('components.panel')

    @slot('title')
        <span class="fi-shop fi-shop-shop"></span> Branch Information <i class="flaticon-airplane49"></i>
        <span class="flaticon-banknote"></span>
    @endslot

    <h4>{{$branch->name}}</h4>
    <address>{!! str_replace(', ',',<br />',$branch->full_address) !!}</address>
    <p><a href="mailto:{{$branch->email}}">{{$branch->email}}</a><br />{{$branch->telephone}}</p>

    <hr>

    <h4><span class="fi-misc-user-1 fi-misc"></span> Staff Contact</h4>
    <p class="lead">{{$staff->full_name}}</p>
    <p><a href="mailto:{{$staff->email}}" class="btn btn-sm btn-block btn-success"><span class="fi-misc-mail fi-misc"></span> {{$staff->email}} </a></p>
    <p><a href="tel:{{$staff->telephone}}" class="btn btn-sm btn-block btn-info"><span class="fi-misc-phone-call fi-misc"></span> {{$staff->telephone}} </a></p>



@endcomponent