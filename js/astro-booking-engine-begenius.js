jQuery( document ).ready(function( $ ) {

    /**
     * BeGenius
     */
    $(".astro_be_form_begenius").submit(function(){

        //BeGenius is a single page application: the search goes in the URL fragment
        //(#room/1/<params>), serialized with $.param() exactly as the booking engine does
        var form = $(this);

        //BeGenius expects the dates in dd/mm/yyyy format
        var checkin_date_arr = form.find('.astro_be_input-checkin-js').val().split('-');
        var checkout_date_arr = form.find('.astro_be_input-checkout-js').val().split('-');

        //occupancy: when a dropdown is disabled, the template prints a hidden field with its value
        var adults = form.find('.astro_be_select-adults');
        adults = adults.length ? adults.val() : form.find('#astro_be_form_begenius_adults').val();

        var children = form.find('.astro_be_select-children');
        children = children.length ? children.val() : form.find('#astro_be_form_begenius_children').val();

        var room = { adults: adults, children: children };

        //children ages: the main script disables the age dropdowns of the children not selected
        if (parseInt(children, 10) > 0) {
            var children_ages = [];
            form.find('.astro_be_select-children_age:enabled').each(function(){
                children_ages.push($(this).val());
            });
            if (children_ages.length) {
                room.children_ages = children_ages;
            }
        }

        var coupon = form.find('.astro_be_input-coupon');

        var params = {
            checkin: checkin_date_arr[2] + '/' + checkin_date_arr[1] + '/' + checkin_date_arr[0],
            checkout: checkout_date_arr[2] + '/' + checkout_date_arr[1] + '/' + checkout_date_arr[0],
            rooms: [ room ],
            code: coupon.length ? String(coupon.val()).trim() : '',
            rid: ''
        };

        //drop the fragment of a previous submit (e.g. after going back), then add the new one
        var action = form.attr('action').split('#')[0];
        form.attr('action', action + '#room/1/' + $.param(params));

    });

});
