jQuery( document ).ready(function( $ ) {

    /**
     * Kross Booking
     */
    $(".astro_be_form_krossbooking").submit(function(){

        var form = $(this);

        //the booking engine takes the dates in Y-m-d format, which is the format of the hidden fields as they are
        form.find('#astro_be_form_krossbooking_from').val(form.find('.astro_be_input-checkin-js').val());
        form.find('#astro_be_form_krossbooking_to').val(form.find('.astro_be_input-checkout-js').val());

        //when a dropdown is disabled the template prints a hidden field with its value
        var adults = form.find('.astro_be_select-adults');
        adults = parseInt(adults.length ? adults.val() : form.find('#astro_be_form_krossbooking_adults').val(), 10) || 1;

        var children = form.find('.astro_be_select-children');
        children = parseInt(children.length ? children.val() : form.find('#astro_be_form_krossbooking_children').val(), 10) || 0;

        //the guests of the room as adults,children,age,age; the main script disables the age
        //dropdowns of the children not selected
        var room = [adults, children];
        if (children > 0) {
            form.find('.astro_be_select-children_age:enabled').each(function(){
                room.push(parseInt($(this).val(), 10));
            });
        }

        form.find('#astro_be_form_krossbooking_guests').val(adults + children);
        form.find('#astro_be_form_krossbooking_n_guests').val(adults + children);
        form.find('#astro_be_form_krossbooking_guests_rooms').val(room.join(',') + ';');

    });

});
