<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! is_admin() ) {
	return;
}

/**
 * Load Admin files.
 */
function astro_be_load_admin_files() {
    if( !is_admin_bar_showing() ) return;

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

	$option_page = isset( $_REQUEST['option_page'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['option_page'] ) ) : '';

	if ( $option_page !== '' ) {

		if ( strpos( $option_page, ASTRO_BE_PREFIX ) === 0 ) {
			$tab = explode( '_', $option_page );
			astro_be_register_option_group( $option_page, end( $tab ) );
		}

	}else{
		astro_be_register_option_group( ASTRO_BE_PREFIX . '_settings', 'settings' );
		astro_be_register_option_group( ASTRO_BE_PREFIX . '_layout', 'layout' );
	}

}

/**
 * Register the options of a settings tab, each one with its sanitize callback.
 */
function astro_be_register_option_group( $option_group, $tab ) {

	$option_names = astro_be_option_names( $tab );
	if ( empty( $option_names ) ) {
		return;
	}

	foreach ( $option_names as $option_name ) {

		// Fixed values listed with the options (such as the form method 'get') are not option names.
		if ( strpos( $option_name, ASTRO_BE_PREFIX ) !== 0 ) {
			continue;
		}

		$sanitize_callback = astro_be_get_option_sanitize_callback( $option_name );

		register_setting( $option_group, $option_name, array(
			'type'              => ( 'astro_be_sanitize_options_list' === $sanitize_callback ) ? 'array' : 'string',
			'sanitize_callback' => $sanitize_callback,
		) );
	}

}
add_action( 'admin_init', 'astro_be_register_settings' );

/**
 * Display the plugin pages in menu.
 */
if (class_exists('Astro_Plugin_Panel')) {

	add_action('astro_plugin_panel_pages', 'astro_be_plugin_panel_submenu');

	function astro_be_plugin_panel_submenu() {
		add_submenu_page(
			'astro-plugin-panel',
			__('Booking engine', 'astro-booking-engine'),
			__('Booking engine', 'astro-booking-engine'),
			'manage_options',
			'astro-booking-engine',
			'astro_be_options'
		);
	}

}

/**
 * Review notice: handle the choice links (nonce + capability), then redirect.
 */
add_action( 'admin_init', 'astro_be_review_notice_actions' );
function astro_be_review_notice_actions() {

	if ( ! isset( $_GET['astro_be_review'] ) ) {
		return;
	}

	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$astro_be_nonce = isset( $_GET['nonce'] ) ? sanitize_text_field( wp_unslash( $_GET['nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $astro_be_nonce, 'astro_be_review_notice' ) ) {
		return;
	}

	$action = sanitize_text_field( wp_unslash( $_GET['astro_be_review'] ) );
	$settings_url = admin_url( 'admin.php?page=' . ASTRO_BE_TEXTDOMAIN );

	switch ( $action ) {
		case 'write' :
			update_option( ASTRO_BE_PREFIX . 'review_notice_dismissed', 'done' );
			wp_redirect( 'https://wordpress.org/support/plugin/astro-booking-engine/reviews/#new-post' );
			exit;

		case 'done' :
			update_option( ASTRO_BE_PREFIX . 'review_notice_dismissed', 'done' );
			wp_safe_redirect( $settings_url );
			exit;

		case 'later' :
			update_option( ASTRO_BE_PREFIX . 'review_notice_dismissed', time() + ( 30 * DAY_IN_SECONDS ) );
			wp_safe_redirect( $settings_url );
			exit;
	}

}

/**
 * Review notice: shown only on the plugin settings page, only to manage_options,
 * and only after the provider has been configured for at least 30 days.
 */
add_action( 'admin_notices', 'astro_be_review_notice' );
function astro_be_review_notice() {

	// Only on the plugin settings page.
	$page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : '';
	if ( $page !== ASTRO_BE_TEXTDOMAIN ) {
		return;
	}

	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// Only when the plugin is really in use.
	$provider = get_option( ASTRO_BE_PREFIX . 'provider' );
	if ( ! $provider ) {
		return;
	}

	// The 30 days start when the provider is first seen configured.
	$start = (int) get_option( ASTRO_BE_PREFIX . 'review_notice_start' );
	if ( ! $start ) {
		update_option( ASTRO_BE_PREFIX . 'review_notice_start', time() );
		return;
	}
	if ( ( time() - $start ) < ( 30 * DAY_IN_SECONDS ) ) {
		return;
	}

	$dismissed = get_option( ASTRO_BE_PREFIX . 'review_notice_dismissed' );
	if ( $dismissed === 'done' ) {
		return;
	}
	if ( $dismissed && (int) $dismissed > time() ) { // "Maybe later" still active.
		return;
	}

	$nonce = wp_create_nonce( 'astro_be_review_notice' );
	$settings_url = admin_url( 'admin.php?page=' . ASTRO_BE_TEXTDOMAIN );

	$write_url = add_query_arg( array( 'astro_be_review' => 'write', 'nonce' => $nonce ), $settings_url );
	$done_url  = add_query_arg( array( 'astro_be_review' => 'done',  'nonce' => $nonce ), $settings_url );
	$later_url = add_query_arg( array( 'astro_be_review' => 'later', 'nonce' => $nonce ), $settings_url );

	?>
	<div class="notice notice-info astro-be-review-notice">
		<p>
			<strong><?php esc_html_e( 'Do you enjoy Astro Booking Engine?', 'astro-booking-engine' ); ?></strong><br />
			<?php esc_html_e( 'You have been using it for a while: a review on WordPress.org would help other users discover it. Thank you!', 'astro-booking-engine' ); ?>
		</p>
		<p>
			<a href="<?php echo esc_url( $write_url ); ?>" class="button button-primary"><?php esc_html_e( 'Sure, I\'ll write a review', 'astro-booking-engine' ); ?></a>
			&nbsp;<a href="<?php echo esc_url( $done_url ); ?>"><?php esc_html_e( 'I\'ve already reviewed it', 'astro-booking-engine' ); ?></a>
			&nbsp;|&nbsp;<a href="<?php echo esc_url( $later_url ); ?>"><?php esc_html_e( 'Maybe later', 'astro-booking-engine' ); ?></a>
		</p>
	</div>
	<?php

}

/**
 * Display the plugin panel to do define the settings.
 */
function astro_be_options() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'astro-booking-engine' ) );
    }

    ?>
    <div class="wrap">
        <h1><?php echo esc_html( astro_be_plugin_data('Name') ); ?></h1>
        <?php

        // The tab becomes part of an included file path: only the known tabs are accepted.
        $tab = isset( $_GET['tab'] ) ? sanitize_key( wp_unslash( $_GET['tab'] ) ) : '';
        if ( ! in_array( $tab, array( 'settings', 'layout', 'support' ), true ) ) {
            $tab = 'settings'; // default panel
        }

		astro_be_tabs_nav($tab);

		include( plugin_dir_path( __FILE__ ) . 'includes/tabs/tab-' . $tab .'.php' );

        ?>
    </div>
    <?php
}