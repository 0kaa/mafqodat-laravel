/* Create Station Validation */
$(document).ready(function () {
    $('#create_station_form').validate({ // initialize the plugin

        rules: {
            type: {
                required: true,
            },
            name: {
                required: true,
                minlength: 3,
            },
            number: {
                required: true,
                minlength: 3,
                number: true,
            },
            details: {
                required: true,
                minlength: 3,
            },
            location: {
                required: true,
            },

        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});


/* Update Station Validation */
$(document).ready(function () {
    $('#update_station_form').validate({ // initialize the plugin

        rules: {
            type: {
                required: true,
            },
            name: {
                required: true,
                minlength: 3,
            },
            number: {
                required: true,
                minlength: 3,
                number: true,
            },
            details: {
                required: true,
                minlength: 3,
            },
            location: {
                required: true,
            },

        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});
