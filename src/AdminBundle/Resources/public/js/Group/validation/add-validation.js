var FormValidation = function (url) {

    // basic validation
    var handleValidation1 = function(url) {
        // for more info visit the official plugin documentation:
        // http://docs.jquery.com/Plugins/Validation

        var form1 = $('#add');
        var error1 = $('.alert-danger', form1);
        var url =url;

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
                select_multi: {
                    maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                    minlength: jQuery.validator.format("At least {0} items must be selected")
                },
                required: "Pole jest wymagane"
            },
            rules: {
                name: {
                    minlength: 2,
                    required: true
                },
                school: {
                    minlength: 2,
                    required: true
                },
                lector: {
                    minlength: 2,
                    required: true
                },
                class: {
                    minlength: 2,
                    required: true
                },
                day: {
                    required: true,
                },
                hour: {
                    required: true,
                },
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.parent(".input-group").size() > 0) {
                    error.insertAfter(element.parent(".input-group"));
                } else if (element.attr("data-error-container")) {
                    error.appendTo(element.attr("data-error-container"));
                } else if (element.parents('.radio-list').size() > 0) {
                    error.appendTo(element.parents('.radio-list').attr("data-error-container"));
                } else if (element.parents('.radio-inline').size() > 0) {
                    error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
                } else if (element.parents('.checkbox-list').size() > 0) {
                    error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
                } else if (element.parents('.checkbox-inline').size() > 0) {
                    error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                error1.show();
                Metronic.scrollTo(error1, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                addFile(url);
            }
        });

        function addFile(url)
        {
            var fd = new FormData(form1[0]);
            $.ajax({
                type: "POST",
                url: url,
                enctype: 'multipart/form-data',
                processData: false,  // Important!
                contentType: false,
                cache: false,
                data: fd,
                success: function ($data) {
                    error1.hide();
                    $('#mainBox').html($data);

                }
            });
        }

    }

    return {
        //main function to initiate the module
        init: function (url) {

            handleValidation1(url);

        }

    };

}();