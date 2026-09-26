jQuery( document ).ready(function( $ ) {

    /**
     * HotelNetSolutions (OnePageBooking)
     */
    $(".astro_be_form_hotelnetsolutions").submit(function(){

        var form = $(this);

        //the booking engine parses the dates with the format D.M.YYYY (10.11.2026): an ISO date
        //is discarded and the stay is not applied at all
        var checkin_arr = form.find('.astro_be_input-checkin-js').val().split('-');
        var checkout_arr = form.find('.astro_be_input-checkout-js').val().split('-');

        form.find('#astro_be_form_hotelnetsolutions_arrival').val(
            parseInt(checkin_arr[2], 10) + '.' + parseInt(checkin_arr[1], 10) + '.' + checkin_arr[0]
        );
        form.find('#astro_be_form_hotelnetsolutions_departure').val(
            parseInt(checkout_arr[2], 10) + '.' + parseInt(checkout_arr[1], 10) + '.' + checkout_arr[0]
        );

        //the ages of the children travel in one parameter, separated by a comma (7,12): the main
        //script disables the age dropdowns of the children not selected
        var ages = form.find('#astro_be_form_hotelnetsolutions_ages');
        var children_ages = [];
        var children = form.find('.astro_be_select-children');
        if (children.length && parseInt(children.val(), 10) > 0) {
            form.find('.astro_be_select-children_age:enabled').each(function(){
                children_ages.push($(this).val());
            });
        }
        ages.val(children_ages.join(','));

        //the ages and the booking code are not sent when they are empty; the fields are enabled
        //again once the form is submitted, so they can still be filled when the booking engine
        //opens in a new tab
        var code = form.find('.astro_be_input-coupon');
        var empty = ages.add(code).filter(function(){
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
