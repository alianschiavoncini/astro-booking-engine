jQuery( document ).ready(function( $ ) {

    /**
     * Secure Holiday
     */
    $(".astro_be_form_secureholiday").submit(function(){

        var form = $(this);

        //the dates of the hidden fields are in Y-m-d format
        var arrival = form.find('.astro_be_input-checkin-js').val();
        var departure = form.find('.astro_be_input-checkout-js').val();

        //adults and children: the selects when they are shown, the hidden fields otherwise
        var adultsField = form.find('.astro_be_select-adults');
        var adults = parseInt(adultsField.length ? adultsField.val() : form.find('#astro_be_form_secureholiday_adults').val(), 10) || 1;
        var childrenField = form.find('.astro_be_select-children');
        var children = parseInt(childrenField.length ? childrenField.val() : form.find('#astro_be_form_secureholiday_children').val(), 10) || 0;
        var ages = [];
        form.find('.astro_be_select-children_age').slice(0, children).each(function() {
            ages.push($(this).val());
        });

        //the dates in d/m/Y format and the guests as 2@;1@6;1@10: the adults, then every child with its age
        form.find('#astro_be_form_secureholiday_dateStart').val(arrival.split('-').reverse().join('/'));
        form.find('#astro_be_form_secureholiday_dateEnd').val(departure.split('-').reverse().join('/'));
        var travelers = adults + '@';
        $.each(ages, function(i, age) {
            travelers += ';1@' + age;
        });
        form.find('#astro_be_form_secureholiday_travelers').val(travelers);

        //an empty discount code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var coupon = form.find('input[name="discountCode"]');
        if (coupon.length && $.trim(coupon.val()) === '') {
            coupon.prop('disabled', true);
            setTimeout(function() {
                coupon.prop('disabled', false);
            }, 0);
        }

    });

});
