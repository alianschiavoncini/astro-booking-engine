jQuery( document ).ready(function( $ ) {

    /**
     * Bedzzle
     */
    $(".astro_be_form_bedzzle").submit(function(){

        var form = $(this);

        //the search travels in the fragment of the address, with the dates in Y-m-d format,
        //which is the format of the hidden fields as they are
        var cid = form.find('.astro_be_input-checkin-js').val();
        var cod = form.find('.astro_be_input-checkout-js').val();

        //when a dropdown is disabled the template prints a hidden field with its value
        var adults = form.find('.astro_be_select-adults');
        adults = adults.length ? adults.val() : form.find('#astro_be_form_bedzzle_adults').val();

        var children = form.find('.astro_be_select-children');
        children = children.length ? children.val() : form.find('#astro_be_form_bedzzle_children').val();

        //the guests of the room: A for every adult, then the age of every child; the main script
        //disables the age dropdowns of the children not selected
        var guests = [];
        for (var i = 0; i < (parseInt(adults, 10) || 1); i++) {
            guests.push('A');
        }
        if (parseInt(children, 10) > 0) {
            form.find('.astro_be_select-children_age:enabled').each(function(){
                guests.push(parseInt($(this).val(), 10));
            });
        }

        var search = 'cid=' + encodeURIComponent(cid) + '&cod=' + encodeURIComponent(cod) + '&gpa=' + encodeURIComponent(guests.join(','));

        var coupon = form.find('.astro_be_input-coupon');
        coupon = coupon.length ? $.trim(coupon.val()) : '';
        if (coupon !== '') {
            search += '&cpn=' + encodeURIComponent(coupon);
        }

        //a GET form replaces the query of the address with its fields and keeps the fragment
        var action = form.attr('action').split('#')[0];
        form.attr('action', action + '#search/' + search);

    });

});
