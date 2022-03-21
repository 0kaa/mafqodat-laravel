$(document).ready(function () {
    $('#create_category_form').validate({ // initialize the plugin

        rules: {
            name_ar: {
                required: true
            },
            name_en: {
                required: true
            },
            image: {
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


/* Update Category Validation */
$(document).ready(function () {
    $('#update_category_form').validate({ // initialize the plugin

        rules: {
            name_ar: {
                required: true
            },
            name_en: {
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
