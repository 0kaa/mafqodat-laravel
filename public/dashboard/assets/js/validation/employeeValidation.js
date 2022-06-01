/* Create Employee Validation */
$(document).ready(function () {
    $('#create_employee_form').validate({ // initialize the plugin

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
            job_number: {
                required: true,
            },
            password: {
                required: true,
                minlength: 6,
            },
            city_id: {
                required: true
            },
            permissions: {
                required: true
            },
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});


/* Update Employee Validation */
$(document).ready(function () {
    $('#update_employee_form').validate({ // initialize the plugin

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
            job_number: {
                required: true,
            },
            working_period: {
                required: true,
            },
            // password: {
            //     required: true,
            //     minlength: 6,
            // },
            city_id: {
                required: true
            },
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});
