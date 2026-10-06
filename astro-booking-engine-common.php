<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Profitroom: the age ranges of the children used when the settings have none. They are the most
 * common ones among the Profitroom hotels (0-3 and 4-14 years); every hotel can enter its own.
 */
if ( ! defined( 'ASTRO_BE_PROFITROOM_CHILDREN_RANGES' ) ) {
	define( 'ASTRO_BE_PROFITROOM_CHILDREN_RANGES', '0-3,4-14' );
}

/**
 * Get the Plugin Data.
 */
function astro_be_plugin_data($var = false) {
	$plugin_file = plugin_dir_path(__FILE__) . 'astro-booking-engine.php';
	if( !function_exists('get_plugin_data') ){
		require_once(ABSPATH . 'wp-admin/includes/plugin.php');
	}
	$get_plugin_data = get_plugin_data( $plugin_file );
	if ($var) { $get_plugin_data = $get_plugin_data[$var]; }
	return $get_plugin_data;
}

/**
 * Set the Booking Form options names.
 */
function astro_be_option_names($tab = false) {

	$option_names = false;

	switch ($tab) {
		case 'settings' :
			$option_names = array(
				'provider' => ASTRO_BE_PREFIX . 'provider',

				/**
				 * 5Stelle
				 */
				ASTRO_BE_PREFIX . '5stelle_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . '5stelle_form_target' => ASTRO_BE_PREFIX . '5stelle_form_target',
				ASTRO_BE_PREFIX . '5stelle_rooms' => esc_attr('1'), //required >= 1; default value = 1
				ASTRO_BE_PREFIX . '5stelle_adults_enable' => ASTRO_BE_PREFIX . '5stelle_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . '5stelle_adults_n_default' => ASTRO_BE_PREFIX . '5stelle_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . '5stelle_adults_n_max' => ASTRO_BE_PREFIX . '5stelle_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . '5stelle_children_enable' => ASTRO_BE_PREFIX . '5stelle_children_enable', //enable/disable
				ASTRO_BE_PREFIX . '5stelle_children_n_default' => ASTRO_BE_PREFIX . '5stelle_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . '5stelle_children_n_max' => ASTRO_BE_PREFIX . '5stelle_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . '5stelle_childage_enable' => ASTRO_BE_PREFIX . '5stelle_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . '5stelle_childage_min' => ASTRO_BE_PREFIX . '5stelle_childage_min', //conditional
				ASTRO_BE_PREFIX . '5stelle_childage_max' => ASTRO_BE_PREFIX . '5stelle_childage_max', //conditional
				ASTRO_BE_PREFIX . '5stelle_submit_label' => ASTRO_BE_PREFIX . '5stelle_submit_label', //optional

				//5Stelle custom fields
				ASTRO_BE_PREFIX . '5stelle_portal' => ASTRO_BE_PREFIX . '5stelle_portal', //required

				/**
				 * Beddy
				 */
				ASTRO_BE_PREFIX . 'beddy_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'beddy_form_target' => ASTRO_BE_PREFIX . 'beddy_form_target',
				ASTRO_BE_PREFIX . 'beddy_adults_enable' => ASTRO_BE_PREFIX . 'beddy_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'beddy_adults_n_default' => ASTRO_BE_PREFIX . 'beddy_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'beddy_adults_n_max' => ASTRO_BE_PREFIX . 'beddy_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'beddy_children_enable' => ASTRO_BE_PREFIX . 'beddy_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'beddy_children_n_default' => ASTRO_BE_PREFIX . 'beddy_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'beddy_children_n_max' => ASTRO_BE_PREFIX . 'beddy_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'beddy_childage_enable' => ASTRO_BE_PREFIX . 'beddy_childage_enable', //required when children are enabled
				ASTRO_BE_PREFIX . 'beddy_childage_min' => ASTRO_BE_PREFIX . 'beddy_childage_min', //conditional
				ASTRO_BE_PREFIX . 'beddy_childage_max' => ASTRO_BE_PREFIX . 'beddy_childage_max', //conditional
				ASTRO_BE_PREFIX . 'beddy_coupon' => ASTRO_BE_PREFIX . 'beddy_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'beddy_submit_label' => ASTRO_BE_PREFIX . 'beddy_submit_label', //optional

				//Beddy custom fields
				ASTRO_BE_PREFIX . 'beddy_hotel' => ASTRO_BE_PREFIX . 'beddy_hotel', //required; the subdomain
				ASTRO_BE_PREFIX . 'beddy_currency' => ASTRO_BE_PREFIX . 'beddy_currency', //required

				/**
				 * Bedzzle
				 */
				ASTRO_BE_PREFIX . 'bedzzle_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'bedzzle_form_target' => ASTRO_BE_PREFIX . 'bedzzle_form_target',
				ASTRO_BE_PREFIX . 'bedzzle_adults_enable' => ASTRO_BE_PREFIX . 'bedzzle_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'bedzzle_adults_n_default' => ASTRO_BE_PREFIX . 'bedzzle_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'bedzzle_adults_n_max' => ASTRO_BE_PREFIX . 'bedzzle_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'bedzzle_children_enable' => ASTRO_BE_PREFIX . 'bedzzle_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'bedzzle_children_n_default' => ASTRO_BE_PREFIX . 'bedzzle_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'bedzzle_children_n_max' => ASTRO_BE_PREFIX . 'bedzzle_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'bedzzle_childage_enable' => ASTRO_BE_PREFIX . 'bedzzle_childage_enable', //required when children are enabled
				ASTRO_BE_PREFIX . 'bedzzle_childage_min' => ASTRO_BE_PREFIX . 'bedzzle_childage_min', //conditional
				ASTRO_BE_PREFIX . 'bedzzle_childage_max' => ASTRO_BE_PREFIX . 'bedzzle_childage_max', //conditional
				ASTRO_BE_PREFIX . 'bedzzle_coupon' => ASTRO_BE_PREFIX . 'bedzzle_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'bedzzle_submit_label' => ASTRO_BE_PREFIX . 'bedzzle_submit_label', //optional

				//Bedzzle custom fields
				ASTRO_BE_PREFIX . 'bedzzle_hotel' => ASTRO_BE_PREFIX . 'bedzzle_hotel', //required; the apikey of the property

				/**
				 * BeGenius
				 */
				ASTRO_BE_PREFIX . 'begenius_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'begenius_form_target' => ASTRO_BE_PREFIX . 'begenius_form_target',
				ASTRO_BE_PREFIX . 'begenius_adults_enable' => ASTRO_BE_PREFIX . 'begenius_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'begenius_adults_n_default' => ASTRO_BE_PREFIX . 'begenius_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'begenius_adults_n_max' => ASTRO_BE_PREFIX . 'begenius_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'begenius_children_enable' => ASTRO_BE_PREFIX . 'begenius_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'begenius_children_n_default' => ASTRO_BE_PREFIX . 'begenius_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'begenius_children_n_max' => ASTRO_BE_PREFIX . 'begenius_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'begenius_childage_enable' => ASTRO_BE_PREFIX . 'begenius_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . 'begenius_childage_min' => ASTRO_BE_PREFIX . 'begenius_childage_min', //conditional
				ASTRO_BE_PREFIX . 'begenius_childage_max' => ASTRO_BE_PREFIX . 'begenius_childage_max', //conditional
				ASTRO_BE_PREFIX . 'begenius_coupon' => ASTRO_BE_PREFIX . 'begenius_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'begenius_submit_label' => ASTRO_BE_PREFIX . 'begenius_submit_label', //optional

				//BeGenius custom fields
				ASTRO_BE_PREFIX . 'begenius_hotel' => ASTRO_BE_PREFIX . 'begenius_hotel', //required

				/**
				 * Booking Designer
				 */
				ASTRO_BE_PREFIX . 'bookingdesigner_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'bookingdesigner_form_target' => ASTRO_BE_PREFIX . 'bookingdesigner_form_target',
				ASTRO_BE_PREFIX . 'bookingdesigner_adults_enable' => ASTRO_BE_PREFIX . 'bookingdesigner_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'bookingdesigner_adults_n_default' => ASTRO_BE_PREFIX . 'bookingdesigner_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'bookingdesigner_adults_n_max' => ASTRO_BE_PREFIX . 'bookingdesigner_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'bookingdesigner_children_enable' => ASTRO_BE_PREFIX . 'bookingdesigner_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'bookingdesigner_children_n_default' => ASTRO_BE_PREFIX . 'bookingdesigner_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'bookingdesigner_children_n_max' => ASTRO_BE_PREFIX . 'bookingdesigner_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'bookingdesigner_childage_enable' => ASTRO_BE_PREFIX . 'bookingdesigner_childage_enable', //required when children are enabled
				ASTRO_BE_PREFIX . 'bookingdesigner_childage_min' => ASTRO_BE_PREFIX . 'bookingdesigner_childage_min', //conditional
				ASTRO_BE_PREFIX . 'bookingdesigner_childage_max' => ASTRO_BE_PREFIX . 'bookingdesigner_childage_max', //conditional
				ASTRO_BE_PREFIX . 'bookingdesigner_coupon' => ASTRO_BE_PREFIX . 'bookingdesigner_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'bookingdesigner_submit_label' => ASTRO_BE_PREFIX . 'bookingdesigner_submit_label', //optional

				//Booking Designer custom fields
				ASTRO_BE_PREFIX . 'bookingdesigner_hotel' => ASTRO_BE_PREFIX . 'bookingdesigner_hotel', //required; the host name of the booking engine

				/**
				 * Booking Expert
				 */
				ASTRO_BE_PREFIX . 'bookingexpert_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'bookingexpert_form_target' => ASTRO_BE_PREFIX . 'bookingexpert_form_target',
				ASTRO_BE_PREFIX . 'bookingexpert_coupon' => ASTRO_BE_PREFIX . 'bookingexpert_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'bookingexpert_submit_label' => ASTRO_BE_PREFIX . 'bookingexpert_submit_label', //optional

				//Booking Expert custom fields
				ASTRO_BE_PREFIX . 'bookingexpert_layout' => ASTRO_BE_PREFIX . 'bookingexpert_layout', //required
				ASTRO_BE_PREFIX . 'bookingexpert_currency' => ASTRO_BE_PREFIX . 'bookingexpert_currency', //required

				/**
				 * Bookvisit
				 */
				ASTRO_BE_PREFIX . 'bookvisit_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'bookvisit_form_target' => ASTRO_BE_PREFIX . 'bookvisit_form_target',
				ASTRO_BE_PREFIX . 'bookvisit_adults_enable' => ASTRO_BE_PREFIX . 'bookvisit_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'bookvisit_adults_n_default' => ASTRO_BE_PREFIX . 'bookvisit_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'bookvisit_adults_n_max' => ASTRO_BE_PREFIX . 'bookvisit_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'bookvisit_children_enable' => ASTRO_BE_PREFIX . 'bookvisit_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'bookvisit_children_n_default' => ASTRO_BE_PREFIX . 'bookvisit_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'bookvisit_children_n_max' => ASTRO_BE_PREFIX . 'bookvisit_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'bookvisit_childage_enable' => ASTRO_BE_PREFIX . 'bookvisit_childage_enable', //required when children are enabled
				ASTRO_BE_PREFIX . 'bookvisit_childage_min' => ASTRO_BE_PREFIX . 'bookvisit_childage_min', //conditional
				ASTRO_BE_PREFIX . 'bookvisit_childage_max' => ASTRO_BE_PREFIX . 'bookvisit_childage_max', //conditional
				ASTRO_BE_PREFIX . 'bookvisit_coupon' => ASTRO_BE_PREFIX . 'bookvisit_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'bookvisit_submit_label' => ASTRO_BE_PREFIX . 'bookvisit_submit_label', //optional

				//Bookvisit custom fields
				ASTRO_BE_PREFIX . 'bookvisit_hotel' => ASTRO_BE_PREFIX . 'bookvisit_hotel', //required; the channel code

				/**
				 * Blastness
				 */
				ASTRO_BE_PREFIX . 'blastness_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'blastness_form_target' => ASTRO_BE_PREFIX . 'blastness_form_target',
				ASTRO_BE_PREFIX . 'blastness_id_albergo' => ASTRO_BE_PREFIX . 'blastness_id_albergo', //required
				ASTRO_BE_PREFIX . 'blastness_dc' => ASTRO_BE_PREFIX . 'blastness_dc', //required
				ASTRO_BE_PREFIX . 'blastness_id_stile' => ASTRO_BE_PREFIX . 'blastness_id_stile',
				ASTRO_BE_PREFIX . 'blastness_adults_enable' => ASTRO_BE_PREFIX . 'blastness_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'blastness_adults_n_default' => ASTRO_BE_PREFIX . 'blastness_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'blastness_adults_n_max' => ASTRO_BE_PREFIX . 'blastness_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'blastness_children_enable' => ASTRO_BE_PREFIX . 'blastness_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'blastness_children_n_default' => ASTRO_BE_PREFIX . 'blastness_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'blastness_children_n_max' => ASTRO_BE_PREFIX . 'blastness_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'blastness_childage_enable' => ASTRO_BE_PREFIX . 'blastness_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . 'blastness_childage_min' => ASTRO_BE_PREFIX . 'blastness_childage_min', //conditional
				ASTRO_BE_PREFIX . 'blastness_childage_max' => ASTRO_BE_PREFIX . 'blastness_childage_max', //conditional
				ASTRO_BE_PREFIX . 'blastness_submit_label' => ASTRO_BE_PREFIX . 'blastness_submit_label', //optional

				/**
				 * Cloudbeds
				 */
				ASTRO_BE_PREFIX . 'cloudbeds_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'cloudbeds_form_target' => ASTRO_BE_PREFIX . 'cloudbeds_form_target',
				ASTRO_BE_PREFIX . 'cloudbeds_adults_enable' => ASTRO_BE_PREFIX . 'cloudbeds_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'cloudbeds_adults_n_default' => ASTRO_BE_PREFIX . 'cloudbeds_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'cloudbeds_adults_n_max' => ASTRO_BE_PREFIX . 'cloudbeds_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'cloudbeds_children_enable' => ASTRO_BE_PREFIX . 'cloudbeds_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'cloudbeds_children_n_default' => ASTRO_BE_PREFIX . 'cloudbeds_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'cloudbeds_children_n_max' => ASTRO_BE_PREFIX . 'cloudbeds_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'cloudbeds_coupon' => ASTRO_BE_PREFIX . 'cloudbeds_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'cloudbeds_submit_label' => ASTRO_BE_PREFIX . 'cloudbeds_submit_label', //optional

				//Cloudbeds custom fields
				ASTRO_BE_PREFIX . 'cloudbeds_hotel' => ASTRO_BE_PREFIX . 'cloudbeds_hotel', //required; host/property
				ASTRO_BE_PREFIX . 'cloudbeds_language' => ASTRO_BE_PREFIX . 'cloudbeds_language', //optional; empty = page language
				ASTRO_BE_PREFIX . 'cloudbeds_currency' => ASTRO_BE_PREFIX . 'cloudbeds_currency', //required

				/**
				 * Data Sistemi
				 */
				ASTRO_BE_PREFIX . 'datasistemi_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'datasistemi_form_target' => ASTRO_BE_PREFIX . 'datasistemi_form_target',
				ASTRO_BE_PREFIX . 'datasistemi_adults_enable' => ASTRO_BE_PREFIX . 'datasistemi_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'datasistemi_adults_n_default' => ASTRO_BE_PREFIX . 'datasistemi_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'datasistemi_adults_n_max' => ASTRO_BE_PREFIX . 'datasistemi_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'datasistemi_children_enable' => ASTRO_BE_PREFIX . 'datasistemi_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'datasistemi_children_n_default' => ASTRO_BE_PREFIX . 'datasistemi_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'datasistemi_children_n_max' => ASTRO_BE_PREFIX . 'datasistemi_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'datasistemi_submit_label' => ASTRO_BE_PREFIX . 'datasistemi_submit_label', //optional

				//Data Sistemi custom fields
				ASTRO_BE_PREFIX . 'datasistemi_idstr' => ASTRO_BE_PREFIX . 'datasistemi_idstr', //required
				ASTRO_BE_PREFIX . 'datasistemi_currency' => ASTRO_BE_PREFIX . 'datasistemi_currency', //required
				ASTRO_BE_PREFIX . 'datasistemi_codpromo' => ASTRO_BE_PREFIX . 'datasistemi_codpromo', //enable/disable

				/**
				 * D-EDGE
				 */
				ASTRO_BE_PREFIX . 'dedge_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'dedge_form_target' => ASTRO_BE_PREFIX . 'dedge_form_target',
				ASTRO_BE_PREFIX . 'dedge_adults_enable' => ASTRO_BE_PREFIX . 'dedge_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'dedge_adults_n_default' => ASTRO_BE_PREFIX . 'dedge_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'dedge_adults_n_max' => ASTRO_BE_PREFIX . 'dedge_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'dedge_children_enable' => ASTRO_BE_PREFIX . 'dedge_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'dedge_children_n_default' => ASTRO_BE_PREFIX . 'dedge_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'dedge_children_n_max' => ASTRO_BE_PREFIX . 'dedge_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'dedge_childage_enable' => ASTRO_BE_PREFIX . 'dedge_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . 'dedge_childage_min' => ASTRO_BE_PREFIX . 'dedge_childage_min', //conditional
				ASTRO_BE_PREFIX . 'dedge_childage_max' => ASTRO_BE_PREFIX . 'dedge_childage_max', //conditional
				ASTRO_BE_PREFIX . 'dedge_coupon' => ASTRO_BE_PREFIX . 'dedge_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'dedge_submit_label' => ASTRO_BE_PREFIX . 'dedge_submit_label', //optional

				//D-EDGE custom fields
				ASTRO_BE_PREFIX . 'dedge_hotel' => ASTRO_BE_PREFIX . 'dedge_hotel', //required; booking engine address

				/**
				 * DIRS21
				 */
				ASTRO_BE_PREFIX . 'dirs21_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'dirs21_form_target' => ASTRO_BE_PREFIX . 'dirs21_form_target',
				ASTRO_BE_PREFIX . 'dirs21_adults_enable' => ASTRO_BE_PREFIX . 'dirs21_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'dirs21_adults_n_default' => ASTRO_BE_PREFIX . 'dirs21_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'dirs21_adults_n_max' => ASTRO_BE_PREFIX . 'dirs21_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'dirs21_children_enable' => ASTRO_BE_PREFIX . 'dirs21_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'dirs21_children_n_default' => ASTRO_BE_PREFIX . 'dirs21_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'dirs21_children_n_max' => ASTRO_BE_PREFIX . 'dirs21_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'dirs21_childage_enable' => ASTRO_BE_PREFIX . 'dirs21_childage_enable', //required when children are enabled
				ASTRO_BE_PREFIX . 'dirs21_childage_min' => ASTRO_BE_PREFIX . 'dirs21_childage_min', //conditional
				ASTRO_BE_PREFIX . 'dirs21_childage_max' => ASTRO_BE_PREFIX . 'dirs21_childage_max', //conditional
				ASTRO_BE_PREFIX . 'dirs21_coupon' => ASTRO_BE_PREFIX . 'dirs21_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'dirs21_submit_label' => ASTRO_BE_PREFIX . 'dirs21_submit_label', //optional

				//DIRS21 custom fields
				ASTRO_BE_PREFIX . 'dirs21_hotel' => ASTRO_BE_PREFIX . 'dirs21_hotel', //required; the code of the property

				/**
				 * Ericsoft
				 */
				ASTRO_BE_PREFIX . 'ericsoft_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'ericsoft_form_target' => ASTRO_BE_PREFIX . 'ericsoft_form_target',
				ASTRO_BE_PREFIX . 'ericsoft_adults_enable' => ASTRO_BE_PREFIX . 'ericsoft_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'ericsoft_adults_n_default' => ASTRO_BE_PREFIX . 'ericsoft_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'ericsoft_adults_n_max' => ASTRO_BE_PREFIX . 'ericsoft_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'ericsoft_children_enable' => ASTRO_BE_PREFIX . 'ericsoft_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'ericsoft_children_n_default' => ASTRO_BE_PREFIX . 'ericsoft_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'ericsoft_children_n_max' => ASTRO_BE_PREFIX . 'ericsoft_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'ericsoft_infants_enable' => ASTRO_BE_PREFIX . 'ericsoft_infants_enable', //enable/disable
				ASTRO_BE_PREFIX . 'ericsoft_infants_n_default' => ASTRO_BE_PREFIX . 'ericsoft_infants_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'ericsoft_infants_n_max' => ASTRO_BE_PREFIX . 'ericsoft_infants_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'ericsoft_submit_label' => ASTRO_BE_PREFIX . 'ericsoft_submit_label', //optional

				//Ericsoft custom fields
				ASTRO_BE_PREFIX . 'ericsoft_idh' => ASTRO_BE_PREFIX . 'ericsoft_idh', //required
				ASTRO_BE_PREFIX . 'ericsoft_currency' => ASTRO_BE_PREFIX . 'ericsoft_currency', //required

				/**
				 * ErmesHotels
				 */
				ASTRO_BE_PREFIX . 'ermeshotels_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'ermeshotels_form_target' => ASTRO_BE_PREFIX . 'ermeshotels_form_target',
				ASTRO_BE_PREFIX . 'ermeshotels_adults_enable' => ASTRO_BE_PREFIX . 'ermeshotels_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'ermeshotels_adults_n_default' => ASTRO_BE_PREFIX . 'ermeshotels_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'ermeshotels_adults_n_max' => ASTRO_BE_PREFIX . 'ermeshotels_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'ermeshotels_children_enable' => ASTRO_BE_PREFIX . 'ermeshotels_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'ermeshotels_children_n_default' => ASTRO_BE_PREFIX . 'ermeshotels_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'ermeshotels_children_n_max' => ASTRO_BE_PREFIX . 'ermeshotels_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'ermeshotels_childage_enable' => ASTRO_BE_PREFIX . 'ermeshotels_childage_enable', //required when children are enabled
				ASTRO_BE_PREFIX . 'ermeshotels_childage_min' => ASTRO_BE_PREFIX . 'ermeshotels_childage_min', //conditional
				ASTRO_BE_PREFIX . 'ermeshotels_childage_max' => ASTRO_BE_PREFIX . 'ermeshotels_childage_max', //conditional
				ASTRO_BE_PREFIX . 'ermeshotels_coupon' => ASTRO_BE_PREFIX . 'ermeshotels_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'ermeshotels_submit_label' => ASTRO_BE_PREFIX . 'ermeshotels_submit_label', //optional

				//ErmesHotels custom fields
				ASTRO_BE_PREFIX . 'ermeshotels_hotel' => ASTRO_BE_PREFIX . 'ermeshotels_hotel', //required; hotel/channel

				/**
				 * Guestline
				 */
				ASTRO_BE_PREFIX . 'guestline_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'guestline_form_target' => ASTRO_BE_PREFIX . 'guestline_form_target',
				ASTRO_BE_PREFIX . 'guestline_adults_enable' => ASTRO_BE_PREFIX . 'guestline_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'guestline_adults_n_default' => ASTRO_BE_PREFIX . 'guestline_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'guestline_adults_n_max' => ASTRO_BE_PREFIX . 'guestline_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'guestline_children_enable' => ASTRO_BE_PREFIX . 'guestline_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'guestline_children_n_default' => ASTRO_BE_PREFIX . 'guestline_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'guestline_children_n_max' => ASTRO_BE_PREFIX . 'guestline_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'guestline_coupon' => ASTRO_BE_PREFIX . 'guestline_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'guestline_submit_label' => ASTRO_BE_PREFIX . 'guestline_submit_label', //optional

				//Guestline custom fields
				ASTRO_BE_PREFIX . 'guestline_site' => ASTRO_BE_PREFIX . 'guestline_site', //required
				ASTRO_BE_PREFIX . 'guestline_hotel' => ASTRO_BE_PREFIX . 'guestline_hotel', //required

				/**
				 * HotelNetSolutions (OnePageBooking)
				 */
				ASTRO_BE_PREFIX . 'hotelnetsolutions_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'hotelnetsolutions_form_target' => ASTRO_BE_PREFIX . 'hotelnetsolutions_form_target',
				ASTRO_BE_PREFIX . 'hotelnetsolutions_adults_enable' => ASTRO_BE_PREFIX . 'hotelnetsolutions_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'hotelnetsolutions_adults_n_default' => ASTRO_BE_PREFIX . 'hotelnetsolutions_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'hotelnetsolutions_adults_n_max' => ASTRO_BE_PREFIX . 'hotelnetsolutions_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'hotelnetsolutions_children_enable' => ASTRO_BE_PREFIX . 'hotelnetsolutions_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'hotelnetsolutions_children_n_default' => ASTRO_BE_PREFIX . 'hotelnetsolutions_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'hotelnetsolutions_children_n_max' => ASTRO_BE_PREFIX . 'hotelnetsolutions_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'hotelnetsolutions_childage_enable' => ASTRO_BE_PREFIX . 'hotelnetsolutions_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . 'hotelnetsolutions_childage_min' => ASTRO_BE_PREFIX . 'hotelnetsolutions_childage_min', //conditional
				ASTRO_BE_PREFIX . 'hotelnetsolutions_childage_max' => ASTRO_BE_PREFIX . 'hotelnetsolutions_childage_max', //conditional
				ASTRO_BE_PREFIX . 'hotelnetsolutions_coupon' => ASTRO_BE_PREFIX . 'hotelnetsolutions_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'hotelnetsolutions_submit_label' => ASTRO_BE_PREFIX . 'hotelnetsolutions_submit_label', //optional

				//HotelNetSolutions custom fields
				ASTRO_BE_PREFIX . 'hotelnetsolutions_hotel' => ASTRO_BE_PREFIX . 'hotelnetsolutions_hotel', //required; booking engine address

				/**
				 * Amadeus iHotelier (TravelClick)
				 */
				ASTRO_BE_PREFIX . 'ihotelier_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'ihotelier_form_target' => ASTRO_BE_PREFIX . 'ihotelier_form_target',
				ASTRO_BE_PREFIX . 'ihotelier_adults_enable' => ASTRO_BE_PREFIX . 'ihotelier_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'ihotelier_adults_n_default' => ASTRO_BE_PREFIX . 'ihotelier_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'ihotelier_adults_n_max' => ASTRO_BE_PREFIX . 'ihotelier_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'ihotelier_children_enable' => ASTRO_BE_PREFIX . 'ihotelier_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'ihotelier_children_n_default' => ASTRO_BE_PREFIX . 'ihotelier_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'ihotelier_children_n_max' => ASTRO_BE_PREFIX . 'ihotelier_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'ihotelier_coupon' => ASTRO_BE_PREFIX . 'ihotelier_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'ihotelier_submit_label' => ASTRO_BE_PREFIX . 'ihotelier_submit_label', //optional

				//Amadeus iHotelier custom fields
				ASTRO_BE_PREFIX . 'ihotelier_hotel' => ASTRO_BE_PREFIX . 'ihotelier_hotel', //required; hotel id
				ASTRO_BE_PREFIX . 'ihotelier_language' => ASTRO_BE_PREFIX . 'ihotelier_language', //optional; empty = page language
				ASTRO_BE_PREFIX . 'ihotelier_currency' => ASTRO_BE_PREFIX . 'ihotelier_currency', //required

				/**
				 * Iperbooking
				 */
				ASTRO_BE_PREFIX . 'iperbooking_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'iperbooking_form_target' => ASTRO_BE_PREFIX . 'iperbooking_form_target',
				ASTRO_BE_PREFIX . 'iperbooking_rooms' => esc_attr('1'), //required >= 1; default value = 1
				ASTRO_BE_PREFIX . 'iperbooking_adults_enable' => ASTRO_BE_PREFIX . 'iperbooking_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'iperbooking_adults_n_default' => ASTRO_BE_PREFIX . 'iperbooking_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'iperbooking_adults_n_max' => ASTRO_BE_PREFIX . 'iperbooking_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'iperbooking_children_enable' => ASTRO_BE_PREFIX . 'iperbooking_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'iperbooking_children_n_default' => ASTRO_BE_PREFIX . 'iperbooking_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'iperbooking_children_n_max' => ASTRO_BE_PREFIX . 'iperbooking_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'iperbooking_childage_enable' => ASTRO_BE_PREFIX . 'iperbooking_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . 'iperbooking_childage_min' => ASTRO_BE_PREFIX . 'iperbooking_childage_min', //conditional
				ASTRO_BE_PREFIX . 'iperbooking_childage_max' => ASTRO_BE_PREFIX . 'iperbooking_childage_max', //conditional
				ASTRO_BE_PREFIX . 'iperbooking_submit_label' => ASTRO_BE_PREFIX . 'iperbooking_submit_label', //optional

				//Iperbooking custom fields
				ASTRO_BE_PREFIX . 'iperbooking_idHotel' => ASTRO_BE_PREFIX . 'iperbooking_idHotel', //required
				ASTRO_BE_PREFIX . 'iperbooking_language' => ASTRO_BE_PREFIX . 'iperbooking_language', //required; one at least
				ASTRO_BE_PREFIX . 'iperbooking_language_default' => ASTRO_BE_PREFIX . 'iperbooking_language_default',
				ASTRO_BE_PREFIX . 'iperbooking_idTrattamento' => ASTRO_BE_PREFIX . 'iperbooking_idTrattamento', //required; default value = 4
				ASTRO_BE_PREFIX . 'iperbooking_idTrattamento_default' => ASTRO_BE_PREFIX . 'iperbooking_idTrattamento_default',
				ASTRO_BE_PREFIX . 'iperbooking_idTrattamento_visible' => ASTRO_BE_PREFIX . 'iperbooking_idTrattamento_visible',
				ASTRO_BE_PREFIX . 'iperbooking_codiceSconto' => ASTRO_BE_PREFIX . 'iperbooking_codiceSconto', //enable/disable

				/**
				 * Journey
				 */
				ASTRO_BE_PREFIX . 'journey_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'journey_form_target' => ASTRO_BE_PREFIX . 'journey_form_target',
				ASTRO_BE_PREFIX . 'journey_adults_enable' => ASTRO_BE_PREFIX . 'journey_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'journey_adults_n_default' => ASTRO_BE_PREFIX . 'journey_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'journey_adults_n_max' => ASTRO_BE_PREFIX . 'journey_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'journey_children_enable' => ASTRO_BE_PREFIX . 'journey_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'journey_children_n_default' => ASTRO_BE_PREFIX . 'journey_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'journey_children_n_max' => ASTRO_BE_PREFIX . 'journey_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'journey_submit_label' => ASTRO_BE_PREFIX . 'journey_submit_label', //optional

				//Journey custom fields
				ASTRO_BE_PREFIX . 'journey_hotel' => ASTRO_BE_PREFIX . 'journey_hotel', //required

				/**
				 * Kross Booking
				 */
				ASTRO_BE_PREFIX . 'krossbooking_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'krossbooking_form_target' => ASTRO_BE_PREFIX . 'krossbooking_form_target',
				ASTRO_BE_PREFIX . 'krossbooking_adults_enable' => ASTRO_BE_PREFIX . 'krossbooking_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'krossbooking_adults_n_default' => ASTRO_BE_PREFIX . 'krossbooking_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'krossbooking_adults_n_max' => ASTRO_BE_PREFIX . 'krossbooking_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'krossbooking_children_enable' => ASTRO_BE_PREFIX . 'krossbooking_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'krossbooking_children_n_default' => ASTRO_BE_PREFIX . 'krossbooking_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'krossbooking_children_n_max' => ASTRO_BE_PREFIX . 'krossbooking_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'krossbooking_childage_enable' => ASTRO_BE_PREFIX . 'krossbooking_childage_enable', //required when children are enabled
				ASTRO_BE_PREFIX . 'krossbooking_childage_min' => ASTRO_BE_PREFIX . 'krossbooking_childage_min', //conditional
				ASTRO_BE_PREFIX . 'krossbooking_childage_max' => ASTRO_BE_PREFIX . 'krossbooking_childage_max', //conditional
				ASTRO_BE_PREFIX . 'krossbooking_submit_label' => ASTRO_BE_PREFIX . 'krossbooking_submit_label', //optional

				//Kross Booking custom fields
				ASTRO_BE_PREFIX . 'krossbooking_hotel' => ASTRO_BE_PREFIX . 'krossbooking_hotel', //required; the code of the property

				/**
				 * Mews
				 */
				ASTRO_BE_PREFIX . 'mews_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'mews_form_target' => ASTRO_BE_PREFIX . 'mews_form_target',
				ASTRO_BE_PREFIX . 'mews_adults_enable' => ASTRO_BE_PREFIX . 'mews_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'mews_adults_n_default' => ASTRO_BE_PREFIX . 'mews_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'mews_adults_n_max' => ASTRO_BE_PREFIX . 'mews_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'mews_children_enable' => ASTRO_BE_PREFIX . 'mews_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'mews_children_n_default' => ASTRO_BE_PREFIX . 'mews_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'mews_children_n_max' => ASTRO_BE_PREFIX . 'mews_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'mews_coupon' => ASTRO_BE_PREFIX . 'mews_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'mews_submit_label' => ASTRO_BE_PREFIX . 'mews_submit_label', //optional

				//Mews custom fields
				ASTRO_BE_PREFIX . 'mews_configuration_id' => ASTRO_BE_PREFIX . 'mews_configuration_id', //required
				ASTRO_BE_PREFIX . 'mews_currency' => ASTRO_BE_PREFIX . 'mews_currency', //required

				/**
				 * Mirai
				 */
				ASTRO_BE_PREFIX . 'mirai_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'mirai_form_target' => ASTRO_BE_PREFIX . 'mirai_form_target',
				ASTRO_BE_PREFIX . 'mirai_adults_enable' => ASTRO_BE_PREFIX . 'mirai_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'mirai_adults_n_default' => ASTRO_BE_PREFIX . 'mirai_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'mirai_adults_n_max' => ASTRO_BE_PREFIX . 'mirai_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'mirai_children_enable' => ASTRO_BE_PREFIX . 'mirai_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'mirai_children_n_default' => ASTRO_BE_PREFIX . 'mirai_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'mirai_children_n_max' => ASTRO_BE_PREFIX . 'mirai_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'mirai_childage_enable' => ASTRO_BE_PREFIX . 'mirai_childage_enable', //required when children are enabled
				ASTRO_BE_PREFIX . 'mirai_childage_min' => ASTRO_BE_PREFIX . 'mirai_childage_min', //conditional
				ASTRO_BE_PREFIX . 'mirai_childage_max' => ASTRO_BE_PREFIX . 'mirai_childage_max', //conditional
				ASTRO_BE_PREFIX . 'mirai_coupon' => ASTRO_BE_PREFIX . 'mirai_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'mirai_submit_label' => ASTRO_BE_PREFIX . 'mirai_submit_label', //optional

				//Mirai custom fields
				ASTRO_BE_PREFIX . 'mirai_hotel' => ASTRO_BE_PREFIX . 'mirai_hotel', //required; code/property
				ASTRO_BE_PREFIX . 'mirai_currency' => ASTRO_BE_PREFIX . 'mirai_currency', //required

				/**
				 * MyGuestCare
				 */
				ASTRO_BE_PREFIX . 'myguestcare_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'myguestcare_form_target' => ASTRO_BE_PREFIX . 'myguestcare_form_target',
				ASTRO_BE_PREFIX . 'myguestcare_adults_enable' => ASTRO_BE_PREFIX . 'myguestcare_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'myguestcare_adults_n_default' => ASTRO_BE_PREFIX . 'myguestcare_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'myguestcare_adults_n_max' => ASTRO_BE_PREFIX . 'myguestcare_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'myguestcare_children_enable' => ASTRO_BE_PREFIX . 'myguestcare_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'myguestcare_children_n_default' => ASTRO_BE_PREFIX . 'myguestcare_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'myguestcare_children_n_max' => ASTRO_BE_PREFIX . 'myguestcare_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'myguestcare_childage_enable' => ASTRO_BE_PREFIX . 'myguestcare_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . 'myguestcare_childage_min' => ASTRO_BE_PREFIX . 'myguestcare_childage_min', //conditional
				ASTRO_BE_PREFIX . 'myguestcare_childage_max' => ASTRO_BE_PREFIX . 'myguestcare_childage_max', //conditional
				ASTRO_BE_PREFIX . 'myguestcare_submit_label' => ASTRO_BE_PREFIX . 'myguestcare_submit_label', //optional

				//MyGuestCare custom fields
				ASTRO_BE_PREFIX . 'myguestcare_idcliente' => ASTRO_BE_PREFIX . 'myguestcare_idcliente', //required

				/**
				 * Octorate
				 */
				ASTRO_BE_PREFIX . 'octorate_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'octorate_form_target' => ASTRO_BE_PREFIX . 'octorate_form_target',
				ASTRO_BE_PREFIX . 'octorate_adults_enable' => ASTRO_BE_PREFIX . 'octorate_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'octorate_adults_n_default' => ASTRO_BE_PREFIX . 'octorate_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'octorate_adults_n_max' => ASTRO_BE_PREFIX . 'octorate_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'octorate_children_enable' => ASTRO_BE_PREFIX . 'octorate_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'octorate_children_n_default' => ASTRO_BE_PREFIX . 'octorate_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'octorate_children_n_max' => ASTRO_BE_PREFIX . 'octorate_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'octorate_childage_enable' => ASTRO_BE_PREFIX . 'octorate_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . 'octorate_childage_min' => ASTRO_BE_PREFIX . 'octorate_childage_min', //conditional
				ASTRO_BE_PREFIX . 'octorate_childage_max' => ASTRO_BE_PREFIX . 'octorate_childage_max', //conditional
				ASTRO_BE_PREFIX . 'octorate_coupon' => ASTRO_BE_PREFIX . 'octorate_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'octorate_submit_label' => ASTRO_BE_PREFIX . 'octorate_submit_label', //optional

				//Octorate custom fields
				ASTRO_BE_PREFIX . 'octorate_codice' => ASTRO_BE_PREFIX . 'octorate_codice', //required
				ASTRO_BE_PREFIX . 'octorate_currency' => ASTRO_BE_PREFIX . 'octorate_currency', //required

				/**
				 * Passepartout
				 */
				ASTRO_BE_PREFIX . 'passepartout_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'passepartout_form_target' => ASTRO_BE_PREFIX . 'passepartout_form_target',
				ASTRO_BE_PREFIX . 'passepartout_rooms' => esc_attr('1'), //required >= 1; default value = 1
				ASTRO_BE_PREFIX . 'passepartout_adults_enable' => ASTRO_BE_PREFIX . 'passepartout_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'passepartout_adults_n_default' => ASTRO_BE_PREFIX . 'passepartout_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'passepartout_adults_n_max' => ASTRO_BE_PREFIX . 'passepartout_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'passepartout_children_enable' => ASTRO_BE_PREFIX . 'passepartout_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'passepartout_children_n_default' => ASTRO_BE_PREFIX . 'passepartout_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'passepartout_children_n_max' => ASTRO_BE_PREFIX . 'passepartout_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'passepartout_childage_enable' => ASTRO_BE_PREFIX . 'passepartout_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . 'passepartout_childage_min' => ASTRO_BE_PREFIX . 'passepartout_childage_min', //conditional
				ASTRO_BE_PREFIX . 'passepartout_childage_max' => ASTRO_BE_PREFIX . 'passepartout_childage_max', //conditional
				ASTRO_BE_PREFIX . 'passepartout_submit_label' => ASTRO_BE_PREFIX . 'passepartout_submit_label', //optional

				//passepartout custom fields
				ASTRO_BE_PREFIX . 'passepartout_Albergo' => ASTRO_BE_PREFIX . 'passepartout_Albergo', //required
				ASTRO_BE_PREFIX . 'passepartout_OidPortaleXAlbergo' => ASTRO_BE_PREFIX . 'passepartout_OidPortaleXAlbergo', //required
				ASTRO_BE_PREFIX . 'passepartout_CodicePromozione' => ASTRO_BE_PREFIX . 'passepartout_CodicePromozione',

				/**
				 * Profitroom
				 */
				ASTRO_BE_PREFIX . 'profitroom_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'profitroom_form_target' => ASTRO_BE_PREFIX . 'profitroom_form_target',
				ASTRO_BE_PREFIX . 'profitroom_adults_enable' => ASTRO_BE_PREFIX . 'profitroom_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'profitroom_adults_n_default' => ASTRO_BE_PREFIX . 'profitroom_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'profitroom_adults_n_max' => ASTRO_BE_PREFIX . 'profitroom_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'profitroom_children_enable' => ASTRO_BE_PREFIX . 'profitroom_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'profitroom_children_n_default' => ASTRO_BE_PREFIX . 'profitroom_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'profitroom_children_n_max' => ASTRO_BE_PREFIX . 'profitroom_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'profitroom_childage_enable' => ASTRO_BE_PREFIX . 'profitroom_childage_enable', //required when children are enabled
				ASTRO_BE_PREFIX . 'profitroom_childage_min' => ASTRO_BE_PREFIX . 'profitroom_childage_min', //conditional
				ASTRO_BE_PREFIX . 'profitroom_childage_max' => ASTRO_BE_PREFIX . 'profitroom_childage_max', //conditional
				ASTRO_BE_PREFIX . 'profitroom_coupon' => ASTRO_BE_PREFIX . 'profitroom_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'profitroom_submit_label' => ASTRO_BE_PREFIX . 'profitroom_submit_label', //optional

				//Profitroom custom fields
				ASTRO_BE_PREFIX . 'profitroom_hotel' => ASTRO_BE_PREFIX . 'profitroom_hotel', //required; the code of the property
				ASTRO_BE_PREFIX . 'profitroom_children_ranges' => ASTRO_BE_PREFIX . 'profitroom_children_ranges', //required when children are enabled; the age ranges of the children, such as 0-2,3-11

				/**
				 * Reservit
				 */
				ASTRO_BE_PREFIX . 'reservit_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'reservit_form_target' => ASTRO_BE_PREFIX . 'reservit_form_target',
				ASTRO_BE_PREFIX . 'reservit_adults_enable' => ASTRO_BE_PREFIX . 'reservit_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'reservit_adults_n_default' => ASTRO_BE_PREFIX . 'reservit_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'reservit_adults_n_max' => ASTRO_BE_PREFIX . 'reservit_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'reservit_children_enable' => ASTRO_BE_PREFIX . 'reservit_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'reservit_children_n_default' => ASTRO_BE_PREFIX . 'reservit_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'reservit_children_n_max' => ASTRO_BE_PREFIX . 'reservit_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'reservit_childage_enable' => ASTRO_BE_PREFIX . 'reservit_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . 'reservit_childage_min' => ASTRO_BE_PREFIX . 'reservit_childage_min', //conditional
				ASTRO_BE_PREFIX . 'reservit_childage_max' => ASTRO_BE_PREFIX . 'reservit_childage_max', //conditional
				ASTRO_BE_PREFIX . 'reservit_coupon' => ASTRO_BE_PREFIX . 'reservit_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'reservit_submit_label' => ASTRO_BE_PREFIX . 'reservit_submit_label', //optional

				//Reservit custom fields
				ASTRO_BE_PREFIX . 'reservit_hotel' => ASTRO_BE_PREFIX . 'reservit_hotel', //required; custid/hotelid

				/**
				 * ResNexus
				 */
				ASTRO_BE_PREFIX . 'resnexus_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'resnexus_form_target' => ASTRO_BE_PREFIX . 'resnexus_form_target',
				ASTRO_BE_PREFIX . 'resnexus_adults_enable' => ASTRO_BE_PREFIX . 'resnexus_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'resnexus_adults_n_default' => ASTRO_BE_PREFIX . 'resnexus_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'resnexus_adults_n_max' => ASTRO_BE_PREFIX . 'resnexus_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'resnexus_children_enable' => ASTRO_BE_PREFIX . 'resnexus_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'resnexus_children_n_default' => ASTRO_BE_PREFIX . 'resnexus_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'resnexus_children_n_max' => ASTRO_BE_PREFIX . 'resnexus_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'resnexus_pets_enable' => ASTRO_BE_PREFIX . 'resnexus_pets_enable', //enable/disable
				ASTRO_BE_PREFIX . 'resnexus_pets_n_default' => ASTRO_BE_PREFIX . 'resnexus_pets_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'resnexus_pets_n_max' => ASTRO_BE_PREFIX . 'resnexus_pets_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'resnexus_submit_label' => ASTRO_BE_PREFIX . 'resnexus_submit_label', //optional

				//ResNexus custom fields
				ASTRO_BE_PREFIX . 'resnexus_hotel' => ASTRO_BE_PREFIX . 'resnexus_hotel', //required; property code
				ASTRO_BE_PREFIX . 'resnexus_children_capacity' => ASTRO_BE_PREFIX . 'resnexus_children_capacity', //required; capacity slot
				ASTRO_BE_PREFIX . 'resnexus_pets_capacity' => ASTRO_BE_PREFIX . 'resnexus_pets_capacity', //required; capacity slot

				/**
				 * RevPlus (WebHotelier)
				 */
				ASTRO_BE_PREFIX . 'revplus_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'revplus_form_target' => ASTRO_BE_PREFIX . 'revplus_form_target',
				ASTRO_BE_PREFIX . 'revplus_adults_enable' => ASTRO_BE_PREFIX . 'revplus_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'revplus_adults_n_default' => ASTRO_BE_PREFIX . 'revplus_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'revplus_adults_n_max' => ASTRO_BE_PREFIX . 'revplus_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'revplus_children_enable' => ASTRO_BE_PREFIX . 'revplus_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'revplus_children_n_default' => ASTRO_BE_PREFIX . 'revplus_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'revplus_children_n_max' => ASTRO_BE_PREFIX . 'revplus_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'revplus_infants_enable' => ASTRO_BE_PREFIX . 'revplus_infants_enable', //enable/disable
				ASTRO_BE_PREFIX . 'revplus_infants_n_default' => ASTRO_BE_PREFIX . 'revplus_infants_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'revplus_infants_n_max' => ASTRO_BE_PREFIX . 'revplus_infants_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'revplus_coupon' => ASTRO_BE_PREFIX . 'revplus_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'revplus_submit_label' => ASTRO_BE_PREFIX . 'revplus_submit_label', //optional

				//RevPlus custom fields
				ASTRO_BE_PREFIX . 'revplus_hotel' => ASTRO_BE_PREFIX . 'revplus_hotel', //required
				ASTRO_BE_PREFIX . 'revplus_htl_code' => ASTRO_BE_PREFIX . 'revplus_htl_code', //optional; empty = all the hotels
				ASTRO_BE_PREFIX . 'revplus_currency' => ASTRO_BE_PREFIX . 'revplus_currency', //required

				/**
				 * Roiback
				 */
				ASTRO_BE_PREFIX . 'roiback_form_method' => esc_attr('post'),
				ASTRO_BE_PREFIX . 'roiback_form_target' => ASTRO_BE_PREFIX . 'roiback_form_target',
				ASTRO_BE_PREFIX . 'roiback_adults_enable' => ASTRO_BE_PREFIX . 'roiback_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'roiback_adults_n_default' => ASTRO_BE_PREFIX . 'roiback_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'roiback_adults_n_max' => ASTRO_BE_PREFIX . 'roiback_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'roiback_children_enable' => ASTRO_BE_PREFIX . 'roiback_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'roiback_children_n_default' => ASTRO_BE_PREFIX . 'roiback_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'roiback_children_n_max' => ASTRO_BE_PREFIX . 'roiback_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'roiback_childage_enable' => ASTRO_BE_PREFIX . 'roiback_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . 'roiback_childage_min' => ASTRO_BE_PREFIX . 'roiback_childage_min', //conditional
				ASTRO_BE_PREFIX . 'roiback_childage_max' => ASTRO_BE_PREFIX . 'roiback_childage_max', //conditional
				ASTRO_BE_PREFIX . 'roiback_coupon' => ASTRO_BE_PREFIX . 'roiback_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'roiback_submit_label' => ASTRO_BE_PREFIX . 'roiback_submit_label', //optional

				//Roiback custom fields
				ASTRO_BE_PREFIX . 'roiback_hotel' => ASTRO_BE_PREFIX . 'roiback_hotel', //required; host
				ASTRO_BE_PREFIX . 'roiback_code' => ASTRO_BE_PREFIX . 'roiback_code', //required

				/**
				 * Sabre SynXis
				 */
				ASTRO_BE_PREFIX . 'synxis_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'synxis_form_target' => ASTRO_BE_PREFIX . 'synxis_form_target',
				ASTRO_BE_PREFIX . 'synxis_adults_enable' => ASTRO_BE_PREFIX . 'synxis_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'synxis_adults_n_default' => ASTRO_BE_PREFIX . 'synxis_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'synxis_adults_n_max' => ASTRO_BE_PREFIX . 'synxis_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'synxis_children_enable' => ASTRO_BE_PREFIX . 'synxis_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'synxis_children_n_default' => ASTRO_BE_PREFIX . 'synxis_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'synxis_children_n_max' => ASTRO_BE_PREFIX . 'synxis_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'synxis_childage_enable' => ASTRO_BE_PREFIX . 'synxis_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . 'synxis_childage_min' => ASTRO_BE_PREFIX . 'synxis_childage_min', //conditional
				ASTRO_BE_PREFIX . 'synxis_childage_max' => ASTRO_BE_PREFIX . 'synxis_childage_max', //conditional
				ASTRO_BE_PREFIX . 'synxis_coupon' => ASTRO_BE_PREFIX . 'synxis_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'synxis_submit_label' => ASTRO_BE_PREFIX . 'synxis_submit_label', //optional

				//Sabre SynXis custom fields
				ASTRO_BE_PREFIX . 'synxis_hotel' => ASTRO_BE_PREFIX . 'synxis_hotel', //required
				ASTRO_BE_PREFIX . 'synxis_chain' => ASTRO_BE_PREFIX . 'synxis_chain', //required
				ASTRO_BE_PREFIX . 'synxis_currency' => ASTRO_BE_PREFIX . 'synxis_currency', //required

				/**
				 * Sirvoy
				 */
				ASTRO_BE_PREFIX . 'sirvoy_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'sirvoy_form_target' => ASTRO_BE_PREFIX . 'sirvoy_form_target',
				ASTRO_BE_PREFIX . 'sirvoy_adults_enable' => ASTRO_BE_PREFIX . 'sirvoy_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'sirvoy_adults_n_default' => ASTRO_BE_PREFIX . 'sirvoy_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'sirvoy_adults_n_max' => ASTRO_BE_PREFIX . 'sirvoy_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'sirvoy_coupon' => ASTRO_BE_PREFIX . 'sirvoy_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'sirvoy_submit_label' => ASTRO_BE_PREFIX . 'sirvoy_submit_label', //optional

				//Sirvoy custom fields
				ASTRO_BE_PREFIX . 'sirvoy_hotel' => ASTRO_BE_PREFIX . 'sirvoy_hotel', //required; the address of the page with the Sirvoy widget

				/**
				 * SiteMinder
				 */
				ASTRO_BE_PREFIX . 'siteminder_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'siteminder_form_target' => ASTRO_BE_PREFIX . 'siteminder_form_target',
				ASTRO_BE_PREFIX . 'siteminder_adults_enable' => ASTRO_BE_PREFIX . 'siteminder_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'siteminder_adults_n_default' => ASTRO_BE_PREFIX . 'siteminder_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'siteminder_adults_n_max' => ASTRO_BE_PREFIX . 'siteminder_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'siteminder_children_enable' => ASTRO_BE_PREFIX . 'siteminder_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'siteminder_children_n_default' => ASTRO_BE_PREFIX . 'siteminder_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'siteminder_children_n_max' => ASTRO_BE_PREFIX . 'siteminder_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'siteminder_infants_enable' => ASTRO_BE_PREFIX . 'siteminder_infants_enable', //enable/disable
				ASTRO_BE_PREFIX . 'siteminder_infants_n_default' => ASTRO_BE_PREFIX . 'siteminder_infants_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'siteminder_infants_n_max' => ASTRO_BE_PREFIX . 'siteminder_infants_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'siteminder_coupon' => ASTRO_BE_PREFIX . 'siteminder_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'siteminder_submit_label' => ASTRO_BE_PREFIX . 'siteminder_submit_label', //optional

				//SiteMinder custom fields
				ASTRO_BE_PREFIX . 'siteminder_hotel' => ASTRO_BE_PREFIX . 'siteminder_hotel', //required
				ASTRO_BE_PREFIX . 'siteminder_currency' => ASTRO_BE_PREFIX . 'siteminder_currency', //required

				/**
				 * Scidoo
				 */
				ASTRO_BE_PREFIX . 'scidoo_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'scidoo_form_target' => ASTRO_BE_PREFIX . 'scidoo_form_target',
				ASTRO_BE_PREFIX . 'scidoo_adults_enable' => ASTRO_BE_PREFIX . 'scidoo_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'scidoo_adults_n_default' => ASTRO_BE_PREFIX . 'scidoo_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'scidoo_adults_n_max' => ASTRO_BE_PREFIX . 'scidoo_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'scidoo_children_enable' => ASTRO_BE_PREFIX . 'scidoo_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'scidoo_children_n_default' => ASTRO_BE_PREFIX . 'scidoo_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'scidoo_children_n_max' => ASTRO_BE_PREFIX . 'scidoo_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'scidoo_childage_enable' => ASTRO_BE_PREFIX . 'scidoo_childage_enable', //required when children are enabled
				ASTRO_BE_PREFIX . 'scidoo_childage_min' => ASTRO_BE_PREFIX . 'scidoo_childage_min', //conditional
				ASTRO_BE_PREFIX . 'scidoo_childage_max' => ASTRO_BE_PREFIX . 'scidoo_childage_max', //conditional
				ASTRO_BE_PREFIX . 'scidoo_submit_label' => ASTRO_BE_PREFIX . 'scidoo_submit_label', //optional

				//Scidoo custom fields
				ASTRO_BE_PREFIX . 'scidoo_cod' => ASTRO_BE_PREFIX . 'scidoo_cod', //required
				ASTRO_BE_PREFIX . 'scidoo_IDsotto_struttura' => ASTRO_BE_PREFIX . 'scidoo_IDsotto_struttura', //optional; 0 = all

				/**
				 * Simple Booking
				 */
				ASTRO_BE_PREFIX . 'simplebooking_form_method' => esc_attr('get'), //required
				ASTRO_BE_PREFIX . 'simplebooking_form_target' => ASTRO_BE_PREFIX . 'simplebooking_form_target', //required
				ASTRO_BE_PREFIX . 'simplebooking_hid' => ASTRO_BE_PREFIX . 'simplebooking_hid', //required
				ASTRO_BE_PREFIX . 'simplebooking_currency' => ASTRO_BE_PREFIX . 'simplebooking_currency', //required
				ASTRO_BE_PREFIX . 'simplebooking_rooms' => ASTRO_BE_PREFIX . 'simplebooking_rooms', //default value = 1
				ASTRO_BE_PREFIX . 'simplebooking_adults_enable' => ASTRO_BE_PREFIX . 'simplebooking_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'simplebooking_adults_n_default' => ASTRO_BE_PREFIX . 'simplebooking_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'simplebooking_adults_n_max' => ASTRO_BE_PREFIX . 'simplebooking_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'simplebooking_children_enable' => ASTRO_BE_PREFIX . 'simplebooking_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'simplebooking_children_n_default' => ASTRO_BE_PREFIX . 'simplebooking_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'simplebooking_children_n_max' => ASTRO_BE_PREFIX . 'simplebooking_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'simplebooking_childage_enable' => ASTRO_BE_PREFIX . 'simplebooking_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . 'simplebooking_childage_min' => ASTRO_BE_PREFIX . 'simplebooking_childage_min', //conditional
				ASTRO_BE_PREFIX . 'simplebooking_childage_max' => ASTRO_BE_PREFIX . 'simplebooking_childage_max', //conditional
				ASTRO_BE_PREFIX . 'simplebooking_coupon' => ASTRO_BE_PREFIX . 'simplebooking_coupon',
				ASTRO_BE_PREFIX . 'simplebooking_submit_label' => ASTRO_BE_PREFIX . 'simplebooking_submit_label', //optional


				/**
				 * Slope
				 */
				ASTRO_BE_PREFIX . 'slope_form_method' => esc_attr('post'),
				ASTRO_BE_PREFIX . 'slope_form_target' => ASTRO_BE_PREFIX . 'slope_form_target',
				ASTRO_BE_PREFIX . 'slope_adults_enable' => ASTRO_BE_PREFIX . 'slope_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'slope_adults_n_default' => ASTRO_BE_PREFIX . 'slope_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'slope_adults_n_max' => ASTRO_BE_PREFIX . 'slope_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'slope_children_enable' => ASTRO_BE_PREFIX . 'slope_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'slope_children_n_default' => ASTRO_BE_PREFIX . 'slope_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'slope_children_n_max' => ASTRO_BE_PREFIX . 'slope_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'slope_submit_label' => ASTRO_BE_PREFIX . 'slope_submit_label', //optional

				//Slope custom fields
				ASTRO_BE_PREFIX . 'slope_hotel' => ASTRO_BE_PREFIX . 'slope_hotel', //required; the code of the property

				/**
				 * ThinkReservations
				 */
				ASTRO_BE_PREFIX . 'thinkreservations_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'thinkreservations_form_target' => ASTRO_BE_PREFIX . 'thinkreservations_form_target',
				ASTRO_BE_PREFIX . 'thinkreservations_adults_enable' => ASTRO_BE_PREFIX . 'thinkreservations_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'thinkreservations_adults_n_default' => ASTRO_BE_PREFIX . 'thinkreservations_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'thinkreservations_adults_n_max' => ASTRO_BE_PREFIX . 'thinkreservations_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'thinkreservations_coupon' => ASTRO_BE_PREFIX . 'thinkreservations_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'thinkreservations_submit_label' => ASTRO_BE_PREFIX . 'thinkreservations_submit_label', //optional

				//ThinkReservations custom fields
				ASTRO_BE_PREFIX . 'thinkreservations_hotel' => ASTRO_BE_PREFIX . 'thinkreservations_hotel', //required; property name

				/**
				 * Vertical Booking
				 */
				ASTRO_BE_PREFIX . 'verticalbooking_form_method' => esc_attr('get'), //required
				ASTRO_BE_PREFIX . 'verticalbooking_form_target' => ASTRO_BE_PREFIX . 'verticalbooking_form_target', //required
				ASTRO_BE_PREFIX . 'verticalbooking_id_albergo' => ASTRO_BE_PREFIX . 'verticalbooking_id_albergo', //required
				ASTRO_BE_PREFIX . 'verticalbooking_dc' => ASTRO_BE_PREFIX . 'verticalbooking_dc', //required
				ASTRO_BE_PREFIX . 'verticalbooking_id_stile' => ASTRO_BE_PREFIX . 'verticalbooking_id_stile',

				ASTRO_BE_PREFIX . 'verticalbooking_adults_enable' => ASTRO_BE_PREFIX . 'verticalbooking_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'verticalbooking_adults_n_default' => ASTRO_BE_PREFIX . 'verticalbooking_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'verticalbooking_adults_n_max' => ASTRO_BE_PREFIX . 'verticalbooking_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'verticalbooking_children_enable' => ASTRO_BE_PREFIX . 'verticalbooking_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'verticalbooking_children_n_default' => ASTRO_BE_PREFIX . 'verticalbooking_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'verticalbooking_children_n_max' => ASTRO_BE_PREFIX . 'verticalbooking_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'verticalbooking_childage_enable' => ASTRO_BE_PREFIX . 'verticalbooking_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . 'verticalbooking_childage_min' => ASTRO_BE_PREFIX . 'verticalbooking_childage_min', //conditional
				ASTRO_BE_PREFIX . 'verticalbooking_childage_max' => ASTRO_BE_PREFIX . 'verticalbooking_childage_max', //conditional
				ASTRO_BE_PREFIX . 'verticalbooking_submit_label' => ASTRO_BE_PREFIX . 'verticalbooking_submit_label', //optional
				/**
				 * Witbooking
				 */
				ASTRO_BE_PREFIX . 'witbooking_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'witbooking_form_target' => ASTRO_BE_PREFIX . 'witbooking_form_target',
				ASTRO_BE_PREFIX . 'witbooking_adults_enable' => ASTRO_BE_PREFIX . 'witbooking_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'witbooking_adults_n_default' => ASTRO_BE_PREFIX . 'witbooking_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'witbooking_adults_n_max' => ASTRO_BE_PREFIX . 'witbooking_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'witbooking_children_enable' => ASTRO_BE_PREFIX . 'witbooking_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'witbooking_children_n_default' => ASTRO_BE_PREFIX . 'witbooking_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'witbooking_children_n_max' => ASTRO_BE_PREFIX . 'witbooking_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'witbooking_infants_enable' => ASTRO_BE_PREFIX . 'witbooking_infants_enable', //enable/disable
				ASTRO_BE_PREFIX . 'witbooking_infants_n_default' => ASTRO_BE_PREFIX . 'witbooking_infants_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'witbooking_infants_n_max' => ASTRO_BE_PREFIX . 'witbooking_infants_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'witbooking_coupon' => ASTRO_BE_PREFIX . 'witbooking_coupon', //enable/disable
				ASTRO_BE_PREFIX . 'witbooking_submit_label' => ASTRO_BE_PREFIX . 'witbooking_submit_label', //optional

				//Witbooking custom fields
				ASTRO_BE_PREFIX . 'witbooking_hotel' => ASTRO_BE_PREFIX . 'witbooking_hotel', //required; host/property
				ASTRO_BE_PREFIX . 'witbooking_language' => ASTRO_BE_PREFIX . 'witbooking_language', //optional; empty = page language

				/**
				 * WuBook
				 */
				ASTRO_BE_PREFIX . 'wubook_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'wubook_form_target' => ASTRO_BE_PREFIX . 'wubook_form_target',
				ASTRO_BE_PREFIX . 'wubook_adults_enable' => ASTRO_BE_PREFIX . 'wubook_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'wubook_adults_n_default' => ASTRO_BE_PREFIX . 'wubook_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'wubook_adults_n_max' => ASTRO_BE_PREFIX . 'wubook_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'wubook_teens_enable' => ASTRO_BE_PREFIX . 'wubook_teens_enable', //enable/disable
				ASTRO_BE_PREFIX . 'wubook_teens_n_default' => ASTRO_BE_PREFIX . 'wubook_teens_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'wubook_teens_n_max' => ASTRO_BE_PREFIX . 'wubook_teens_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'wubook_children_enable' => ASTRO_BE_PREFIX . 'wubook_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'wubook_children_n_default' => ASTRO_BE_PREFIX . 'wubook_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'wubook_children_n_max' => ASTRO_BE_PREFIX . 'wubook_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'wubook_babies_enable' => ASTRO_BE_PREFIX . 'wubook_babies_enable', //enable/disable
				ASTRO_BE_PREFIX . 'wubook_babies_n_default' => ASTRO_BE_PREFIX . 'wubook_babies_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'wubook_babies_n_max' => ASTRO_BE_PREFIX . 'wubook_babies_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'wubook_submit_label' => ASTRO_BE_PREFIX . 'wubook_submit_label', //optional

				//WuBook custom fields
				ASTRO_BE_PREFIX . 'wubook_ep' => ASTRO_BE_PREFIX . 'wubook_ep', //required
				ASTRO_BE_PREFIX . 'wubook_currency' => ASTRO_BE_PREFIX . 'wubook_currency', //required
			);
			break;

		case 'layout' :
			$option_names = array(
				ASTRO_BE_PREFIX . 'form_style' => ASTRO_BE_PREFIX . 'form_style', //classic|compact
				ASTRO_BE_PREFIX . 'form_density' => ASTRO_BE_PREFIX . 'form_density', //compact|roomy
				ASTRO_BE_PREFIX . 'form_width' => ASTRO_BE_PREFIX . 'form_width', //auto|full

				ASTRO_BE_PREFIX . 'widget-background-color' => ASTRO_BE_PREFIX . 'widget-background-color',
				ASTRO_BE_PREFIX . 'widget-border-radius' => ASTRO_BE_PREFIX . 'widget-border-radius',

				ASTRO_BE_PREFIX . 'label-font-color' => ASTRO_BE_PREFIX . 'label-font-color',
				ASTRO_BE_PREFIX . 'label-font-size' => ASTRO_BE_PREFIX . 'label-font-size',
				ASTRO_BE_PREFIX . 'label-font-weight' => ASTRO_BE_PREFIX . 'label-font-weight',

				ASTRO_BE_PREFIX . 'field-font-color' => ASTRO_BE_PREFIX . 'field-font-color',
				ASTRO_BE_PREFIX . 'field-font-size' => ASTRO_BE_PREFIX . 'field-font-size',
				ASTRO_BE_PREFIX . 'field-font-weight' => ASTRO_BE_PREFIX . 'field-font-weight',
				ASTRO_BE_PREFIX . 'field-background-color' => ASTRO_BE_PREFIX . 'field-background-color',
				ASTRO_BE_PREFIX . 'field-hover-background-color' => ASTRO_BE_PREFIX . 'field-hover-background-color',
				ASTRO_BE_PREFIX . 'field-border-width' => ASTRO_BE_PREFIX . 'field-border-width',
				ASTRO_BE_PREFIX . 'field-border-style' => ASTRO_BE_PREFIX . 'field-border-style',
				ASTRO_BE_PREFIX . 'field-border-color' => ASTRO_BE_PREFIX . 'field-border-color',
				ASTRO_BE_PREFIX . 'field-border-radius' => ASTRO_BE_PREFIX . 'field-border-radius',
				ASTRO_BE_PREFIX . 'calendar' => ASTRO_BE_PREFIX . 'calendar',

				ASTRO_BE_PREFIX . 'submit-font-color' => ASTRO_BE_PREFIX . 'submit-font-color',
				ASTRO_BE_PREFIX . 'submit-font-size' => ASTRO_BE_PREFIX . 'submit-font-size',
				ASTRO_BE_PREFIX . 'submit-font-weight' => ASTRO_BE_PREFIX . 'submit-font-weight',
				ASTRO_BE_PREFIX . 'submit-background-color' => ASTRO_BE_PREFIX . 'submit-background-color',
				ASTRO_BE_PREFIX . 'submit-border-width' => ASTRO_BE_PREFIX . 'submit-border-width',
				ASTRO_BE_PREFIX . 'submit-border-style' => ASTRO_BE_PREFIX . 'submit-border-style',
				ASTRO_BE_PREFIX . 'submit-border-color' => ASTRO_BE_PREFIX . 'submit-border-color',
				ASTRO_BE_PREFIX . 'submit-border-radius' => ASTRO_BE_PREFIX . 'submit-border-radius',

				ASTRO_BE_PREFIX . 'custom-css' => ASTRO_BE_PREFIX . 'custom-css',
			);
			break;
	}


	return $option_names;
}

/**
 * Return the calendar themes shipped in vendors/jquery-ui-themes/themes/.
 */
function astro_be_calendar_themes() {
	return array('base', 'black-tie', 'blitzer', 'cupertino', 'dark-hive', 'dot-luv', 'eggplant', 'excite-bike', 'flick', 'hot-sneaks', 'humanity', 'le-frog', 'mint-choc', 'overcast', 'pepper-grinder', 'redmond', 'smoothness', 'south-street', 'start', 'sunny', 'swanky-purse', 'trontastic', 'ui-darkness', 'ui-lightness', 'vader');
}

/**
 * Return the sanitize callback of a plugin option.
 * The same callback is used when the option is saved (register_setting) and when it is
 * read to build paths, URLs or inline CSS (astro_be_get_sanitized_option), so that values
 * saved by older versions are validated as well.
 * Provider fields not listed here are plain text: sanitize_text_field().
 */
function astro_be_get_option_sanitize_callback( $option_name ) {
	$name = substr( $option_name, strlen( ASTRO_BE_PREFIX ) );

	// General and layout settings.
	if ( 'provider' === $name ) {
		return 'astro_be_sanitize_provider';
	}
	if ( 'form_style' === $name ) {
		return 'astro_be_sanitize_form_style';
	}
	if ( 'form_density' === $name ) {
		return 'astro_be_sanitize_form_density';
	}
	if ( 'form_width' === $name ) {
		return 'astro_be_sanitize_form_width';
	}
	if ( 'calendar' === $name ) {
		return 'astro_be_sanitize_calendar_theme';
	}
	if ( 'custom-css' === $name ) {
		return 'astro_be_sanitize_custom_css';
	}
	if ( preg_match( '/-color$/', $name ) ) {
		return 'astro_be_block_sanitize_css_color';
	}
	if ( preg_match( '/-(font-size|border-width|border-radius)$/', $name ) ) {
		return 'astro_be_sanitize_absint_or_empty';
	}
	if ( preg_match( '/-font-weight$/', $name ) ) {
		return 'astro_be_sanitize_font_weight';
	}
	if ( preg_match( '/-border-style$/', $name ) ) {
		return 'astro_be_sanitize_border_style';
	}

	// Provider settings: <provider>_<field>.
	if ( preg_match( '/_form_target$/', $name ) ) {
		return 'astro_be_sanitize_form_target';
	}
	if ( preg_match( '/_(enable|coupon|codiceSconto|codpromo|CodicePromozione|idTrattamento_visible)$/', $name ) ) {
		return 'astro_be_sanitize_checkbox';
	}
	if ( preg_match( '/_(n_default|n_max|childage_min|childage_max)$/', $name ) ) {
		return 'astro_be_sanitize_absint_or_empty';
	}
	// Prima della regola generica sui nomi in _language, che serve alle liste di Iperbooking.
	if ( 'ihotelier_language' === $name ) {
		return 'astro_be_sanitize_ihotelier_language';
	}
	if ( 'cloudbeds_language' === $name ) {
		return 'astro_be_sanitize_cloudbeds_language';
	}
	if ( 'witbooking_language' === $name ) {
		return 'astro_be_sanitize_witbooking_language';
	}
	if ( preg_match( '/_(language|idTrattamento)$/', $name ) ) {
		return 'astro_be_sanitize_options_list';
	}
	if ( preg_match( '/_configuration_id$/', $name ) ) {
		return 'astro_be_sanitize_uuid';
	}
	if ( 'bookingexpert_layout' === $name ) {
		return 'astro_be_sanitize_bookingexpert_layout';
	}
	if ( 'octorate_codice' === $name ) {
		return 'astro_be_sanitize_octorate_codice';
	}
	if ( 'revplus_hotel' === $name ) {
		return 'astro_be_sanitize_revplus_hotel';
	}
	if ( 'revplus_htl_code' === $name ) {
		return 'astro_be_sanitize_revplus_htl_code';
	}
	if ( 'resnexus_hotel' === $name ) {
		return 'astro_be_sanitize_resnexus_hotel';
	}
	if ( 'resnexus_children_capacity' === $name ) {
		return 'astro_be_sanitize_resnexus_children_capacity';
	}
	if ( 'resnexus_pets_capacity' === $name ) {
		return 'astro_be_sanitize_resnexus_pets_capacity';
	}
	if ( 'thinkreservations_hotel' === $name ) {
		return 'astro_be_sanitize_thinkreservations_hotel';
	}
	if ( 'ihotelier_hotel' === $name ) {
		return 'astro_be_sanitize_ihotelier_hotel';
	}
	if ( 'cloudbeds_hotel' === $name ) {
		return 'astro_be_sanitize_cloudbeds_hotel';
	}
	if ( 'reservit_hotel' === $name ) {
		return 'astro_be_sanitize_reservit_hotel';
	}
	if ( 'hotelnetsolutions_hotel' === $name ) {
		return 'astro_be_sanitize_hotelnetsolutions_hotel';
	}
	if ( 'dedge_hotel' === $name ) {
		return 'astro_be_sanitize_dedge_hotel';
	}
	if ( 'roiback_hotel' === $name ) {
		return 'astro_be_sanitize_roiback_hotel';
	}
	if ( 'roiback_code' === $name ) {
		return 'astro_be_sanitize_roiback_code';
	}
	if ( 'dirs21_hotel' === $name ) {
		return 'astro_be_sanitize_dirs21_hotel';
	}
	if ( 'bookvisit_hotel' === $name ) {
		return 'astro_be_sanitize_bookvisit_hotel';
	}
	if ( 'sirvoy_hotel' === $name ) {
		return 'astro_be_sanitize_sirvoy_hotel';
	}
	if ( 'profitroom_hotel' === $name ) {
		return 'astro_be_sanitize_profitroom_hotel';
	}
	if ( 'profitroom_children_ranges' === $name ) {
		return 'astro_be_sanitize_profitroom_children_ranges';
	}
	if ( 'krossbooking_hotel' === $name ) {
		return 'astro_be_sanitize_krossbooking_hotel';
	}
	if ( 'slope_hotel' === $name ) {
		return 'astro_be_sanitize_slope_hotel';
	}
	if ( 'bedzzle_hotel' === $name ) {
		return 'astro_be_sanitize_bedzzle_hotel';
	}
	if ( 'beddy_hotel' === $name ) {
		return 'astro_be_sanitize_beddy_hotel';
	}
	if ( 'bookingdesigner_hotel' === $name ) {
		return 'astro_be_sanitize_bookingdesigner_hotel';
	}
	if ( 'ermeshotels_hotel' === $name ) {
		return 'astro_be_sanitize_ermeshotels_hotel';
	}
	if ( 'mirai_hotel' === $name ) {
		return 'astro_be_sanitize_mirai_hotel';
	}
	if ( 'witbooking_hotel' === $name ) {
		return 'astro_be_sanitize_witbooking_hotel';
	}
	if ( 'journey_hotel' === $name ) {
		return 'astro_be_sanitize_journey_hotel';
	}
	if ( 'guestline_site' === $name ) {
		return 'astro_be_sanitize_guestline_site';
	}
	if ( 'guestline_hotel' === $name ) {
		return 'astro_be_sanitize_guestline_hotel';
	}
	if ( 'siteminder_hotel' === $name ) {
		return 'astro_be_sanitize_siteminder_hotel';
	}
	if ( 'synxis_hotel' === $name || 'synxis_chain' === $name ) {
		return 'astro_be_sanitize_synxis_' . substr( $name, strlen( 'synxis_' ) );
	}
	if ( 'scidoo_cod' === $name ) {
		return 'astro_be_sanitize_scidoo_cod';
	}
	if ( 'scidoo_IDsotto_struttura' === $name ) {
		return 'astro_be_sanitize_absint_or_empty';
	}

	return 'sanitize_text_field';
}

/**
 * Return a plugin option passed through its sanitize callback.
 */
function astro_be_get_sanitized_option( $option_name ) {
	return call_user_func( astro_be_get_option_sanitize_callback( $option_name ), get_option( $option_name ) );
}

/**
 * Provider: it becomes part of the template and script file paths, so only the name of an
 * existing template is accepted.
 */
function astro_be_sanitize_provider( $value ) {
	if ( ! is_string( $value ) || ! preg_match( '/^[a-z0-9]+$/', $value ) ) {
		return '';
	}
	if ( ! file_exists( plugin_dir_path( __FILE__ ) . 'templates/' . $value . '.php' ) ) {
		return '';
	}
	return $value;
}

/**
 * Checkbox: '1' when checked, empty otherwise.
 */
function astro_be_sanitize_checkbox( $value ) {
	return ( is_scalar( $value ) && '1' === (string) $value ) ? '1' : '';
}

/**
 * Number from a dropdown; the empty value ("inherit") is kept.
 */
function astro_be_sanitize_absint_or_empty( $value ) {
	if ( ! is_scalar( $value ) || '' === trim( (string) $value ) ) {
		return '';
	}
	return absint( $value );
}

/**
 * Identifier in UUID format (Mews configuration ID), part of the form address.
 * The whole booking engine address can be pasted: only the identifier is kept.
 */
function astro_be_sanitize_uuid( $value ) {
	if ( is_string( $value ) && preg_match( '/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/i', $value, $matches ) ) {
		return strtolower( $matches[0] );
	}
	return '';
}

/**
 * Octorate property code: a number. The whole booking engine address can be pasted: the
 * value of its codice parameter is kept.
 */
function astro_be_sanitize_octorate_codice( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}
	if ( preg_match( '/[?&]codice=(\d+)/', $value, $matches ) ) {
		return $matches[1];
	}
	$value = trim( $value );
	return preg_match( '/^\d+$/', $value ) ? $value : '';
}

/**
 * Scidoo property code: a number. The whole booking engine address can be pasted: the value
 * of its cod parameter is kept.
 */
function astro_be_sanitize_scidoo_cod( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}
	if ( preg_match( '/[?&]cod=(\d+)/', $value, $matches ) ) {
		return $matches[1];
	}
	$value = trim( $value );
	return preg_match( '/^\d+$/', $value ) ? $value : '';
}

/**
 * RevPlus property name: the subdomain of reserve-online.net, part of the form address.
 * The whole booking engine address can be pasted: only the subdomain is kept.
 */
function astro_be_sanitize_revplus_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}
	$value = strtolower( trim( $value ) );
	if ( preg_match( '#^(?:https?://)?([a-z0-9-]+)\.reserve-online\.net#', $value, $matches ) ) {
		return $matches[1];
	}
	return preg_match( '/^[a-z0-9-]+$/', $value ) ? $value : '';
}

/**
 * RevPlus hotel code of a multi-hotel account: letters, digits, - and _.
 */
function astro_be_sanitize_revplus_htl_code( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}
	$value = trim( $value );
	return preg_match( '/^[A-Za-z0-9_-]+$/', $value ) ? $value : '';
}

/**
 * Booking Expert layout: a number. The whole booking engine address can be pasted: the value
 * of its layout parameter is kept.
 */
function astro_be_sanitize_bookingexpert_layout( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}
	if ( preg_match( '/[?&]layout=(\d+)/', $value, $matches ) ) {
		return $matches[1];
	}
	$value = trim( $value );
	return preg_match( '/^\d+$/', $value ) ? $value : '';
}

/**
 * Sabre SynXis property and chain codes: numbers. The whole booking engine address can be
 * pasted in either field: the value of its hotel= or chain= parameter is kept.
 */
function astro_be_sanitize_synxis_hotel( $value ) {
	return astro_be_sanitize_synxis_code( $value, 'hotel' );
}

function astro_be_sanitize_synxis_chain( $value ) {
	return astro_be_sanitize_synxis_code( $value, 'chain' );
}

function astro_be_sanitize_synxis_code( $value, $parameter ) {
	if ( ! is_string( $value ) ) {
		return '';
	}
	if ( preg_match( '/[?&]' . $parameter . '=(\d+)/i', $value, $matches ) ) {
		return $matches[1];
	}
	$value = trim( $value );
	return preg_match( '/^\d+$/', $value ) ? $value : '';
}

/**
 * SiteMinder property name: the last part of the booking engine address, part of the form
 * action. The whole address can be pasted: only the property name is kept.
 */
function astro_be_sanitize_siteminder_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}
	$value = strtolower( trim( $value ) );
	if ( preg_match( '#/properties/([a-z0-9-]+)#', $value, $matches ) ) {
		return $matches[1];
	}
	return preg_match( '/^[a-z0-9-]+$/', $value ) ? $value : '';
}

/**
 * Guestline site code: part of the form address. The whole booking engine address can be
 * pasted, both the current one (booking.eu.guestline.app/<site>/availability) and the old one
 * (<site>.dbm.guestline.net), which the booking engine redirects to the current one.
 */
function astro_be_sanitize_guestline_site( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}
	$value = trim( $value );
	if ( preg_match( '#guestline\.app/([A-Za-z0-9-]+)#', $value, $matches ) ) {
		return $matches[1];
	}
	if ( preg_match( '#(?:https?://)?([A-Za-z0-9-]+)\.dbm\.guestline\.net#', $value, $matches ) ) {
		return strtoupper( $matches[1] );
	}
	return preg_match( '/^[A-Za-z0-9-]+$/', $value ) ? $value : '';
}

/**
 * Guestline property code: the value of the hotel parameter. The whole booking engine address
 * can be pasted.
 */
function astro_be_sanitize_guestline_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}
	$value = trim( $value );
	if ( preg_match( '/[?&]hotel=([A-Za-z0-9-]+)/i', $value, $matches ) ) {
		return $matches[1];
	}
	return preg_match( '/^[A-Za-z0-9-]+$/', $value ) ? $value : '';
}

/**
 * Journey property name: the subdomain of onejourney.travel, part of the form address.
 * The whole booking engine address can be pasted: only the subdomain is kept.
 */
function astro_be_sanitize_journey_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}
	$value = strtolower( trim( $value ) );
	if ( preg_match( '#^(?:https?://)?([a-z0-9-]+)\.onejourney\.travel#', $value, $matches ) ) {
		return $matches[1];
	}
	return preg_match( '/^[a-z0-9-]+$/', $value ) ? $value : '';
}

/**
 * Witbooking booking engine address: the host and the property, kept as host/property.
 * The whole address is pasted by the user, with or without the language segment, and it can be
 * the one of Witbooking (engine.witbooking.com) or of the property (reservations.myhotel.com).
 */
function astro_be_sanitize_witbooking_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = trim( $value );
	$value = preg_replace( '#^https?://#i', '', $value );
	$value = preg_replace( '#[?\#].*$#', '', $value );

	// host[/lingua]/hotel/struttura, oppure il solo host/struttura.
	if ( preg_match( '#^([a-z0-9.-]+)/(?:[a-z]{2}/)?hotel/([A-Za-z0-9._-]+)#i', $value, $matches ) ) {
		return strtolower( $matches[1] ) . '/' . $matches[2];
	}
	if ( preg_match( '#^([a-z0-9.-]+\.[a-z]{2,})/([A-Za-z0-9._-]+)$#i', $value, $matches ) ) {
		return strtolower( $matches[1] ) . '/' . $matches[2];
	}

	return '';
}

/**
 * Witbooking: the languages of the booking engine, as code => name. A language which is not one
 * of these gives a "page not found", so only these are used in the address.
 */
function astro_be_witbooking_languages() {
	return array(
		'es' => __( 'Spanish', 'astro-booking-engine' ),
		'en' => __( 'English', 'astro-booking-engine' ),
		'it' => __( 'Italian', 'astro-booking-engine' ),
		'fr' => __( 'French', 'astro-booking-engine' ),
		'de' => __( 'German', 'astro-booking-engine' ),
		'pt' => __( 'Portuguese', 'astro-booking-engine' ),
		'ca' => __( 'Catalan', 'astro-booking-engine' ),
		'ru' => __( 'Russian', 'astro-booking-engine' ),
		'nl' => __( 'Dutch', 'astro-booking-engine' ),
		'ja' => __( 'Japanese', 'astro-booking-engine' ),
		'zh' => __( 'Chinese', 'astro-booking-engine' ),
		'eu' => __( 'Basque', 'astro-booking-engine' ),
		'da' => __( 'Danish', 'astro-booking-engine' ),
		'sv' => __( 'Swedish', 'astro-booking-engine' ),
		'ro' => __( 'Romanian', 'astro-booking-engine' ),
		'hu' => __( 'Hungarian', 'astro-booking-engine' ),
		'ko' => __( 'Korean', 'astro-booking-engine' ),
	);
}

/**
 * Witbooking: the language chosen in the settings, empty when it follows the page.
 */
function astro_be_sanitize_witbooking_language( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}
	$value = strtolower( trim( $value ) );
	return array_key_exists( $value, astro_be_witbooking_languages() ) ? $value : '';
}

/**
 * Witbooking: return the language of the booking engine address. The settings can fix one;
 * otherwise the language of the page is used when the booking engine has it, English otherwise.
 * The property answers in its own language when it does not have the requested one.
 */
function astro_return_witbooking_language() {

	$chosen = astro_be_get_sanitized_option( ASTRO_BE_PREFIX . 'witbooking_language' );
	if ( $chosen ) {
		return $chosen;
	}

	$lang = astro_return_post_language();

	return array_key_exists( $lang, astro_be_witbooking_languages() ) ? $lang : 'en';
}

/**
 * Beddy booking engine address: only the subdomain of the property is kept (terramarinahotel for
 * https://terramarinahotel.beddy.io/#/(beddy:list)?lang=it). The whole address is pasted by the
 * user; the subdomain alone, as the plugin saves it, is accepted as well.
 */
function astro_be_sanitize_beddy_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = strtolower( trim( $value ) );

	if ( preg_match( '#^(?:https?://)?([a-z0-9](?:[a-z0-9-]*[a-z0-9])?)\.beddy\.io(?:[/?\#]|$)#', $value, $matches ) ) {
		return $matches[1];
	}

	if ( preg_match( '/^[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/', $value ) ) {
		return $value;
	}

	return '';
}

/**
 * DIRS21 booking engine address: only the code of the property is kept (transit-loft for
 * https://reservation.one.dirs21.de/transit-loft). The address of the older booking engine
 * (https://v4.ibe.dirs21.de/channels/<code>/) gives the same code; the code alone is accepted as well.
 */
function astro_be_sanitize_dirs21_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = strtolower( trim( $value ) );

	if ( preg_match( '#^(?:https?://)?reservation\.one\.dirs21\.de/([a-z0-9](?:[a-z0-9-]*[a-z0-9])?)(?:[/?\#]|$)#', $value, $matches ) ) {
		return $matches[1];
	}

	if ( preg_match( '#^(?:https?://)?v\d+\.ibe\.dirs21\.de/channels/([a-z0-9](?:[a-z0-9-]*[a-z0-9])?)(?:[/?\#]|$)#', $value, $matches ) ) {
		return $matches[1];
	}

	if ( preg_match( '/^[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/', $value ) ) {
		return $value;
	}

	return '';
}

/**
 * Bookvisit booking engine address: only the channel code is kept (the channelId of
 * https://online.bookvisit.com/accommodation/list?channelId=<code>, also on the Nozio address
 * book2.nozio.com). The code alone, as the plugin saves it, is accepted as well.
 */
function astro_be_sanitize_bookvisit_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = strtolower( trim( $value ) );
	$code  = '([0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})';

	if ( preg_match( '#[?&]channelid=' . $code . '(?:[&\#]|$)#', $value, $matches ) ) {
		return $matches[1];
	}

	if ( preg_match( '#^' . $code . '$#', $value, $matches ) ) {
		return $matches[1];
	}

	return '';
}

/**
 * Sirvoy: the address of the page of the hotel website with the Sirvoy booking widget, which reads
 * the search from its own address. Any http or https address is accepted, without the fragment.
 */
function astro_be_sanitize_sirvoy_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = trim( preg_replace( '/\#.*$/', '', trim( $value ) ) );
	$value = esc_url_raw( $value, array( 'http', 'https' ) );

	return wp_http_validate_url( $value ) ? $value : '';
}

/**
 * Profitroom booking engine address: only the code of the property is kept (arcticcityhotel for
 * https://booking.profitroom.com/en/arcticcityhotel/pricelist/rooms/, also on the domain of the hotel,
 * and for the Upper Booking addresses such as https://wis.upperbooking.com/arcticcityhotel/be-panel).
 * The code alone, as the plugin saves it, is accepted as well.
 */
function astro_be_sanitize_profitroom_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = strtolower( trim( $value ) );

	if ( preg_match( '#^(?:https?://)?[a-z0-9.-]+/[a-z]{2}(?:-[a-z]{2})?/([a-z0-9]+)/(?:pricelist|offer|room)#', $value, $matches ) ) {
		return $matches[1];
	}

	if ( preg_match( '#^(?:(?:https?:)?//)?[a-z0-9]+\.upperbooking\.com/([a-z0-9]+)(?:[/?\#]|$)#', $value, $matches ) && 'js' !== $matches[1] ) {
		return $matches[1];
	}

	if ( preg_match( '/^[a-z0-9]+$/', $value ) ) {
		return $value;
	}

	return '';
}

/**
 * Profitroom: the age ranges of the children set for the hotel, kept as 0-3,4-14 (sorted, without
 * spaces). Ranges written wrong, with the minimum greater than the maximum or overlapping the previous
 * one are dropped; an empty value, or one with no valid range, gives the default ranges.
 */
function astro_be_sanitize_profitroom_children_ranges( $value ) {
	if ( ! is_string( $value ) || '' === trim( $value ) ) {
		return ASTRO_BE_PROFITROOM_CHILDREN_RANGES;
	}

	$ranges = array();
	foreach ( explode( ',', $value ) as $range ) {
		if ( preg_match( '/^\s*(\d{1,2})\s*-\s*(\d{1,2})\s*$/', $range, $matches ) && (int) $matches[1] <= (int) $matches[2] ) {
			$ranges[ (int) $matches[1] ] = array( (int) $matches[1], (int) $matches[2] );
		}
	}
	ksort( $ranges );

	// Le fasce non si sovrappongono: una fascia che comincia dentro la precedente viene scartata.
	$kept = array();
	$last = -1;
	foreach ( $ranges as $range ) {
		if ( $range[0] > $last ) {
			$kept[] = $range[0] . '-' . $range[1];
			$last   = $range[1];
		}
	}

	return $kept ? implode( ',', $kept ) : ASTRO_BE_PROFITROOM_CHILDREN_RANGES;
}

/**
 * Kross Booking booking engine address: only the code of the property is kept (hotelcampanello for
 * https://hotelcampanello.kross.travel/book/step1). The whole address is pasted by the user, also
 * the one of the Kross widget script (data.krossbooking.com/widget/v6/hotelcampanello/5.js); the code
 * alone, as the plugin saves it, is accepted as well.
 */
function astro_be_sanitize_krossbooking_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = strtolower( trim( $value ) );

	if ( preg_match( '#^(?:https?://)?([a-z0-9](?:[a-z0-9-]*[a-z0-9])?)\.kross\.travel(?:[/?\#]|$)#', $value, $matches ) ) {
		return $matches[1];
	}

	if ( preg_match( '#^(?:https?://)?data\.krossbooking\.com/widget/v\d+/([a-z0-9](?:[a-z0-9-]*[a-z0-9])?)/#', $value, $matches ) ) {
		return $matches[1];
	}

	if ( preg_match( '/^[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/', $value ) ) {
		return $value;
	}

	return '';
}

/**
 * Slope booking engine address: only the code of the property is kept (the one after
 * https://booking.slope.it/, such as 0a1b2c3d-4e5f-6a7b-8c9d-0e1f2a3b4c5d). The whole address is pasted
 * by the user; the code alone, as the plugin saves it, is accepted as well.
 */
function astro_be_sanitize_slope_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = strtolower( trim( $value ) );
	$code  = '([0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})';

	if ( preg_match( '#^(?:https?://)?booking\.slope\.it/(?:widgets/search/)?' . $code . '(?:[/?\#]|$)#', $value, $matches ) ) {
		return $matches[1];
	}

	if ( preg_match( '#^' . $code . '$#', $value, $matches ) ) {
		return $matches[1];
	}

	return '';
}

/**
 * Bedzzle booking engine address: only the key of the property is kept (the value of apikey in
 * https://booking.bedzzle.com/desktop/?apikey=AbCd1234&lang=). The whole address is pasted by the
 * user; the key alone, as the plugin saves it, is accepted as well.
 */
function astro_be_sanitize_bedzzle_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = trim( $value );

	if ( preg_match( '#[?&]apikey=([A-Za-z0-9]+)#', $value, $matches ) ) {
		return $matches[1];
	}

	if ( preg_match( '/^[A-Za-z0-9]{8,64}$/', $value ) ) {
		return $value;
	}

	return '';
}

/**
 * Booking Designer booking engine address: only the host name is kept (book.yourhotel.com for
 * https://book.yourhotel.com/en/booking-engine/), since every hotel has its own. The whole address
 * is pasted by the user; the host name alone, as the plugin saves it, is accepted as well.
 */
function astro_be_sanitize_bookingdesigner_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = strtolower( trim( $value ) );

	if ( preg_match( '#^(?:https?://)?((?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z]{2,})(?:[/?\#]|$)#', $value, $matches ) ) {
		return $matches[1];
	}

	return '';
}

/**
 * ErmesHotels booking engine address: the code of the hotel and the one of the channel, kept as
 * hotel/channel (2029/604 for https://book.ermeshotels.com/hotel/2029/channel/604/language/2/rooms).
 * The whole address is pasted by the user; hotel/channel alone, as the plugin saves it, is accepted.
 */
function astro_be_sanitize_ermeshotels_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = trim( $value );

	if ( preg_match( '#^(?:https?://)?book\.ermeshotels\.com/hotel/(\d+)/channel/(\d+)(?:[/?\#]|$)#i', $value, $matches ) ) {
		return $matches[1] . '/' . $matches[2];
	}

	if ( preg_match( '#^(\d+)/(\d+)$#', $value, $matches ) ) {
		return $matches[1] . '/' . $matches[2];
	}

	return '';
}

/**
 * Mirai booking engine address: the code of the booking engine and the one of the property,
 * kept as code/property. The whole address is pasted by the user.
 */
function astro_be_sanitize_mirai_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = trim( $value );

	if ( preg_match( '#reservation\.mirai\.com/([A-Za-z0-9_-]+)/#', $value, $matches ) ) {
		$code = $matches[1];
		if ( preg_match( '/[?&]idtokenprovider=(\d+)/i', $value, $property ) ) {
			return $code . '/' . $property[1];
		}
		return '';
	}

	// Anche il solo codice/struttura, come lo salva il plugin.
	if ( preg_match( '#^([A-Za-z0-9_-]+)/(\d+)$#', $value, $matches ) ) {
		return $matches[1] . '/' . $matches[2];
	}

	return '';
}

/**
 * ResNexus property: the code in the booking engine address, after /book/ or in the UID
 * parameter of the older addresses. The whole address is pasted by the user, and the code alone
 * is accepted too. It is the identifier ResNexus gives to the property, letters and numbers with
 * hyphens.
 */
function astro_be_sanitize_resnexus_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = trim( $value );

	if ( preg_match( '#/book/([A-Fa-f0-9-]{8,})#i', $value, $matches ) ) {
		return strtoupper( $matches[1] );
	}
	if ( preg_match( '/[?&]uid=([A-Fa-f0-9-]{8,})/i', $value, $matches ) ) {
		return strtoupper( $matches[1] );
	}

	return preg_match( '/^[A-Fa-f0-9-]{8,}$/', $value ) ? strtoupper( $value ) : '';
}

/**
 * ResNexus pets slot: the same numbered capacity slots of the children, with three as the usual
 * number of the pets one.
 */
function astro_be_sanitize_resnexus_pets_capacity( $value ) {
	$value = is_scalar( $value ) ? (int) $value : 0;

	return ( $value >= 2 && $value <= 6 ) ? (string) $value : '3';
}

/**
 * ResNexus children slot: the guest types after the adults are numbered capacity slots, set by
 * every property, so the number of the children one is a setting. Two is the usual one.
 */
function astro_be_sanitize_resnexus_children_capacity( $value ) {
	$value = is_scalar( $value ) ? (int) $value : 0;

	return ( $value >= 2 && $value <= 6 ) ? (string) $value : '2';
}

/**
 * ThinkReservations property: the name in the booking engine address, between the host and
 * /reservations. The whole address is pasted by the user, and the name alone is accepted too.
 */
function astro_be_sanitize_thinkreservations_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = trim( $value );
	$value = preg_replace( '#^https?://#i', '', $value );
	$value = preg_replace( '#[?\#].*$#', '', $value );

	if ( preg_match( '#^secure\.thinkreservations\.com/([A-Za-z0-9._-]+)#i', $value, $matches ) ) {
		return $matches[1];
	}

	return preg_match( '/^[A-Za-z0-9._-]+$/', $value ) ? $value : '';
}

/**
 * Amadeus iHotelier (TravelClick) property: the numeric code of the hotel. The whole address is
 * pasted by the user, of the reservations or of the bookings host, and the code is also accepted
 * on its own. It is the same code the address repeats in the HotelId parameter.
 */
function astro_be_sanitize_ihotelier_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = trim( $value );

	// travelclick.com/<codice> oppure ...?HotelId=<codice>
	if ( preg_match( '#travelclick\.com/(\d+)#i', $value, $matches ) ) {
		return $matches[1];
	}
	if ( preg_match( '/[?&]hotelid=(\d+)/i', $value, $matches ) ) {
		return $matches[1];
	}

	return preg_match( '/^\d+$/', $value ) ? $value : '';
}

/**
 * Amadeus iHotelier: the languages of the booking engine, as numeric id => name. The engine takes
 * the language as a number; an id the property does not have falls back to English without errors.
 */
function astro_be_ihotelier_languages() {
	return array(
		'1' => __( 'English', 'astro-booking-engine' ),
		'2' => __( 'Spanish', 'astro-booking-engine' ),
		'3' => __( 'French', 'astro-booking-engine' ),
		'7' => __( 'German', 'astro-booking-engine' ),
		'5' => __( 'Chinese', 'astro-booking-engine' ),
		'6' => __( 'Japanese', 'astro-booking-engine' ),
	);
}

/**
 * Amadeus iHotelier: the language of the page, as the code the booking engine uses.
 */
function astro_be_ihotelier_language_ids() {
	return array( 'en' => '1', 'es' => '2', 'fr' => '3', 'de' => '7', 'zh' => '5', 'ja' => '6' );
}

/**
 * Amadeus iHotelier: the language chosen in the settings, empty when it follows the page.
 */
function astro_be_sanitize_ihotelier_language( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}
	$value = trim( $value );
	return array_key_exists( $value, astro_be_ihotelier_languages() ) ? $value : '';
}

/**
 * Amadeus iHotelier: return the language id of the booking engine. The settings can fix one;
 * otherwise the language of the page is used when the booking engine has it, English otherwise.
 */
function astro_return_ihotelier_language() {

	$chosen = astro_be_get_sanitized_option( ASTRO_BE_PREFIX . 'ihotelier_language' );
	if ( $chosen ) {
		return $chosen;
	}

	$ids  = astro_be_ihotelier_language_ids();
	$lang = astro_return_post_language();

	return isset( $ids[ $lang ] ) ? $ids[ $lang ] : '1';
}

/**
 * Cloudbeds booking engine address: the host and the property, kept as host/property. The whole
 * address is pasted by the user, with or without the language segment, and the host can be the
 * general one (hotels.cloudbeds.com) or a regional one (us2.cloudbeds.com).
 */
function astro_be_sanitize_cloudbeds_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = trim( $value );
	$value = preg_replace( '#^https?://#i', '', $value );
	$value = preg_replace( '#[?\#].*$#', '', $value );

	// host[/lingua]/reservation/<struttura>
	if ( preg_match( '#^([a-z0-9.-]+\.cloudbeds\.com)/(?:[a-z]{2}/)?reservation/([A-Za-z0-9_-]+)#i', $value, $matches ) ) {
		return strtolower( $matches[1] ) . '/' . $matches[2];
	}

	// La forma gia' normalizzata, host/struttura: il valore salvato viene sanificato di nuovo
	// a ogni lettura, quindi deve passare anche la seconda volta.
	if ( preg_match( '#^([a-z0-9.-]+\.cloudbeds\.com)/([A-Za-z0-9_-]{3,})/?$#i', $value, $matches ) ) {
		return strtolower( $matches[1] ) . '/' . $matches[2];
	}

	return '';
}

/**
 * Cloudbeds: the languages of the booking engine, as code => name. A language which is not one
 * of these gives a 404, so only these are used in the address.
 */
function astro_be_cloudbeds_languages() {
	return array(
		'en' => __( 'English', 'astro-booking-engine' ),
		'es' => __( 'Spanish', 'astro-booking-engine' ),
		'it' => __( 'Italian', 'astro-booking-engine' ),
		'fr' => __( 'French', 'astro-booking-engine' ),
		'de' => __( 'German', 'astro-booking-engine' ),
		'pt' => __( 'Portuguese', 'astro-booking-engine' ),
		'nl' => __( 'Dutch', 'astro-booking-engine' ),
		'ru' => __( 'Russian', 'astro-booking-engine' ),
		'zh' => __( 'Chinese', 'astro-booking-engine' ),
		'ja' => __( 'Japanese', 'astro-booking-engine' ),
		'ko' => __( 'Korean', 'astro-booking-engine' ),
		'pl' => __( 'Polish', 'astro-booking-engine' ),
		'sv' => __( 'Swedish', 'astro-booking-engine' ),
		'no' => __( 'Norwegian', 'astro-booking-engine' ),
		'fi' => __( 'Finnish', 'astro-booking-engine' ),
		'el' => __( 'Greek', 'astro-booking-engine' ),
		'tr' => __( 'Turkish', 'astro-booking-engine' ),
		'he' => __( 'Hebrew', 'astro-booking-engine' ),
		'hu' => __( 'Hungarian', 'astro-booking-engine' ),
		'cs' => __( 'Czech', 'astro-booking-engine' ),
		'ro' => __( 'Romanian', 'astro-booking-engine' ),
		'th' => __( 'Thai', 'astro-booking-engine' ),
		'ca' => __( 'Catalan', 'astro-booking-engine' ),
		'sk' => __( 'Slovak', 'astro-booking-engine' ),
		'lt' => __( 'Lithuanian', 'astro-booking-engine' ),
		'et' => __( 'Estonian', 'astro-booking-engine' ),
	);
}

/**
 * Cloudbeds: the language chosen in the settings, empty when it follows the page.
 */
function astro_be_sanitize_cloudbeds_language( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}
	$value = strtolower( trim( $value ) );
	return array_key_exists( $value, astro_be_cloudbeds_languages() ) ? $value : '';
}

/**
 * Cloudbeds: return the language segment of the booking engine address. The settings can fix one;
 * otherwise the language of the page is used when the booking engine has it, English otherwise.
 * A language the booking engine does not have answers with a 404, so it is never used.
 */
function astro_return_cloudbeds_language() {

	$chosen = astro_be_get_sanitized_option( ASTRO_BE_PREFIX . 'cloudbeds_language' );
	if ( $chosen ) {
		return $chosen;
	}

	$lang = astro_return_post_language();

	return array_key_exists( $lang, astro_be_cloudbeds_languages() ) ? $lang : 'en';
}

/**
 * Reservit booking engine address: the two codes of the property, kept as custid/hotelid.
 * The whole address is pasted by the user, of the current booking engine
 * (secure.reservit.com/fo/booking/<custid>/<hotelid>/dates) or of the quick search
 * (reserhotel.php?id=<custid>&hotelid=<hotelid>), which carry the same two codes.
 */
function astro_be_sanitize_reservit_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = trim( $value );
	$value = preg_replace( '#^https?://#i', '', $value );

	// Indirizzo del motore: .../booking/<custid>/<hotelid>/...
	if ( preg_match( '#/booking/(\d+)/(\d+)#', $value, $matches ) ) {
		return $matches[1] . '/' . $matches[2];
	}

	// Ricerca rapida: ...?id=<custid>&hotelid=<hotelid>
	if ( preg_match( '#\?(.+)$#', $value, $matches ) ) {
		$query = array();
		parse_str( $matches[1], $query );

		$custid = isset( $query['id'] ) ? $query['id'] : ( isset( $query['custid'] ) ? $query['custid'] : '' );

		if ( preg_match( '/^\d+$/', (string) $custid ) && isset( $query['hotelid'] ) && preg_match( '/^\d+$/', (string) $query['hotelid'] ) ) {
			return $custid . '/' . $query['hotelid'];
		}

		return '';
	}

	// I soli due codici, separati dalla barra.
	if ( preg_match( '#^(\d+)/(\d+)/?$#', $value, $matches ) ) {
		return $matches[1] . '/' . $matches[2];
	}

	return '';
}

/**
 * HotelNetSolutions (OnePageBooking) booking engine address: the host and the property, kept
 * as host/property. The whole address is pasted by the user, with or without the parameters.
 */
function astro_be_sanitize_hotelnetsolutions_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = trim( $value );
	$value = preg_replace( '#^https?://#i', '', $value );
	$value = preg_replace( '#[?\#].*$#', '', $value );

	if ( preg_match( '#^([a-z0-9.-]+\.[a-z]{2,})/([A-Za-z0-9._-]+)/?$#i', $value, $matches ) ) {
		return strtolower( $matches[1] ) . '/' . $matches[2];
	}

	return '';
}

/**
 * D-EDGE booking engine address, kept as host and path. The whole address is pasted by the
 * user and it can be of either generation of the booking engine: the current one, which is
 * kept up to the language (secure-hotel-booking.com/d-edge/My-Hotel/ABCD/12345/en-US), or the
 * previous one, of which the host and the property are kept (book-secure.com/abcd12345).
 * The /d-edge/ path is what tells the two apart when the form is built.
 */
function astro_be_sanitize_dedge_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = trim( $value );
	$value = preg_replace( '#^https?://#i', '', $value );

	// Motore attuale: host/d-edge/…/<lingua>[/Pagina].
	if ( preg_match( '#^([a-z0-9.-]+)/d-edge/([^?\#]+)#i', $value, $matches ) ) {
		$host     = strtolower( $matches[1] );
		$segments = array_values( array_filter( explode( '/', $matches[2] ), 'strlen' ) );

		// L'indirizzo si ferma alla lingua: quello che segue è il nome della pagina.
		for ( $i = count( $segments ) - 1; $i >= 0; $i-- ) {
			// Stessa forma che il motore riconosce come lingua: en-US, fr-FR, nl.
			if ( preg_match( '/^[a-z]{2}(-[A-Za-z]+)?(-[A-Z]{2})?$/', $segments[ $i ] ) ) {
				return $host . '/d-edge/' . implode( '/', array_slice( $segments, 0, $i + 1 ) );
			}
		}

		return '';
	}

	// Motore precedente: host/index.php?…&property=<codice>.
	if ( preg_match( '#^([a-z0-9.-]+\.[a-z]{2,})/[^?]*\?(.+)$#i', $value, $matches ) ) {
		$host  = strtolower( $matches[1] );
		$query = array();
		parse_str( $matches[2], $query );

		if ( isset( $query['property'] ) && preg_match( '/^[A-Za-z0-9._-]+$/', $query['property'] ) ) {
			return $host . '/' . $query['property'];
		}

		return '';
	}

	// Motore precedente, con il solo codice della struttura: host/<codice>.
	if ( preg_match( '#^([a-z0-9.-]+\.[a-z]{2,})/([A-Za-z0-9._-]+)/?$#i', $value, $matches ) ) {
		return strtolower( $matches[1] ) . '/' . $matches[2];
	}

	return '';
}

/**
 * Roiback booking engine address: the host, which is usually the one of the property.
 * The whole address can be pasted.
 */
function astro_be_sanitize_roiback_hotel( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}
	$value = strtolower( trim( $value ) );
	$value = preg_replace( '#^https?://#', '', $value );
	$value = preg_replace( '#[/?\#].*$#', '', $value );

	return preg_match( '/^[a-z0-9.-]+\.[a-z]{2,}$/', $value ) ? $value : '';
}

/**
 * Roiback property code: also the value of the hotel field of a booking form is accepted,
 * which is the code with hotel_ in front of it.
 */
function astro_be_sanitize_roiback_code( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}
	$value = trim( $value );
	$value = preg_replace( '/^hotel_/i', '', $value );

	return preg_match( '/^[A-Za-z0-9._-]+$/', $value ) ? $value : '';
}

/**
 * Form style: the classic layout or the compact one. Empty or unknown means classic, so a
 * site updating from an earlier version keeps exactly the form it had.
 */
function astro_be_sanitize_form_style( $value ) {
	return ( is_string( $value ) && 'compact' === $value ) ? 'compact' : 'classic';
}

/**
 * Form density, for the compact style only: compact or roomy. Roomy gives 44x44 targets,
 * the size the WCAG recommend for touch.
 */
function astro_be_sanitize_form_density( $value ) {
	return ( is_string( $value ) && 'roomy' === $value ) ? 'roomy' : 'compact';
}

/**
 * Form width, for the modern style only: 'auto' makes the card as wide as its fields need,
 * 'full' stretches it to the whole content column, which is what a booking bar in a hero
 * section usually wants.
 */
function astro_be_sanitize_form_width( $value ) {
	return ( is_string( $value ) && 'full' === $value ) ? 'full' : 'auto';
}

/**
 * Form target: new or same window.
 */
function astro_be_sanitize_form_target( $value ) {
	return ( is_string( $value ) && in_array( $value, array( '_blank', '_self' ), true ) ) ? $value : '';
}

/**
 * Font weight: values of the Layout dropdown.
 */
function astro_be_sanitize_font_weight( $value ) {
	return ( is_string( $value ) && in_array( $value, array( 'normal', 'bold' ), true ) ) ? $value : '';
}

/**
 * Border style: values of the Layout dropdown.
 */
function astro_be_sanitize_border_style( $value ) {
	$border_styles = array('none', 'dashed', 'dotted', 'double', 'groove', 'hidden', 'inset', 'outset', 'ridge', 'solid');
	return ( is_string( $value ) && in_array( $value, $border_styles, true ) ) ? $value : '';
}

/**
 * Calendar theme: one of the themes shipped with the plugin.
 */
function astro_be_sanitize_calendar_theme( $value ) {
	return ( is_string( $value ) && in_array( $value, astro_be_calendar_themes(), true ) ) ? $value : '';
}

/**
 * Custom CSS: printed inside a <style> element, so HTML tags (such as </style>) are removed.
 */
function astro_be_sanitize_custom_css( $value ) {
	return is_string( $value ) ? wp_strip_all_tags( $value ) : '';
}

/**
 * Lists of options with dynamic rows (Iperbooking languages and treatments):
 * array( 'option_N' => array( 'code' => ..., 'url' => ... ) ).
 */
function astro_be_sanitize_options_list( $value ) {
	if ( ! is_array( $value ) ) {
		return array();
	}

	$options = array();
	foreach ( $value as $key => $option ) {
		if ( ! is_array( $option ) ) {
			continue;
		}
		$fields = array();
		foreach ( $option as $field => $field_value ) {
			if ( ! is_scalar( $field_value ) ) {
				continue;
			}
			$fields[ sanitize_key( $field ) ] = ( 'url' === $field ) ? esc_url_raw( $field_value ) : sanitize_text_field( $field_value );
		}
		$options[ sanitize_key( $key ) ] = $fields;
	}

	return $options;
}

/**
 * Former uninstall callback: it was registered on this file instead of the main plugin file,
 * so WordPress never ran it, and it did not delete anything. The options are now removed by
 * uninstall.php.
 *
 * @deprecated 2.1.0
 */
function astro_be_unregister_option_names() {
	_deprecated_function( __FUNCTION__, '2.1.0' );

	$tab = 'settings';
	$option_group = ASTRO_BE_PREFIX . '_' . $tab;
	$option_names = astro_be_option_names($tab);

	foreach ($option_names as $option_name) {
		register_setting( $option_group, $option_name, array( 'sanitize_callback' => astro_be_get_option_sanitize_callback( $option_name ) ) );
	}
}

/**
 * Return the Astro Booking Engine shortcode.
 */
function astro_be_shortcode_output() {
	// Get the Template
	$provider = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'provider');
	if (($provider == '') && current_user_can( 'manage_options' )) {
		$plugin_settings_url = admin_url('admin.php?page=astro-booking-engine');
		$str = '<div class="astro-error astro-error-no-provider">';
		$str .= esc_html__( 'This message is visible only to the site administrator.', 'astro-booking-engine' );
		$str .= '<br />';
		$str .= esc_html__( 'No provider has been selected in Astro Booking Engine plugin.', 'astro-booking-engine' );
		$str .= '<br />';
		$str .= esc_html__('Choose your provider at plugin', 'astro-booking-engine' );
		$str .= ' <a href="'.esc_url($plugin_settings_url).'">';
		$str .= esc_html__('settings page', 'astro-booking-engine' );
		$str .= '</a>.';
		$str .= '</div>';
		return $str;
	}

	if ($provider == '') {
		return '';
	}

	$template_file = plugin_dir_path(__FILE__) . 'templates/' .$provider.'.php';
	if (file_exists($template_file)) { // Check if the template file exists.
		ob_start();
		include($template_file);
		$content = ob_get_clean();
		return $content;
	}
}
add_shortcode('astro-booking-engine', 'astro_be_shortcode_output');

/**
 * Return the form action URL based on language.
 */
function astro_be_get_provider_form_action_url_language() {
	$provider = get_option(ASTRO_BE_PREFIX.'provider');

	$form_urls = get_option(ASTRO_BE_PREFIX.$provider.'_language');
	if ( ! is_array( $form_urls ) ) {
		return '';
	}

	if ( class_exists( 'SitePress' ) ) { //check if WPML is active
		$current_post_language = apply_filters( 'wpml_current_language', NULL );
	}else{ //No WPML; get WP language setting
		$current_post_language = substr( get_bloginfo("language"), 0, 2 );
	}

	foreach ( $form_urls as $option ) {
		if ( isset( $option['code'], $option['url'] ) && ( $option['url'] !== '' ) && ( strtolower( $option['code'] ) == strtolower( (string) $current_post_language ) ) ) {
			return $option['url'];
		}
	}

	//no language detected => set the default language provided
	$default_language_option = get_option(ASTRO_BE_PREFIX.$provider.'_language_default');
	if ( is_scalar( $default_language_option ) && isset( $form_urls[ $default_language_option ]['url'] ) ) {
		return $form_urls[ $default_language_option ]['url'];
	}

	return '';
}

/**
 * Turn a hex color into an array of RGB components, or false when the value is not a plain
 * opaque hex: a named color, an rgb() notation or a color with alpha depends on what sits
 * behind it, so its contrast cannot be computed here.
 */
function astro_be_hex_to_rgb( $value ) {

	if ( ! is_string( $value ) ) {
		return false;
	}
	$value = trim( $value );
	if ( ! preg_match( '/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6}|[0-9a-fA-F]{8})$/', $value ) ) {
		return false;
	}

	$hex = substr( $value, 1 );
	if ( 3 === strlen( $hex ) ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}
	if ( 8 === strlen( $hex ) ) {
		if ( 'ff' !== strtolower( substr( $hex, 6, 2 ) ) ) {
			return false; // trasparente: il contrasto dipende da cosa c'e' sotto
		}
		$hex = substr( $hex, 0, 6 );
	}

	return array(
		hexdec( substr( $hex, 0, 2 ) ),
		hexdec( substr( $hex, 2, 2 ) ),
		hexdec( substr( $hex, 4, 2 ) ),
	);
}

/**
 * Relative luminance of an RGB triplet, as defined by WCAG 2.x.
 */
function astro_be_relative_luminance( $rgb ) {

	$canali = array();
	foreach ( $rgb as $componente ) {
		$componente = $componente / 255;
		$canali[] = ( $componente <= 0.03928 ) ? ( $componente / 12.92 ) : pow( ( $componente + 0.055 ) / 1.055, 2.4 );
	}

	return ( 0.2126 * $canali[0] ) + ( 0.7152 * $canali[1] ) + ( 0.0722 * $canali[2] );
}

/**
 * Contrast ratio between two colors, from 1 to 21, or false when either one cannot be read.
 */
function astro_be_contrast_ratio( $primo, $secondo ) {

	$a = astro_be_hex_to_rgb( $primo );
	$b = astro_be_hex_to_rgb( $secondo );
	if ( ! $a || ! $b ) {
		return false;
	}

	$la = astro_be_relative_luminance( $a );
	$lb = astro_be_relative_luminance( $b );

	return ( max( $la, $lb ) + 0.05 ) / ( min( $la, $lb ) + 0.05 );
}

/**
 * Color pairs of the modern style that do not reach the 4.5:1 asked by WCAG AA.
 *
 * Only for the modern style: there the colors left empty fall back to known defaults, while
 * the classic form inherits them from the theme and there would be nothing to compare.
 */
function astro_be_layout_contrast_warnings() {

	if ( 'compact' !== astro_be_get_sanitized_option( ASTRO_BE_PREFIX . 'form_style' ) ) {
		return array();
	}

	$scelto = function( $opzione, $predefinito ) {
		$valore = astro_be_get_sanitized_option( ASTRO_BE_PREFIX . $opzione );
		return ( is_string( $valore ) && '' !== $valore ) ? $valore : $predefinito;
	};

	$sfondo = $scelto( 'widget-background-color', '#ffffff' );
	$testo  = $scelto( 'field-font-color', '#1e1e1e' );

	$coppie = array(
		array( __( 'Labels on the form background', 'astro-booking-engine' ), $scelto( 'label-font-color', '#6b7280' ), $sfondo ),
		array( __( 'Values on the form background', 'astro-booking-engine' ), $testo, $sfondo ),
		array( __( 'Values on the hover background', 'astro-booking-engine' ), $testo, $scelto( 'field-hover-background-color', '#fbfbfb' ) ),
		array( __( 'Submit button text on its background', 'astro-booking-engine' ), $scelto( 'submit-font-color', '#ffffff' ), $scelto( 'submit-background-color', '#404040' ) ),
	);

	$avvisi = array();
	foreach ( $coppie as $coppia ) {
		$rapporto = astro_be_contrast_ratio( $coppia[1], $coppia[2] );
		if ( false === $rapporto || $rapporto >= 4.5 ) {
			continue;
		}
		$avvisi[] = sprintf(
			/* translators: 1: name of the color pair, 2: contrast ratio, e.g. 3.10 */
			__( '%1$s: %2$s:1', 'astro-booking-engine' ),
			$coppia[0],
			number_format_i18n( $rapporto, 2 )
		);
	}

	return $avvisi;
}

/**
 * Return the custom Layout CSS classes.
 */
function astro_be_get_custom_layout() {

	$arr = array();

	/**
	 * Stile compatto: invece di ripetere i selettori si impostano le variabili una volta sola
	 * su .astro_be--compact, e la pelle le usa dove servono. Le opzioni sono le stesse del
	 * layout classico, cosi' chi passa allo stile nuovo ritrova i colori che aveva scelto.
	 */
	$vars = array();
	$mappa = array(
		'widget-background-color'     => '--abe-bg',
		'widget-border-radius'        => '--abe-radius',
		'label-font-color'            => '--abe-muted',
		'label-font-size'             => '--abe-label-size',
		'field-font-color'            => '--abe-fg',
		'field-font-size'             => '--abe-value-size',
		'field-border-color'          => '--abe-line',
		'field-hover-background-color'=> '--abe-hover',
		'submit-background-color'     => '--abe-accent',
		'submit-font-color'           => '--abe-accent-fg',
	);
	$con_px = array( '--abe-radius', '--abe-label-size', '--abe-value-size' );

	foreach ( $mappa as $opzione => $variabile ) {
		$valore = astro_be_get_sanitized_option( ASTRO_BE_PREFIX . $opzione );
		if ( '' === $valore || false === $valore ) {
			continue;
		}
		if ( in_array( $variabile, $con_px, true ) ) {
			$valore .= 'px';
		}
		$vars[] = $variabile . ':' . $valore;
	}
	if ( ! empty( $vars ) ) {
		$arr[] = array( 'class' => '.astro_be.astro_be--compact', 'prop' => implode( ';', $vars ) );
	}

	//Widget
	$widget = array();
	$widget_background_color = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'widget-background-color');
	if (!empty($widget_background_color)) {
		$widget[] = 'background-color:'.$widget_background_color;
	}
	$widget_border_radius = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'widget-border-radius');
	if (!empty($widget_border_radius)) {
		$widget[] = 'border-radius:'.$widget_border_radius.'px';
	}
	if (!empty($widget)) {
		$widget = implode(';', $widget);
		$arr[] = array('class' => '.astro_be', 'prop' => $widget);
	}

	//Label
	$label = array();
	$label_font_color = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'label-font-color');
	if (!empty($label_font_color)) {
		$label[] = 'color:'.$label_font_color;
	}
	$label_font_size = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'label-font-size');
	if (!empty($label_font_size)) {
		$label[] = 'font-size:'.$label_font_size.'px';
	}
	$label_font_weight = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'label-font-weight');
	if (!empty($label_font_weight)) {
		$label[] = 'font-weight:'.$label_font_weight;
	}
	if (!empty($label)) {
		$label = implode(';', $label);
		$arr[] = array('class' => '.astro_be .astro_be_label', 'prop' => $label);
	}

	//Field
	$field = array();
	$field_font_color = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'field-font-color');
	if (!empty($field_font_color)) {
		$field[] = 'color:'.$field_font_color;
	}
	$field_font_size = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'field-font-size');
	if (!empty($field_font_size)) {
		$field[] = 'font-size:'.$field_font_size.'px';
	}
	$field_font_weight = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'field-font-weight');
	if (!empty($field_font_weight)) {
		$field[] = 'font-weight:'.$field_font_weight;
	}
	$field_background_color = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'field-background-color');
	if (!empty($field_background_color)) {
		$field[] = 'background-color:'.$field_background_color;
	}
	$field_border_width = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'field-border-width');
	if (!empty($field_border_width)) {
		$field[] = 'border-width:'.$field_border_width.'px';
	}
	$field_border_style = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'field-border-style');
	if (!empty($field_border_style)) {
		$field[] = 'border-style:'.$field_border_style;
	}
	$field_border_color = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'field-border-color');
	if (!empty($field_border_color)) {
		$field[] = 'border-color:'.$field_border_color;
	}
	$field_border_radius = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'field-border-radius');
	if (!empty($field_border_radius)) {
		$field[] = 'border-radius:'.$field_border_radius.'px';
	}
	if (!empty($field)) {
		$field = implode(';', $field);
		$arr[] = array('class' => '.astro_be .astro_be_input:not(.astro_be_input-submit_button),.astro_be_select', 'prop' => $field);
	}

	//Submit
	$submit = array();
	$submit_font_color = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'submit-font-color');
	if (!empty($submit_font_color)) {
		$submit[] = 'color:'.$submit_font_color;
	}
	$submit_font_size = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'submit-font-size');
	if (!empty($submit_font_size)) {
		$submit[] = 'font-size:'.$submit_font_size.'px';
	}
	$submit_font_weight = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'submit-font-weight');
	if (!empty($submit_font_weight)) {
		$submit[] = 'font-weight:'.$submit_font_weight;
	}
	$submit_background_color = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'submit-background-color');
	if (!empty($submit_background_color)) {
		$submit[] = 'background-color:'.$submit_background_color;
	}
	$submit_border_width = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'submit-border-width');
	if (!empty($submit_border_width)) {
		$submit[] = 'border-width:'.$submit_border_width.'px';
	}
	$submit_border_style = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'submit-border-style');
	if (!empty($submit_border_style)) {
		$submit[] = 'border-style:'.$submit_border_style;
	}
	$submit_border_color = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'submit-border-color');
	if (!empty($submit_border_color)) {
		$submit[] = 'border-color:'.$submit_border_color;
	}
	$submit_border_radius = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'submit-border-radius');
	if (!empty($submit_border_radius)) {
		$submit[] = 'border-radius:'.$submit_border_radius.'px';
	}
	if (!empty($submit)) {
		$submit = implode(';', $submit);
		$arr[] = array('class' => '.astro_be .astro_be_input-submit_button', 'prop' => $submit);
	}

	$custom_css = astro_be_get_sanitized_option(ASTRO_BE_PREFIX.'custom-css');

	$str = false;
	if (!empty($arr) || !empty($custom_css)) {
		foreach ($arr as $item) {
			$str .= $item['class'].'{'.$item['prop'].';}';
		}
		$str .= $custom_css;
	}

	return $str;
}

/**
 * Return the post language.
 */
function astro_get_post_language() {
	$wp_page_language = get_bloginfo("language");

	if (str_contains($wp_page_language, '-')) {
		$wp_page_language = explode('-', $wp_page_language);
		$wp_page_language = $wp_page_language[0];
	}

	return $wp_page_language;
}

/**
 * Return the post language.
 */
function astro_return_post_language() {
	$lang = astro_get_post_language();
	$lang = strtolower($lang);

	return $lang;
}

/**
 * ErmesHotels: return the language as the number the booking engine uses in its address.
 * The languages it does not have fall back to English.
 */
function astro_return_ermeshotels_language_id() {

	$ids = array( 'en' => 1, 'it' => 2, 'de' => 3, 'fr' => 4, 'es' => 5, 'zh' => 6, 'ru' => 7, 'pt' => 8 );
	$lang = astro_return_post_language();

	return isset( $ids[ $lang ] ) ? $ids[ $lang ] : 1;
}

/**
 * Booking Designer: return the language.
 * The language is a segment of the booking engine address; the hotels have it in Italian, English,
 * German and French, and a language they do not have opens the page in Italian: the other languages
 * fall back to English.
 */
function astro_return_bookingdesigner_language() {

	$lang = astro_return_post_language();

	if ( ! in_array( $lang, array( 'it', 'en', 'de', 'fr' ), true ) ) {
		$lang = 'en';
	}

	return $lang;
}

/**
 * DIRS21: return the culture, the language and the country, such as it-IT. The languages the booking
 * engine does not have fall back to British English.
 */
function astro_return_dirs21_culture() {

	$cultures = array( 'de' => 'de-DE', 'en' => 'en-GB', 'it' => 'it-IT', 'fr' => 'fr-FR', 'es' => 'es-ES', 'nl' => 'nl-NL', 'da' => 'da-DK', 'pl' => 'pl-PL', 'cs' => 'cs-CZ' );
	$lang = astro_return_post_language();

	return isset( $cultures[ $lang ] ) ? $cultures[ $lang ] : 'en-GB';
}

/**
 * Bookvisit: return the culture, as the Bookvisit widgets name it. Every channel has its own languages
 * and opens in its main one with the others; the languages Bookvisit does not know fall back to
 * British English.
 */
function astro_return_bookvisit_culture() {

	$cultures = array( 'sv' => 'sv-SE', 'en' => 'en-GB', 'de' => 'de-DE', 'da' => 'da-DK', 'nb' => 'no-NO', 'nn' => 'no-NO', 'no' => 'no-NO', 'fr' => 'fr-FR', 'it' => 'it-IT', 'es' => 'es-ES', 'fi' => 'fi-FI', 'ja' => 'ja-JP', 'ru' => 'ru-RU', 'lt' => 'lt-LT', 'lv' => 'lv-LV', 'et' => 'et-EE', 'pt' => 'pt-PT', 'nl' => 'nl-NL', 'ar' => 'ar-SA', 'ko' => 'ko-KR', 'zh' => 'zh-CN', 'is' => 'is-IS', 'ka' => 'ka-GE' );
	$lang = astro_return_post_language();

	return isset( $cultures[ $lang ] ) ? $cultures[ $lang ] : 'en-GB';
}

/**
 * Sirvoy: return the language of the widget. Only the languages of the pages written in one of
 * them are sent; with the others the widget chooses by itself.
 */
function astro_return_sirvoy_language() {

	$lang = astro_return_post_language();

	return in_array( $lang, array( 'en', 'sv', 'da', 'fi', 'de', 'fr', 'es', 'it', 'nl' ), true ) ? $lang : '';
}

/**
 * Profitroom: return the language, a segment of the booking engine address. The languages it does
 * not have fall back to English.
 */
function astro_return_profitroom_language() {

	$lang = astro_return_post_language();

	if ( ! in_array( $lang, array( 'en', 'pl', 'de', 'it', 'fr', 'es', 'cs', 'sk', 'hu', 'nl', 'fi', 'sv', 'da', 'ru', 'uk', 'pt' ), true ) ) {
		$lang = 'en';
	}

	return $lang;
}

/**
 * Kross Booking: return the language.
 * Every property has its own languages, and opens in its main one with the others: Italian and
 * English are always there, German, French and Spanish are sent when the page is in those
 * languages, the other languages fall back to English.
 */
function astro_return_krossbooking_language() {

	$lang = astro_return_post_language();

	if ( ! in_array( $lang, array( 'it', 'en', 'de', 'fr', 'es' ), true ) ) {
		$lang = 'en';
	}

	return $lang;
}

/**
 * Bedzzle: return the language.
 * The booking engine is translated into these languages, and opens in Italian with the others:
 * those fall back to English.
 */
function astro_return_bedzzle_language() {

	$lang = astro_return_post_language();

	if ( ! in_array( $lang, array( 'it', 'en', 'de', 'fr', 'es' ), true ) ) {
		$lang = 'en';
	}

	return $lang;
}

/**
 * Beddy: return the language.
 * The booking engine is translated into these languages only: the others fall back to English.
 */
function astro_return_beddy_language() {

	$lang = astro_return_post_language();

	if ( ! in_array( $lang, array( 'it', 'en', 'es', 'fr', 'de', 'ru', 'ja' ), true ) ) {
		$lang = 'en';
	}

	return $lang;
}

/**
 * BeGenius: return the language.
 * The language is a segment of the booking engine address, which returns a 404 for the
 * languages it does not support: those fall back to English.
 */
function astro_return_begenius_language() {

	$lang = astro_return_post_language();

	if ( ! in_array( $lang, array( 'it', 'en', 'de', 'fr', 'es', 'pt' ), true ) ) {
		$lang = 'en';
	}

	return $lang;
}

/**
 * Mews: return the language in the xx-YY format (the WordPress site language, e.g. it-IT).
 * Mews opens the property default language when the language is not supported.
 */
function astro_return_mews_language() {
	return get_bloginfo( 'language' );
}

/**
 * Octorate: return the language, among the ones of the booking engine (English otherwise).
 */
function astro_return_octorate_language() {

	$lang = strtoupper( astro_get_post_language() );

	if ( ! in_array( $lang, array( 'IT', 'EN', 'FR', 'ES', 'DE', 'RU', 'PT', 'NL', 'JA', 'EL', 'TR', 'ZH', 'CA', 'RO' ), true ) ) {
		$lang = 'EN';
	}

	return $lang;
}

/**
 * Scidoo: return the language number of the booking engine (English otherwise).
 */
function astro_return_scidoo_language() {

	$languages = array( 'it' => 0, 'en' => 1, 'es' => 2, 'fr' => 3, 'de' => 4, 'ru' => 5 );
	$lang = astro_return_post_language();

	return isset( $languages[ $lang ] ) ? $languages[ $lang ] : 1;
}

/**
 * Vertical Booking: return the language.
 */
function astro_return_verticalbooking_language() {

	$lang = astro_get_post_language();
	$lang = strtolower($lang);

	switch ($lang) {
		case 'it' :  $lang = 'ita'; break;
		case 'de' :  $lang = 'deu'; break;
		case 'fr' :  $lang = 'fra'; break;
		case 'es' :  $lang = 'esp'; break;
		case 'ru' :  $lang = 'rus'; break;
		case 'nl' :  $lang = 'dut'; break;
		case 'pt' :  $lang = 'por'; break;
		case 'fi' :  $lang = 'fin'; break;
		case 'el' :  $lang = 'ell'; break;
		case 'zh' :  $lang = 'chi'; break;
		case 'ko' :  $lang = 'kor'; break;
		case 'ja' :  $lang = 'jpn'; break;
		case 'th' :  $lang = 'tha'; break;
		case 'vi' :  $lang = 'vie'; break;
		case 'bg' :  $lang = 'bul'; break;
		case 'no' :  $lang = 'nor'; break;
		case 'nb' :  $lang = 'nor'; break; //Norwegian Bokmål
		case 'nn' :  $lang = 'nor'; break; //Norwegian Nynorsk
		case 'sv' :  $lang = 'sve'; break;
		case 'ro' :  $lang = 'ron'; break;
		case 'pl' :  $lang = 'pls'; break;
		case 'hu' :  $lang = 'hun'; break;
		case 'sl' :  $lang = 'slo'; break;
		case 'cz' :  $lang = 'cze'; break;
		case 'da' :  $lang = 'dan'; break;
		case 'ca' :  $lang = 'cat'; break;
		default : //'eng', 'usa', 'etn', 'bra'
			$lang = 'eng';
	}

	return $lang;
}


/**
 * Return the list of currencies.
 * Generated from https://www.html-code-generator.com/php/array/currency-names
 */
function astro_return_currencies() {
	$currency_list = array(
		"EUR","USD","AED","AFA","ALL","AMD","ANG","AOA","ARS","AUD","AWG","AZN","BAM","BBD","BDT","BEF","BGN","BHD","BIF","BMD","BND","BOB","BRL","BSD","BTC","BTN","BWP","BYR","BZD",
		"CAD","CDF","CHF","CLF","CLP","CNY","COP","CRC","CUC","CVE","CZK","DEM","DJF","DKK","DOP","DZD","EEK","EGP","ERN","ETB","FJD","FKP","GBP","GEL","GHS","GIP","GMD","GNF","GRD",
		"GTQ","GYD","HKD","HNL","HRK","HTG","HUF","IDR","ILS","INR","IQD","IRR","ISK","ITL","JMD","JOD","JPY","KES","KGS","KHR","KMF","KPW","KRW","KWD","KYD","KZT","LAK","LBP","LKR",
		"LRD","LSL","LTC","LTL","LVL","LYD","MAD","MDL","MGA","MKD","MMK","MNT","MOP","MRO","MUR","MVR","MWK","MXN","MYR","MZM","NAD","NGN","NIO","NOK","NPR","NZD","OMR","PAB","PEN",
		"PGK","PHP","PKR","PLN","PYG","QAR","RON","RSD","RUB","RWF","SAR","SBD","SCR","SDG","SEK","SGD","SHP","SKK","SLL","SOS","SRD","SSP","STD","SVC","SYP","SZL","THB","TJS","TMT",
		"TND","TOP","TRY","TTD","TWD","TZS","UAH","UGX","UYU","UZS","VEF","VND","VUV","WST","XAF","XCD","XDR","XOF","XPF","YER","ZAR","ZMK","ZWL"
	);
	return $currency_list;
}


function astro_print_checkin_checkout_datepicker_format() {
	/*
	Formats:
		01 march 2023 -> dd MM yy
		2023-03-01 -> yy-mm-dd
		01/03/2023 -> dd/mm/yy
		03/01/2023 -> mm/dd/yy

	PHP to JS:
		Y -> yy
		m -> mm
		j -> dd
		F -> MM

	Combination for select dropdown:
			j F Y day Month year
			Y-m-d year-month-day
			m/d/Y month/day/year
			d/m/Y day/month/year
	*/

	$wp_date_format = get_option('date_format');
	$wp_date_format = str_replace('F', 'MM', $wp_date_format);
	$wp_date_format = str_replace('j', 'dd', $wp_date_format);
	$wp_date_format = str_replace('Y', 'yy', $wp_date_format);
	$wp_date_format = str_replace('m', 'mm', $wp_date_format);

	return $wp_date_format;
}
