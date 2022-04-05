/* Create Station Validation */
$(document).ready(function () {
    $('#create_station_form').validate({ // initialize the plugin

        rules: {
            type: {
                required: true,
            },
            name_ar: {
                required: true,
                minlength: 3,
            },
            name_en: {
                required: true,
                minlength: 3,
            },
            number: {
                required: true,
                number: true,
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
            name_ar: {
                required: true,
                minlength: 3,
            },
            name_en: {
                required: true,
                minlength: 3,
            },
            number: {
                required: true,
                number: true,
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
