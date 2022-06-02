/* Create item Validation */
$(document).ready(function () {
    slug = '';
    $('#selectCategory').change(function(e) {
        e.preventDefault();

        slug = $(this).find(':selected').data('slug');

    });

    value = '';
    $('#reportType').change(function(e) {
        e.preventDefault();

        value = $(this).find(':selected').val();

    });


    $('#create_item_form').validate({ // initialize the plugin

        rules: {
            details: {
                required: true,
                minlength: 3,
                depends: function(element) {
                    return slug != 'money';
                }
            },
            type: {
                required: true,
                minlength: 3,
                depends: function(element) {
                    return slug == 'other';
                }
            },
            cost: {
                required: true,
                number: true,
                min: 0,
                depends: function(element) {
                    return slug == 'money';
                }
            },
            date: {
                required: true,
            },
            time: {
                required: true,
            },
            storage_id: {
                required: true,
            },
            category_id: {
                required: true
            },
            station_id: {
                required: true
            },
            informer_name: {
                required: true,
                depends: function(element) {
                    return value == 'found';
                }
            },
            informer_phone: {
                required: true,
                depends: function(element) {
                    return value == 'found';
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

    value = '';
    $('#reportType').change(function(e) {
        e.preventDefault();

        value = $(this).find(':selected').val();

    });

    $('#update_item_form').validate({ // initialize the plugin

        rules: {
            details: {
                minlength: 3,
            },
            type: {
                minlength: 3,
            },
            cost: {
                number: true,
                min: 0,
            },
            date: {
                required: true,
            },
            time: {
                required: true,
            },
            storage_id: {
                required: true,
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
                    return $("#is_delivered").is(":checked");
                }
            },
            sur_name: {
                required: true,
                depends: function(element) {
                    return $("#is_delivered").is(":checked");
                }
            },
            email: {
                required: true,
                email: true,
                depends: function(element) {
                    return $("#is_delivered").is(":checked");
                }
            },
            address: {
                required: true,
                depends: function(element) {
                    return $("#is_delivered").is(":checked");
                }
            },
            // second_address: {
            //     required: true,
            //     depends: function(element) {
            //         return $("#is_delivered").is(":checked");
            //     }
            // },
            postcode: {
                required: true,
                depends: function(element) {
                    return $("#is_delivered").is(":checked");
                }
            },
            phone: {
                required: true,
                maxlength: 12,
                depends: function(element) {
                    return $("#is_delivered").is(":checked");
                }
            },
            mobile: {
                required: true,
                maxlength: 12,
                depends: function(element) {
                    return $("#is_delivered").is(":checked");
                }
            },
            informer_name: {
                required: true,
                depends: function(element) {
                    return value == 'found';
                }
            },
            informer_phone: {
                required: true,
                depends: function(element) {
                    return value == 'found';
                }
            },
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});
