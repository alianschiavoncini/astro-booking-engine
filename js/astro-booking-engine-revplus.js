jQuery( document ).ready(function( $ ) {

    /**
     * RevPlus (WebHotelier)
     */
    $(".astro_be_form_revplus").submit(function(){

        var form = $(this);

        //RevPlus expects the arrival date in ISO format (Y-m-d) and the number of nights
        var checkin_date = form.find('.astro_be_input-checkin-js').val();
        var checkout_date = form.find('.astro_be_input-checkout-js').val();
        form.find('#astro_be_form_revplus_checkin').val(checkin_date);

        var checkin_arr = checkin_date.split('-');
        var checkout_arr = checkout_date.split('-');
        var nights = Math.round(
            (Date.UTC(checkout_arr[0], checkout_arr[1] - 1, checkout_arr[2]) - Date.UTC(checkin_arr[0], checkin_arr[1] - 1, checkin_arr[2])) / 86400000
        );
        form.find('#astro_be_form_revplus_nights').val(nights > 0 ? nights : 1);

        //an empty voucher is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var voucher = form.find('input[name="voucher"]');
        if (voucher.length && $.trim(voucher.val()) === '') {
            voucher.prop('disabled', true);
            setTimeout(function() {
                voucher.prop('disabled', false);
            }, 0);
        }

    });

});
