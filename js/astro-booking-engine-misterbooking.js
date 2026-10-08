jQuery( document ).ready(function( $ ) {

    /**
     * Misterbooking
     */
    $(".astro_be_form_misterbooking").submit(function(){

        var form = $(this);

        //the dates of the hidden fields are in Y-m-d format
        var arrival = form.find('.astro_be_input-checkin-js').val();
        var departure = form.find('.astro_be_input-checkout-js').val();
        var nights = Math.round((Date.parse(departure) - Date.parse(arrival)) / 86400000);
        if (!(nights > 0)) {
            nights = 1;
        }

        //the date is read in d/m/Y format with the French interface, m/d/Y with the English one
        var parts = arrival.split('-');
        var french = form.find('#astro_be_form_misterbooking_langue').val() === 'francais';
        form.find('#astro_be_form_misterbooking_date_deb').val(french ? parts[2] + '/' + parts[1] + '/' + parts[0] : parts[1] + '/' + parts[2] + '/' + parts[0]);
        form.find('#astro_be_form_misterbooking_nb_nuit').val(nights);

        //an empty promotional code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var coupon = form.find('input[name="code_promo"]');
        if (coupon.length && $.trim(coupon.val()) === '') {
            coupon.prop('disabled', true);
            setTimeout(function() {
                coupon.prop('disabled', false);
            }, 0);
        }

    });

});
