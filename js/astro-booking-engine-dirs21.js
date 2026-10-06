jQuery( document ).ready(function( $ ) {

    /**
     * DIRS21
     */
    $(".astro_be_form_dirs21").submit(function(){

        var form = $(this);

        //the dates in Y-m-d format, which is the format of the hidden fields as they are
        var arrival = form.find('.astro_be_input-checkin-js').val();
        var departure = form.find('.astro_be_input-checkout-js').val();
        form.find('#astro_be_form_dirs21_range').val(arrival + ',' + departure);

        //the length of stay, in nights
        var nights = Math.round((Date.parse(departure) - Date.parse(arrival)) / 86400000);
        form.find('#astro_be_form_dirs21_los').val(nights > 0 ? nights : 1);

        //when a dropdown is disabled the template prints a hidden field with its value
        var adults = form.find('.astro_be_select-adults');
        adults = parseInt(adults.length ? adults.val() : form.find('#astro_be_form_dirs21_adults').val(), 10) || 1;

        var children = form.find('.astro_be_select-children');
        children = parseInt(children.length ? children.val() : form.find('#astro_be_form_dirs21_children').val(), 10) || 0;

        //the children as their ages: the main script disables the age dropdowns of the children not selected
        var ages = [];
        if (children > 0) {
            form.find('.astro_be_select-children_age:enabled').each(function(){
                ages.push(parseInt($(this).val(), 10));
            });
        }

        form.find('#astro_be_form_dirs21_sets').val(JSON.stringify([{ occupancy: { adultCount: adults, children: ages } }]));

        //an empty promo code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var coupon = form.find('input[name="rateCode"]');
        if (coupon.length && $.trim(coupon.val()) === '') {
            coupon.prop('disabled', true);
            setTimeout(function() {
                coupon.prop('disabled', false);
            }, 0);
        }

    });

});
