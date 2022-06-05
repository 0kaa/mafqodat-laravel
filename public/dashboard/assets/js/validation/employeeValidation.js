/* Create Employee Validation */
$(document).ready(function () {
    $('#create_employee_form').validate({ // initialize the plugin

        rules: {
            name: {
                required: true,
                minlength: 3,
            },
            email: {
                required: true,
                email: true,
            },
            phone: {
                required: true,
                maxlength: 12,
            },
            job_number: {
                required: true,
            },
            date_of_hiring: {
                required: true,
            },
            working_period: {
                required: true,
            },
            password: {
                required: true,
                minlength: 6,
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
            name: {
                required: true,
                minlength: 3,
            },
            email: {
                required: true,
                email: true,
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
            date_of_hiring: {
                required: true,
            },
            // password: {
            //     required: true,
            //     minlength: 6,
            // },
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});
