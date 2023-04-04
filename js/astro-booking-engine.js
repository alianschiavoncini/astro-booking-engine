jQuery( document ).ready(function( $ ) {

    /**
     * Datepicker for Check-in and Check-out
     */
    var astro_be_checkin = '.astro_be_input-checkin';
    var astro_be_checkout = '.astro_be_input-checkout';

    $(astro_be_checkin).datepicker({
        defaultDate: "+1w",
        inline: true,
        showOtherMonths: true,
        dateFormat: $(astro_be_checkin).attr( "data-date-format"),
        minDate: "today",

        onClose: function( selectedDate ) {
            $( astro_be_checkout ).datepicker( "option", "minDate", selectedDate );
            var myDate = $(this).datepicker("getDate");

            //set the date in the checkin hidden field
            const date_in_js = new Date(myDate.setDate(myDate.getDate()));
            date_in_js_year  = date_in_js.getFullYear();
            date_in_js_month = (date_in_js.getMonth() + 1);
            if (date_in_js_month < 10) { date_in_js_month = '0' + date_in_js_month; }
            date_in_js_day = date_in_js.getDate();
            if (date_in_js_day < 10) { date_in_js_day = '0' + date_in_js_day; }
            date_in_js_value = date_in_js_year + '-' + date_in_js_month + '-' + date_in_js_day;
            $('.astro_be_input-checkin-js').val(date_in_js_value);

            //get the tomorrow date
            myDate.setDate( myDate.getDate() + 1 );
            var date = new Date();
            date.setDate(date.getDate() + 1);
            $(astro_be_checkout).datepicker("setDate", myDate);

            //set the date in the checkout hidden field
            const date_out_js = new Date(myDate.setDate(myDate.getDate()));
            date_out_js_year  = date_out_js.getFullYear();
            date_out_js_month = (date_out_js.getMonth() + 1);
            if (date_out_js_month < 10) { date_out_js_month = '0' + date_out_js_month; }
            date_out_js_day   = date_out_js.getDate();
            if (date_out_js_day < 10) { date_out_js_day = '0' + date_out_js_day; }
            date_out_js_value = date_out_js_year + '-' + date_out_js_month + '-' + date_out_js_day;
            $('.astro_be_input-checkout-js').val(date_out_js_value);
        }
    });

    $(astro_be_checkout).datepicker({
        defaultDate: "+1w",
        inline: true,
        showOtherMonths: true,
        dateFormat: $( astro_be_checkout ).attr( "data-date-format"),
        minDate: "today" + 1,

        onClose: function() {
            var myDate = $(this).datepicker("getDate");
            myDate.setDate( myDate.getDate() );

            const date_out_js = new Date(myDate.setDate(myDate.getDate()));
            date_out_js_year  = date_out_js.getFullYear();
            date_out_js_month = (date_out_js.getMonth() + 1);
            if (date_out_js_month < 10) { date_out_js_month = '0' + date_out_js_month; }
            date_out_js_day   = date_out_js.getDate();
            if (date_out_js_day < 10) { date_out_js_day = '0' + date_out_js_day; }
            date_out_js_value = date_out_js_year + '-' + date_out_js_month + '-' + date_out_js_day;
            $('.astro_be_input-checkout-js').val(date_out_js_value);
        }
    });

    $(astro_be_checkin).datepicker("setDate", "today");
    $(astro_be_checkout).datepicker("setDate", "today" + 1);

    /**
     * Show/hide child age select dropdown based on children select option value
     */
    var astro_be_children = '.astro_be_select-children';
    var astro_be_child_age = '.astro_be_column-children_age';

    //disable and hide all the children age
    $(astro_be_child_age + " select").prop('disabled', 'disabled')
    $(astro_be_child_age).css('display', 'none');

    //show the children_age select based on n children selected
    $( ".astro_be_select-children" ).change(function () {

        //disable and hide all children select the age before viewing them
        $(astro_be_child_age + " select").prop('disabled', 'disabled')
        $(astro_be_child_age).css('display', 'none');

        //get the value of the choosen children
        var n_children = $(astro_be_children).val();

        for (i = 1; i <= n_children; i++) {
            var wrapper = astro_be_child_age + '-' + i;
            $(wrapper + ' select').prop('disabled', false);
            $(wrapper).css('display', 'block');
        }

    });

    //show the childage selects if n children selected > 0
    var n_children_selected = $('.astro_be_select-children').length;
    if (n_children_selected) {
        var n_children_selected_value = $( "select.astro_be_select-children option:selected" ).val();

        if (n_children_selected_value > 0) {
            //disable and hide all children select the age before viewing them
            $(astro_be_child_age + " select").prop('disabled', 'disabled')
            $(astro_be_child_age).css('display', 'none');

            for (i = 1; i <= n_children_selected_value; i++) {
                var wrapper = astro_be_child_age + '-' + i;
                $(wrapper + ' select').prop('disabled', false);
                $(wrapper).css('display', 'block');
            }
        }
    }

});