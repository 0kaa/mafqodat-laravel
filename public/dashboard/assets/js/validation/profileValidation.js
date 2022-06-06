/* Create Employee Validation */
$(document).ready(function () {
    $('#update_profile').validate({ // initialize the plugin

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
            password: {
                required: true,
                minlength: 6,
            },
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});

