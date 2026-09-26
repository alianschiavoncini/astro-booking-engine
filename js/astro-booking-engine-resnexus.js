jQuery( document ).ready(function( $ ) {

    /**
     * ResNexus
     */
    $(".astro_be_form_resnexus").submit(function(){

        var form = $(this);

        //ResNexus expects the dates in ISO format (Y-m-d), the same the plugin hidden fields keep
        form.find('#astro_be_form_resnexus_startdate').val(form.find('.astro_be_input-checkin-js').val());
        form.find('#astro_be_form_resnexus_enddate').val(form.find('.astro_be_input-checkout-js').val());

    });

});
