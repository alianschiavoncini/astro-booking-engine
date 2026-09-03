jQuery( document ).ready(function( $ ) {

    /**
     * WuBook
     */
    $(".astro_be_form_wubook").submit(function(){

        //WuBook expects the dates in dd/mm/yyyy format
        var checkin_date = $(this).find('.astro_be_input-checkin-js').val();
        var checkin_date_arr = checkin_date.split('-');
        $(this).find('#astro_be_form_wubook_f').val(checkin_date_arr[2] + '/' + checkin_date_arr[1] + '/' + checkin_date_arr[0]);

        var checkout_date = $(this).find('.astro_be_input-checkout-js').val();
        var checkout_date_arr = checkout_date.split('-');
        $(this).find('#astro_be_form_wubook_t').val(checkout_date_arr[2] + '/' + checkout_date_arr[1] + '/' + checkout_date_arr[0]);

        //o format: adults.teens.children.babies
        //the hidden field is seeded by the template with the default counts,
        //so a segment is replaced only when its select is displayed
        var o_field = $(this).find('#astro_be_form_wubook_o');
        var o = o_field.val().split('.');

        var adults = $(this).find('.astro_be_select-adults');
        if (adults.length) {
            o[0] = adults.val();
        }

        var teens = $(this).find('.astro_be_select-teens');
        if (teens.length) {
            o[1] = teens.val();
        }

        var children = $(this).find('.astro_be_select-children');
        if (children.length) {
            o[2] = children.val();
        }

        var babies = $(this).find('.astro_be_select-babies');
        if (babies.length) {
            o[3] = babies.val();
        }

        o_field.val(o.join('.'));

    });

});
