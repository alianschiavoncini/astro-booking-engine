<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! is_admin() ) {
	return;
}

function astro_be_delete_options_prefixed( $prefix ) {
	global $wpdb;

	// esc_like() neutralizza _ e % nel prefisso; prepare() si occupa del resto.
	$like = $wpdb->esc_like( $prefix ) . '%';

	$option_names = $wpdb->get_col(
		$wpdb->prepare( "SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE %s", $like )
	);

	// delete_option() e non una DELETE diretta: aggiorna anche la cache degli oggetti, altrimenti
	// con una cache persistente le opzioni cancellate continuerebbero a essere lette.
	$deleted = 0;
	foreach ( $option_names as $option_name ) {
		if ( delete_option( $option_name ) ) {
			$deleted++;
		}
	}

	return $deleted;
}

$delete_options = false;
if ( isset( $_GET['delete_options'] ) && '1' === $_GET['delete_options'] ) {

	// La capability da sola non basta: senza nonce un amministratore autenticato puo
	// essere indotto a eseguire la cancellazione con una semplice richiesta forgiata
	// (CVE-2025-10308). Servono entrambi i controlli.
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'astro-booking-engine' ) );
	}

	$astro_be_nonce = isset( $_GET['nonce'] ) ? sanitize_text_field( wp_unslash( $_GET['nonce'] ) ) : '';

	if ( ! wp_verify_nonce( $astro_be_nonce, 'astro_be_delete_options' ) ) {
		wp_die( esc_html__( 'Security check failed. Please go back and try again.', 'astro-booking-engine' ) );
	}

	astro_be_delete_options_prefixed( ASTRO_BE_PREFIX );
	$delete_options = __( 'All the plugin options have deleted.', 'astro-booking-engine' );
}

// URL del pulsante di reset, con nonce.
$astro_be_delete_options_url = add_query_arg(
	array(
		'page'           => ASTRO_BE_TEXTDOMAIN,
		'tab'            => 'support',
		'delete_options' => 1,
		'nonce'          => wp_create_nonce( 'astro_be_delete_options' ),
	),
	admin_url( 'admin.php' )
);

$tab = 'support';
$option_group = ASTRO_BE_PREFIX . $tab;

settings_fields($option_group);
do_settings_sections($option_group);
?>
<div class="<?php echo esc_attr(ASTRO_BE_PREFIX) . 'wrapper'; ?> <?php echo esc_attr( $option_group ); ?>">

    <div class="section-wrapper">
        <div class="section-wrapper-inner">

            <h2 id="support" class="title"><?php esc_html_e('Support', 'astro-booking-engine' ); ?></h2>

            <h3 id="support-configuration" class="title"><?php esc_html_e( 'How to start with this plugin', 'astro-booking-engine' ); ?></h3>
            <ol>
                <li><?php esc_html_e( 'Get data settings from your booking engine provider; if you don\'t have one, you need to adopt one', 'astro-booking-engine' ); ?> (<a href="#support-providers-list"><?php esc_html_e( 'see the list of currently available providers', 'astro-booking-engine' ); ?></a>)</li>
                <li><?php esc_html_e( 'Select the provider name and configure its settings', 'astro-booking-engine' ); ?></li>
                <li><?php esc_html_e( 'Configure the booking form layout (optional)', 'astro-booking-engine' ); ?></li>
                <li><?php esc_html_e( 'Add the Astro Booking Engine block in the editor, use the [astro-booking-engine] shortcode in your post/page content, or add the Astro Booking Engine widget in the widget area.', 'astro-booking-engine' ); ?></li>
            </ol>
            <p><strong><?php esc_html_e( 'IMPORTANT', 'astro-booking-engine' ); ?></strong>:
				<?php esc_html_e( 'it is mandatory to have the provider data settings and the provider contract must be active in order to use the Astro Booking Engine.', 'astro-booking-engine' ); ?><br>
				<?php esc_html_e( 'The booking engine provider can send you the useful settings to configure the Astro Booking Engine; we are not a booking engine provider.', 'astro-booking-engine' ); ?><br>
				<?php esc_html_e( 'Only after configuring the Astro Booking Engine with the provider\'s data, you can you start to use the booking form on your website.', 'astro-booking-engine' ); ?></p>

            <hr />

            <h3 id="support-providers-list" class="title"><?php esc_html_e( 'Providers list', 'astro-booking-engine' ); ?></h3>
            <p><?php esc_html_e( 'Currently, Astro Booking Engine can be connected to the following booking engine providers (in alphabetic order).', 'astro-booking-engine' ); ?></p>
            <?php
			// Provider, sito dell'azienda e paese della sua sede: una riga per provider,
			// in ordine alfabetico. Il paese passa da __() perche' la tabella e' tradotta.
			$astro_be_providers = array(
				array( 'name' => '5Stelle', 'url' => 'https://www.hotelcinquestelle.cloud/en/', 'country' => __( 'Italy', 'astro-booking-engine' ) ),
				array( 'name' => 'Amadeus iHotelier (TravelClick)', 'url' => 'https://amadeus-hospitality.com/', 'country' => __( 'Spain', 'astro-booking-engine' ) ),
				array( 'name' => 'Beddy', 'url' => 'https://www.beddy.io/', 'country' => __( 'Italy', 'astro-booking-engine' ) ),
				array( 'name' => 'BeGenius', 'url' => 'http://www.begenius.it/', 'country' => __( 'Italy', 'astro-booking-engine' ) ),
				array( 'name' => 'Blastness', 'url' => 'https://www.blastness.com/', 'country' => __( 'Italy', 'astro-booking-engine' ) ),
				array( 'name' => 'Booking Expert', 'url' => 'https://bookingexpert.com/', 'country' => __( 'Italy', 'astro-booking-engine' ) ),
				array( 'name' => 'Cloudbeds', 'url' => 'https://www.cloudbeds.com/', 'country' => __( 'United States', 'astro-booking-engine' ) ),
				array( 'name' => 'Data Sistemi', 'url' => 'https://www.datasistemi.eu/', 'country' => __( 'Italy', 'astro-booking-engine' ) ),
				array( 'name' => 'D-EDGE', 'url' => 'https://www.d-edge.com/', 'country' => __( 'France', 'astro-booking-engine' ) ),
				array( 'name' => 'Ericsoft', 'url' => 'https://www.ericsoft.com/', 'country' => __( 'Italy', 'astro-booking-engine' ) ),
				array( 'name' => 'ErmesHotels', 'url' => 'https://ermeshotels.com/', 'country' => __( 'Italy', 'astro-booking-engine' ) ),
				array( 'name' => 'Guestline', 'url' => 'https://www.guestline.com/', 'country' => __( 'United Kingdom', 'astro-booking-engine' ) ),
				array( 'name' => 'HotelNetSolutions (OnePageBooking)', 'url' => 'https://hotelnetsolutions.de/en/', 'country' => __( 'Germany', 'astro-booking-engine' ) ),
				array( 'name' => 'Iperbooking', 'url' => 'https://www.iperbooking.com/', 'country' => __( 'Italy', 'astro-booking-engine' ) ),
				array( 'name' => 'Journey', 'url' => 'https://journey.travel/', 'country' => __( 'United Kingdom', 'astro-booking-engine' ) ),
				array( 'name' => 'Mews', 'url' => 'https://www.mews.com/', 'country' => __( 'Netherlands', 'astro-booking-engine' ) ),
				array( 'name' => 'Mirai', 'url' => 'https://www.mirai.com/', 'country' => __( 'Spain', 'astro-booking-engine' ) ),
				array( 'name' => 'MyGuestCare', 'url' => 'https://www.mycomp.it/', 'country' => __( 'Italy', 'astro-booking-engine' ) ),
				array( 'name' => 'Octorate', 'url' => 'https://www.octorate.com/', 'country' => __( 'Italy', 'astro-booking-engine' ) ),
				array( 'name' => 'Passepartout', 'url' => 'https://www.passepartout.net/', 'country' => __( 'San Marino', 'astro-booking-engine' ) ),
				array( 'name' => 'Reservit', 'url' => 'https://www.reservit.com/', 'country' => __( 'France', 'astro-booking-engine' ) ),
				array( 'name' => 'ResNexus', 'url' => 'https://resnexus.com/', 'country' => __( 'United States', 'astro-booking-engine' ) ),
				array( 'name' => 'RevPlus (WebHotelier)', 'url' => 'https://www.revplus.com/', 'country' => __( 'Greece', 'astro-booking-engine' ) ),
				array( 'name' => 'Roiback', 'url' => 'https://www.roiback.com/', 'country' => __( 'Spain', 'astro-booking-engine' ) ),
				array( 'name' => 'Sabre SynXis', 'url' => 'https://www.sabre.com/products/hospitality/', 'country' => __( 'United States', 'astro-booking-engine' ) ),
				array( 'name' => 'Scidoo', 'url' => 'https://www.scidoo.com/', 'country' => __( 'Italy', 'astro-booking-engine' ) ),
				array( 'name' => 'Simple booking', 'url' => 'https://www.simplebooking.travel/', 'country' => __( 'Italy', 'astro-booking-engine' ) ),
				array( 'name' => 'SiteMinder', 'url' => 'https://www.siteminder.com/', 'country' => __( 'Australia', 'astro-booking-engine' ) ),
				array( 'name' => 'ThinkReservations', 'url' => 'https://www.thinkreservations.com/', 'country' => __( 'United States', 'astro-booking-engine' ) ),
				array( 'name' => 'Vertical booking', 'url' => 'https://www.verticalbooking.com/en/home/', 'country' => __( 'Italy', 'astro-booking-engine' ) ),
				array( 'name' => 'Witbooking', 'url' => 'https://www.witbooking.com/', 'country' => __( 'Spain', 'astro-booking-engine' ) ),
				array( 'name' => 'WuBook', 'url' => 'https://wubook.net/', 'country' => __( 'Italy', 'astro-booking-engine' ) ),
			);
			?>
            <table class="widefat striped astro_be_providers_table">
                <thead>
                    <tr>
                        <th scope="col"><?php esc_html_e( 'Provider', 'astro-booking-engine' ); ?></th>
                        <th scope="col"><?php esc_html_e( 'Country of the company', 'astro-booking-engine' ); ?></th>
                    </tr>
                </thead>
                <tbody>
					<?php foreach ( $astro_be_providers as $astro_be_provider_row ) { ?>
                    <tr>
                        <td><a href="<?php echo esc_url( $astro_be_provider_row['url'] ); ?>" target="_blank"><?php echo esc_html( $astro_be_provider_row['name'] ); ?></a></td>
                        <td><?php echo esc_html( $astro_be_provider_row['country'] ); ?></td>
                    </tr>
					<?php } ?>
                </tbody>
            </table>

            <p><?php esc_html_e( 'Is your booking engine provider not available in Astro Booking Engine?', 'astro-booking-engine' ); ?><br>
				<?php esc_html_e( 'Write me an email at', 'astro-booking-engine' ); ?> <a href="mailto:alian@alian.it">alian@alian.it</a>.</p>

            <hr />

            <h3 id="support-faqs" class="title"><?php esc_html_e( 'FAQs', 'astro-booking-engine' ); ?></h3>
            <p><span class="support-faq-question"><?php esc_html_e( 'Do you need support?', 'astro-booking-engine' ); ?></span><br>
                <span class="support-faq-answer"><?php esc_html_e( 'Request support at the ', 'astro-booking-engine' ); ?> <a href="https://wordpress.org/support/plugin/astro-booking-engine/" target="_blank"><?php esc_html_e( 'plugin support page', 'astro-booking-engine' ); ?></a>.</span></p>

            <p><span class="support-faq-question"><?php esc_html_e( 'Have more questions?', 'astro-booking-engine' ); ?></span><br>
            <span class="support-faq-answer"><?php esc_html_e( 'Write me an email at', 'astro-booking-engine' ); ?> <a href="mailto:alian@alian.it">alian@alian.it</a>.</span></p>

            <hr />

            <h3 id="support-about-author" class="title"><?php esc_html_e( 'About the author', 'astro-booking-engine' ); ?></h3>
            <p><strong>Alian Schiavoncini</strong><br>
                <?php esc_html_e( 'Creator of Astro Booking Engine and founder of AboutMyHotel.', 'astro-booking-engine' ); ?></p>
            <ul>
                <li><?php esc_html_e( 'Website:', 'astro-booking-engine' ); ?> <a href="<?php echo esc_url( 'https://www.alian.it' ); ?>" target="_blank" rel="noopener noreferrer">www.alian.it</a></li>
                <li><a href="<?php echo esc_url( 'https://www.aboutmyhotel.com' ); ?>" target="_blank" rel="noopener noreferrer">AboutMyHotel</a>: <?php esc_html_e( 'hotel reputation and market intelligence platform.', 'astro-booking-engine' ); ?></li>
                <li><?php esc_html_e( 'Bug reports and suggestions:', 'astro-booking-engine' ); ?> <a href="mailto:alian@alian.it">alian@alian.it</a></li>
            </ul>
            <p class="description"><?php esc_html_e( 'AboutMyHotel is a separate, commercial service by the same author. It is not required to use this plugin.', 'astro-booking-engine' ); ?></p>

            <hr />

            <h3 id="support-data-reset" class="title"><?php esc_html_e( 'Plugin data reset', 'astro-booking-engine' ); ?></h3>
            <p><a class="button button-primary" href="<?php echo esc_url( $astro_be_delete_options_url ); ?>"><?php esc_html_e( 'Remove all plugin settings', 'astro-booking-engine' ); ?></a></p>
            <p class="color-red"><?php echo esc_html($delete_options); ?></p>

        </div>
    </div>

</div>
