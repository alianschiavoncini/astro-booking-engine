jQuery( document ).ready(function( $ ) {

    /**
     * General
     */
    // Color picker
    $('.colorpicker').wpColorPicker();

    // Show/hide the provider panel
    $("#astro_be_provider").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
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

        //5Stelle
        if($('.box.5stelle').css('display') == 'block') {

            var astro_be_5stelle_portal = $('#astro_be_5stelle_portal').val();
            if (astro_be_5stelle_portal == '') {
                $error_msg += '- Portal: the field is required.\n';
            }

            if ($error_msg != '') {
                $error_msg = '5Stelle fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //begenius
        if($('.box.begenius').css('display') == 'block') {

            var astro_be_begenius_hotel = $.trim( $('#astro_be_begenius_hotel').val() );
            if (astro_be_begenius_hotel == '') {
                $error_msg += '- Hotel code: the field is required.\n';
            } else if (!/^[A-Za-z0-9_-]+$/.test(astro_be_begenius_hotel)) {
                $error_msg += '- Hotel code: only letters, numbers, hyphens and underscores are allowed.\n';
            }

            if ($('#astro_be_begenius_children_enable').is(':checked') && !$("#astro_be_begenius_childage_enable").is(":checked")) {
                $error_msg += '- children age: must be enable if the children dropdown is enable.\n';
            }

            if ($('#astro_be_begenius_childage_enable').is(':checked')) {

                var astro_be_begenius_childage_min = $('#astro_be_begenius_childage_min').length;
                var astro_be_begenius_childage_max = $('#astro_be_begenius_childage_max').length;

                if (astro_be_begenius_childage_min && astro_be_begenius_childage_max) {
                    var astro_be_begenius_childage_min_value = parseInt( $("#astro_be_begenius_childage_min option:selected").val() );
                    var astro_be_begenius_childage_max_value = parseInt( $("#astro_be_begenius_childage_max option:selected").val() );

                    if (astro_be_begenius_childage_min_value > astro_be_begenius_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'BeGenius fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //blastness
        if($('.box.blastness').css('display') == 'block') {

            var astro_be_blastness_id_albergo = $('#astro_be_blastness_id_albergo').val();
            if (astro_be_blastness_id_albergo == '') {
                $error_msg += '- id_albergo: the field is required.\n';
            }

            var astro_be_blastness_dc = $('#astro_be_blastness_dc').val();
            if (astro_be_blastness_dc == '') {
                $error_msg += '- dc: the field is required.\n';
            }

            if ($('#astro_be_blastness_childage_enable').is(':checked')) {

                var astro_be_blastness_childage_min = $('#astro_be_blastness_childage_min').length;
                var astro_be_blastness_childage_max = $('#astro_be_blastness_childage_max').length;

                if (astro_be_blastness_childage_min && astro_be_blastness_childage_max) {
                    var astro_be_blastness_childage_min_value = parseInt( $("#astro_be_blastness_childage_min option:selected").val() );
                    var astro_be_blastness_childage_max_value = parseInt( $("#astro_be_blastness_childage_max option:selected").val() );

                    if (astro_be_blastness_childage_min_value > astro_be_blastness_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'Blastness fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //bookingexpert
        if($('.box.bookingexpert').css('display') == 'block') {

            var astro_be_bookingexpert_layout = $.trim($('#astro_be_bookingexpert_layout').val());
            if (astro_be_bookingexpert_layout == '') {
                $error_msg += '- layout: the field is required.\n';
            } else if (!/^\d+$/.test(astro_be_bookingexpert_layout) && !/[?&]layout=\d+/.test(astro_be_bookingexpert_layout)) {
                $error_msg += '- layout: enter the number after layout= in the booking engine address.\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Booking Expert fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //datasistemi
        if($('.box.datasistemi').css('display') == 'block') {

            var astro_be_datasistemi_idstr = $('#astro_be_datasistemi_idstr').val();
            if (astro_be_datasistemi_idstr == '') {
                $error_msg += '- idstr: the field is required.\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Data Sistemi fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //ericsoft
        if($('.box.ericsoft').css('display') == 'block') {

            var astro_be_ericsoft_idh = $('#astro_be_ericsoft_idh').val();
            if (astro_be_ericsoft_idh == '') {
                $error_msg += '- idh: the field is required.\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Ericsoft fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //mews
        if($('.box.mews').css('display') == 'block') {

            var astro_be_mews_configuration_id = $('#astro_be_mews_configuration_id').val();
            if (astro_be_mews_configuration_id == '') {
                $error_msg += '- Configuration ID: the field is required.\n';
            } else if (!/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/i.test(astro_be_mews_configuration_id)) {
                $error_msg += '- Configuration ID: the format is not valid (e.g. aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee).\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Mews fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //octorate
        if($('.box.octorate').css('display') == 'block') {

            var astro_be_octorate_codice = $.trim($('#astro_be_octorate_codice').val());
            if (astro_be_octorate_codice == '') {
                $error_msg += '- codice: the field is required.\n';
            } else if (!/^\d+$/.test(astro_be_octorate_codice) && !/[?&]codice=\d+/.test(astro_be_octorate_codice)) {
                $error_msg += '- codice: enter the number after codice= in the booking engine address.\n';
            }

            if ($('#astro_be_octorate_childage_enable').is(':checked')) {

                var astro_be_octorate_childage_min = $('#astro_be_octorate_childage_min').length;
                var astro_be_octorate_childage_max = $('#astro_be_octorate_childage_max').length;

                if (astro_be_octorate_childage_min && astro_be_octorate_childage_max) {
                    var astro_be_octorate_childage_min_value = parseInt( $("#astro_be_octorate_childage_min option:selected").val() );
                    var astro_be_octorate_childage_max_value = parseInt( $("#astro_be_octorate_childage_max option:selected").val() );

                    if (astro_be_octorate_childage_min_value > astro_be_octorate_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'Octorate fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //revplus
        if($('.box.revplus').css('display') == 'block') {

            var astro_be_revplus_hotel = $.trim($('#astro_be_revplus_hotel').val());
            if (astro_be_revplus_hotel == '') {
                $error_msg += '- Property name: the field is required.\n';
            } else if (!/^[a-zA-Z0-9-]+$/.test(astro_be_revplus_hotel) && !/^(https?:\/\/)?[a-zA-Z0-9-]+\.reserve-online\.net/.test(astro_be_revplus_hotel)) {
                $error_msg += '- Property name: enter the name before .reserve-online.net in the booking engine address.\n';
            }

            var astro_be_revplus_htl_code = $.trim($('#astro_be_revplus_htl_code').val());
            if (astro_be_revplus_htl_code != '' && !/^[a-zA-Z0-9_-]+$/.test(astro_be_revplus_htl_code)) {
                $error_msg += '- property: the code can contain letters, digits, - and _ only.\n';
            }

            if ($error_msg != '') {
                $error_msg = 'RevPlus fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //scidoo
        if($('.box.scidoo').css('display') == 'block') {

            var astro_be_scidoo_cod = $.trim($('#astro_be_scidoo_cod').val());
            if (astro_be_scidoo_cod == '') {
                $error_msg += '- cod: the field is required.\n';
            } else if (!/^\d+$/.test(astro_be_scidoo_cod) && !/[?&]cod=\d+/.test(astro_be_scidoo_cod)) {
                $error_msg += '- cod: enter the number after cod= in the booking engine address.\n';
            }

            var astro_be_scidoo_IDsotto_struttura = $.trim($('#astro_be_scidoo_IDsotto_struttura').val());
            if (astro_be_scidoo_IDsotto_struttura != '' && !/^\d+$/.test(astro_be_scidoo_IDsotto_struttura)) {
                $error_msg += '- IDsotto_struttura: the value must be a number.\n';
            }

            //Scidoo receives the children as the list of their ages
            if ($('#astro_be_scidoo_children_enable').is(':checked') && !$("#astro_be_scidoo_childage_enable").is(":checked")) {
                $error_msg += '- children age: it must be enabled when children are enabled.\n';
            }

            if ($('#astro_be_scidoo_childage_enable').is(':checked')) {

                var astro_be_scidoo_childage_min = $('#astro_be_scidoo_childage_min').length;
                var astro_be_scidoo_childage_max = $('#astro_be_scidoo_childage_max').length;

                if (astro_be_scidoo_childage_min && astro_be_scidoo_childage_max) {
                    var astro_be_scidoo_childage_min_value = parseInt( $("#astro_be_scidoo_childage_min option:selected").val() );
                    var astro_be_scidoo_childage_max_value = parseInt( $("#astro_be_scidoo_childage_max option:selected").val() );

                    if (astro_be_scidoo_childage_min_value > astro_be_scidoo_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'Scidoo fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //myguestcare
        if($('.box.myguestcare').css('display') == 'block') {

            var astro_be_myguestcare_idcliente = $('#astro_be_myguestcare_idcliente').val();
            if (astro_be_myguestcare_idcliente == '') {
                $error_msg += '- idcliente: the field is required.\n';
            }

            if ($('#astro_be_myguestcare_children_enable').is(':checked') && !$("#astro_be_myguestcare_childage_enable").is(":checked")) {
                $error_msg += '- children age: must be enable if the children dropdown is enable.\n';
            }

            if ($('#astro_be_myguestcare_childage_enable').is(':checked')) {

                var astro_be_myguestcare_childage_min = $('#astro_be_myguestcare_childage_min').length;
                var astro_be_myguestcare_childage_max = $('#astro_be_myguestcare_childage_max').length;

                if (astro_be_myguestcare_childage_min && astro_be_myguestcare_childage_max) {
                    var astro_be_myguestcare_childage_min_value = parseInt( $("#astro_be_myguestcare_childage_min option:selected").val() );
                    var astro_be_myguestcare_childage_max_value = parseInt( $("#astro_be_myguestcare_childage_max option:selected").val() );

                    if (astro_be_myguestcare_childage_min_value > astro_be_myguestcare_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'MyGuestCare fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

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

        //passepartout
        /*if($('.box.passepartout').css('display') == 'block') {

            var astro_be_passepartout_Albergo = $('#astro_be_passepartout_Albergo').val();
            if (astro_be_passepartout_Albergo == '') {
                $error_msg += '- Albergo: the field is required.\n';
            }

            var astro_be_passepartout_OidPortaleXAlbergo = $('#astro_be_passepartout_OidPortaleXAlbergo').val();
            if (astro_be_passepartout_OidPortaleXAlbergo == '') {
                $error_msg += '- OidPortaleXAlbergo: the field is required.\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Passepartout fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }*/

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

        //wubook
        if($('.box.wubook').css('display') == 'block') {

            var astro_be_wubook_ep = $('#astro_be_wubook_ep').val();
            if (astro_be_wubook_ep == '') {
                $error_msg += '- ep: the field is required.\n';
            }

            if ($error_msg != '') {
                $error_msg = 'WuBook fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //simplebooking
        if($('.box.simplebooking').css('display') == 'block') {

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