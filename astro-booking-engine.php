<?php
/*
 * Plugin Name:       Astro Booking Engine
 * Plugin URI:        https://wordpress.org/plugins/astro-booking-engine
 * Description:       Hotel booking form via Gutenberg block or shortcode, independent from the provider: switch booking engine anytime, your form stays the same.
 * Version:           2.4.0
 * Requires at least: 6.0.1
 * Requires PHP:      7.4
 * Author:            Alian Schiavoncini
 * Author URI:        https://www.alian.it
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       astro-booking-engine
 * Domain Path:       /languages
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class file inclusions.
 */
require_once(dirname(__FILE__) . '/includes/classes/class-astro-plugin-panel.php');
require_once(dirname(__FILE__) . '/includes/classes/class-astro-booking-engine-widget.php');

/**
 * File inclusions.
 */
require_once(dirname(__FILE__) . '/astro-booking-engine-common.php');
require_once(dirname(__FILE__) . '/astro-booking-engine-block.php');

if ( is_admin() ) {
	require_once(dirname(__FILE__) . '/astro-booking-engine-admin.php');
}

/**
 * Plugin constants.
 */
define('ASTRO_BE_VERSION', '2.4.0');
define('ASTRO_BE_PREFIX', 'astro_be_');
define('ASTRO_BE_TEXTDOMAIN', astro_be_plugin_data('TextDomain'));

/**
 * Loading Text Domain.
 */
add_action( 'init', 'astro_be_load_textdomain' );
function astro_be_load_textdomain() {
	load_plugin_textdomain( 'astro-booking-engine', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

/**
 * Alla prima attivazione il form nuovo e' quello compatto; chi aggiorna da una versione
 * precedente non passa di qui, l'opzione resta assente e il sanificatore risponde 'classic':
 * il suo form non cambia di una virgola finche' non lo decide lui.
 */
register_activation_hook( __FILE__, 'astro_be_activate' );
function astro_be_activate() {
	if ( false !== get_option( ASTRO_BE_PREFIX . 'form_style' ) ) {
		return; // gia' scelto
	}
	$gia_configurato = ( false !== get_option( ASTRO_BE_PREFIX . 'provider' ) );
	add_option( ASTRO_BE_PREFIX . 'form_style', $gia_configurato ? 'classic' : 'compact' );
	add_option( ASTRO_BE_PREFIX . 'form_density', 'compact' );
}

/**
 * Enqueue plugin files.
 */
add_action('init', 'astro_be_enqueue_files');
function astro_be_enqueue_files() {

	$plugin_version = ASTRO_BE_VERSION;
	$style = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'form_style');
	$compact = ( 'compact' === $style );

	// Il calendario di jQuery UI serve al solo stile classico: con quello compatto il
	// datepicker e' flatpickr, e caricare entrambi sarebbe peso inutile su ogni pagina.
	if (!$compact) {
		// jQuery UI - ref. https://code.jquery.com/ui/
		wp_enqueue_script('jquery-ui-datepicker-js' );

		// UI theme: only the themes shipped with the plugin (the value is part of the stylesheet path)
		$jquery_ui_theme = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'calendar');
		if (!$jquery_ui_theme) { $jquery_ui_theme = 'base'; }
		$jquery_ui_theme_url = plugin_dir_url( __FILE__ ) . 'vendors/jquery-ui-themes/themes/'.$jquery_ui_theme.'/jquery-ui.min.css';
		wp_enqueue_style('jquery-ui-datepicker-css', $jquery_ui_theme_url, array(), ASTRO_BE_VERSION);
	}

	// Enqueue main files
	wp_register_style( 'astro-booking-engine', plugin_dir_url( __FILE__ ) . 'css/astro-booking-engine.css', array(), $plugin_version );
	wp_enqueue_style( 'astro-booking-engine' );

	$main_deps = $compact ? array( 'jquery' ) : array( 'jquery', 'jquery-ui-datepicker' );
	wp_enqueue_script( 'astro-booking-engine', plugin_dir_url( __FILE__ ) . 'js/astro-booking-engine.js', $main_deps, $plugin_version );

	if ($compact) {
		wp_enqueue_style( 'astro-booking-engine-flatpickr', plugin_dir_url( __FILE__ ) . 'vendors/flatpickr/flatpickr.min.css', array(), $plugin_version );
		wp_enqueue_style( 'astro-booking-engine-compact', plugin_dir_url( __FILE__ ) . 'css/astro-booking-engine-compact.css', array( 'astro-booking-engine' ), $plugin_version );

		wp_enqueue_script( 'astro-booking-engine-flatpickr', plugin_dir_url( __FILE__ ) . 'vendors/flatpickr/flatpickr.min.js', array(), $plugin_version, true );

		// localizzazione del calendario: solo se il plugin ha il file della lingua della pagina
		$lang = astro_return_post_language();
		$l10n_file = plugin_dir_path( __FILE__ ) . 'vendors/flatpickr/l10n/' . $lang . '.min.js';
		if ( preg_match( '/^[a-z]{2}$/', $lang ) && file_exists( $l10n_file ) ) {
			wp_enqueue_script( 'astro-booking-engine-flatpickr-l10n', plugin_dir_url( __FILE__ ) . 'vendors/flatpickr/l10n/' . $lang . '.min.js', array( 'astro-booking-engine-flatpickr' ), $plugin_version, true );
		}

		wp_enqueue_script( 'astro-booking-engine-compact', plugin_dir_url( __FILE__ ) . 'js/astro-booking-engine-compact.js', array( 'jquery', 'astro-booking-engine', 'astro-booking-engine-flatpickr' ), $plugin_version, true );

		wp_localize_script( 'astro-booking-engine-compact', 'astro_be_compact_settings', array(
			'density' => astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'form_density'),
			'width'   => astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'form_width'),
		) );
		wp_localize_script( 'astro-booking-engine-compact', 'astro_be_compact_i18n', array(
			'guests'     => __( 'Guests', 'astro-booking-engine' ),
			'cancel'     => __( 'Cancel', 'astro-booking-engine' ),
			'save'       => __( 'Save', 'astro-booking-engine' ),
			'adult_one'  => __( 'adult', 'astro-booking-engine' ),
			'adult_many' => __( 'adults', 'astro-booking-engine' ),
			'child_one'  => __( 'child', 'astro-booking-engine' ),
			'child_many' => __( 'children', 'astro-booking-engine' ),
			'pet_one'    => __( 'pet', 'astro-booking-engine' ),
			'pet_many'   => __( 'pets', 'astro-booking-engine' ),
			// nomi per chi naviga con lo screen reader: "+" e "-" da soli non dicono di cosa
			'decrease'   => __( 'decrease', 'astro-booking-engine' ),
			'increase'   => __( 'increase', 'astro-booking-engine' ),
			'calendar'   => __( 'Calendar', 'astro-booking-engine' ),
		) );
	}

	// Add custom CSS
	// Va agganciato all'ultimo foglio in coda, altrimenti quello della pelle compatta viene
	// stampato dopo e, a parita' di specificita', sovrascrive le variabili scelte nel pannello.
	$custom_css = astro_be_get_custom_layout();
	if (!empty($custom_css)) {
		wp_add_inline_style( $compact ? 'astro-booking-engine-compact' : 'astro-booking-engine', $custom_css );
	}

	// Enqueue the Provider files
	$provider = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'provider');
	if ($provider) {
		$provider_deps = array_merge( $main_deps, array( 'astro-booking-engine' ) );
		$provider_js_path_file = plugin_dir_path( __FILE__ ) . 'js/astro-booking-engine-' . $provider . '.js';
		if (file_exists($provider_js_path_file)) {
			wp_enqueue_script( 'astro-booking-engine-' . $provider, plugin_dir_url( __FILE__ ) . 'js/astro-booking-engine-'.$provider.'.js', $provider_deps, $plugin_version );
		}
	}

}

/**
 * Add Settings Link.
 */
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'astro_be_add_plugin_page_settings_link');
function astro_be_add_plugin_page_settings_link( $links ) {
	array_unshift(
		$links,
		'<a href="' .
		esc_url( admin_url('admin.php?page=' . ASTRO_BE_TEXTDOMAIN ) ) .
		'">' . esc_html__('Settings', 'astro-booking-engine' ) . '</a>'
	);
	return $links;
}

/**
 * Add "Support" and "Author website" links to the plugin row on the Plugins screen.
 */
add_filter( 'plugin_row_meta', 'astro_be_plugin_row_meta', 10, 2 );
function astro_be_plugin_row_meta( $links, $file ) {
	if ( plugin_basename( __FILE__ ) !== $file ) {
		return $links;
	}

	$links[] = '<a href="' . esc_url( admin_url( 'admin.php?page=' . ASTRO_BE_TEXTDOMAIN . '&tab=support' ) ) . '">' . esc_html__( 'Support', 'astro-booking-engine' ) . '</a>';
	$links[] = '<a href="' . esc_url( 'https://www.alian.it' ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Author website', 'astro-booking-engine' ) . '</a>';

	return $links;
}
