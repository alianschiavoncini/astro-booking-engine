jQuery( document ).ready(function( $ ) {

    /**
     * Mews
     */
    $(".astro_be_form_mews").submit(function(){

        //Mews expects the dates in ISO format (Y-m-d), same as the plugin hidden fields
        var checkin_date = $(this).find('.astro_be_input-checkin-js').val();
        $(this).find('#astro_be_form_mews_checkin').val(checkin_date);

        var checkout_date = $(this).find('.astro_be_input-checkout-js').val();
        $(this).find('#astro_be_form_mews_checkout').val(checkout_date);

        //an empty voucher code is not sent; the field is enabled again once the form is
        //submitted, so it can still be filled when the booking engine opens in a new tab
        var $coupon = $(this).find('input[name="mewsVoucherCode"]');
        if ($coupon.length && $.trim($coupon.val()) === '') {
            $coupon.prop('disabled', true);
            setTimeout(function() {
                $coupon.prop('disabled', false);
            }, 0);
        }

    });

});
