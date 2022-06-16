/* Create item Validation */
$(document).ready(function () {

    var lang = $('#locale').attr('lang');

    if (lang == 'ar') {
        var message_date = 'يجب ان يكون تاريخ الفقد أصغر من او مساوى لتاريخ اليوم';

    } else {
        var message_date = "Loss date must be less than or equal to today's date";

    }

    $.validator.addMethod('greaterThanDate', function (value) {
        // get date today and compare with the date entered
        var today = new Date();
        var date = new Date(value);
        return date <= today;

    }, message_date);

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
            },
            date: {
                required: true,
                greaterThanDate: true,
            },
            time: {
                required: true,
            },
            storage_id: {
                depends: function(element) {
                    return value == 'lost';
                }
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
                number: true,
                maxlength: 12,
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

    var lang = $('#locale').attr('lang');

    if (lang == 'ar') {
        var message_date = 'يجب ان يكون تاريخ الفقد أصغر من او مساوى لتاريخ اليوم';

    } else {
        var message_date = "Loss date must be less than or equal to today's date";

    }

    $.validator.addMethod('greaterThanDate', function (value) {
        // get date today and compare with the date entered
        var today = new Date();
        var date = new Date(value);
        return date <= today;

    }, message_date);

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
            date: {
                required: true,
                greaterThanDate: true,
            },
            time: {
                required: true,
            },
            storage_id: {
                required: true,
                depends: function(element) {
                    return value == 'lost';
                }
            },
            category_id: {
                required: true
            },
            station_id: {
                required: true
            },
            full_name: {
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
            informer_name: {
                required: true,
                depends: function(element) {
                    return value == 'found';
                }
            },
            informer_phone: {
                required: true,
                number: true,
                maxlength: 12,
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
