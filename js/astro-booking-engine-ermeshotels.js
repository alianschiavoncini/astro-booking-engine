jQuery( document ).ready(function( $ ) {

    /**
     * ErmesHotels
     */
    $(".astro_be_form_ermeshotels").submit(function(){

        var form = $(this);

        //the booking engine takes the dates in Y-m-d format as well, dropping the dashes
        form.find('#astro_be_form_ermeshotels_arrival').val(form.find('.astro_be_input-checkin-js').val());
        form.find('#astro_be_form_ermeshotels_departure').val(form.find('.astro_be_input-checkout-js').val());

        //children ages, comma separated: the main script disables the age dropdowns of the
        //children not selected
        var children_ages = [];
        var children = form.find('.astro_be_select-children');
        if (children.length && parseInt(children.val(), 10) > 0) {
            form.find('.astro_be_select-children_age:enabled').each(function(){
                children_ages.push(parseInt($(this).val(), 10));
            });
        }

        var ages = form.find('#astro_be_form_ermeshotels_ages');
        ages.val(children_ages.join(','));

        //empty parameters are not sent; the fields are enabled again once the form is submitted,
        //so they can still be filled when the booking engine opens in a new tab
        var empty = [];
        if (children_ages.length === 0) {
            empty.push(ages);
        }
        var promo = form.find('input[name="promocode"]');
        if (promo.length && $.trim(promo.val()) === '') {
            empty.push(promo);
        }
        $.each(empty, function(i, field) {
            field.prop('disabled', true);
        });
        setTimeout(function() {
            $.each(empty, function(i, field) {
                field.prop('disabled', false);
            });
        }, 0);

    });

});
