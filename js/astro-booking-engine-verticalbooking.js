jQuery( document ).ready(function( $ ) {

    /**
     * Vertical booking
     */
    $(".astro_be_form_verticalbooking").submit(function(){

        var checkin_date = $(this).find('.astro_be_input-checkin-js').val();
        //alert(checkin_date);
        var checkin_date_arr = checkin_date.split('-');
        $(this).find('input.gg').val(checkin_date_arr[2]);
        $(this).find('input.mm').val(checkin_date_arr[1]);
        $(this).find('input.aa').val(checkin_date_arr[0]);

        var checkout_date = $(this).find('.astro_be_input-checkout-js').val();
        var checkout_date_arr = checkout_date.split('-');
        $(this).find('input.ggf').val(checkout_date_arr[2]);
        $(this).find('input.mmf').val(checkout_date_arr[1]);
        $(this).find('input.aaf').val(checkout_date_arr[0]);

    });

});