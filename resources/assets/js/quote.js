$( document ).ready(function() {

//            jQuery('#quote_form').bind('submit',function(e){
//
//                if($('#form-check').val()!==""){
//                    alert('ok');
//                } else {
//                    alert('not ok');
//                    e.preventDefault();
//                }
//
//            });

           $("#add_product").click(function () {


               $("#product_builder").find("select").each(function (i, data) {
                   console.log($(this).find("option:selected").val());
                   console.log($(this).find("option:selected").text());
               });

           });


    $('#add_product').click(function () {

        // COPY THE INVOICE LINE
        $('#invoice_table tbody').append($('#invoice_table tbody tr:first').clone());

        console.log('clones');

        var product_builder = getInvoiceLine();

        var hiddeninputs = $('#invoice_table tbody tr:last').find('input[type="hidden"]');
        var qty = $('#invoice_table tbody tr:last').find('input[type="text"]');

        console.log(qty);


//                    var hiddeninputs = $(this).find('input[type="text"]');
        var count = $('#invoice_table tbody tr').length;
//
        hiddeninputs.eq(0).attr({
            name: 'order[' + count + '][product_id]',
            value: product_builder[1].id
        }).parent().append(product_builder[1].value);

        hiddeninputs.eq(1).attr({
            name: 'order[' + count + '][paper_id]',
            value: product_builder[2].id
        }).parent().append(product_builder[2].value);
        hiddeninputs.eq(2).attr({
            name: 'order[' + count + '][size_id]',
            value: product_builder[3].id
        }).parent().append(product_builder[3].value);

        $('#invoice_table tbody tr td:last').html('£'+product_builder[4].price);

        qty.attr({
            name: 'order[' + count + '][qty]',
            value: 1
        });

        clearDropDown();
        $('#form-check').val('test');

        $('<div class="alert alert-success notification"><span class="glyphicon glyphicon-ok"></span> '+product_builder[1].value+' successfully added to the quotation!</div>').insertAfter('#product_builder').delay(3000).fadeOut();

    });


    /**
     *
     */
    $('#category_id').on('change', function (e) {

        var category_id = e.target.value;

        // SEND REQUEST
        $.get('/admin/ajax-product/' + category_id, function (data) {

            // CLEAR DROPDOWN
            $('#product_id').empty();
            $('#paper_id').empty();
            $('#size_id').empty();


            $('#product_id').append($('<option></option>').attr("value", "").text('-- Select Product --'));

            $.each(data, function (i, item) {
//                        console.log(item);
                $('#product_id').append($('<option>', {
                    value: item.id,
                    text: item.name
                }));

            });

        });
    });

    $('#product_id').on('change', function (e) {

        var product_id = e.target.value;

        // SEND REQUET
        $.get('/admin/ajax-product-options/' + product_id, function (data) {

            // CLEAR DROPDOWN
            $('#paper_id').empty();
            $('#size_id').empty();

            console.log(data);

            $('#product_price').attr('value',data.price);

            $('#paper_id').append($('<option></option>').attr("value", "").text('-- Select Paper --'));
            $('#size_id').append($('<option></option>').attr("value", "").text('-- Select Size --'));

            $.each(data.sizes, function (i, item) {
//                        console.log(item);
                $('#size_id').append($('<option>', {
                    value: i,
                    text: item
                }));

            });

            $.each(data.papers, function (i, item) {
//                        console.log(item);
                $('#paper_id').append($('<option>', {
                    value: i,
                    text: item
                }));

            });

        });
    });


    /**
     * GET THE CUSTOMER ID AND LOAD THEIR ADDRESSES INTO THE DROP DOWN
     */
    $('#customer_id').on('change', function (e) {

        var customer_id = e.target.value;

        // SEND THE REQUEST TO GET TEH DADRESSES
        $.get('/admin/ajax-address/' + customer_id, function (data) {

            // CLEAR DROPDOWNS
            $('#address_id').empty();

            // LOOP THROUGH RESULTS AND ADD THE OPTIONS
            $.each(data, function (i, item) {

                $('#address_id').append($('<option>', {
                    value: item.id,
                    text: item.name
                }));

            });

        });
    });

    // FOR DEBUGGING
    $('#address_id').on('change', function (e) {
//                console.log('Address' + e.target.value + 'was clicked');
    });



});



function getInvoiceLine(){

    var data = [];
    var success = true;

    $('#product_builder').find('select option:selected').each(function(i,item){
        data[i] = {id : item.value, value : item.innerHTML};
    });

    data.push({price: $('#product_price').val()});
    console.log(data);
    return data;
}

/**
 * Clear the product builder form
 * @returns {boolean}
 */
function clearDropDown(){
    $('#product_builder').find('select').each(function(item){
        $(this).prop('selectedIndex',0);
        if(item>1){
            $(this).empty();
        }
    });
    return true;
}