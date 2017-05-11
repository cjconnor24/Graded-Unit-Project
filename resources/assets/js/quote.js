$( document ).ready(function() {

    var count = $('#invoice_table tbody tr').length;

    $('#invoice_table').on('click', '.remove-row', function() {
        // event.preventDefault();
        $(this).closest('tr').remove();
        renumberRows();
    });

    function renumberRows(){
        var inputsPerRow = 4;
        // $( "input[name^='order']" ).each(function(i,item){
        $( "#invoice_table tbody tr" ).each(function(i,item){
            console.log(item);
        });
    }

    /**
     * Check to make sure the product builder entries are valid before amending
     * @returns {boolean}
     */
    function productBuilderValid(){

               var result = [];

               $("#product_builder").find("select").each(function (i, data) {

                   var lineValue = $(this).find("option:selected").val();
                   result.push($.isNumeric(lineValue));

               });

               return (result.indexOf(false)==-1);

    }


    $('#add_product').click(function () {

        // CHECK BOXES ARE FILLED, IF NOT DISPLAY ERROR
        if(!productBuilderValid()){
            $('<div class="alert alert-danger notification"><span class="glyphicon glyphicon-alert"></span>  Please select all options before adding.</div>').insertAfter('#product_builder').delay(3000).fadeOut();
            return false;
        }


        // COPY THE INVOICE LINE
        $('#invoice_table tbody').append($('#invoice_table tbody tr:first').clone());

        console.log('clones');

        var product_builder = getInvoiceLine();

        var hiddeninputs = $('#invoice_table tbody tr:last').find('input[type="hidden"]');
        var qty = $('#invoice_table tbody tr:last').find('input[type="text"]');

        console.log(qty);


        // INCREASE THE COUNTER SO NO NAME OVERWRITES
        /**
         * Global scope further up
         */
        count++;

        // FIND HIDDEN ATTRIBUTE...ASSIGN THE VALUE, THE NAME AND APPEND THE HTML
        // FOR THE END USER TABLE VIEW
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

        $('#invoice_table tbody tr td:nth-child(5)').html('£'+product_builder[4].price);

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
     * Holds address data
     */
    var addressData;

    /**
     * GET THE CUSTOMER ID AND LOAD THEIR ADDRESSES INTO THE DROP DOWN
     */
    $('#customer_id').on('change', function(e){
        var customer_id = e.target.value;

        // SEND THE REQUEST TO GET TEH DADRESSES
        $.get('/admin/ajax-address/' + customer_id, function (data) {

            // CLEAR DROPDOWNS
            $('#address_id').empty();

            addressData = data;

            writeCustomerAddress(data[0],'#customer_address');
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
               console.log('Address' + e.target.value + 'was clicked');
               console.log(e.target.selectedIndex);
               writeCustomerAddress(addressData[e.target.selectedIndex],'#customer_address');
    });

    // $('#branch_id').on('change', function (e) {
    //     console.log('Address' + e.target.value + 'was clicked');
    //     console.log(e.target.selectedIndex);
    //     writeCustomerAddress(addressData[e.target.selectedIndex],'#customer_address');
    // });



});

/**
 * Write The Address Data to the customer address element
 * @param addressData
 * @returns {boolean}
 */
function writeCustomerAddress(addressData,idEl){

    $(idEl).empty();

    $(idEl).append(addressData.address1+'<br />');
    $(idEl).append((addressData.address2!=='' ? addressData.address2 +'<br />':''));
    $(idEl).append((addressData.address3!=='' ? addressData.address3 +'<br />':''));
    $(idEl).append((addressData.address4!=='' ? addressData.address4 +'<br />':''));
    $(idEl).append(addressData.postcode+'');

    return true;
}

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
        if(item>=1){
            $(this).empty();
        }
    });
    return true;
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/**
 * FUNCTION TO SUBMIT NEW QUOTE
 */
$('#quote_form').submit(function(event){

    console.log('this triggers');
    event.preventDefault();

    var postData = $('form').serializeArray();

    $.ajax({
        type:'POST',
        data:postData,
        url:'/admin/quotations',
        success: function(response){

            window.location.href = response.redirect;
        },
        error: function(response){
            var errorString = '';
            $.each(response.responseJSON,function(i,v){
                errorString+=('<p>'+v[0]+'</p>');
            });

            $('.alert-danger').html(errorString).slideDown();
        }
    })

});

// $('#quote_edit_form').submit(function(event){
//
//     console.log('this triggers the edit form');
//     event.preventDefault();
//
//     var postData = $('form').serializeArray();
//
//     // console.log(postData);
//
//     $.ajax({
//         type:'PATCH',
//         data:postData,
//         url:'/admin/quotations/18/edit',
//         success: function(response){
//
//             // window.location.href = response.redirect;
//             console.log(response);
//         },
//         error: function(response){
//             console.log('ERROR');
//             var errorString = '';
//             $.each(response.responseJSON,function(i,v){
//                 errorString+=('<p>'+v[0]+'</p>');
//             });
//
//             $('.alert-danger').html(errorString).slideDown();
//         }
//     })
//
// });