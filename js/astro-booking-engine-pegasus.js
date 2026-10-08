jQuery( document ).ready(function( $ ) {

    /**
     * Pegasus
     */
    $(".astro_be_form_pegasus").submit(function(){

        var form = $(this);

        //the arrival in Y-m-d format, which is the format of the hidden field as it is, and the nights
        var arrival = form.find('.astro_be_input-checkin-js').val();
        var departure = form.find('.astro_be_input-checkout-js').val();
        var nights = Math.round((Date.parse(departure) - Date.parse(arrival)) / 86400000);
        form.find('#astro_be_form_pegasus_CheckinDate').val(arrival);
        form.find('#astro_be_form_pegasus_LOS').val(nights > 0 ? nights : 1);

        //an empty access code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var coupon = form.find('input[name="accessCode"]');
        if (coupon.length && $.trim(coupon.val()) === '') {
            coupon.prop('disabled', true);
            setTimeout(function() {
                coupon.prop('disabled', false);
            }, 0);
        }

    });

});
