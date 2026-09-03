jQuery( document ).ready(function( $ ) {

    /**
     * Data Sistemi
     */
    $(".astro_be_form_datasistemi").submit(function(){

        //Data Sistemi expects the dates in ISO format (Y-m-d), same as the plugin hidden fields
        var checkin_date = $(this).find('.astro_be_input-checkin-js').val();
        $(this).find('#astro_be_form_datasistemi_checkin').val(checkin_date);

        var checkout_date = $(this).find('.astro_be_input-checkout-js').val();
        $(this).find('#astro_be_form_datasistemi_checkout').val(checkout_date);

    });

});
