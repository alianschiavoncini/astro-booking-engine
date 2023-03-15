jQuery( document ).ready(function( $ ) {

    /**
     * Simple booking
     */
    $(".astro_be_form_simplebooking").submit(function(){

        var checkin_date = $(this).find('.astro_be_input-checkin-js').val();
        $(this).find('#astro_be_form_simplebooking_in').val(checkin_date);

        var checkout_date = $(this).find('.astro_be_input-checkout-js').val();
        $(this).find('#astro_be_form_simplebooking_out').val(checkout_date);

        var adults = $(this).find('.astro_be_select-adults').val();
        let adults_format = "";
        for (let i = 0; i < adults; i++) {
            adults_format += "A,";
        }
        adults_format.slice(0, -1);
        $(this).find('#astro_be_form_simplebooking_guests').val(adults_format);

        //TODO children + children age
        //return false;

    });

});