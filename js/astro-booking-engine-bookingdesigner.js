jQuery( document ).ready(function( $ ) {

    /**
     * Booking Designer
     */
    $(".astro_be_form_bookingdesigner").submit(function(){

        var form = $(this);

        //the booking engine takes the dates in Y-m-d format, which is the format of the hidden fields as they are
        form.find('#astro_be_form_bookingdesigner_fdate').val(form.find('.astro_be_input-checkin-js').val());
        form.find('#astro_be_form_bookingdesigner_tdate').val(form.find('.astro_be_input-checkout-js').val());

        //an empty coupon is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var coupon = form.find('input[name="coupon_code"]');
        if (coupon.length && $.trim(coupon.val()) === '') {
            coupon.prop('disabled', true);
            setTimeout(function() {
                coupon.prop('disabled', false);
            }, 0);
        }

    });

});
