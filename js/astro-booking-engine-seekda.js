jQuery( document ).ready(function( $ ) {

    /**
     * Seekda
     */
    $(".astro_be_form_seekda").submit(function(){

        var form = $(this);

        //the dates of the hidden fields are in Y-m-d format
        var arrival = form.find('.astro_be_input-checkin-js').val();
        var departure = form.find('.astro_be_input-checkout-js').val();

        //the booking engine takes the dates in Y-m-d format, as they are
        form.find('#astro_be_form_seekda_checkin').val(arrival);
        form.find('#astro_be_form_seekda_checkout').val(departure);

        //an empty promotional code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var coupon = form.find('input[name="skd-promotion-code"]');
        if (coupon.length && $.trim(coupon.val()) === '') {
            coupon.prop('disabled', true);
            setTimeout(function() {
                coupon.prop('disabled', false);
            }, 0);
        }

    });

});
