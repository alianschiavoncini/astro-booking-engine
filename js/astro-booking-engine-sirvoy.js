jQuery( document ).ready(function( $ ) {

    /**
     * Sirvoy
     */
    $(".astro_be_form_sirvoy").submit(function(){

        var form = $(this);

        //the Sirvoy widget takes the dates in Y-m-d format, which is the format of the hidden fields as they are
        form.find('#astro_be_form_sirvoy_check_in').val(form.find('.astro_be_input-checkin-js').val());
        form.find('#astro_be_form_sirvoy_check_out').val(form.find('.astro_be_input-checkout-js').val());

        //an empty booking code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var coupon = form.find('input[name="code"]');
        if (coupon.length && $.trim(coupon.val()) === '') {
            coupon.prop('disabled', true);
            setTimeout(function() {
                coupon.prop('disabled', false);
            }, 0);
        }

    });

});
