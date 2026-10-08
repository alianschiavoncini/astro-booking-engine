jQuery( document ).ready(function( $ ) {

    /**
     * Avvio
     */
    $(".astro_be_form_avvio").submit(function(){

        var form = $(this);

        //the dates of the hidden fields are in Y-m-d format
        var arrival = form.find('.astro_be_input-checkin-js').val();
        var departure = form.find('.astro_be_input-checkout-js').val();
        var nights = Math.round((Date.parse(departure) - Date.parse(arrival)) / 86400000);
        if (!(nights > 0)) {
            nights = 1;
        }

        //adults and children: the selects when they are shown, the hidden fields otherwise
        var adultsField = form.find('.astro_be_select-adults');
        var adults = parseInt(adultsField.length ? adultsField.val() : form.find('#astro_be_form_avvio_adults').val(), 10) || 1;
        var childrenField = form.find('.astro_be_select-children');
        var children = parseInt(childrenField.length ? childrenField.val() : form.find('#astro_be_form_avvio_children').val(), 10) || 0;
        var ages = [];
        form.find('.astro_be_select-children_age').slice(0, children).each(function() {
            ages.push($(this).val());
        });

        form.find('#astro_be_form_avvio_checkin').val(arrival);
        form.find('#astro_be_form_avvio_nights').val(nights);

        //the number of the children and their ages, childage1, childage2...: one hidden field each,
        //added at every submit in place of the previous ones
        form.find('#astro_be_form_avvio_partyc').val(children);
        form.find('input.astro_be_avvio_childage').remove();
        $.each(ages, function(i, age) {
            $('<input type="hidden" class="astro_be_avvio_childage" />').attr('name', 'childage' + (i + 1)).val(age).appendTo(form);
        });

        //an empty promotional code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var coupon = form.find('input[name="promocode"]');
        if (coupon.length && $.trim(coupon.val()) === '') {
            coupon.prop('disabled', true);
            setTimeout(function() {
                coupon.prop('disabled', false);
            }, 0);
        }

    });

});
