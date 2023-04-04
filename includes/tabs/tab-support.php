<?php
if( ! is_admin() ) {
	return;
}

function astro_be_delete_options_prefixed( $prefix ) {
	global $wpdb;
	$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '{$prefix}%'" );
}

$delete_options = false;
if (isset($_GET['delete_options']) && ($_GET['delete_options'] == 1)) {
	astro_be_delete_options_prefixed( ASTRO_BE_PREFIX );
	$delete_options = __( 'All the plugin options have deleted.', 'astro-booking-engine' );
}

$tab = 'support';
$option_group = ASTRO_BE_PREFIX . $tab;

settings_fields($option_group);
do_settings_sections($option_group);
?>
<div class="<?php echo ASTRO_BE_PREFIX . 'wrapper'; ?> <?php echo esc_attr( $option_group ); ?>">

    <div class="section-wrapper">
        <div class="section-wrapper-inner">

            <h2 id="support" class="title"><?php _e('Support', 'astro-booking-engine' ); ?></h2>

            <h3 id="support-configuration" class="title"><?php _e( 'How to start with this plugin', 'astro-booking-engine' ); ?></h3>
            <ol>
                <li><?php _e( 'Get data settings from your booking engine provider; if you don\'t have one, you need to adopt one', 'astro-booking-engine' ); ?> (<a href="#support-providers-list"><?php _e( 'see the list of currently available providers', 'astro-booking-engine' ); ?></a>)</li>
                <li><?php _e( 'Select the provider name and configure its settings', 'astro-booking-engine' ); ?></li>
                <li><?php _e( 'Configure the booking form layout (optional)', 'astro-booking-engine' ); ?></li>
                <li><?php _e( 'Use the [astro-booking-engine] shortcode in your post/page content or add the Astro Booking Engine in the widget area.', 'astro-booking-engine' ); ?></li>
            </ol>
            <p><strong><?php _e( 'IMPORTANT', 'astro-booking-engine' ); ?></strong>:
				<?php _e( 'it is mandatory to have the provider data settings and the provider contract must be active in order to use the Astro Booking Engine.', 'astro-booking-engine' ); ?><br>
				<?php _e( 'The booking engine provider can send you the useful settings to configure the Astro Booking Engine; we are not a booking engine provider.', 'astro-booking-engine' ); ?><br>
				<?php _e( 'Only after configuring the Astro Booking Engine with the provider\'s data, you can you start to use the booking form on your website.', 'astro-booking-engine' ); ?></p>

            <hr />

            <h3 id="support-providers-list" class="title"><?php _e( 'Providers list', 'astro-booking-engine' ); ?></h3>
            <p><?php _e( 'Currently, Astro Booking Engine can be connected to the following booking engine providers (in alphabetic order).', 'astro-booking-engine' ); ?></p>
            <ul>
                <li><a href="https://www.iperbooking.com" target="_blank">Iperbooking</a></li>
                <li><a href="https://www.simplebooking.travel" target="_blank">Simple Booking</a></li>
                <li><a href="https://www.verticalbooking.com" target="_blank">Vertical Booking</a></li>
            </ul>

            <p><?php _e( 'Is your booking engine provider not available in Astro Booking Engine?', 'astro-booking-engine' ); ?><br>
				<?php _e( 'Write me an email at', 'astro-booking-engine' ); ?> <a href="mailto:info@astrothemes.com">info@astrothemes.com</a>.</p>

            <hr />

            <h3 id="support-faqs" class="title"><?php _e( 'FAQs', 'astro-booking-engine' ); ?></h3>
            <p><span class="support-faq-question"><?php _e( 'Do you need support?', 'astro-booking-engine' ); ?></span><br>
                <span class="support-faq-answer"><?php _e( 'Request support at the ', 'astro-booking-engine' ); ?> <a href="https://wordpress.org/support/plugin/display-post-link/" target="_blank"><?php _e( 'plugin support page', 'astro-booking-engine' ); ?></a>.</span></p>

            <p><span class="support-faq-question"><?php _e( 'Have more questions?', 'astro-booking-engine' ); ?></span><br>
            <span class="support-faq-answer"><?php _e( 'Write me an email at', 'astro-booking-engine' ); ?> <a href="mailto:info@astrothemes.com">info@astrothemes.com</a>.</span></p>

            <hr />

            <h3 id="support-data-reset" class="title"><?php _e( 'Plugin data reset', 'astro-booking-engine' ); ?></h3>
            <p><a class="button button-primary" href="?page=<?php echo ASTRO_BE_TEXTDOMAIN; ?>&amp;tab=support&amp;delete_options=1"><?php _e( 'Remove all plugin settings', 'astro-booking-engine' ); ?></a></p>
            <p class="color-red"><?php echo $delete_options; ?></p>

        </div>
    </div>

</div>
