jQuery(document).ready(function ($) {
    /*
     * Login Form
     */
    $("#log_in_form").validate({
        rules: {
            email: {
                required: true,
                customemail: true,
            },
            password: {
                required: true,
            },
        },
    });
    $("#user_registration").validate({
        rules: {
            email: {
                required: true,
                customemail: true,
            },
            name: {
                required: true,
                letterswithbasicpunc: true,
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10,
            },
            gender: {
                required: true,
            },
        },
                errorPlacement: function(error, element) 
        {
            if ( element.is(":radio") ) 
            {
                error.appendTo( element.parents('.options') );
            }
            else 
            { // This is the default behavior 
                error.insertAfter( element );
            }
         }
    });
    $("#staff_registration").validate({
        rules: {
            email: {
                required: true,
                customemail: true,
            },
            name: {
                required: true,
                letterswithbasicpunc: true,
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10,
            },
            gender: {
                required: true,
            },
        },
                errorPlacement: function(error, element) 
        {
            if ( element.is(":radio") ) 
            {
                error.appendTo( element.parents('.options') );
            }
            else 
            { // This is the default behavior 
                error.insertAfter( element );
            }
         }
    });
    //////////////////////////////////////////////
    /*
     * Change Password
     */
    $("#change_password_form").validate({
        rules: {
            current_password: {
                required: true,
            },
            new_password: {
                required: true,
            },
            confirm_password: {
                required: true,
                equalTo: "#new_password"
            },
        },
    });
    /*
     * Forget Password
     */
    $("#forgetpassword_form").validate({
        rules: {
            email: {
                required: true,
                customemail: true,
            },
        },
    });
    $("#contact_form").validate({
        rules: {
            email: {
                required: true,
                customemail: true,
            },
            name: {
                required: true,
                letterswithbasicpunc: true,
            },
            message: {
                required: true,
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10,
            },
        },
    });
    $("#location_management").validate({
        rules: {
            location: {
                required: true,
            },
            description: {
                required: true,
            },
        },
    });
    $("#search_slot").validate({
        rules: {
            parking_area_id: {
                required: true,
            },
            date: {
                required: true,
            },
            start_time: {
                required: true,
            },
            vehicle_type: {
                required: true,
            },
            end_time: {
                required: true,
            },
        },
    });
    


///////////////////////////////////////////////////////////////////////////////////////////

        $('#search-slot').click(function () {
            $("#search_slot").valid(); 
        });
});
