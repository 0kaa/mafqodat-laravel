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
            first_name: {
                required: true,
                depends: function(element) {
                    return $("#is_deliverd").is(":checked");
                }
            },
            sur_name: {
                required: true,
                depends: function(element) {
                    return $("#is_deliverd").is(":checked");
                }
            },
            email: {
                required: true,
                email: true,
                depends: function(element) {
                    return $("#is_deliverd").is(":checked");
                }
            },
            address: {
                required: true,
                depends: function(element) {
                    return $("#is_deliverd").is(":checked");
                }
            },
            // second_address: {
            //     required: true,
            //     depends: function(element) {
            //         return $("#is_deliverd").is(":checked");
            //     }
            // },
            city: {
                required: true,
                depends: function(element) {
                    return $("#is_deliverd").is(":checked");
                }
            },
            postcode: {
                required: true,
                depends: function(element) {
                    return $("#is_deliverd").is(":checked");
                }
            },
            phone: {
                required: true,
                maxlength: 12,
                depends: function(element) {
                    return $("#is_deliverd").is(":checked");
                }
            },
            mobile: {
                required: true,
                maxlength: 12,
                depends: function(element) {
                    return $("#is_deliverd").is(":checked");
                }
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
