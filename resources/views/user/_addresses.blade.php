<div class="col-md-4">
<div class="panel-group">
    @foreach($addresses as $address)
        <div class="panel panel-default">

            <div class="panel-heading">
                {{$address->name}}
            </div>

            <div class="panel-body">
                <p>{{$address->address1}}<br />
                    {!!$address->address2 ?: '' !!}
                    {!!$address->address3 ?: '' !!}
                    {!!$address->address4 ?: '' !!}
                    {!!$address->postcode ?: '' !!}</p>
            </div>

            <div class="panel-footer">Panel Footer</div>

        </div>
    @endforeach
</div>
</div>