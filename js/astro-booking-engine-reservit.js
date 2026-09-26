jQuery( document ).ready(function( $ ) {

    /**
     * Reservit
     */
    $(".astro_be_form_reservit").submit(function(){

        var form = $(this);

        //the quick search of Reservit takes the dates split in day, month and year, without
        //leading zeros, one triple for the arrival and one for the departure
        var checkin_arr = form.find('.astro_be_input-checkin-js').val().split('-');
        var checkout_arr = form.find('.astro_be_input-checkout-js').val().split('-');

        form.find('#astro_be_form_reservit_fday').val(parseInt(checkin_arr[2], 10));
        form.find('#astro_be_form_reservit_fmonth').val(parseInt(checkin_arr[1], 10));
        form.find('#astro_be_form_reservit_fyear').val(checkin_arr[0]);

        form.find('#astro_be_form_reservit_tday').val(parseInt(checkout_arr[2], 10));
        form.find('#astro_be_form_reservit_tmonth').val(parseInt(checkout_arr[1], 10));
        form.find('#astro_be_form_reservit_tyear').val(checkout_arr[0]);

        //the ages travel in one numbered field each (ages1, ages2...), sent by the form itself:
        //the main script disables the age dropdowns of the children not selected, so only the
        //ages of the chosen children are part of the request and nothing has to be composed here

        //an empty discount code is not sent; the field is enabled again once the form is
        //submitted, so it can still be filled when the booking engine opens in a new tab
        var code = form.find('.astro_be_input-coupon');
        if (code.length && $.trim(code.val()) === '') {
            code.prop('disabled', true);
            setTimeout(function() {
                code.prop('disabled', false);
            }, 0);
        }

    });

});
