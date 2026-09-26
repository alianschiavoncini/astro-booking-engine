jQuery( document ).ready(function( $ ) {

    /**
     * ThinkReservations
     */
    $(".astro_be_form_thinkreservations").submit(function(){

        var form = $(this);

        //ThinkReservations expects the dates in ISO format (Y-m-d), the same the plugin keeps
        form.find('#astro_be_form_thinkreservations_start_date').val(form.find('.astro_be_input-checkin-js').val());
        form.find('#astro_be_form_thinkreservations_end_date').val(form.find('.astro_be_input-checkout-js').val());

        //the promo code travels with customer_group beside it: without a code neither of the two
        //is sent, otherwise the booking engine opens on the promo field with nothing in it. Both
        //are enabled again once the form is submitted, so the code can still be filled when the
        //booking engine opens in a new tab
        var code = form.find('.astro_be_input-coupon');
        var group = form.find('#astro_be_form_thinkreservations_customer_group');
        if (!code.length || $.trim(code.val()) === '') {
            var empty = code.add(group);
            empty.prop('disabled', true);
            setTimeout(function() {
                empty.prop('disabled', false);
            }, 0);
        }

    });

});
