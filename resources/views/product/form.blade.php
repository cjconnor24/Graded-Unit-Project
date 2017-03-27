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
    {!! Form::text('price',null,['class'=>'form-control','required']) !!}
</div>

<div class="form-group">
    {!! Form::label('sizes',"Product Sizes") !!}
    {!! Form::select('sizes[]', $sizes, (isset($product) ? $product->sizes()->pluck('id')->toArray() : null) , ['multiple' => 'multiple', 'class'=>'form-control','required']) !!}
</div>

<div class="form-group">
    {!! Form::label('category',"Product Category") !!}
    {!! Form::select('category', $categories, (isset($product) ? $product->category->id : null), ['class'=>'form-control']) !!}
</div>