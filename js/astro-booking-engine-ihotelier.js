jQuery( document ).ready(function( $ ) {

    /**
     * Amadeus iHotelier (TravelClick)
     */
    $(".astro_be_form_ihotelier").submit(function(){

        var form = $(this);

        //the booking engine expects the dates in M/D/Y (12/25/2026), not the ISO ones
        var checkin_arr = form.find('.astro_be_input-checkin-js').val().split('-');
        var checkout_arr = form.find('.astro_be_input-checkout-js').val().split('-');

        form.find('#astro_be_form_ihotelier_datein').val(
            parseInt(checkin_arr[1], 10) + '/' + parseInt(checkin_arr[2], 10) + '/' + checkin_arr[0]
        );
        form.find('#astro_be_form_ihotelier_dateout').val(
            parseInt(checkout_arr[1], 10) + '/' + parseInt(checkout_arr[2], 10) + '/' + checkout_arr[0]
        );

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
