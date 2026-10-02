jQuery( document ).ready(function( $ ) {

    /**
     * Beddy
     */
    $(".astro_be_form_beddy").submit(function(){

        var form = $(this);

        //the whole search travels in one parameter: a JSON object encoded in base64, with the
        //dates in Y-m-d format, which is the format of the hidden fields as they are
        var date_from = form.find('.astro_be_input-checkin-js').val();
        var date_to = form.find('.astro_be_input-checkout-js').val();

        //when a dropdown is disabled the template prints a hidden field with its value
        var adults = form.find('.astro_be_select-adults');
        adults = adults.length ? adults.val() : form.find('#astro_be_form_beddy_adults').val();

        var children = form.find('.astro_be_select-children');
        children = children.length ? children.val() : form.find('#astro_be_form_beddy_children').val();

        //children ages: the main script disables the age dropdowns of the children not selected
        var children_ages = [];
        if (parseInt(children, 10) > 0) {
            form.find('.astro_be_select-children_age:enabled').each(function(){
                children_ages.push(parseInt($(this).val(), 10));
            });
        }

        var coupon = form.find('.astro_be_input-coupon');
        coupon = coupon.length ? $.trim(coupon.val()) : '';

        var search = {
            date_from: date_from,
            date_to: date_to,
            rooms: [{ adults: parseInt(adults, 10) || 1, children: children_ages }],
            lang: form.find('input[name="lang"]').val(),
            currency: form.find('#astro_be_form_beddy_currency').val(),
            coupon_code: coupon
        };

        //base64 of the UTF-8 bytes, so that a coupon with accented letters does not break btoa
        var json = JSON.stringify(search);
        form.find('#astro_be_form_beddy_search').val(window.btoa(unescape(encodeURIComponent(json))));

    });

});
