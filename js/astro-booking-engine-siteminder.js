jQuery( document ).ready(function( $ ) {

    /**
     * SiteMinder
     */
    $(".astro_be_form_siteminder").submit(function(){

        var form = $(this);

        //SiteMinder expects the dates in ISO format (Y-m-d), same as the plugin hidden fields
        form.find('#astro_be_form_siteminder_checkin').val(form.find('.astro_be_input-checkin-js').val());
        form.find('#astro_be_form_siteminder_checkout').val(form.find('.astro_be_input-checkout-js').val());

        //an empty promo code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var promo = form.find('input[name="promoCode"]');
        if (promo.length && $.trim(promo.val()) === '') {
            promo.prop('disabled', true);
            setTimeout(function() {
                promo.prop('disabled', false);
            }, 0);
        }

    });

});
