jQuery( document ).ready(function( $ ) {

    /**
     * Iperbooking
     */
    $(".astro_be_form_iperbooking").submit(function(){

        var checkin_date = $(this).find('.astro_be_input-checkin-js').val();
        var checkin_date_arr = checkin_date.split('-');
        $(this).find('#astro_be_form_iperbooking_checkin').val(checkin_date_arr[2] + '/' + checkin_date_arr[1] + '/' + checkin_date_arr[0]); //format dd/mm/yy

        var checkout_date = $(this).find('.astro_be_input-checkout-js').val();
        var checkout_date_arr = checkout_date.split('-');
        $(this).find('#astro_be_form_iperbooking_checkout').val(checkout_date_arr[2] + '/' + checkout_date_arr[1] + '/' + checkout_date_arr[0]); //format dd/mm/yy

    });

});