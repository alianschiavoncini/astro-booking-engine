jQuery( document ).ready(function( $ ) {

    /**
     * Windsurfer CRS
     */
    $(".astro_be_form_windsurfer").submit(function(){

        var form = $(this);

        //the booking engine accepts the dates in Y-m-d format, which is the format of the hidden fields as they are
        form.find('#astro_be_form_windsurfer_checkin').val(form.find('.astro_be_input-checkin-js').val());
        form.find('#astro_be_form_windsurfer_checkout').val(form.find('.astro_be_input-checkout-js').val());

        //an empty promo code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var coupon = form.find('input[name="promo"]');
        if (coupon.length && $.trim(coupon.val()) === '') {
            coupon.prop('disabled', true);
            setTimeout(function() {
                coupon.prop('disabled', false);
            }, 0);
        }

    });

});
