
{{--<div class="panel-group">--}}

@foreach($addresses->chunk(3) as $chunk)

    <div class="row">

    @foreach($chunk as $address)

        <div class="col-sm-4">

        @component('components.panel')
            @slot('title')
                <span class="fi-misc-placeholder fi-misc"></span> {{$address->name}}
                @endslot

                <p>{{$address->address1}}<br />
                    {!!$address->address2 ?: '' !!}
                    {!!$address->address3 ?: '' !!}
                    {!!$address->address4 ?: '' !!}
                    {!!$address->postcode ?: '' !!}</p>

            @slot('footer')
                    <a href="{{action('AddressController@edit',['address'=>$address->id])}}" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                    <a href="javascript:alert('Still to code');" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                @endslot

            @endcomponent

        </div>

        @endforeach

    </div>

    @endforeach