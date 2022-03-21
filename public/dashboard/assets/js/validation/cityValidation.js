$(document).ready(function () {
    $('#city_form').validate({ // initialize the plugin

        rules: {
            name_ar: {
                required: true
            },
            name_en: {
                required: true
            },
            country_id: {
                required: true
            },
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});
