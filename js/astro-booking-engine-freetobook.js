jQuery( document ).ready(function( $ ) {

    /**
     * freetobook
     */
    $(".astro_be_form_freetobook").submit(function(){

        var form = $(this);

        //the dates of the hidden fields are in Y-m-d format
        var arrival = form.find('.astro_be_input-checkin-js').val();
        var departure = form.find('.astro_be_input-checkout-js').val();

        //adults and children: the selects when they are shown, the hidden fields otherwise
        var adultsField = form.find('.astro_be_select-adults');
        var adults = parseInt(adultsField.length ? adultsField.val() : form.find('#astro_be_form_freetobook_adults').val(), 10) || 1;
        var childrenField = form.find('.astro_be_select-children');
        var children = parseInt(childrenField.length ? childrenField.val() : form.find('#astro_be_form_freetobook_children').val(), 10) || 0;
        var ages = [];
        form.find('.astro_be_select-children_age').slice(0, children).each(function() {
            ages.push(parseInt($(this).val(), 10) || 0);
        });

        //the dates and the guests travel as JSON: {"checkInDate":"Y-m-d","checkOutDate":"Y-m-d"} and
        //[{"numberOfAdults":2,"children":[{"age":7}]}]; a child without the age menu counts as 0 years old
        var children_list = [];
        for (var i = 0; i < children; i++) {
            children_list.push({ age: (i < ages.length) ? ages[i] : 0 });
        }
        form.find('#astro_be_form_freetobook_dates').val(JSON.stringify({ checkInDate: arrival, checkOutDate: departure }));
        form.find('#astro_be_form_freetobook_occupancies').val(JSON.stringify([{ numberOfAdults: adults, children: children_list }]));

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
