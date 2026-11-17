jQuery( document ).ready(function( $ ) {

    /**
     * BookYourStay
     */
    $(".astro_be_form_bookyourstay").submit(function(){

        var form = $(this);

        //the dates of the hidden fields are in Y-m-d format
        var arrival = form.find('.astro_be_input-checkin-js').val();
        var departure = form.find('.astro_be_input-checkout-js').val();
        var nights = Math.round((Date.parse(departure) - Date.parse(arrival)) / 86400000);
        if (!(nights > 0)) {
            nights = 1;
        }

        //adults and children: the selects when they are shown, the hidden fields otherwise
        var adultsField = form.find('.astro_be_select-adults');
        var adults = parseInt(adultsField.length ? adultsField.val() : form.find('#astro_be_form_bookyourstay_adults').val(), 10) || 1;
        var childrenField = form.find('.astro_be_select-children');
        var children = parseInt(childrenField.length ? childrenField.val() : form.find('#astro_be_form_bookyourstay_children').val(), 10) || 0;
        var ages = [];
        form.find('.astro_be_select-children_age').slice(0, children).each(function() {
            ages.push(parseInt($(this).val(), 10) || 0);
        });

        //the arrival in Y-m-d format and the nights; the guests as the counts of the age ranges of the hotel,
        //in its order: adults first, then the children, counted in the first children range
        form.find('#astro_be_form_bookyourstay_arrivaldate').val(arrival);
        form.find('#astro_be_form_bookyourstay_lengthofstay').val(nights);
        form.find('#astro_be_form_bookyourstay_roomcounts').val(adults + ',' + children);

        //an empty promotional code is not sent; the field is enabled again once the form is submitted,
        //so it can still be filled when the booking engine opens in a new tab
        var coupon = form.find('input[name="promotioncode"]');
        if (coupon.length && $.trim(coupon.val()) === '') {
            coupon.prop('disabled', true);
            setTimeout(function() {
                coupon.prop('disabled', false);
            }, 0);
        }

    });

});
