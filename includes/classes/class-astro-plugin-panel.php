<?php
/**
 * AstroThemes Plugin Panel Class.
 *
 * @class   Astro_Plugin_Panel
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (!class_exists('Astro_Plugin_Panel')) {

	class Astro_Plugin_Panel {
		public function __construct() {
			add_action('admin_menu', array($this, 'astro_plugin_panel_pages'));
		}

		public function astro_plugin_panel_pages() {
			$page_title = 'AstroThemes';
			$menu_title = 'AstroThemes';
			$capability = 'manage_options';
			$slug = 'astro-plugin-panel';
			$callback = '';
			$icon = plugin_dir_url( __FILE__ ) . '../../images/astrothemes-icon.png';
			$position = 80;
			add_menu_page($page_title, $menu_title, $capability, $slug, $callback, $icon, $position);

			do_action( 'astro_plugin_panel_pages' );

			$this->remove_duplicate_submenu_page();
		}

		public function remove_duplicate_submenu_page() {
			remove_submenu_page( 'astro-plugin-panel', 'astro-plugin-panel' );
		}

	}

	new Astro_Plugin_Panel();

}

