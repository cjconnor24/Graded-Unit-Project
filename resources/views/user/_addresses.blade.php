
{{--<div class="panel-group">--}}
    @foreach($addresses as $address)

        <div class="col-md-4">
        @component('components.panel')
            @slot('title')
                <a href="{{action('UserProfileController@editAddress',['address'=>$address->id])}}">{{$address->name}}</a>
                @endslot

                <p>{{$address->address1}}<br />
                    {!!$address->address2 ?: '' !!}
                    {!!$address->address3 ?: '' !!}
                    {!!$address->address4 ?: '' !!}
                    {!!$address->postcode ?: '' !!}</p>

            @slot('footer')
                    <a href="{{action('UserProfileController@editAddress',['address'=>$address->id])}}" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                    <a href="#" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                @endslot

            @endcomponent

        </div>

    @endforeach

</div>