jQuery( document ).ready(function( $ ) {

    /**
     * Journey
     */
    $(".astro_be_form_journey").submit(function(){

        var form = $(this);

        //Journey expects the dates in ISO format (Y-m-d), same as the plugin hidden fields
        form.find('#astro_be_form_journey_fromdate').val(form.find('.astro_be_input-checkin-js').val());
        form.find('#astro_be_form_journey_todate').val(form.find('.astro_be_input-checkout-js').val());

    });

});
