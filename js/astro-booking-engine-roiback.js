jQuery( document ).ready(function( $ ) {

    /**
     * Roiback
     */
    $(".astro_be_form_roiback").submit(function(){

        var form = $(this);

        //Roiback expects the dates in d/m/Y format, in two pairs of fields with the same value
        var checkin_arr = form.find('.astro_be_input-checkin-js').val().split('-');
        var checkout_arr = form.find('.astro_be_input-checkout-js').val().split('-');

        var checkin_date = checkin_arr[2] + '/' + checkin_arr[1] + '/' + checkin_arr[0];
        var checkout_date = checkout_arr[2] + '/' + checkout_arr[1] + '/' + checkout_arr[0];

        form.find('#astro_be_form_roiback_entrada').val(checkin_date);
        form.find('#astro_be_form_roiback_startdate').val(checkin_date);
        form.find('#astro_be_form_roiback_salida').val(checkout_date);
        form.find('#astro_be_form_roiback_enddate').val(checkout_date);

        //the guests travel in one parameter: a JSON array, one entry per room, such as
        //[{"adults":"2","children":"1","ages":"5;9"}], where the ages are separated by a
        //semicolon. When a dropdown is disabled the template prints a hidden field with its value
        var adults = form.find('.astro_be_select-adults');
        adults = adults.length ? adults.val() : form.find('#astro_be_form_roiback_adults').val();

        var children = form.find('.astro_be_select-children');
        children = children.length ? children.val() : form.find('#astro_be_form_roiback_children').val();

        //children ages: the main script disables the age dropdowns of the children not selected
        var children_ages = [];
        if (parseInt(children, 10) > 0) {
            form.find('.astro_be_select-children_age:enabled').each(function(){
                children_ages.push($(this).val());
            });
        }

        var occupancies = [{
            adults: String(parseInt(adults, 10) || 1),
            children: String(parseInt(children, 10) || 0),
            ages: children_ages.join(';')
        }];
        form.find('#astro_be_form_roiback_occupancies').val(JSON.stringify(occupancies));

        //an empty promotional code is not sent; the field is enabled again once the form is
        //submitted, so it can still be filled when the booking engine opens in a new tab
        var promo = form.find('input[name="codpromo"]');
        if (promo.length && $.trim(promo.val()) === '') {
            promo.prop('disabled', true);
            setTimeout(function() {
                promo.prop('disabled', false);
            }, 0);
        }

    });

});
