jQuery( document ).ready(function( $ ) {

    /**
     * General
     */
    // Color picker
    $('.colorpicker').wpColorPicker();

    // Show/hide the provider panel
    $("#astro_be_provider").change(function(){

        /*$("form.astro_be_settings_form").removeClass (function (index, className) {
            return (className.match (/(^|\s)astro_be_settings_form_\S+/g) || []).join(' ');
        });*/

        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();

                /*console.log(optionValue);
                $("form.astro_be_settings_form").addClass("astro_be_settings_form_" + optionValue);*/
            }else{
                $(".box").hide();
            }
        });
    }).change();


    /**
     * Provider: iperbooking
     * add dynamic fields
     */
    // idTrattamento
    var iperbooking_treatment_max_fields = 10;
    var iperbooking_treatment_wrapper = $(".iperbooking-treatment");
    var iperbooking_treatment_add_button = $(".iperbooking-treatment-options-add-field");

    var iperbooking_treatment_n = $('.iperbooking-treatment .provider-fieldset').length;
    $(iperbooking_treatment_add_button).click(function(e) {
        e.preventDefault();
        if (iperbooking_treatment_n < iperbooking_treatment_max_fields) {
            iperbooking_treatment_n++;

            $(iperbooking_treatment_wrapper).append('<fieldset class="provider-fieldset provider-fieldset-' + iperbooking_treatment_n + '">' +
                '<legend class="provider-fieldset-legend">Treatment option #' + iperbooking_treatment_n + '</legend>' +
                '<div class="provider-fieldset-content">' +
                '<div class="provider-fieldset-row">' +
                '<span class="provider-fieldset-label">Value:</span>' +
                '<input type="text" name="astro_be_iperbooking_idTrattamento[option_' + iperbooking_treatment_n + '][value]" class="regular-text" />' +
                '</div>' +
                '<div class="provider-fieldset-row">' +
                '<span class="provider-fieldset-label">Label:</span>' +
                '<input type="text" name="astro_be_iperbooking_idTrattamento[option_' + iperbooking_treatment_n + '][label]" class="regular-text" />' +
                '</div>' +
                '<div class="provider-fieldset-row">' +
                '<span class="provider-fieldset-label">Default:</span>' +
                '<input type="radio" value="option_' + iperbooking_treatment_n + '" ' +
                'name="astro_be_iperbooking_idTrattamento_default" ' +
                'class="iperbooking-treatment-option-default iperbooking-treatment-option-' + iperbooking_treatment_n + '" />' +
                '</div>' +
                '</div>' +
                '<button class="button iperbooking-treatment-options-delete-field">Delete</button>' +
                '</fieldset>');

        } else {
            alert('You reached the limits of ' + iperbooking_treatment_max_fields);
        }
    });

    $(iperbooking_treatment_wrapper).on("click", ".iperbooking-treatment-options-delete-field", function(e) {
        e.preventDefault();
        $(this).parent('fieldset.provider-fieldset').remove();
        iperbooking_treatment_n--;
    })

    // language
    var iperbooking_language_max_fields = 5;
    var iperbooking_language_wrapper = $(".iperbooking-language");
    var iperbooking_language_add_button = $(".iperbooking-language-options-add-field");

    var iperbooking_language_n = $('.iperbooking-language .provider-fieldset').length;
    $(iperbooking_language_add_button).click(function(e) {
        e.preventDefault();
        if (iperbooking_language_n < iperbooking_language_max_fields) {
            iperbooking_language_n++;

            $(iperbooking_language_wrapper).append('<fieldset class="provider-fieldset provider-fieldset-' + iperbooking_language_n + '">' +
                '<legend class="provider-fieldset-legend">Language option #' + iperbooking_language_n + '</legend>' +
                '<div class="provider-fieldset-content">' +
                '<div class="provider-fieldset-row">' +
                '<span class="provider-fieldset-label">Lang code:</span>' +
                '<input type="text" name="astro_be_iperbooking_language[option_' + iperbooking_language_n + '][code]" class="regular-text" />' +
                '</div>' +
                '<div class="provider-fieldset-row">' +
                '<span class="provider-fieldset-label">URL:</span>' +
                '<input type="text" name="astro_be_iperbooking_language[option_' + iperbooking_language_n + '][url]" class="regular-text" />' +
                '</div>' +
                '<div class="provider-fieldset-row">' +
                '<span class="provider-fieldset-label">Default:</span>' +
                '<input type="radio" value="option_' + iperbooking_language_n + '" ' +
                'name="astro_be_iperbooking_language_default" ' +
                'class="iperbooking-language-option-default iperbooking-language-option-' + iperbooking_language_n + '" />' +
                '</div>' +
                '</div>' +
                '<button class="button iperbooking-language-options-delete-field">Delete</button>' +
                '</fieldset>');

        } else {
            alert('You reached the limits of ' + iperbooking_language_max_fields);
        }
    });

    $(iperbooking_language_wrapper).on("click", ".iperbooking-language-options-delete-field", function(e) {
        e.preventDefault();
        $(this).parent('fieldset.provider-fieldset').remove();
        iperbooking_language_n--;
    })

    /**
     * Form validation on submit
     */
    $('form.astro_be_settings_form').submit( function() {

        $error_msg = '';

        //iperbooking
        if($('.box.iperbooking').css('display') == 'block') {


            var astro_be_iperbooking_idHotel = $('#astro_be_iperbooking_idHotel').val();
            if (astro_be_iperbooking_idHotel == '') {
                $error_msg += '- idHotel: the field is required.\n';
            }

            var astro_be_iperbooking_language_required = $('input[name="astro_be_iperbooking_language[option_1][code]"]').val();
            if (astro_be_iperbooking_language_required == '') {
                $error_msg += '- Language options: one language option is required.\n';
            }

            var astro_be_iperbooking_idtrattamento_required = $('input[name="astro_be_iperbooking_idTrattamento[option_1][value]"]').val();
            if (astro_be_iperbooking_idtrattamento_required == '') {
                $error_msg += '- Treatments: one treatment option is required.\n';
            }

            if ($('#astro_be_iperbooking_childage_enable').is(':checked')) {

                var astro_be_iperbooking_childage_min = $('#astro_be_iperbooking_childage_min').length;
                var astro_be_iperbooking_childage_max = $('#astro_be_iperbooking_childage_max').length;

                if (astro_be_iperbooking_childage_min && astro_be_iperbooking_childage_max) {
                    var astro_be_iperbooking_childage_min_value = parseInt( $("#astro_be_iperbooking_childage_min option:selected").val() );
                    var astro_be_iperbooking_childage_max_value = parseInt( $("#astro_be_iperbooking_childage_max option:selected").val() );

                    if (astro_be_iperbooking_childage_min_value > astro_be_iperbooking_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'Iperbooking fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //verticalbooking
        if($('.box.verticalbooking').css('display') == 'block') {

            var astro_be_verticalbooking_id_albergo = $('#astro_be_verticalbooking_id_albergo').val();
            if (astro_be_verticalbooking_id_albergo == '') {
                $error_msg += '- id_albergo: the field is required.\n';
            }

            var astro_be_verticalbooking_dc = $('#astro_be_verticalbooking_dc').val();
            if (astro_be_verticalbooking_dc == '') {
                $error_msg += '- dc: the field is required.\n';
            }

            if ($('#astro_be_verticalbooking_childage_enable').is(':checked')) {

                var astro_be_verticalbooking_childage_min = $('#astro_be_verticalbooking_childage_min').length;
                var astro_be_verticalbooking_childage_max = $('#astro_be_verticalbooking_childage_max').length;

                if (astro_be_verticalbooking_childage_min && astro_be_verticalbooking_childage_max) {
                    var astro_be_verticalbooking_childage_min_value = parseInt( $("#astro_be_verticalbooking_childage_min option:selected").val() );
                    var astro_be_verticalbooking_childage_max_value = parseInt( $("#astro_be_verticalbooking_childage_max option:selected").val() );

                    if (astro_be_verticalbooking_childage_min_value > astro_be_verticalbooking_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'Vertical booking fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //simplebooking
        if($('.box.simplebooking').css('display') == 'block') {

            var astro_be_verticalbooking_hid = $('#astro_be_verticalbooking_hid').val();
            if (astro_be_verticalbooking_hid == '') {
                $error_msg += '- hid: the field is required.\n';
            }

            if ($('#astro_be_simplebooking_children_enable').is(':checked') && !$("#astro_be_simplebooking_childage_enable").is(":checked")) {
                $error_msg += '- children age: must be enable if the children dropdown is enable.\n';
            }

            if ($('#astro_be_simplebooking_childage_enable').is(':checked')) {

                var astro_be_simplebooking_childage_min = $('#astro_be_simplebooking_childage_min').length;
                var astro_be_simplebooking_childage_max = $('#astro_be_simplebooking_childage_max').length;

                if (astro_be_simplebooking_childage_min && astro_be_simplebooking_childage_max) {
                    var astro_be_simplebooking_childage_min_value = parseInt( $("#astro_be_simplebooking_childage_min option:selected").val() );
                    var astro_be_simplebooking_childage_max_value = parseInt( $("#astro_be_simplebooking_childage_max option:selected").val() );

                    if (astro_be_simplebooking_childage_min_value > astro_be_simplebooking_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'Simple booking fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }


    });

});