jQuery( document ).ready(function( $ ) {

    /**
     * Booking Expert
     */
    $(".astro_be_form_bookingexpert").submit(function(){

        var form = $(this);

        //Booking Expert expects the dates in d/m/Y format and the number of nights
        var checkin_arr = form.find('.astro_be_input-checkin-js').val().split('-');
        var checkout_arr = form.find('.astro_be_input-checkout-js').val().split('-');

        form.find('#astro_be_form_bookingexpert_checkin').val(checkin_arr[2] + '/' + checkin_arr[1] + '/' + checkin_arr[0]);
        form.find('#astro_be_form_bookingexpert_checkout').val(checkout_arr[2] + '/' + checkout_arr[1] + '/' + checkout_arr[0]);

        var nights = Math.round(
            (Date.UTC(checkout_arr[0], checkout_arr[1] - 1, checkout_arr[2]) - Date.UTC(checkin_arr[0], checkin_arr[1] - 1, checkin_arr[2])) / 86400000
        );
        form.find('#astro_be_form_bookingexpert_nights').val(nights > 0 ? nights : 1);

        //an empty coupon is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var coupon = form.find('input[name="coupon"]');
        if (coupon.length && $.trim(coupon.val()) === '') {
            coupon.prop('disabled', true);
            setTimeout(function() {
                coupon.prop('disabled', false);
            }, 0);
        }

    });

});
