<?php
if( ! is_admin() ) {
	return;
}

/**
 * Add the plugin link to the admin menu.
 */
add_action( 'admin_menu', 'astro_be_menu' );

/*function my_admin_menu() {
	add_menu_page(
		'AstroThemes',
		'AstroThemes Menu',
		'manage_options',
		'astro-booking-engine',
		'myplguin_admin_page',
		plugin_dir_url( __FILE__ ) . 'images/astrothemes-icon.png',
		999
	);
}

function myplguin_admin_page(){
	echo 'Welcome to admin page';
}
my_admin_menu();*/

/**
 * Add the config for the admin menu.
 */
function astro_be_menu() {
    add_options_page( 'Astro Booking Engine Options', 'Astro Booking Engine', 'manage_options', 'astro-booking-engine', 'astro_be_options' );
}

/**
 * Load Admin files.
 */
function astro_be_load_admin_files() {
    if(!is_admin_bar_showing()) return;

	/**
	 * Main admin styles and scripts
	 */
	wp_enqueue_style ( 'astro-booking-engine-admin-styles', plugins_url('/css/astro-booking-engine-admin.css', __FILE__), array(), astro_be_plugin_data('Version') );

	wp_register_script( 'astro-booking-engine-admin-scripts', plugins_url('/js/astro-booking-engine-admin.js', __FILE__), array('jquery'), astro_be_plugin_data('Version'), true );
	wp_enqueue_script( 'astro-booking-engine-admin-scripts' );

	/**
	 * Include WP Iris color picker.
	 */
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script(
		'iris',
		admin_url( 'js/iris.min.js' ),
		array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ),
		false,
		1
	);
	wp_enqueue_script(
		'wp-color-picker',
		admin_url( 'js/color-picker.min.js' ),
		array( 'iris' ),
		false,
		1
	);
	$colorpicker_l10n = array(
		'clear' => __( 'Clear', 'astro-booking-engine' ),
		'defaultString' => __( 'Default', 'astro-booking-engine' ),
		'pick' => __( 'Select Color', 'astro-booking-engine' ),
		'current' => __( 'Current Color', 'astro-booking-engine' ),
	);
	wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n );

	/**
     * Include the plugin navigation.
     */
    include(plugin_dir_path(__FILE__) . 'includes/tabs/tabs-nav.php');
}
add_action( 'admin_enqueue_scripts', 'astro_be_load_admin_files' );

/**
 * Register options settings.
 */
function astro_be_register_settings() {

    if (isset($_REQUEST['option_page']) && !empty($_REQUEST['option_page'])) {
        $option_page = sanitize_text_field($_REQUEST['option_page']);
        $tab = explode('_', $option_page);
		$option_group = $option_page;
		$option_names = astro_be_option_names(end($tab));

        if (!empty($option_names)) {

			foreach ($option_names as $option_name) {
				$arr = array();
				if (strpos($option_name, '_options')) {
					$arr = array('type' => 'array');
				}
				register_setting( $option_group, $option_name, array($arr) );
			}

		}

    }else{
		$tab = 'settings';
		$option_group = ASTRO_BE_PREFIX . '_' . $tab;
		$option_names = astro_be_option_names($tab);

		if (!empty($option_names)) {
			foreach ($option_names as $option_name) {
				$arr = array();
				if (strpos($option_name, '_options')) {
					$arr = array('type' => 'array');
				}
				register_setting($option_group, $option_name, array($arr));
			}
		}

		$tab = 'layout';
		$option_group = ASTRO_BE_PREFIX . '_' . $tab;
		$option_names = astro_be_option_names($tab);

		if (!empty($option_names)) {

            foreach ($option_names as $option_name) {
                $arr = array();
                if (strpos($option_name, '_options')) {
                    $arr = array('type' => 'array');
                }
                register_setting( $option_group, $option_name, array($arr) );
            }

		}
    }

}
add_action( 'admin_init', 'astro_be_register_settings' );

/**
 * Display the plugin panel to do define the settings.
 */
function astro_be_options() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.', 'astro-booking-engine' ) );
    }

    ?>
    <div class="wrap">
        <h1><?php echo astro_be_plugin_data('Name'); ?></h1>
        <?php

        $tab  = 'settings'; // default panel
        if (isset($_REQUEST['tab']) && !empty($_REQUEST['tab'])) {
            $tab  = sanitize_text_field($_REQUEST['tab']);
        }

		astro_be_tabs_nav($tab);

        include( plugin_dir_path( __FILE__ ) . 'includes/tabs/tab-' . $tab .'.php' );

        ?>
    </div>
    <?php
}