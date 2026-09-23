jQuery( document ).ready(function( $ ) {

    /**
     * Octorate
     */
    $(".astro_be_form_octorate").submit(function(){

        var form = $(this);

        //Octorate expects the dates in ISO format (Y-m-d), same as the plugin hidden fields
        form.find('#astro_be_form_octorate_checkin').val(form.find('.astro_be_input-checkin-js').val());
        form.find('#astro_be_form_octorate_checkout').val(form.find('.astro_be_input-checkout-js').val());

        //children ages, comma separated (e.g. 5,9): the main script disables the age dropdowns
        //of the children not selected
        var children_ages = [];
        var children = form.find('.astro_be_select-children');
        if (children.length && parseInt(children.val(), 10) > 0) {
            form.find('.astro_be_select-children_age:enabled').each(function(){
                children_ages.push($(this).val());
            });
        }
        form.find('#astro_be_form_octorate_childrenAges').val(children_ages.join(','));

        //an empty coupon is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var coupon = form.find('input[name="coupon"]');
        if (coupon.length && $.trim(coupon.val()) === '') {
            coupon.prop('disabled', true);
            setTimeout(function() {
                coupon.prop('disabled', false);
            }, 0);
        }

    });

});
