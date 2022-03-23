/* Create item Validation */
$(document).ready(function () {
    $('#create_item_form').validate({ // initialize the plugin

        rules: {
            details: {
                required: true,
                minlength: 3,
            },
            date: {
                required: true,
            },
            time: {
                required: true,
            },
            storage: {
                required: true,
                minlength: 3,
            },
            category_id: {
                required: true
            },
            station_id: {
                required: true
            },
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});


/* Update item Validation */
$(document).ready(function () {
    $('#update_item_form').validate({ // initialize the plugin


        rules: {
            details: {
                required: true,
                minlength: 3,
            },
            date: {
                required: true,
            },
            time: {
                required: true,
            },
            storage: {
                required: true,
                minlength: 3,
            },
            category_id: {
                required: true
            },
            station_id: {
                required: true
            },
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});
