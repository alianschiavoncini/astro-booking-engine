/**
 * Narrow containers. From a given screen width the form puts its fields side by side, whatever
 * the room of the box it is placed in: in a sidebar or in a narrow column they do not fit, and
 * the classic style cuts them off while the compact one sticks out of the box. When that
 * happens the box gets astro_be--stacked, and the fields go one under the other as on phones;
 * astro_be--narrow, in the compact style, also puts the two dates one under the other.
 * The check is done again when the width of the container changes.
 */
(function () {

    function astroBeFits( box ) {
        // classic style: the fields overflow the box, which cuts them off
        if ( box.scrollWidth > box.clientWidth + 1 ) {
            return false;
        }
        // compact style: the box is as wide as its fields, and gets wider than its container
        var container = box.parentElement;
        if ( container && container.clientWidth ) { // an inline container has no width of its own
            var style = window.getComputedStyle( container );
            var room = container.clientWidth - parseFloat( style.paddingLeft ) - parseFloat( style.paddingRight );
            if ( box.offsetWidth > room + 1 ) {
                return false;
            }
        }
        // compact style: the values (dates, guests) are cut with an ellipsis before overflowing
        var values = box.querySelectorAll( '.astro_be_compact_value' );
        for ( var i = 0; i < values.length; i++ ) {
            if ( values[ i ].scrollWidth > values[ i ].clientWidth + 1 ) {
                return false;
            }
        }
        return true;
    }

    function astroBeCheck( box ) {
        if ( ! box.clientWidth ) {
            return; // hidden, for instance in a closed tab: checked again when it is shown
        }
        box.classList.remove( 'astro_be--stacked', 'astro_be--narrow' );
        if ( astroBeFits( box ) ) {
            return;
        }
        box.classList.add( 'astro_be--stacked' );
        // very narrow (compact style): the two dates do not fit side by side either
        if ( ! astroBeFits( box ) ) {
            box.classList.add( 'astro_be--narrow' );
        }
    }

    function astroBeCheckAll() {
        var boxes = document.querySelectorAll( '.astro_be' );
        for ( var i = 0; i < boxes.length; i++ ) {
            astroBeCheck( boxes[ i ] );
        }
    }

    function astroBeStart() {
        var boxes = document.querySelectorAll( '.astro_be' );
        if ( ! boxes.length ) {
            return;
        }
        window.addEventListener( 'load', astroBeCheckAll );
        if ( ! window.ResizeObserver ) {
            window.addEventListener( 'resize', astroBeCheckAll );
            setTimeout( astroBeCheckAll, 0 );
            return;
        }
        // The container is observed, not the box: the box changes width itself when it is
        // stacked. Only width changes count, and the check runs in the next frame, outside
        // the observer callback, so that changing the layout does not notify the observer again.
        var observer = new ResizeObserver( function ( entries ) {
            entries.forEach( function ( entry ) {
                var container = entry.target;
                var width = Math.round( entry.contentRect.width );
                if ( container.astroBeWidth === width ) {
                    return;
                }
                container.astroBeWidth = width;
                window.requestAnimationFrame( function () {
                    for ( var i = 0; i < container.astroBeBoxes.length; i++ ) {
                        astroBeCheck( container.astroBeBoxes[ i ] );
                    }
                } );
            } );
        } );
        for ( var i = 0; i < boxes.length; i++ ) {
            var container = boxes[ i ].parentElement;
            if ( ! container ) {
                continue;
            }
            if ( ! container.astroBeBoxes ) {
                container.astroBeBoxes = [];
                observer.observe( container );
            }
            container.astroBeBoxes.push( boxes[ i ] );
        }
    }

    if ( document.readyState === 'loading' ) {
        document.addEventListener( 'DOMContentLoaded', astroBeStart );
    } else {
        astroBeStart();
    }

})();

jQuery( document ).ready(function( $ ) {

    // Compact style: the calendar is flatpickr and jQuery UI datepicker is not loaded, and the
    // compact script handles the dates and the children ages on its own.
    if ( ! $.fn.datepicker ) {
        return;
    }

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
