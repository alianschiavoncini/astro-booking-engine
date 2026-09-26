jQuery( document ).ready(function( $ ) {

    /**
     * Cloudbeds
     */
    $(".astro_be_form_cloudbeds").submit(function(){

        var form = $(this);

        //Cloudbeds expects the dates in ISO format (Y-m-d), the same the plugin hidden fields keep
        form.find('#astro_be_form_cloudbeds_checkin').val(form.find('.astro_be_input-checkin-js').val());
        form.find('#astro_be_form_cloudbeds_checkout').val(form.find('.astro_be_input-checkout-js').val());

        //an empty promo code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var promo = form.find('.astro_be_input-coupon');
        if (promo.length && $.trim(promo.val()) === '') {
            promo.prop('disabled', true);
            setTimeout(function() {
                promo.prop('disabled', false);
            }, 0);
        }

    });

});
