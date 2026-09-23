jQuery( document ).ready(function( $ ) {

    /**
     * Scidoo
     */
    $(".astro_be_form_scidoo").submit(function(){

        var form = $(this);

        //Scidoo expects the arrival date in ISO format (Y-m-d) and the number of nights
        var checkin_date = form.find('.astro_be_input-checkin-js').val();
        var checkout_date = form.find('.astro_be_input-checkout-js').val();
        form.find('#astro_be_form_scidoo_dataarr').val(checkin_date);

        var checkin_arr = checkin_date.split('-');
        var checkout_arr = checkout_date.split('-');
        var nights = Math.round(
            (Date.UTC(checkout_arr[0], checkout_arr[1] - 1, checkout_arr[2]) - Date.UTC(checkin_arr[0], checkin_arr[1] - 1, checkin_arr[2])) / 86400000
        );
        form.find('#astro_be_form_scidoo_notti').val(nights > 0 ? nights : 1);

        //children: Scidoo receives only the list of their ages, comma separated (e.g. 5,9);
        //the main script disables the age dropdowns of the children not selected
        var children_ages = [];
        var children = form.find('.astro_be_select-children');
        if (children.length && parseInt(children.val(), 10) > 0) {
            form.find('.astro_be_select-children_age:enabled').each(function(){
                children_ages.push($(this).val());
            });
        }
        form.find('#astro_be_form_scidoo_children').val(children_ages.join(','));

    });

});
