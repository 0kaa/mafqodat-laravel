/* Create Employee Validation */
$(document).ready(function () {
    $('#update_profile').validate({ // initialize the plugin

        rules: {
            first_name: {
                required: true,
                minlength: 3,
            },
            family_name: {
                required: true,
                minlength: 3,
            },
            email: {
                required: true,
                email: true,
            },
            address: {
                required: true,
                minlength: 3,
            },
            phone: {
                required: true,
                maxlength: 12,
            },
            mobile: {
                required: true,
                maxlength: 12,
            },
            password: {
                required: true,
                minlength: 6,
            },
            country_id: {
                required: true
            },
            city_id: {
                required: true
            },
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});

