jQuery( document ).ready(function( $ ) {

    /**
     * MyGuestCare
     */
    $(".astro_be_form_myguestcare").submit(function(){

        //MyGuestCare expects the dates in dd/mm/yyyy format
        var checkin_date = $(this).find('.astro_be_input-checkin-js').val();
        var checkin_date_arr = checkin_date.split('-');
        $(this).find('#astro_be_form_myguestcare_arrivo').val(checkin_date_arr[2] + '/' + checkin_date_arr[1] + '/' + checkin_date_arr[0]);

        var checkout_date = $(this).find('.astro_be_input-checkout-js').val();
        var checkout_date_arr = checkout_date.split('-');
        $(this).find('#astro_be_form_myguestcare_partenza').val(checkout_date_arr[2] + '/' + checkout_date_arr[1] + '/' + checkout_date_arr[0]);

    });

});
