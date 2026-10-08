jQuery( document ).ready(function( $ ) {

    /**
     * Bookassist
     */
    $(".astro_be_form_bookassist").submit(function(){

        var form = $(this);

        //the dates of the hidden fields are in Y-m-d format
        var arrival = form.find('.astro_be_input-checkin-js').val();
        var departure = form.find('.astro_be_input-checkout-js').val();

        //the booking engine takes the dates in Y-m-d format, as they are
        form.find('#astro_be_form_bookassist_date_in').val(arrival);
        form.find('#astro_be_form_bookassist_date_out').val(departure);

    });

});
