<?php
/*
 * Plugin Name:       Astro Booking Engine
 * Plugin URI:        https://wordpress.org/plugins/astro-booking-engine
 * Description:       Display the booking engine form of your favorite provider.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            AstroThemes
 * Author URI:        https://www.astrothemes.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://github.com/alianschiavoncini/astro-booking-engine
 * Text Domain:       astro-booking-engine
 * Domain Path:       /languages
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * File inclusions.
 */
require_once(dirname(__FILE__) . '/astro-booking-engine-common.php');
require_once(dirname(__FILE__) . '/includes/classes/class-astro-booking-engine-widget.php');

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

	//jQuery UI - ref. https://code.jquery.com/ui/
	wp_enqueue_script('jquery-ui-datepicker', array( 'jquery' ) );

	//UI theme
	$jquery_ui_theme = get_option(ASTRO_BE_PREFIX.'calendar');
	if (!$jquery_ui_theme) { $jquery_ui_theme = 'base'; }
	$jquery_ui_theme_url = plugin_dir_url( __FILE__ ) . 'vendors/jquery-ui-themes/themes/'.$jquery_ui_theme.'/jquery-ui.min.css';
	wp_enqueue_style('jquery-ui-datepicker', $jquery_ui_theme_url);

	//Main enqueue files
	wp_register_style( 'astro-booking-engine', plugin_dir_url( __FILE__ ) . 'css/astro-booking-engine.css' );
	wp_enqueue_style( 'astro-booking-engine' );
	wp_enqueue_script( 'astro-booking-engine', plugin_dir_url( __FILE__ ) . 'js/astro-booking-engine.js', array( 'jquery', 'jquery-ui-datepicker' )  );

}

/**
 * Add Settings Link.
 */
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'astro_be_add_plugin_page_settings_link');
function astro_be_add_plugin_page_settings_link( $links ) {
	array_unshift(
		$links,
		'<a href="' .
		admin_url('options-general.php?page='. ASTRO_BE_TEXTDOMAIN) .
		'">' . __('Settings', 'astro-booking-engine' ) . '</a>'
	);
	return $links;
}