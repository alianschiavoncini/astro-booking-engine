jQuery( document ).ready(function( $ ) {

    /**
     * General
     */
    // Color picker
    $('.colorpicker').wpColorPicker();

    // Le opzioni di layout non valgono per entrambi gli stili: densita' e sfondo al passaggio
    // del mouse riguardano solo il moderno, il tema del calendario solo il classico (il moderno
    // ha un calendario proprio). Si mostrano quelle che contano, senza toglierle dal form.
    var $astro_be_form_style = $('#astro_be_form_style');
    if ($astro_be_form_style.length) {
        $astro_be_form_style.on('change', function () {
            var moderno = ($(this).val() === 'compact');
            $('.astro_be_row-modern-only').toggle(moderno);
            $('.astro_be_row-classic-only').toggle(!moderno);
        }).trigger('change');
    }

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

        //beddy
        if($('.box.beddy').css('display') == 'block') {

            var astro_be_beddy_hotel = $.trim($('#astro_be_beddy_hotel').val());
            if (astro_be_beddy_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/^(https?:\/\/)?[a-z0-9]([a-z0-9-]*[a-z0-9])?\.beddy\.io([\/?#]|$)/i.test(astro_be_beddy_hotel) && !/^[a-z0-9]([a-z0-9-]*[a-z0-9])?$/i.test(astro_be_beddy_hotel)) {
                $error_msg += '- Booking engine address: enter the address of your booking engine, such as https://yourhotel.beddy.io/\n';
            }

            //Beddy receives the children as their ages
            if ($('#astro_be_beddy_children_enable').is(':checked') && !$("#astro_be_beddy_childage_enable").is(":checked")) {
                $error_msg += '- children age: it must be enabled when children are enabled.\n';
            }

            if ($('#astro_be_beddy_childage_enable').is(':checked')) {

                var astro_be_beddy_childage_min = $('#astro_be_beddy_childage_min').length;
                var astro_be_beddy_childage_max = $('#astro_be_beddy_childage_max').length;

                if (astro_be_beddy_childage_min && astro_be_beddy_childage_max) {
                    var astro_be_beddy_childage_min_value = parseInt( $("#astro_be_beddy_childage_min option:selected").val() );
                    var astro_be_beddy_childage_max_value = parseInt( $("#astro_be_beddy_childage_max option:selected").val() );

                    if (astro_be_beddy_childage_min_value > astro_be_beddy_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'Beddy fields errors:\n' + $error_msg;
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

        //reservit
        if($('.box.reservit').css('display') == 'block') {

            var astro_be_reservit_hotel = $.trim($('#astro_be_reservit_hotel').val());
            if (astro_be_reservit_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/\/booking\/\d+\/\d+/.test(astro_be_reservit_hotel) && !/[?&](id|custid)=\d+/.test(astro_be_reservit_hotel) && !/^\d+\/\d+$/.test(astro_be_reservit_hotel)) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, such as https://secure.reservit.com/fo/booking/12345/67890/dates\n';
            }

            //Reservit sends the children as their ages: without them they are not sent at all
            if ($('#astro_be_reservit_children_enable').is(':checked') && !$("#astro_be_reservit_childage_enable").is(":checked")) {
                $error_msg += '- children age: it must be enabled when children are enabled.\n';
            }

            if ($('#astro_be_reservit_childage_enable').is(':checked')) {

                var astro_be_reservit_childage_min = $('#astro_be_reservit_childage_min').length;
                var astro_be_reservit_childage_max = $('#astro_be_reservit_childage_max').length;

                if (astro_be_reservit_childage_min && astro_be_reservit_childage_max) {
                    var astro_be_reservit_childage_min_value = parseInt( $("#astro_be_reservit_childage_min option:selected").val() );
                    var astro_be_reservit_childage_max_value = parseInt( $("#astro_be_reservit_childage_max option:selected").val() );

                    if (astro_be_reservit_childage_min_value > astro_be_reservit_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'Reservit fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //hotelnetsolutions
        if($('.box.hotelnetsolutions').css('display') == 'block') {

            var astro_be_hns_hotel = $.trim($('#astro_be_hotelnetsolutions_hotel').val());
            if (astro_be_hns_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/^(https?:\/\/)?[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}\/[A-Za-z0-9._-]+/.test(astro_be_hns_hotel)) {
                $error_msg += '- Booking engine address: enter the address of your booking engine, such as https://onepagebooking.com/myhotel\n';
            }

            if ($('#astro_be_hotelnetsolutions_childage_enable').is(':checked')) {

                var astro_be_hns_childage_min = $('#astro_be_hotelnetsolutions_childage_min').length;
                var astro_be_hns_childage_max = $('#astro_be_hotelnetsolutions_childage_max').length;

                if (astro_be_hns_childage_min && astro_be_hns_childage_max) {
                    var astro_be_hns_childage_min_value = parseInt( $("#astro_be_hotelnetsolutions_childage_min option:selected").val() );
                    var astro_be_hns_childage_max_value = parseInt( $("#astro_be_hotelnetsolutions_childage_max option:selected").val() );

                    if (astro_be_hns_childage_min_value > astro_be_hns_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'HotelNetSolutions fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //resnexus
        if($('.box.resnexus').css('display') == 'block') {

            var astro_be_resnexus_hotel = $.trim($('#astro_be_resnexus_hotel').val());
            if (astro_be_resnexus_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/\/book\/[A-Fa-f0-9-]{8,}/i.test(astro_be_resnexus_hotel) && !/[?&]uid=[A-Fa-f0-9-]{8,}/i.test(astro_be_resnexus_hotel) && !/^[A-Fa-f0-9-]{8,}$/.test(astro_be_resnexus_hotel)) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, such as https://resnexus.com/resnexus/reservations/book/ABCDEF12-3456-7890-ABCD-EF1234567890\n';
            }

            if ($error_msg != '') {
                $error_msg = 'ResNexus fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //thinkreservations
        if($('.box.thinkreservations').css('display') == 'block') {

            var astro_be_tr_hotel = $.trim($('#astro_be_thinkreservations_hotel').val());
            if (astro_be_tr_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/secure\.thinkreservations\.com\/[A-Za-z0-9._-]+/i.test(astro_be_tr_hotel) && !/^[A-Za-z0-9._-]+$/.test(astro_be_tr_hotel)) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, such as https://secure.thinkreservations.com/myproperty/reservations\n';
            }

            if ($error_msg != '') {
                $error_msg = 'ThinkReservations fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //ihotelier
        if($('.box.ihotelier').css('display') == 'block') {

            var astro_be_ihotelier_hotel = $.trim($('#astro_be_ihotelier_hotel').val());
            if (astro_be_ihotelier_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/travelclick\.com\/\d+/i.test(astro_be_ihotelier_hotel) && !/[?&]hotelid=\d+/i.test(astro_be_ihotelier_hotel) && !/^\d+$/.test(astro_be_ihotelier_hotel)) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, such as https://reservations.travelclick.com/12345\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Amadeus iHotelier fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //cloudbeds
        if($('.box.cloudbeds').css('display') == 'block') {

            var astro_be_cloudbeds_hotel = $.trim($('#astro_be_cloudbeds_hotel').val());
            if (astro_be_cloudbeds_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/[a-z0-9.-]+\.cloudbeds\.com\/([a-z]{2}\/)?reservation\/[A-Za-z0-9_-]+/i.test(astro_be_cloudbeds_hotel)) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, such as https://hotels.cloudbeds.com/en/reservation/AbCdEf\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Cloudbeds fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //dedge
        if($('.box.dedge').css('display') == 'block') {

            var astro_be_dedge_hotel = $.trim($('#astro_be_dedge_hotel').val());
            if (astro_be_dedge_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/\/d-edge\/.+\/[a-z]{2}(-[A-Za-z]+)?(-[A-Z]{2})?(\/|$)/.test(astro_be_dedge_hotel) && !/[?&]property=[A-Za-z0-9._-]+/.test(astro_be_dedge_hotel)) {
                $error_msg += '- Booking engine address: enter the address of your booking engine, such as https://www.secure-hotel-booking.com/d-edge/My-Hotel/ABCD/12345/en-US/DateSelection or https://www.book-secure.com/index.php?s=results&property=abcd12345\n';
            }

            if ($('#astro_be_dedge_childage_enable').is(':checked')) {

                var astro_be_dedge_childage_min = $('#astro_be_dedge_childage_min').length;
                var astro_be_dedge_childage_max = $('#astro_be_dedge_childage_max').length;

                if (astro_be_dedge_childage_min && astro_be_dedge_childage_max) {
                    var astro_be_dedge_childage_min_value = parseInt( $("#astro_be_dedge_childage_min option:selected").val() );
                    var astro_be_dedge_childage_max_value = parseInt( $("#astro_be_dedge_childage_max option:selected").val() );

                    if (astro_be_dedge_childage_min_value > astro_be_dedge_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'D-EDGE fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //roiback
        if($('.box.roiback').css('display') == 'block') {

            var astro_be_roiback_hotel = $.trim($('#astro_be_roiback_hotel').val());
            if (astro_be_roiback_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/^(https?:\/\/)?[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/.test(astro_be_roiback_hotel)) {
                $error_msg += '- Booking engine address: enter the address of your booking engine, such as https://reservas.myhotel.com\n';
            }

            var astro_be_roiback_code = $.trim($('#astro_be_roiback_code').val());
            if (astro_be_roiback_code == '') {
                $error_msg += '- Hotel code: the field is required.\n';
            } else if (!/^(hotel_)?[A-Za-z0-9._-]+$/.test(astro_be_roiback_code)) {
                $error_msg += '- Hotel code: only letters, numbers, dots, hyphens and underscores are allowed.\n';
            }

            if ($('#astro_be_roiback_childage_enable').is(':checked')) {

                var astro_be_roiback_childage_min = $('#astro_be_roiback_childage_min').length;
                var astro_be_roiback_childage_max = $('#astro_be_roiback_childage_max').length;

                if (astro_be_roiback_childage_min && astro_be_roiback_childage_max) {
                    var astro_be_roiback_childage_min_value = parseInt( $("#astro_be_roiback_childage_min option:selected").val() );
                    var astro_be_roiback_childage_max_value = parseInt( $("#astro_be_roiback_childage_max option:selected").val() );

                    if (astro_be_roiback_childage_min_value > astro_be_roiback_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'Roiback fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //mirai
        if($('.box.mirai').css('display') == 'block') {

            var astro_be_mirai_hotel = $.trim($('#astro_be_mirai_hotel').val());
            if (astro_be_mirai_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/reservation\.mirai\.com\/[A-Za-z0-9_-]+\/.*idtokenprovider=\d+/i.test(astro_be_mirai_hotel) && !/^[A-Za-z0-9_-]+\/\d+$/.test(astro_be_mirai_hotel)) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, the one with idtokenprovider.\n';
            }

            //Mirai sends the children as their ages
            if ($('#astro_be_mirai_children_enable').is(':checked') && !$("#astro_be_mirai_childage_enable").is(":checked")) {
                $error_msg += '- children age: it must be enabled when children are enabled.\n';
            }

            if ($('#astro_be_mirai_childage_enable').is(':checked')) {

                var astro_be_mirai_childage_min = $('#astro_be_mirai_childage_min').length;
                var astro_be_mirai_childage_max = $('#astro_be_mirai_childage_max').length;

                if (astro_be_mirai_childage_min && astro_be_mirai_childage_max) {
                    var astro_be_mirai_childage_min_value = parseInt( $("#astro_be_mirai_childage_min option:selected").val() );
                    var astro_be_mirai_childage_max_value = parseInt( $("#astro_be_mirai_childage_max option:selected").val() );

                    if (astro_be_mirai_childage_min_value > astro_be_mirai_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'Mirai fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //witbooking
        if($('.box.witbooking').css('display') == 'block') {

            var astro_be_witbooking_hotel = $.trim($('#astro_be_witbooking_hotel').val());
            if (astro_be_witbooking_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/^(https?:\/\/)?[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}\/(([a-z]{2}\/)?hotel\/)?[A-Za-z0-9._-]+/.test(astro_be_witbooking_hotel)) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, such as https://engine.witbooking.com/es/hotel/myhotel.com\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Witbooking fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //journey
        if($('.box.journey').css('display') == 'block') {

            var astro_be_journey_hotel = $.trim($('#astro_be_journey_hotel').val());
            if (astro_be_journey_hotel == '') {
                $error_msg += '- Property name: the field is required.\n';
            } else if (!/^[a-zA-Z0-9-]+$/.test(astro_be_journey_hotel) && !/^(https?:\/\/)?[a-zA-Z0-9-]+\.onejourney\.travel/.test(astro_be_journey_hotel)) {
                $error_msg += '- Property name: enter the name before .onejourney.travel in the booking engine address.\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Journey fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //bedzzle
        if($('.box.bedzzle').css('display') == 'block') {

            var astro_be_bedzzle_hotel = $.trim($('#astro_be_bedzzle_hotel').val());
            if (astro_be_bedzzle_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/[?&]apikey=[A-Za-z0-9]+/.test(astro_be_bedzzle_hotel) && !/^[A-Za-z0-9]{8,64}$/.test(astro_be_bedzzle_hotel)) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, the one with apikey.\n';
            }

            //Bedzzle receives the children as their ages
            if ($('#astro_be_bedzzle_children_enable').is(':checked') && !$("#astro_be_bedzzle_childage_enable").is(":checked")) {
                $error_msg += '- children age: it must be enabled when children are enabled.\n';
            }

            if ($('#astro_be_bedzzle_childage_enable').is(':checked')) {

                var astro_be_bedzzle_childage_min = $('#astro_be_bedzzle_childage_min').length;
                var astro_be_bedzzle_childage_max = $('#astro_be_bedzzle_childage_max').length;

                if (astro_be_bedzzle_childage_min && astro_be_bedzzle_childage_max) {
                    var astro_be_bedzzle_childage_min_value = parseInt( $("#astro_be_bedzzle_childage_min option:selected").val() );
                    var astro_be_bedzzle_childage_max_value = parseInt( $("#astro_be_bedzzle_childage_max option:selected").val() );

                    if (astro_be_bedzzle_childage_min_value > astro_be_bedzzle_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'Bedzzle fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //krossbooking
        if($('.box.krossbooking').css('display') == 'block') {

            var astro_be_krossbooking_hotel = $.trim($('#astro_be_krossbooking_hotel').val());
            if (astro_be_krossbooking_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/[a-z0-9-]+\.kross\.travel/i.test(astro_be_krossbooking_hotel) && !/data\.krossbooking\.com\/widget\/v\d+\/[a-z0-9-]+\//i.test(astro_be_krossbooking_hotel) && !/^[a-z0-9-]+$/i.test(astro_be_krossbooking_hotel)) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, such as https://yourhotel.kross.travel/book/step1\n';
            }

            //Kross Booking receives the children as their ages
            if ($('#astro_be_krossbooking_children_enable').is(':checked') && !$("#astro_be_krossbooking_childage_enable").is(":checked")) {
                $error_msg += '- children age: it must be enabled when children are enabled.\n';
            }

            if ($('#astro_be_krossbooking_childage_enable').is(':checked')) {

                var astro_be_krossbooking_childage_min = $('#astro_be_krossbooking_childage_min').length;
                var astro_be_krossbooking_childage_max = $('#astro_be_krossbooking_childage_max').length;

                if (astro_be_krossbooking_childage_min && astro_be_krossbooking_childage_max) {
                    var astro_be_krossbooking_childage_min_value = parseInt( $("#astro_be_krossbooking_childage_min option:selected").val() );
                    var astro_be_krossbooking_childage_max_value = parseInt( $("#astro_be_krossbooking_childage_max option:selected").val() );

                    if (astro_be_krossbooking_childage_min_value > astro_be_krossbooking_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'Kross Booking fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //pegasus
        if($('.box.pegasus').css('display') == 'block') {

            var astro_be_pegasus_hotel = $.trim($('#astro_be_pegasus_hotel').val());
            if (astro_be_pegasus_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/[a-z0-9-]+\.book\.pegsbe\.com/i.test(astro_be_pegasus_hotel) && !/^[a-z0-9-]+$/i.test(astro_be_pegasus_hotel)) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, such as https://yourhotel.book.pegsbe.com/\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Pegasus fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //windsurfer
        if($('.box.windsurfer').css('display') == 'block') {

            var astro_be_windsurfer_hotel = $.trim($('#astro_be_windsurfer_hotel').val());
            if (astro_be_windsurfer_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/[?&]propertyID=\d+/i.test(astro_be_windsurfer_hotel) && !/^\d+$/.test(astro_be_windsurfer_hotel)) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, the one with propertyID.\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Windsurfer CRS fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //arosuite
        if($('.box.arosuite').css('display') == 'block') {

            var astro_be_arosuite_hotel = $.trim($('#astro_be_arosuite_hotel').val());
            if (astro_be_arosuite_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/^(https?:\/\/)?[a-z0-9.-]+\.[a-z0-9-]+\/sites\/[a-z0-9-]+/i.test(astro_be_arosuite_hotel)) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, such as https://reserve31.arosuite.com/sites/your-hotel/availability\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Aro Suite fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //avvio
        if($('.box.avvio').css('display') == 'block') {

            var astro_be_avvio_hotel = $.trim($('#astro_be_avvio_hotel').val());
            if (astro_be_avvio_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/\S/.test(astro_be_avvio_hotel)) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, such as https://fe.avvio.com/convert/site/Your%20Hotel/en/results.php\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Avvio fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //bookassist
        if($('.box.bookassist').css('display') == 'block') {

            var astro_be_bookassist_hotel = $.trim($('#astro_be_bookassist_hotel').val());
            if (astro_be_bookassist_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!(/[?&]hotel_id=\d+/i.test(astro_be_bookassist_hotel) || /^\d+(\/\d+)?$/.test(astro_be_bookassist_hotel))) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, the one with hotel_id and guide_id.\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Bookassist fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //misterbooking
        if($('.box.misterbooking').css('display') == 'block') {

            var astro_be_misterbooking_hotel = $.trim($('#astro_be_misterbooking_hotel').val());
            if (astro_be_misterbooking_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!(/[?&]id_etab=[a-z0-9_-]+/i.test(astro_be_misterbooking_hotel) || /^[a-z0-9_-]+$/i.test(astro_be_misterbooking_hotel))) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, the one with id_etab.\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Misterbooking fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //netaffinity
        if($('.box.netaffinity').css('display') == 'block') {

            var astro_be_netaffinity_hotel = $.trim($('#astro_be_netaffinity_hotel').val());
            if (astro_be_netaffinity_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/^https?:\/\/[^\s\/]+\.[^\s\/]+/i.test(astro_be_netaffinity_hotel)) {
                $error_msg += '- Booking engine address: enter the address of the booking page of your website, such as https://www.yourhotel.com/bookings.html\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Net Affinity fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //omnibees
        if($('.box.omnibees').css('display') == 'block') {

            var astro_be_omnibees_hotel = $.trim($('#astro_be_omnibees_hotel').val());
            if (astro_be_omnibees_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!(/[?&]q=\d+/i.test(astro_be_omnibees_hotel) || /omnibees\.com\/hotel\/\d+/i.test(astro_be_omnibees_hotel) || /^\d+$/.test(astro_be_omnibees_hotel))) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, such as https://book.omnibees.com/hotelresults?q=12345\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Omnibees fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //secureholiday
        if($('.box.secureholiday').css('display') == 'block') {

            var astro_be_secureholiday_hotel = $.trim($('#astro_be_secureholiday_hotel').val());
            if (astro_be_secureholiday_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!(/secureholiday\.net\/[a-z]{2}\/\d+/i.test(astro_be_secureholiday_hotel) || /^\d+$/.test(astro_be_secureholiday_hotel))) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, such as https://reservation.secureholiday.net/it/1234/search/product-list\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Secure Holiday fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //seekda
        if($('.box.seekda').css('display') == 'block') {

            var astro_be_seekda_hotel = $.trim($('#astro_be_seekda_hotel').val());
            if (astro_be_seekda_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!(/[a-z0-9-]+\.officialbookings\.com/i.test(astro_be_seekda_hotel) || /ibe\.seekda\.com\/dsr\/[a-z0-9-]+/i.test(astro_be_seekda_hotel) || /^[a-z0-9-]+$/i.test(astro_be_seekda_hotel))) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, such as https://s001234.officialbookings.com/\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Seekda fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //slope
        if($('.box.slope').css('display') == 'block') {

            var astro_be_slope_hotel = $.trim($('#astro_be_slope_hotel').val());
            if (astro_be_slope_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/i.test(astro_be_slope_hotel)) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, such as https://booking.slope.it/0a1b2c3d-4e5f-6a7b-8c9d-0e1f2a3b4c5d\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Slope fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //dirs21
        if($('.box.dirs21').css('display') == 'block') {

            var astro_be_dirs21_hotel = $.trim($('#astro_be_dirs21_hotel').val());
            if (astro_be_dirs21_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!(/reservation\.one\.dirs21\.de\/[a-z0-9-]+/i.test(astro_be_dirs21_hotel) || /dirs21\.de\/channels\/[a-z0-9-]+/i.test(astro_be_dirs21_hotel) || /^[a-z0-9-]+$/i.test(astro_be_dirs21_hotel))) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, such as https://reservation.one.dirs21.de/yourhotel\n';
            }

            //DIRS21 receives the children as their ages
            if ($('#astro_be_dirs21_children_enable').is(':checked') && !$("#astro_be_dirs21_childage_enable").is(":checked")) {
                $error_msg += '- children age: it must be enabled when children are enabled.\n';
            }

            if ($('#astro_be_dirs21_childage_enable').is(':checked')) {

                var astro_be_dirs21_childage_min = $('#astro_be_dirs21_childage_min').length;
                var astro_be_dirs21_childage_max = $('#astro_be_dirs21_childage_max').length;

                if (astro_be_dirs21_childage_min && astro_be_dirs21_childage_max) {
                    var astro_be_dirs21_childage_min_value = parseInt( $("#astro_be_dirs21_childage_min option:selected").val() );
                    var astro_be_dirs21_childage_max_value = parseInt( $("#astro_be_dirs21_childage_max option:selected").val() );

                    if (astro_be_dirs21_childage_min_value > astro_be_dirs21_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'DIRS21 fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //bookvisit
        if($('.box.bookvisit').css('display') == 'block') {

            var astro_be_bookvisit_hotel = $.trim($('#astro_be_bookvisit_hotel').val());
            if (astro_be_bookvisit_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!(/[?&]channelid=[0-9a-f-]{36}/i.test(astro_be_bookvisit_hotel) || /^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i.test(astro_be_bookvisit_hotel))) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, the one with channelId.\n';
            }

            //Bookvisit receives the children as their ages
            if ($('#astro_be_bookvisit_children_enable').is(':checked') && !$("#astro_be_bookvisit_childage_enable").is(":checked")) {
                $error_msg += '- children age: it must be enabled when children are enabled.\n';
            }

            if ($('#astro_be_bookvisit_childage_enable').is(':checked')) {

                var astro_be_bookvisit_childage_min = $('#astro_be_bookvisit_childage_min').length;
                var astro_be_bookvisit_childage_max = $('#astro_be_bookvisit_childage_max').length;

                if (astro_be_bookvisit_childage_min && astro_be_bookvisit_childage_max) {
                    var astro_be_bookvisit_childage_min_value = parseInt( $("#astro_be_bookvisit_childage_min option:selected").val() );
                    var astro_be_bookvisit_childage_max_value = parseInt( $("#astro_be_bookvisit_childage_max option:selected").val() );

                    if (astro_be_bookvisit_childage_min_value > astro_be_bookvisit_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'Bookvisit fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //profitroom
        if($('.box.profitroom').css('display') == 'block') {

            var astro_be_profitroom_hotel = $.trim($('#astro_be_profitroom_hotel').val());
            if (astro_be_profitroom_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!(/\/[a-z]{2}(-[a-z]{2})?\/[a-z0-9]+\/(pricelist|offer|room)/i.test(astro_be_profitroom_hotel) || /upperbooking\.com\/[a-z0-9]+/i.test(astro_be_profitroom_hotel) || /^[a-z0-9]+$/i.test(astro_be_profitroom_hotel))) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, such as https://booking.profitroom.com/en/yourhotel/pricelist/rooms/\n';
            }

            //Profitroom receives the children in the age ranges of the hotel
            if ($('#astro_be_profitroom_children_enable').is(':checked') && !/^\s*\d{1,2}\s*-\s*\d{1,2}\s*(,\s*\d{1,2}\s*-\s*\d{1,2}\s*)*$/.test($.trim($('#astro_be_profitroom_children_ranges').val()))) {
                $error_msg += '- Children age ranges: enter the age ranges of the children set for the hotel, such as 0-2,3-11,12-14.\n';
            }

            //Profitroom receives the children as their ages
            if ($('#astro_be_profitroom_children_enable').is(':checked') && !$("#astro_be_profitroom_childage_enable").is(":checked")) {
                $error_msg += '- children age: it must be enabled when children are enabled.\n';
            }

            if ($('#astro_be_profitroom_childage_enable').is(':checked')) {

                var astro_be_profitroom_childage_min = $('#astro_be_profitroom_childage_min').length;
                var astro_be_profitroom_childage_max = $('#astro_be_profitroom_childage_max').length;

                if (astro_be_profitroom_childage_min && astro_be_profitroom_childage_max) {
                    var astro_be_profitroom_childage_min_value = parseInt( $("#astro_be_profitroom_childage_min option:selected").val() );
                    var astro_be_profitroom_childage_max_value = parseInt( $("#astro_be_profitroom_childage_max option:selected").val() );

                    if (astro_be_profitroom_childage_min_value > astro_be_profitroom_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'Profitroom fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //sirvoy
        if($('.box.sirvoy').css('display') == 'block') {

            var astro_be_sirvoy_hotel = $.trim($('#astro_be_sirvoy_hotel').val());
            if (astro_be_sirvoy_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!(/^https?:\/\/[^\s\/]+\.[^\s\/]+/i.test(astro_be_sirvoy_hotel))) {
                $error_msg += '- Booking engine address: enter the whole address of the page of your website with the Sirvoy booking widget, such as https://www.yourhotel.com/book/\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Sirvoy fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //bookingdesigner
        if($('.box.bookingdesigner').css('display') == 'block') {

            var astro_be_bookingdesigner_hotel = $.trim($('#astro_be_bookingdesigner_hotel').val());
            if (astro_be_bookingdesigner_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/^(https?:\/\/)?([a-z0-9]([a-z0-9-]*[a-z0-9])?\.)+[a-z]{2,}([\/?#]|$)/i.test(astro_be_bookingdesigner_hotel)) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, such as https://book.yourhotel.com/en/booking-engine/\n';
            }

            //Booking Designer receives the children as their ages
            if ($('#astro_be_bookingdesigner_children_enable').is(':checked') && !$("#astro_be_bookingdesigner_childage_enable").is(":checked")) {
                $error_msg += '- children age: it must be enabled when children are enabled.\n';
            }

            if ($('#astro_be_bookingdesigner_childage_enable').is(':checked')) {

                var astro_be_bookingdesigner_childage_min = $('#astro_be_bookingdesigner_childage_min').length;
                var astro_be_bookingdesigner_childage_max = $('#astro_be_bookingdesigner_childage_max').length;

                if (astro_be_bookingdesigner_childage_min && astro_be_bookingdesigner_childage_max) {
                    var astro_be_bookingdesigner_childage_min_value = parseInt( $("#astro_be_bookingdesigner_childage_min option:selected").val() );
                    var astro_be_bookingdesigner_childage_max_value = parseInt( $("#astro_be_bookingdesigner_childage_max option:selected").val() );

                    if (astro_be_bookingdesigner_childage_min_value > astro_be_bookingdesigner_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'Booking Designer fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //ermeshotels
        if($('.box.ermeshotels').css('display') == 'block') {

            var astro_be_ermeshotels_hotel = $.trim($('#astro_be_ermeshotels_hotel').val());
            if (astro_be_ermeshotels_hotel == '') {
                $error_msg += '- Booking engine address: the field is required.\n';
            } else if (!/book\.ermeshotels\.com\/hotel\/\d+\/channel\/\d+/i.test(astro_be_ermeshotels_hotel) && !/^\d+\/\d+$/.test(astro_be_ermeshotels_hotel)) {
                $error_msg += '- Booking engine address: enter the whole address of your booking engine, the one with hotel and channel.\n';
            }

            //ErmesHotels receives the children as their ages
            if ($('#astro_be_ermeshotels_children_enable').is(':checked') && !$("#astro_be_ermeshotels_childage_enable").is(":checked")) {
                $error_msg += '- children age: it must be enabled when children are enabled.\n';
            }

            if ($('#astro_be_ermeshotels_childage_enable').is(':checked')) {

                var astro_be_ermeshotels_childage_min = $('#astro_be_ermeshotels_childage_min').length;
                var astro_be_ermeshotels_childage_max = $('#astro_be_ermeshotels_childage_max').length;

                if (astro_be_ermeshotels_childage_min && astro_be_ermeshotels_childage_max) {
                    var astro_be_ermeshotels_childage_min_value = parseInt( $("#astro_be_ermeshotels_childage_min option:selected").val() );
                    var astro_be_ermeshotels_childage_max_value = parseInt( $("#astro_be_ermeshotels_childage_max option:selected").val() );

                    if (astro_be_ermeshotels_childage_min_value > astro_be_ermeshotels_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'ErmesHotels fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //guestline
        if($('.box.guestline').css('display') == 'block') {

            var astro_be_guestline_site = $.trim($('#astro_be_guestline_site').val());
            if (astro_be_guestline_site == '') {
                $error_msg += '- Site code: the field is required.\n';
            } else if (!/^[a-zA-Z0-9-]+$/.test(astro_be_guestline_site) && !/guestline\.(app|net)/i.test(astro_be_guestline_site)) {
                $error_msg += '- Site code: enter the code before /availability in the booking engine address.\n';
            }

            var astro_be_guestline_hotel = $.trim($('#astro_be_guestline_hotel').val());
            if (astro_be_guestline_hotel == '') {
                $error_msg += '- hotel: the field is required.\n';
            } else if (!/^[a-zA-Z0-9-]+$/.test(astro_be_guestline_hotel) && !/[?&]hotel=[a-zA-Z0-9-]+/i.test(astro_be_guestline_hotel)) {
                $error_msg += '- hotel: enter the code after hotel= in the booking engine address.\n';
            }

            if ($error_msg != '') {
                $error_msg = 'Guestline fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //siteminder
        if($('.box.siteminder').css('display') == 'block') {

            var astro_be_siteminder_hotel = $.trim($('#astro_be_siteminder_hotel').val());
            if (astro_be_siteminder_hotel == '') {
                $error_msg += '- Property name: the field is required.\n';
            } else if (!/^[a-zA-Z0-9-]+$/.test(astro_be_siteminder_hotel) && !/\/properties\/[a-zA-Z0-9-]+/.test(astro_be_siteminder_hotel)) {
                $error_msg += '- Property name: enter the last part of the booking engine address, after /properties/.\n';
            }

            if ($error_msg != '') {
                $error_msg = 'SiteMinder fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }

        //synxis
        if($('.box.synxis').css('display') == 'block') {

            var astro_be_synxis_codes = [['hotel', 'astro_be_synxis_hotel'], ['chain', 'astro_be_synxis_chain']];
            for (var s = 0; s < astro_be_synxis_codes.length; s++) {
                var astro_be_synxis_label = astro_be_synxis_codes[s][0];
                var astro_be_synxis_value = $.trim($('#' + astro_be_synxis_codes[s][1]).val());
                if (astro_be_synxis_value == '') {
                    $error_msg += '- ' + astro_be_synxis_label + ': the field is required.\n';
                } else if (!/^\d+$/.test(astro_be_synxis_value) && !(new RegExp('[?&]' + astro_be_synxis_label + '=\\d+', 'i')).test(astro_be_synxis_value)) {
                    $error_msg += '- ' + astro_be_synxis_label + ': enter the number after ' + astro_be_synxis_label + '= in the booking engine address.\n';
                }
            }

            if ($('#astro_be_synxis_childage_enable').is(':checked')) {

                var astro_be_synxis_childage_min = $('#astro_be_synxis_childage_min').length;
                var astro_be_synxis_childage_max = $('#astro_be_synxis_childage_max').length;

                if (astro_be_synxis_childage_min && astro_be_synxis_childage_max) {
                    var astro_be_synxis_childage_min_value = parseInt( $("#astro_be_synxis_childage_min option:selected").val() );
                    var astro_be_synxis_childage_max_value = parseInt( $("#astro_be_synxis_childage_max option:selected").val() );

                    if (astro_be_synxis_childage_min_value > astro_be_synxis_childage_max_value) {
                        $error_msg += '- children age: min child age value is greater than max value.\n';
                    }
                }

            }

            if ($error_msg != '') {
                $error_msg = 'Sabre SynXis fields errors:\n' + $error_msg;
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
                $error_msg = 'Vertical Booking fields errors:\n' + $error_msg;
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
                $error_msg = 'Simple Booking fields errors:\n' + $error_msg;
                alert($error_msg);
                return false;
            }

        }


    });

});