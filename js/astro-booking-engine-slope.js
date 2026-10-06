jQuery( document ).ready(function( $ ) {

    /**
     * Slope
     */
    $(".astro_be_form_slope").submit(function(){

        var form = $(this);

        //the booking engine takes the dates in d/m/Y format: the hidden fields are in Y-m-d format
        function slope_date(value) {
            var parts = (value || '').split('-');
            return parts.length === 3 ? parts[2] + '/' + parts[1] + '/' + parts[0] : value;
        }

        form.find('#astro_be_form_slope_arrival').val(slope_date(form.find('.astro_be_input-checkin-js').val()));
        form.find('#astro_be_form_slope_departure').val(slope_date(form.find('.astro_be_input-checkout-js').val()));

    });

});
