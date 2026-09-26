jQuery( document ).ready(function( $ ) {

    /**
     * Witbooking
     */
    $(".astro_be_form_witbooking").submit(function(){

        var form = $(this);

        //Witbooking expects the dates in d-m-Y format (10-11-2026), not the ISO one
        var checkin_arr = form.find('.astro_be_input-checkin-js').val().split('-');
        var checkout_arr = form.find('.astro_be_input-checkout-js').val().split('-');

        form.find('#astro_be_form_witbooking_datein').val(checkin_arr[2] + '-' + checkin_arr[1] + '-' + checkin_arr[0]);
        form.find('#astro_be_form_witbooking_dateout').val(checkout_arr[2] + '-' + checkout_arr[1] + '-' + checkout_arr[0]);

        //an empty promo code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var promo = form.find('input[name="prom"]');
        if (promo.length && $.trim(promo.val()) === '') {
            promo.prop('disabled', true);
            setTimeout(function() {
                promo.prop('disabled', false);
            }, 0);
        }

    });

});
