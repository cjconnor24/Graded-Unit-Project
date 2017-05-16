@component('components.panel')

    @slot('title')
        <span class="fi-shop fi-shop-shop"></span> Branch Information <i class="flaticon-airplane49"></i>
        <span class="flaticon-banknote"></span>
    @endslot

    <h4>Spectrum Contact</h4>
    <p>{{$staff->full_name}}<br /> <a class="btn btn-sm btn-info" href="mailto:{{$staff->email}}"><span class="glyphicon glyphicon-envelope"></span> E-Mail {{$staff->first_name}} </a></p>

    <h4>{{$branch->name}}</h4>
    <p>{!! str_replace(', ',',<br />',$branch->full_address) !!}</p>
    <p><a href="mailto:{{$branch->email}}">{{$branch->email}}</a><br />{{$branch->telephone}}</p>

@endcomponent