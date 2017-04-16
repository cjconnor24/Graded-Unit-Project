<div class="form-group">
    {!! Form::label('name',"Product Name") !!}
    {!! Form::text('name',null,['class'=>'form-control','required']) !!}
</div>
<div class="form-group">
    {!! Form::label('description',"Product Description") !!}
    {!! Form::textarea('description',null,['class'=>'form-control','required']) !!}
</div>

<div class="form-group">



    {!! Form::label('price',"Product Price") !!}
    <div class="input-group">
        <div class="input-group-addon">£</div>
        {!! Form::text('price',null,['class'=>'form-control','required']) !!}
    </div>
</div>

<div class="row">

    <p class="help-block">Please select available product options</p>

<div class="col-md-6">

<div class="form-group">
    {!! Form::label('sizes',"Product Sizes") !!}
    {!! Form::select('sizes[]', $sizes, (isset($product) ? $product->sizes()->pluck('id')->toArray() : null) , ['multiple' => 'multiple', 'class'=>'form-control','required']) !!}
</div>

</div>

<div class="col-md-6">

<div class="form-group">
    {!! Form::label('papers',"Available Paper") !!}
    {!! Form::select('papers[]', $papers, (isset($product) ? $product->papers()->pluck('id')->toArray() : null) , ['multiple' => 'multiple', 'class'=>'form-control','required']) !!}
</div>
</div>

</div>

<div class="form-group">
    {!! Form::label('category',"Product Category") !!}
    {!! Form::select('category', $categories, (isset($product) ? $product->category->id : null), ['class'=>'form-control']) !!}
</div>