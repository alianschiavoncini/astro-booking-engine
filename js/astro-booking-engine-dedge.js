jQuery( document ).ready(function( $ ) {

    /**
     * D-EDGE
     */
    $(".astro_be_form_dedge").submit(function(){

        var form = $(this);

        //D-EDGE expects the dates in ISO format (Y-m-d), same as the plugin hidden fields, in
        //both generations of the booking engine: only the name of the parameter changes
        form.find('#astro_be_form_dedge_arrival').val(form.find('.astro_be_input-checkin-js').val());
        form.find('#astro_be_form_dedge_departure').val(form.find('.astro_be_input-checkout-js').val());

        //the ages of the children travel in one parameter, with the separator of the generation
        //in use: an underscore (7_12) for the current booking engine, a comma for the previous
        //one. The main script disables the age dropdowns of the children not selected.
        var childages = form.find('#astro_be_form_dedge_childages');
        var children_ages = [];
        var children = form.find('.astro_be_select-children');
        if (children.length && parseInt(children.val(), 10) > 0) {
            form.find('.astro_be_select-children_age:enabled').each(function(){
                children_ages.push($(this).val());
            });
        }
        childages.val(children_ages.join(childages.data('separator')));

        //the ages and an empty promo code are not sent when they are empty; the fields are
        //enabled again once the form is submitted, so they can still be filled when the
        //booking engine opens in a new tab
        var promo = form.find('.astro_be_input-coupon');
        var empty = childages.add(promo).filter(function(){
            return $.trim($(this).val()) === '';
        });
        if (empty.length) {
            empty.prop('disabled', true);
            setTimeout(function() {
                empty.prop('disabled', false);
            }, 0);
        }

    });

});
