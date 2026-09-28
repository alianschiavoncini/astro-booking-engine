/**
 * Astro Booking Engine — lo stile moderno anche nell'anteprima del blocco.
 *
 * Nell'editor il blocco si disegna con ServerSideRender: il markup arriva via REST DOPO il
 * caricamento della pagina, quindi lo script della pelle — che gira al ready — non lo vede.
 * Dal 6.3, poi, la tela dell'editor sta dentro un iframe, cioe' in un altro documento.
 *
 * Qui si guarda quel documento e si applica la pelle a ogni form che compare. L'anteprima
 * resta statica (sta dentro <Disabled>), quindi il calendario non viene creato.
 */
( function ( $ ) {

	'use strict';

	if ( ! $ || 'function' !== typeof window.astro_be_applica_stile_compatto ) {
		return;
	}

	var documentoTela = null;
	var osservatoreTela = null;
	var attesa = null;

	function tela() {
		var iframe = document.querySelector( 'iframe[name="editor-canvas"]' );
		if ( iframe && iframe.contentDocument && iframe.contentDocument.body ) {
			return iframe.contentDocument;
		}
		return document;
	}

	function applica( doc ) {
		try {
			window.astro_be_applica_stile_compatto( doc, { anteprima: true } );
		} catch ( e ) {}
	}

	// Le mutazioni arrivano a raffica, e applicare la pelle ne genera altre: si aspetta che
	// la tela si fermi un momento, poi si passa una volta sola.
	function applicaFraPoco( doc ) {
		window.clearTimeout( attesa );
		attesa = window.setTimeout( function () { applica( doc ); }, 60 );
	}

	function aggancia() {

		var doc = tela();

		if ( doc !== documentoTela ) {
			if ( osservatoreTela ) {
				osservatoreTela.disconnect();
			}
			documentoTela = doc;
			osservatoreTela = new window.MutationObserver( function () { applicaFraPoco( doc ); } );
			osservatoreTela.observe( doc.body, { childList: true, subtree: true } );
		}

		applicaFraPoco( doc );
	}

	// La tela puo' comparire dopo, ed essere ricreata passando da un editor all'altro:
	// si tiene d'occhio il documento dell'editor, senza interrogarlo a intervalli.
	function avvia() {
		aggancia();
		if ( document.body ) {
			new window.MutationObserver( function () { aggancia(); } )
				.observe( document.body, { childList: true, subtree: true } );
		}
	}

	if ( 'loading' === document.readyState ) {
		document.addEventListener( 'DOMContentLoaded', avvia );
	} else {
		avvia();
	}

}( window.jQuery ) );
