jQuery( document ).ready(function( $ ) {

    /**
     * Ericsoft
     */
    $(".astro_be_form_ericsoft").submit(function(){

        var checkin_date = $(this).find('.astro_be_input-checkin-js').val();
        $(this).find('#astro_be_form_ericsoft_arrival').val(checkin_date);

        var checkout_date = $(this).find('.astro_be_input-checkout-js').val();
        $(this).find('#astro_be_form_ericsoft_departure').val(checkout_date);

        //pax format: adults_0_children_infants
        //the hidden field is seeded by the template with the default counts,
        //so a segment is replaced only when its select is displayed
        var pax_field = $(this).find('#astro_be_form_ericsoft_pax');
        var pax = pax_field.val().split('_');

        var adults = $(this).find('.astro_be_select-adults');
        if (adults.length) {
            pax[0] = adults.val();
        }

        var children = $(this).find('.astro_be_select-children');
        if (children.length) {
            pax[2] = children.val();
        }

        var infants = $(this).find('.astro_be_select-infants');
        if (infants.length) {
            pax[3] = infants.val();
        }

        pax_field.val(pax.join('_'));

    });

});
