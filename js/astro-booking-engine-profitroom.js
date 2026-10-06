jQuery( document ).ready(function( $ ) {

    /**
     * Profitroom
     */
    $(".astro_be_form_profitroom").submit(function(){

        var form = $(this);

        //the booking engine takes the dates in Y-m-d format, which is the format of the hidden fields as they are
        form.find('#astro_be_form_profitroom_check-in').val(form.find('.astro_be_input-checkin-js').val());
        form.find('#astro_be_form_profitroom_check-out').val(form.find('.astro_be_input-checkout-js').val());

        //when a dropdown is disabled the template prints a hidden field with its value
        var adults = form.find('.astro_be_select-adults');
        adults = parseInt(adults.length ? adults.val() : form.find('#astro_be_form_profitroom_adults').val(), 10) || 1;

        var children = form.find('.astro_be_select-children');
        children = parseInt(children.length ? children.val() : form.find('#astro_be_form_profitroom_children').val(), 10) || 0;

        //the age ranges of the hotel, such as 0-2,3-11,12-14
        var ranges = [];
        $.each((form.find('#astro_be_form_profitroom_ranges').val() || '').split(','), function(i, range) {
            var limits = range.split('-');
            if (limits.length === 2) {
                ranges.push({ min: parseInt(limits[0], 10), max: parseInt(limits[1], 10) });
            }
        });

        //every child is counted in the range of their age; a child older than the last range is an
        //adult for the booking engine, and an age between two ranges goes to the closest one
        var counts = {};
        if (children > 0 && ranges.length) {
            form.find('.astro_be_select-children_age:enabled').each(function(){
                var age = parseInt($(this).val(), 10);
                var best = null;
                var distance = null;
                $.each(ranges, function(i, range) {
                    var d = age < range.min ? range.min - age : (age > range.max ? age - range.max : 0);
                    if (distance === null || d < distance) {
                        best = range;
                        distance = d;
                    }
                });
                var oldest = Math.max.apply(null, $.map(ranges, function(range) { return range.max; }));
                if (age > oldest) {
                    adults++;
                    return;
                }
                var key = 'r1_child' + best.min + '-' + best.max;
                counts[key] = (counts[key] || 0) + 1;
            });
        }

        form.find('#astro_be_form_profitroom_r1_adults').val(adults);

        //one field for every range, added on every submit and removed from the previous one
        form.find('.astro_be_profitroom_child').remove();
        $.each(counts, function(name, count) {
            $('<input type="hidden" class="astro_be_profitroom_child" />').attr('name', name).val(count).appendTo(form);
        });

        //an empty promo code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var coupon = form.find('input[name="code"]');
        if (coupon.length && $.trim(coupon.val()) === '') {
            coupon.prop('disabled', true);
            setTimeout(function() {
                coupon.prop('disabled', false);
            }, 0);
        }

    });

});
