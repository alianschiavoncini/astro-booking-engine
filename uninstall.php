<?php
/**
 * Astro Booking Engine uninstall: remove the plugin data when the plugin is deleted.
 *
 * Run by WordPress only when the plugin is deleted from the Plugins screen, never on
 * deactivation. All the plugin options share the astro_be_ prefix; the widget instances are
 * stored in widget_astro_be.
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

function astro_be_uninstall_delete_options() {
	global $wpdb;

	$option_names = $wpdb->get_col(
		$wpdb->prepare( "SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE %s", $wpdb->esc_like( 'astro_be_' ) . '%' )
	);

	foreach ( $option_names as $option_name ) {
		delete_option( $option_name );
	}

	delete_option( 'widget_astro_be' );
}

if ( is_multisite() ) {
	foreach ( get_sites( array( 'fields' => 'ids', 'number' => 0 ) ) as $astro_be_site_id ) {
		switch_to_blog( $astro_be_site_id );
		astro_be_uninstall_delete_options();
		restore_current_blog();
	}
} else {
	astro_be_uninstall_delete_options();
}
