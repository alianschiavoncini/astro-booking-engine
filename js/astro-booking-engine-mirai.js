jQuery( document ).ready(function( $ ) {

    /**
     * Mirai
     */
    $(".astro_be_form_mirai").submit(function(){

        var form = $(this);

        //Mirai expects the dates in d/m/Y format and the number of nights, which wins over the
        //departure date when the two do not agree
        var checkin_arr = form.find('.astro_be_input-checkin-js').val().split('-');
        var checkout_arr = form.find('.astro_be_input-checkout-js').val().split('-');

        form.find('#astro_be_form_mirai_checkin').val(checkin_arr[2] + '/' + checkin_arr[1] + '/' + checkin_arr[0]);
        form.find('#astro_be_form_mirai_checkout').val(checkout_arr[2] + '/' + checkout_arr[1] + '/' + checkout_arr[0]);

        var nights = Math.round(
            (Date.UTC(checkout_arr[0], checkout_arr[1] - 1, checkout_arr[2]) - Date.UTC(checkin_arr[0], checkin_arr[1] - 1, checkin_arr[2])) / 86400000
        );
        form.find('#astro_be_form_mirai_nights').val(nights > 0 ? nights : 1);

        //the guests travel in one parameter: a JSON array encoded in base64, one entry per room,
        //such as [{"adults":2,"children":[5,9]}], where the children are their ages.
        //When a dropdown is disabled the template prints a hidden field with its value.
        var adults = form.find('.astro_be_select-adults');
        adults = adults.length ? adults.val() : form.find('#astro_be_form_mirai_adults').val();

        var children = form.find('.astro_be_select-children');
        children = children.length ? children.val() : form.find('#astro_be_form_mirai_children').val();

        //children ages: the main script disables the age dropdowns of the children not selected
        var children_ages = [];
        if (parseInt(children, 10) > 0) {
            form.find('.astro_be_select-children_age:enabled').each(function(){
                children_ages.push(parseInt($(this).val(), 10));
            });
        }

        var parties = [{ adults: parseInt(adults, 10) || 1, children: children_ages }];
        form.find('#astro_be_form_mirai_parties').val(window.btoa(JSON.stringify(parties)));

        //an empty promotional code is not sent; the field is enabled again once the form is
        //submitted, so it can still be filled when the booking engine opens in a new tab
        var promo = form.find('input[name="clientCode"]');
        if (promo.length && $.trim(promo.val()) === '') {
            promo.prop('disabled', true);
            setTimeout(function() {
                promo.prop('disabled', false);
            }, 0);
        }

    });

});
