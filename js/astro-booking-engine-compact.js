(function ($) {

    var T = (window.astro_be_compact_i18n || {});
    function t(chiave, fallback) { return T[chiave] || fallback; }

    /**
     * Applica la pelle ai form dentro `contesto` (un documento o un elemento).
     *
     * `opzioni.anteprima` serve all'editor a blocchi: li' la scheda si deve vedere, ma il
     * calendario non va creato, perche' l'anteprima non e' interattiva e dal 6.3 la tela
     * dell'editor sta in un iframe, cioe' in un documento diverso da quello di flatpickr.
     */
    function astro_be_applica(contesto, opzioni) {

        opzioni = opzioni || {};

        // impostazioni passate da PHP con wp_localize_script
        var S = (window.astro_be_compact_settings || {});
        // densita': 'compact' (predefinita) oppure 'roomy'
        var densita = (S.density === 'roomy') ? 'roomy' : 'compact';

        $(contesto || document).find('.astro_be').each(function () {

            var box = $(this);
            var form = box.find('.astro_be_form');
            if (!form.length || box.hasClass('astro_be--compact')) { return; }

            var checkinJs = form.find('.astro_be_input-checkin-js');
            var checkoutJs = form.find('.astro_be_input-checkout-js');
            if (!checkinJs.length || !checkoutJs.length) { return; } // provider senza date: resta il classico

            var adulti = form.find('.astro_be_select-adults');
            var bambini = form.find('.astro_be_select-children');
            var animali = form.find('.astro_be_select-pets');
            var eta = form.find('.astro_be_select-children_age');
            var coupon = form.find('.astro_be_input-coupon');
            var submit = form.find('input[type="submit"]');

            // Piu' form nella stessa pagina (contenuto + widget in barra laterale) producono gli
            // stessi id: le <label for> del secondo puntano ai campi del primo. Finche' i template
            // non generano id univoci, li si rende unici qui, sistemando anche le etichette.
            (function rendiIdUnici() {
                var token = 'abe' + Math.random().toString(36).slice(2, 7);
                form.find('[id]').each(function () {
                    var vecchio = this.id;
                    if (document.querySelectorAll('[id="' + (window.CSS && CSS.escape ? CSS.escape(vecchio) : vecchio) + '"]').length < 2) { return; }
                    var nuovo = vecchio + '-' + token;
                    form.find('label[for="' + vecchio + '"]').attr('for', nuovo);
                    this.id = nuovo;
                });
            })();

            box.addClass('astro_be--compact');
            if (densita === 'roomy') { box.addClass('astro_be--roomy'); }
            // larghezza: la scheda si adatta al contenuto, oppure occupa tutta la colonna
            if (S.width === 'full') { box.addClass('astro_be--full'); }

            // il calendario classico non serve piu': in produzione jQuery UI non viene nemmeno
            // caricato con lo stile compatto, qui lo si smonta per non lasciarlo a vista
            var classici = form.find('.astro_be_input-checkin, .astro_be_input-checkout');
            if ($.fn.datepicker && classici.length) {
                try { classici.datepicker('destroy'); } catch (e) {}
            }

            // ---------- struttura ----------
            var wrap = $('<div class="astro_be_compact"></div>');

            var gruppoDate = $(
                '<div class="astro_be_compact_group">' +
                  '<button type="button" class="astro_be_compact_field" data-role="checkin">' +
                    '<span class="astro_be_compact_label"></span>' +
                    '<span class="astro_be_compact_value"></span>' +
                  '</button>' +
                  '<span class="astro_be_compact_arrow" aria-hidden="true">&rarr;</span>' +
                  '<button type="button" class="astro_be_compact_field astro_be_compact_field--end" data-role="checkout">' +
                    '<span class="astro_be_compact_label"></span>' +
                    '<span class="astro_be_compact_value"></span>' +
                  '</button>' +
                '</div>');

            gruppoDate.find('[data-role="checkin"] .astro_be_compact_label')
                .text(form.find('.astro_be_label-checkin').first().text() || t('checkin', 'Check-in'));
            gruppoDate.find('[data-role="checkout"] .astro_be_compact_label')
                .text(form.find('.astro_be_label-checkout').first().text() || t('checkout', 'Check-out'));

            wrap.append(gruppoDate);

            var ospiti = null;
            if (adulti.length || bambini.length || animali.length) {
                wrap.append('<div class="astro_be_compact_sep"></div>');
                ospiti = $(
                    '<div class="astro_be_compact_guests">' +
                      '<button type="button" class="astro_be_compact_field" aria-expanded="false">' +
                        '<span class="astro_be_compact_label"></span>' +
                        '<span class="astro_be_compact_value" aria-live="polite"></span>' +
                      '</button>' +
                      '<div class="astro_be_compact_panel" hidden></div>' +
                    '</div>');
                // Come le altre etichette: testo, mai HTML, perche' le traduzioni non sono fidate.
                ospiti.find('.astro_be_compact_label').text(t('guests', 'Ospiti'));
                wrap.append(ospiti);
            }

            if (coupon.length) {
                wrap.append('<div class="astro_be_compact_sep"></div>');
                var box_coupon = $('<div class="astro_be_compact_coupon"></div>');
                var etichetta = form.find('.astro_be_label-coupon').first().text() || t('coupon', 'Codice');
                var id = 'astro_be_compact_coupon_' + Math.random().toString(36).slice(2, 8);
                box_coupon.append($('<label class="astro_be_compact_label"></label>').attr('for', id).text(etichetta));
                coupon.attr('id', id).attr('placeholder', t('coupon_placeholder', '—'));
                box_coupon.append(coupon); // spostato, non duplicato: resta lo stesso elemento
                wrap.append(box_coupon);
            }

            if (submit.length) {
                var box_submit = $('<div class="astro_be_compact_submit"></div>');
                box_submit.append(submit); // spostato: il form continua a inviarsi da solo
                wrap.append(box_submit);
            }

            form.append(wrap);

            // ---------- date ----------
            var ingressoFp = $('<input type="text" class="astro_be_compact_fp" tabindex="-1" aria-hidden="true" style="position:absolute;opacity:0;width:0;height:0;pointer-events:none">');
            form.append(ingressoFp);

            function mostraDate() {
                gruppoDate.find('[data-role="checkin"] .astro_be_compact_value').text(formatta(checkinJs.val()));
                gruppoDate.find('[data-role="checkout"] .astro_be_compact_value').text(formatta(checkoutJs.val()));
            }
            function formatta(iso) {
                if (!iso) { return '—'; }
                var p = iso.split('-');
                var d = new Date(Date.UTC(p[0], p[1] - 1, p[2]));
                try {
                    return d.toLocaleDateString(document.documentElement.lang || undefined,
                        { day: 'numeric', month: 'short', year: 'numeric', timeZone: 'UTC' });
                } catch (e) { return p[2] + '/' + p[1] + '/' + p[0]; }
            }

            var fp = null;
            var apertoDa = null; // il pulsante che ha aperto il calendario: li' deve tornare il fuoco
            if (window.flatpickr && !opzioni.anteprima) {

                gruppoDate.find('.astro_be_compact_field')
                    .attr({ 'aria-haspopup': 'dialog', 'aria-expanded': 'false' });

                fp = window.flatpickr(ingressoFp[0], {
                    mode: 'range',
                    dateFormat: 'Y-m-d',
                    minDate: 'today',
                    showMonths: window.matchMedia('(min-width: 720px)').matches ? 2 : 1,
                    defaultDate: [checkinJs.val(), checkoutJs.val()],
                    locale: (window.flatpickr.l10ns && window.flatpickr.l10ns[(document.documentElement.lang || 'en').slice(0, 2)]) || undefined,
                    onReady: function (date, testo, istanza) {
                        // Il contenitore e' l'unica parte del calendario che puo' prendere il fuoco
                        // (tabindex="-1"): senza ruolo e nome lo screen reader non saprebbe dire
                        // dove si e' finiti. Qui si usa l'istanza passata dal gancio: la variabile
                        // fp non e' ancora assegnata, perche' onReady scatta durante la creazione.
                        istanza.calendarContainer.setAttribute('role', 'dialog');
                        istanza.calendarContainer.setAttribute('aria-modal', 'false');
                        istanza.calendarContainer.setAttribute('aria-label', t('calendar', 'Calendario'));
                    },
                    onChange: function () {
                        // A ogni scelta flatpickr ridisegna i giorni: l'elemento che aveva il fuoco
                        // sparisce e il fuoco cade sul <body>, lasciando a meta' chi sta scegliendo
                        // il periodo con la tastiera.
                        if (fp.isOpen && !fp.calendarContainer.contains(document.activeElement)) {
                            fp.calendarContainer.focus();
                        }
                    },
                    onClose: function (date) {
                        if (date.length === 2) {
                            checkinJs.val(fp.formatDate(date[0], 'Y-m-d'));
                            checkoutJs.val(fp.formatDate(date[1], 'Y-m-d'));
                            // si tiene allineato anche il campo classico, per chi torna indietro
                            form.find('.astro_be_input-checkin').val(fp.formatDate(date[0], 'Y-m-d'));
                            form.find('.astro_be_input-checkout').val(fp.formatDate(date[1], 'Y-m-d'));
                            mostraDate();
                        }

                        gruppoDate.find('.astro_be_compact_field').attr('aria-expanded', 'false');

                        // Chiudendo, flatpickr rimette il fuoco sul proprio campo nascosto, che e'
                        // invisibile e aria-hidden: va riportato sul pulsante da cui si e' partiti.
                        var tornaA = apertoDa;
                        apertoDa = null;
                        if (tornaA) {
                            setTimeout(function () {
                                var f = document.activeElement;
                                if (!f || f === document.body || f === ingressoFp[0] ||
                                    (fp.calendarContainer && fp.calendarContainer.contains(f))) {
                                    tornaA.focus();
                                }
                            }, 0);
                        }
                    }
                });

                gruppoDate.find('.astro_be_compact_field').on('click', function () {
                    apertoDa = this;
                    $(this).attr('aria-expanded', 'true');
                    fp.open();
                    // Senza il fuoco dentro il calendario i tasti freccia non arrivano a flatpickr:
                    // con la sola tastiera le date resterebbero impossibili da scegliere.
                    if (fp.calendarContainer) { fp.calendarContainer.focus(); }
                });
            }
            mostraDate();

            // ---------- ospiti ----------
            if (ospiti) {
                var pannello = ospiti.find('.astro_be_compact_panel');
                var bottone = ospiti.find('.astro_be_compact_field');

                function riga(select, etichettaTesto, minimo) {
                    if (!select.length) { return null; }
                    var r = $('<div class="astro_be_compact_stepper_row"></div>');
                    r.append($('<span class="astro_be_compact_stepper_label"></span>').text(etichettaTesto));
                    var st = $('<div class="astro_be_compact_stepper"></div>');
                    // "+" e "-" da soli, letti dallo screen reader, non dicono di cosa: il nome
                    // accessibile porta con se' l'etichetta della riga ("Adulti: aumenta").
                    var meno = $('<button type="button">&minus;</button>')
                        .attr('aria-label', etichettaTesto + ': ' + t('decrease', 'diminuisci'));
                    var out = $('<output></output>');
                    var piu = $('<button type="button">+</button>')
                        .attr('aria-label', etichettaTesto + ': ' + t('increase', 'aumenta'));
                    st.append(meno, out, piu);
                    r.append(st);

                    var max = select.find('option').length ? parseInt(select.find('option').last().val(), 10) : 0;

                    function aggiorna() {
                        var v = parseInt(select.val(), 10) || 0;
                        out.text(v);
                        meno.prop('disabled', v <= minimo);
                        piu.prop('disabled', v >= max);
                    }
                    meno.on('click', function () {
                        var v = (parseInt(select.val(), 10) || 0) - 1;
                        if (v >= minimo) { select.val(String(v)).trigger('change'); }
                    });
                    piu.on('click', function () {
                        var v = (parseInt(select.val(), 10) || 0) + 1;
                        if (v <= max) { select.val(String(v)).trigger('change'); }
                    });
                    select.on('change', function () { aggiorna(); disegnaEta(); riepilogo(); });
                    aggiorna();
                    return r;
                }

                var r1 = riga(adulti, form.find('.astro_be_label-adults').first().text() || t('adults', 'Adulti'), 1);
                var r2 = riga(bambini, form.find('.astro_be_label-children').first().text() || t('children', 'Bambini'), 0);
                var boxEta = $('<div class="astro_be_compact_ages"></div>');
                var r3 = riga(animali, form.find('.astro_be_label-pets').first().text() || t('pets', 'Animali'), 0);

                if (r1) { pannello.append(r1); }
                if (r2) { pannello.append(r2); pannello.append(boxEta); }
                if (r3) { pannello.append(r3); }

                var pulsanti = $('<div class="astro_be_compact_panel_buttons">' +
                    '<button type="button" data-role="cancel"></button>' +
                    '<button type="button" data-role="save"></button></div>');
                pulsanti.find('[data-role="cancel"]').text(t('cancel', 'Annulla'));
                pulsanti.find('[data-role="save"]').text(t('save', 'Salva'));
                pannello.append(pulsanti);

                // Le tendine delle eta' restano quelle originali e si spostano nel pannello
                // INSIEME alla loro colonna: lo script principale del plugin le abilita e le
                // nasconde con il selettore '.astro_be_column-children_age-N select', quindi
                // portando via il solo <select> smetterebbe di trovarle.
                var colonneEta = form.find('[class*="astro_be_column-children_age-"]');
                colonneEta.appendTo(boxEta);

                // Quante eta' mostrare lo decide questa funzione, senza fidarsi di quello che ha
                // gia' fatto (o non fatto) lo script principale: se per qualunque motivo quello non
                // fosse ancora girato — ordine degli script, un file vecchio servito dalla cache —
                // si vedrebbero tutte le colonne anche con zero bambini.
                function disegnaEta() {
                    var n = bambini.length ? (parseInt(bambini.val(), 10) || 0) : 0;
                    var mostrate = 0;
                    colonneEta.each(function (i) {
                        var visibile = (i < n);
                        $(this).css('display', visibile ? 'block' : 'none');
                        // una tendina disabilitata non viene inviata: e' cosi' che le eta' di
                        // troppo restano fuori dalla richiesta
                        $(this).find('select').prop('disabled', !visibile);
                        if (visibile) { mostrate++; }
                    });
                    boxEta.toggle(mostrate > 0);
                }

                function riepilogo() {
                    var parti = [];
                    function pezzo(select, uno, molti) {
                        if (!select.length) { return; }
                        var v = parseInt(select.val(), 10) || 0;
                        if (v > 0) { parti.push(v + ' ' + (v === 1 ? uno : molti)); }
                    }
                    pezzo(adulti, t('adult_one', 'adulto'), t('adult_many', 'adulti'));
                    pezzo(bambini, t('child_one', 'bambino'), t('child_many', 'bambini'));
                    pezzo(animali, t('pet_one', 'animale'), t('pet_many', 'animali'));
                    bottone.find('.astro_be_compact_value').text(parti.length ? parti.join(', ') : '—');
                }

                var memoria = {};
                function apri() {
                    memoria = { a: adulti.val(), b: bambini.val(), p: animali.val(),
                                e: eta.map(function () { return this.value; }).get() };
                    pannello.prop('hidden', false);
                    bottone.attr('aria-expanded', 'true');
                    pannello.find('button').first().focus();
                }
                function chiudi() { pannello.prop('hidden', true); bottone.attr('aria-expanded', 'false'); }

                bottone.on('click', function () { pannello.prop('hidden') ? apri() : chiudi(); });
                pulsanti.find('[data-role="save"]').on('click', function () { chiudi(); bottone.focus(); });
                pulsanti.find('[data-role="cancel"]').on('click', function () {
                    if (adulti.length) { adulti.val(memoria.a).trigger('change'); }
                    if (bambini.length) { bambini.val(memoria.b).trigger('change'); }
                    if (animali.length) { animali.val(memoria.p).trigger('change'); }
                    eta.each(function (i) { this.value = memoria.e[i]; });
                    chiudi(); bottone.focus();
                });
                $(document).on('keydown', function (e) { if (e.key === 'Escape' && !pannello.prop('hidden')) { chiudi(); bottone.focus(); } });
                $(document).on('click', function (e) {
                    if (!pannello.prop('hidden') && !$.contains(ospiti[0], e.target)) { chiudi(); }
                });

                disegnaEta();
                riepilogo();
            }
        });
    }

    // usata anche dall'editor a blocchi, che la richiama a ogni nuova anteprima
    window.astro_be_applica_stile_compatto = astro_be_applica;

    $(function () { astro_be_applica(document, {}); });

}(jQuery));
