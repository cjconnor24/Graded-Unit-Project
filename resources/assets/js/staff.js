
$(document).ready(function(){

    /**
     * SETUP AJAX
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**
     * GET THE FORM DATA SET THE USER ID
     * @type {{user_id: *}}
     */
    var postData = {
        user_id: window.location.pathname.split('/')[3]
    }

    /**
     * LISTEN FOR ROLE BUTTON AND TOGGLE ROLE
     */
    $('.role-button').on('click',function(e){

        postData.role_id = $(this).attr('data-role-id');
        e.preventDefault();
        $.ajax({
            type:'POST',
            data:postData,
            url:'/admin/staff/role',
            success: function(response) {

            },
            error: function(response) {
                console.log('oh oh '+response)
            },
        });

        if($(this).hasClass('btn-default')){

            $(this).removeClass('btn-default').addClass('btn-success');
            $(this).text('Remove Role');

        } else {
            $(this).removeClass('btn-success').addClass('btn-default');
            $(this).text('Add Role');
        }

    });

    /**
     * DISABLE THE USER
     */
    $('#confirmDisable').click(function () {

        console.log('this triggers');
        event.preventDefault();

        $.ajax({
            type:'POST',
            data:postData,
            url:'/admin/staff/disable',
            success: function(response) {
                console.log(response);

                // BUTTONS
                $('#stateButton').attr({
                    "class": 'btn btn-lg btn-success btn-block',
                    "data-target":'#activateModal'
                });
                $('#stateButton').text('Activate User');

                $( "#statePanel" ).removeClass( "panel-success" ).addClass( "panel-danger" );
                $('.fi-misc-padlock').removeClass('fi-misc-padlock').addClass('fi-misc-padlock-1');
                $('.panel-heading strong').text('Disabled');

            },

        })

    });

    /**
     * EnABLE THE USER
     */
    $('#confirmEnable').click(function () {

        console.log('this triggers');
        event.preventDefault();

        $.ajax({
            type:'POST',
            data:postData,
            url:'/admin/staff/enable',
            success: function(response) {
                console.log(response);

                $('#stateButton').attr({
                    "class": 'btn btn-lg btn-danger btn-block',
                    "data-target":'#deactivateModal'
                });
                $('#stateButton').text('Disable User?');

                $( "#statePanel" ).removeClass( "panel-danger" ).addClass( "panel-success" );
                $('.fi-misc-padlock-1').removeClass('fi-misc-padlock-1').addClass('fi-misc-padlock');
                $('.panel-heading strong').text('Active');

            },

        })

    });

});