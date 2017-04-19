<div class="form-group">
    {!! Form::label('name',"Address Name") !!}
    {!! Form::text('name',null,['class'=>'form-control','required']) !!}
</div>
<div class="form-group">
    {!! Form::label('address1',"Address Line 1") !!}
    {!! Form::text('address1',null,['class'=>'form-control','required']) !!}
</div>
<div class="form-group">
    {!! Form::label('address2',"Address Line 2") !!}
    {!! Form::text('address2',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('address3',"Address Line 3") !!}
    {!! Form::text('address3',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('address4',"Address Line 4") !!}
    {!! Form::text('address4',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('postcode',"Postcode") !!}
    {!! Form::text('postcode',null,['class'=>'form-control','required']) !!}
</div>