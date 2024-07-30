<?php
/*
 * Plugin Name:       Astro Booking Engine
 * Plugin URI:        https://wordpress.org/plugins/astro-booking-engine
 * Description:       Display the booking engine form through the use of the shortcode [astro-booking-engine]. Includes the most popular booking engine providers.
 * Version:           1.3.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            AstroThemes
 * Author URI:        https://www.astrothemes.com
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

if ( is_admin() ) {
	require_once(dirname(__FILE__) . '/astro-booking-engine-admin.php');
}

/**
 * Plugin constants.
 */
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
 * Enqueue plugin files.
 */
add_action('init', 'astro_be_enqueue_files');
function astro_be_enqueue_files() {

	// jQuery UI - ref. https://code.jquery.com/ui/
	wp_enqueue_script('jquery-ui-datepicker-js' );

	// UI theme
	$jquery_ui_theme = get_option(ASTRO_BE_PREFIX.'calendar');
	if (!$jquery_ui_theme) { $jquery_ui_theme = 'base'; }
	$jquery_ui_theme_url = plugin_dir_url( __FILE__ ) . 'vendors/jquery-ui-themes/themes/'.$jquery_ui_theme.'/jquery-ui.min.css';
	wp_enqueue_style('jquery-ui-datepicker-css', $jquery_ui_theme_url);

	$plugin_version = astro_be_plugin_data('Version');

	// Enqueue main files
	wp_register_style( 'astro-booking-engine', plugin_dir_url( __FILE__ ) . 'css/astro-booking-engine.css', array(), $plugin_version );
	wp_enqueue_style( 'astro-booking-engine' );
	wp_enqueue_script( 'astro-booking-engine', plugin_dir_url( __FILE__ ) . 'js/astro-booking-engine.js', array( 'jquery', 'jquery-ui-datepicker' ), $plugin_version );

	// Add custom CSS
	$custom_css = astro_be_get_custom_layout();
	if (!empty($custom_css)) {
		wp_add_inline_style('astro-booking-engine', $custom_css);
	}

	// Enqueue the Provider files
	$provider = get_option(ASTRO_BE_PREFIX.'provider');
	if ($provider) {
		$provider = sanitize_text_field($provider);
		$provider_js_path_file = plugin_dir_path( __FILE__ ) . 'js/astro-booking-engine-' . $provider . '.js';
		if (file_exists($provider_js_path_file)) {
			wp_enqueue_script( 'astro-booking-engine-' . $provider, plugin_dir_url( __FILE__ ) . 'js/astro-booking-engine-'.$provider.'.js', array( 'jquery', 'jquery-ui-datepicker', 'astro-booking-engine' ), $plugin_version );
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
		admin_url('admin.php?page=' . ASTRO_BE_TEXTDOMAIN ) .
		'">' . __('Settings', 'astro-booking-engine' ) . '</a>'
	);
	return $links;
}
