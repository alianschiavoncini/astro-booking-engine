jQuery( document ).ready(function( $ ) {

    /**
     * Datepicker for Check-in and Check-out
     */
    var astro_be_checkin = '.astro_be_input-checkin';
    var astro_be_checkout = '.astro_be_input-checkout';

    $(astro_be_checkin).datepicker({
        defaultDate: "+1w",
        inline: true,
        showOtherMonths: true,
        dateFormat: $(astro_be_checkin).attr( "data-date-format"),
        minDate: "today",

        onClose: function( selectedDate ) {
            $( astro_be_checkout ).datepicker( "option", "minDate", selectedDate );
            var myDate = $(this).datepicker("getDate");

            //set the date in the checkin hidden field
            const date_in_js = new Date(myDate.setDate(myDate.getDate()));
            date_in_js_year  = date_in_js.getFullYear();
            date_in_js_month = (date_in_js.getMonth() + 1);
            if (date_in_js_month < 10) { date_in_js_month = '0' + date_in_js_month; }
            date_in_js_day = date_in_js.getDate();
            if (date_in_js_day < 10) { date_in_js_day = '0' + date_in_js_day; }
            date_in_js_value = date_in_js_year + '-' + date_in_js_month + '-' + date_in_js_day;
            $('.astro_be_input-checkin-js').val(date_in_js_value);

            //get the tomorrow date
            myDate.setDate( myDate.getDate() + 1 );
            var date = new Date();
            date.setDate(date.getDate() + 1);
            $(astro_be_checkout).datepicker("setDate", myDate);

            //set the date in the checkout hidden field
            const date_out_js = new Date(myDate.setDate(myDate.getDate()));
            date_out_js_year  = date_out_js.getFullYear();
            date_out_js_month = (date_out_js.getMonth() + 1);
            if (date_out_js_month < 10) { date_out_js_month = '0' + date_out_js_month; }
            date_out_js_day   = date_out_js.getDate();
            if (date_out_js_day < 10) { date_out_js_day = '0' + date_out_js_day; }
            date_out_js_value = date_out_js_year + '-' + date_out_js_month + '-' + date_out_js_day;
            $('.astro_be_input-checkout-js').val(date_out_js_value);
        }
    });

    $(astro_be_checkout).datepicker({
        defaultDate: "+1w",
        inline: true,
        showOtherMonths: true,
        dateFormat: $( astro_be_checkout ).attr( "data-date-format"),
        minDate: "today" + 1,

        onClose: function() {
            var myDate = $(this).datepicker("getDate");
            myDate.setDate( myDate.getDate() );

            const date_out_js = new Date(myDate.setDate(myDate.getDate()));
            date_out_js_year  = date_out_js.getFullYear();
            date_out_js_month = (date_out_js.getMonth() + 1);
            if (date_out_js_month < 10) { date_out_js_month = '0' + date_out_js_month; }
            date_out_js_day   = date_out_js.getDate();
            if (date_out_js_day < 10) { date_out_js_day = '0' + date_out_js_day; }
            date_out_js_value = date_out_js_year + '-' + date_out_js_month + '-' + date_out_js_day;
            $('.astro_be_input-checkout-js').val(date_out_js_value);
        }
    });

    $(astro_be_checkin).datepicker("setDate", "today");
    $(astro_be_checkout).datepicker("setDate", "today" + 1);

    /**
     * Show/hide child age select dropdown based on children select option value.
     *
     * Ogni form fa storia a se': un sito puo' avere il form nel contenuto e un altro nella
     * barra laterale. Prima i selettori erano globali e '.astro_be_select-children' prendeva
     * il primo form della pagina, quindi le eta' del secondo non si attivavano mai.
     */
    $('.astro_be_form').each(function () {

        var form = $(this);
        var bambini = form.find('.astro_be_select-children');
        var colonne = form.find('[class*="astro_be_column-children_age"]');

        if (!bambini.length || !colonne.length) { return; }

        function mostra(n) {
            colonne.find('select').prop('disabled', 'disabled');
            colonne.css('display', 'none');
            for (var i = 1; i <= n; i++) {
                var col = form.find('.astro_be_column-children_age-' + i);
                col.find('select').prop('disabled', false);
                col.css('display', 'block');
            }
        }

        bambini.on('change', function () {
            mostra(parseInt(bambini.val(), 10) || 0);
        });

        mostra(parseInt(bambini.val(), 10) || 0);
    });

});
