<?php
if( ! is_admin() ) {
	return;
}

function astro_be_tabs_nav($panel) {

	// active tab class
	$active_class = 'nav-tab-active';

	echo '<nav class="nav-tab-wrapper">';

	echo '<a href="?page='.urlencode_deep(ASTRO_BE_TEXTDOMAIN).'&amp;tab=settings" class="nav-tab ';
	if ($panel == 'settings') { echo esc_attr($active_class); }
	echo '">' . esc_html__('Settings', 'astro-booking-engine' ) . '</a>';

	echo '<a href="?page='.urlencode_deep(ASTRO_BE_TEXTDOMAIN).'&amp;tab=layout" class="nav-tab ';
	if ($panel == 'layout') { echo esc_attr($active_class); }
	echo '">' . esc_html__('Layout', 'astro-booking-engine' ) . '</a>';

	echo '<a href="?page='.urlencode_deep(ASTRO_BE_TEXTDOMAIN).'&amp;tab=support" class="nav-tab ';
	if ($panel == 'support') { echo esc_attr($active_class); }
	echo '">' . esc_html__('Support', 'astro-booking-engine' ) . '</a>';

	echo '</nav>';

}