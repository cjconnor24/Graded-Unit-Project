
<div class="panel-group">
    @foreach($addresses as $address)
        <div class="panel panel-default">

            <div class="panel-heading">
                <a href="{{action('UserProfileController@editAddress',['address'=>$address->id])}}">{{$address->name}}</a>
            </div>

            <div class="panel-body">
                <p>{{$address->address1}}<br />
                    {!!$address->address2 ?: '' !!}
                    {!!$address->address3 ?: '' !!}
                    {!!$address->address4 ?: '' !!}
                    {!!$address->postcode ?: '' !!}</p>
            </div>

            <div class="panel-footer">
                <a href="{{action('UserProfileController@editAddress',['address'=>$address->id])}}" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                <a href="#" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</a>
            </div>

        </div>
    @endforeach
</div>
</div>