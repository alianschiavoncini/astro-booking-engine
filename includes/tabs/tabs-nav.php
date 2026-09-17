<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! is_admin() ) {
	return;
}

function astro_be_tabs_nav($panel) {

	$tabs = array(
		'settings' => __( 'Settings', 'astro-booking-engine' ),
		'layout'   => __( 'Layout', 'astro-booking-engine' ),
		'support'  => __( 'Support', 'astro-booking-engine' ),
	);

	echo '<nav class="nav-tab-wrapper">';

	foreach ( $tabs as $tab => $label ) {
		$url = add_query_arg( array( 'page' => ASTRO_BE_TEXTDOMAIN, 'tab' => $tab ), admin_url( 'admin.php' ) );
		$class = ( $panel === $tab ) ? 'nav-tab nav-tab-active' : 'nav-tab';
		echo '<a href="' . esc_url( $url ) . '" class="' . esc_attr( $class ) . '">' . esc_html( $label ) . '</a>';
	}

	echo '</nav>';

}
