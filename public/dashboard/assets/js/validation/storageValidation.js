$(document).ready(function () {
    $('#create_storage_form').validate({ // initialize the plugin

        rules: {
            name_ar: {
                required: true
            },
            name_en: {
                required: true
            },
            category_id: {
                required: true
            },
        },


        errorElement: "span",
        errorLabelContainer: '.errorTxt',

        submitHandler: function(form) {
            form.submit();
        }
    });
});


/* Update Storage Validation */
$(document).ready(function () {
    $('#update_storage_form').validate({ // initialize the plugin

        rules: {
            name_ar: {
                required: true
            },
            name_en: {
                required: true
            },
            category_id: {
                required: true
            },
        },


        errorElement: "span",
        errorLabelContainer: '.errorTxt',

        submitHandler: function(form) {
            form.submit();
        }
    });
});
