jQuery( document ).ready(function( $ ) {

    /**
     * Bookvisit
     */
    $(".astro_be_form_bookvisit").submit(function(){

        var form = $(this);

        //the arrival in Y-m-d format, which is the format of the hidden field as it is, and the nights
        var arrival = form.find('.astro_be_input-checkin-js').val();
        var departure = form.find('.astro_be_input-checkout-js').val();
        var nights = Math.round((Date.parse(departure) - Date.parse(arrival)) / 86400000);
        form.find('#astro_be_form_bookvisit_StartDate').val(arrival);
        form.find('#astro_be_form_bookvisit_NrNights').val(nights > 0 ? nights : 1);

        //when a dropdown is disabled the template prints a hidden field with its value
        var adults = form.find('.astro_be_select-adults');
        adults = parseInt(adults.length ? adults.val() : form.find('#astro_be_form_bookvisit_adults').val(), 10) || 1;

        var children = form.find('.astro_be_select-children');
        children = parseInt(children.length ? children.val() : form.find('#astro_be_form_bookvisit_children').val(), 10) || 0;

        //the room as a2_c5_c9: the adults, then the age of every child; the main script disables
        //the age dropdowns of the children not selected
        var room = 'a' + adults;
        if (children > 0) {
            form.find('.astro_be_select-children_age:enabled').each(function(){
                room += '_c' + parseInt($(this).val(), 10);
            });
        }
        form.find('#astro_be_form_bookvisit_RoomConfig').val(room);

        //an empty promo code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var coupon = form.find('input[name="PromoCode"]');
        if (coupon.length && $.trim(coupon.val()) === '') {
            coupon.prop('disabled', true);
            setTimeout(function() {
                coupon.prop('disabled', false);
            }, 0);
        }

    });

});
