jQuery( document ).ready(function( $ ) {

    /**
     * Sabre SynXis
     */
    $(".astro_be_form_synxis").submit(function(){

        var form = $(this);

        //SynXis expects the dates in ISO format (Y-m-d), same as the plugin hidden fields
        form.find('#astro_be_form_synxis_arrive').val(form.find('.astro_be_input-checkin-js').val());
        form.find('#astro_be_form_synxis_depart').val(form.find('.astro_be_input-checkout-js').val());

        //children ages, separated by a pipe (e.g. 5|9): the main script disables the age
        //dropdowns of the children not selected. Without them SynXis asks the guests for the ages
        var children_ages = [];
        var children = form.find('.astro_be_select-children');
        if (children.length && parseInt(children.val(), 10) > 0) {
            form.find('.astro_be_select-children_age:enabled').each(function(){
                children_ages.push($(this).val());
            });
        }
        form.find('#astro_be_form_synxis_childages').val(children_ages.join('|'));

        //an empty promo code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var promo = form.find('input[name="promo"]');
        if (promo.length && $.trim(promo.val()) === '') {
            promo.prop('disabled', true);
            setTimeout(function() {
                promo.prop('disabled', false);
            }, 0);
        }

    });

});
