<!-- Modal -->
<div id="product_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="fi-shop-price-tag fi-shop"></span> Add Product to Quotation</h4>
            </div>
            <div class="modal-body">

                <div id="product_builder">

                    <p>To add a product to the quotation, simply select from the options below.</p>

                    <div class="form-group"><label for="category_id">Product Category</label>{!! Form::select('', $categories, null, ['id'=>'category_id','placeholder' => 'Choose a product','class'=>'form-control']) !!}</div>

                    <div class="form-group"><label for="product-id">Product</label><select id="product_id" class="form-control"></select></div>
                    <div class="form-group"><label for="paper_id">Paper Stock</label><select id="paper_id" class="form-control"></select></div>
                    <div class="form-group"><label for="size_id">Size Option</label><select id="size_id" class="form-control"></select></div>
                    <input type="hidden" id="product_price">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="add_product">Add Product</button>

                <button type="button" class="btn btn-default" data-dismiss="modal">Finished</button>
            </div>
        </div>

    </div>
</div>