jQuery( document ).ready(function( $ ) {

    /**
     * Aro Suite
     */
    $(".astro_be_form_arosuite").submit(function(){

        var form = $(this);

        //the dates of the hidden fields are in Y-m-d format
        var arrival = form.find('.astro_be_input-checkin-js').val();
        var departure = form.find('.astro_be_input-checkout-js').val();
        var nights = Math.round((Date.parse(departure) - Date.parse(arrival)) / 86400000);
        if (!(nights > 0)) {
            nights = 1;
        }

        //the arrival in d-m-Y format and the nights
        form.find('#astro_be_form_arosuite_StartDate').val(arrival.split('-').reverse().join('-'));
        form.find('#astro_be_form_arosuite_nights').val(nights);

        //an empty promotional code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var coupon = form.find('input[name="promocode"]');
        if (coupon.length && $.trim(coupon.val()) === '') {
            coupon.prop('disabled', true);
            setTimeout(function() {
                coupon.prop('disabled', false);
            }, 0);
        }

    });

});
