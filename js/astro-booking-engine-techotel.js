jQuery( document ).ready(function( $ ) {

    /**
     * TecHotel (Picasso Online)
     */
    $(".astro_be_form_techotel").submit(function(){

        var form = $(this);

        //the dates of the hidden fields are in Y-m-d format
        var arrival = form.find('.astro_be_input-checkin-js').val();
        var departure = form.find('.astro_be_input-checkout-js').val();

        //adults and children: the selects when they are shown, the hidden fields otherwise
        var adultsField = form.find('.astro_be_select-adults');
        var adults = parseInt(adultsField.length ? adultsField.val() : form.find('#astro_be_form_techotel_adults').val(), 10) || 1;
        var childrenField = form.find('.astro_be_select-children');
        var children = parseInt(childrenField.length ? childrenField.val() : form.find('#astro_be_form_techotel_children').val(), 10) || 0;
        var ages = [];
        form.find('.astro_be_select-children_age').slice(0, children).each(function() {
            ages.push(parseInt($(this).val(), 10) || 0);
        });

        //the booking engine takes the dates in Y-m-d format, as they are
        form.find('#astro_be_form_techotel_arrivalDate').val(arrival);
        form.find('#astro_be_form_techotel_departureDate').val(departure);

        //the children are counted in the two age ranges of the hotel (children1 and children2, in the order
        //of the settings, such as 0-4,5-15); without ranges or ages they are all counted in the first one
        var ranges = $.map(String(form.find('#astro_be_form_techotel_ranges').val() || '').split(','), function(range) {
            var limits = range.split('-');
            return (limits.length === 2) ? [[parseInt(limits[0], 10), parseInt(limits[1], 10)]] : null;
        });
        var counts = [0, 0];
        for (var i = 0; i < children; i++) {
            var field = 0;
            if (i < ages.length && ranges.length === 2 && ages[i] >= ranges[1][0] && ages[i] <= ranges[1][1]) {
                field = 1;
            }
            counts[field]++;
        }
        form.find('#astro_be_form_techotel_children1').val(counts[0]);
        form.find('#astro_be_form_techotel_children2').val(counts[1]);

        //an empty campaign code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var coupon = form.find('input[name="campaigncode"]');
        if (coupon.length && $.trim(coupon.val()) === '') {
            coupon.prop('disabled', true);
            setTimeout(function() {
                coupon.prop('disabled', false);
            }, 0);
        }

    });

});
