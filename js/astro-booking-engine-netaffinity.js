jQuery( document ).ready(function( $ ) {

    /**
     * Net Affinity
     */
    $(".astro_be_form_netaffinity").submit(function(event){

        var form = $(this);

        //the booking engine reads the search from the fragment of the address of the booking page:
        //#!/accommodation/search/date/<checkin>/<checkout>, in Y-m-d format as the hidden fields are.
        //The page is opened by the script, in the tab the settings say, as a form does not keep the fragment.
        event.preventDefault();
        var url = form.attr('action').split('#')[0] + '#!/accommodation/search/date/' + form.find('.astro_be_input-checkin-js').val() + '/' + form.find('.astro_be_input-checkout-js').val();
        if (form.attr('target') === '_blank') {
            window.open(url, '_blank');
        } else {
            window.location.href = url;
        }

    });

});
