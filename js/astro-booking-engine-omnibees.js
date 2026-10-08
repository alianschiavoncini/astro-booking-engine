jQuery( document ).ready(function( $ ) {

    /**
     * Omnibees
     */
    $(".astro_be_form_omnibees").submit(function(){

        var form = $(this);

        //the dates of the hidden fields are in Y-m-d format
        var arrival = form.find('.astro_be_input-checkin-js').val();
        var departure = form.find('.astro_be_input-checkout-js').val();

        //adults and children: the selects when they are shown, the hidden fields otherwise
        var adultsField = form.find('.astro_be_select-adults');
        var adults = parseInt(adultsField.length ? adultsField.val() : form.find('#astro_be_form_omnibees_adults').val(), 10) || 1;
        var childrenField = form.find('.astro_be_select-children');
        var children = parseInt(childrenField.length ? childrenField.val() : form.find('#astro_be_form_omnibees_children').val(), 10) || 0;
        var ages = [];
        form.find('.astro_be_select-children_age').slice(0, children).each(function() {
            ages.push($(this).val());
        });

        //the dates in dmY format, without separators, and the ages of the children separated by semicolons
        form.find('#astro_be_form_omnibees_CheckIn').val(arrival.split('-').reverse().join(''));
        form.find('#astro_be_form_omnibees_CheckOut').val(departure.split('-').reverse().join(''));
        form.find('#astro_be_form_omnibees_ag').val(ages.join(';'));

        //an empty promotional code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var coupon = form.find('input[name="Code"]');
        if (coupon.length && $.trim(coupon.val()) === '') {
            coupon.prop('disabled', true);
            setTimeout(function() {
                coupon.prop('disabled', false);
            }, 0);
        }

    });

});
