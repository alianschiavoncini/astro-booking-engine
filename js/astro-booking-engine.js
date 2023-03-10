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
            myDate.setDate( myDate.getDate() + 1 );
            var date = new Date();
            date.setDate(date.getDate() + 1);
            $(astro_be_checkout).datepicker("setDate", myDate);
        }
    });

    $(astro_be_checkout).datepicker({
        defaultDate: "+1w",
        inline: true,
        showOtherMonths: true,
        dateFormat: $( astro_be_checkout ).attr( "data-date-format"),
        minDate: "today" + 1,
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

    /**
     * Vertical booking customization
     */
    $(".astro_be_form_verticalbooking").submit(function(){

        var checkin_date = $(astro_be_checkin).val();
        var checkin_date_arr = checkin_date.split('/');
        $(this).find('#gg').val(checkin_date_arr[0]);
        $(this).find('#mm').val(checkin_date_arr[1]);
        $(this).find('#aa').val(checkin_date_arr[2]);

        var checkout_date = $(astro_be_checkout).val();
        var checkout_date_arr = checkout_date.split('/');
        $(this).find('#ggf').val(checkout_date_arr[0]);
        $(this).find('#mmf').val(checkout_date_arr[1]);
        $(this).find('#aaf').val(checkout_date_arr[2]);

    });

});