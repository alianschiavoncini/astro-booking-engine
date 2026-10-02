<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! is_admin() ) {
	return;
}

$tab = 'settings';
$option_group = ASTRO_BE_PREFIX . $tab;
?>
<div class="<?php echo esc_attr( ASTRO_BE_PREFIX . 'wrapper' ); ?> <?php echo esc_attr( $option_group ); ?>">

    <div class="section-wrapper">
        <div class="section-wrapper-inner">

            <h2 id="settings" class="title"><?php esc_html_e('Settings', 'astro-booking-engine' ); ?></h2>
            <p><?php
				// La stringa contiene <strong>: va stampata con wp_kses() e non con
				// esc_html_e(), che ne convertirebbe i tag in entita rendendoli visibili
				// a video. La whitelist consente il solo <strong>.
				echo wp_kses(
					__( 'Astro Booking Engine displays the booking form using the <strong>Astro Booking Engine</strong> block in the editor or the shortcode <strong>[astro-booking-engine]</strong>.', 'astro-booking-engine' ),
					array( 'strong' => array() )
				);
			?></p>
            <p><?php esc_html_e( 'For installation details, read more at the', 'astro-booking-engine'); ?>
                <?php printf( '<a href="%1$s">%2$s</a>',
                    esc_url( add_query_arg( array( 'page' => ASTRO_BE_TEXTDOMAIN, 'tab' => 'support' ), admin_url( 'admin.php' ) ) ),
                    esc_html__('support page', 'astro-booking-engine')
                ); ?>.</p>

        </div>
    </div>

    <form method="post" action="options.php" class="<?php echo esc_attr($option_group); ?>_form">
        <?php
        settings_fields($option_group);
        do_settings_sections($option_group);
        ?>

        <div class="section-wrapper">
            <div class="section-wrapper-inner">

                <h2 id="provider" class="title"><?php esc_html_e('Provider', 'astro-booking-engine' ); ?></h2>
                <table class="form-table">
                    <?php
                    $field = array(
                        'label' => esc_html__('Your provider', 'astro-booking-engine' ),
                        'description' => esc_html__('Select your provider and configure its settings to enable Astro Booking Engine.', 'astro-booking-engine' ),
                        'name' => ASTRO_BE_PREFIX.'provider',
                        'value' => get_option(ASTRO_BE_PREFIX.'provider'),
                        'placeholder' => false
                    );
                    ?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
                                <?php
                                $options = array(
                                                '' => '---',
                                                '5stelle' => '5Stelle',
                                                'ihotelier' => 'Amadeus iHotelier (TravelClick)',
                                                'beddy' => 'Beddy',
                                                'begenius' => 'BeGenius',
                                                'blastness' => 'Blastness',
                                                'bookingexpert' => 'Booking Expert',
                                                'cloudbeds' => 'Cloudbeds',
                                                'datasistemi' => 'Data Sistemi',
                                                'dedge' => 'D-EDGE',
                                                'ericsoft' => 'Ericsoft',
                                                'ermeshotels' => 'ErmesHotels',
                                                'guestline' => 'Guestline',
                                                'hotelnetsolutions' => 'HotelNetSolutions (OnePageBooking)',
                                                'iperbooking' => 'Iperbooking',
                                                'journey' => 'Journey',
                                                'mews' => 'Mews',
                                                'mirai' => 'Mirai',
                                                'myguestcare' => 'MyGuestCare',
                                                'octorate' => 'Octorate',
                                                'passepartout' => 'Passepartout',
                                                'reservit' => 'Reservit',
                                                'resnexus' => 'ResNexus',
                                                'revplus' => 'RevPlus (WebHotelier)',
                                                'roiback' => 'Roiback',
                                                'synxis' => 'Sabre SynXis',
                                                'scidoo' => 'Scidoo',
                                                'simplebooking' => 'Simple booking',
                                                'siteminder' => 'SiteMinder',
                                                'thinkreservations' => 'ThinkReservations',
                                                'verticalbooking' => 'Vertical booking',
                                                'witbooking' => 'Witbooking',
                                                'wubook' => 'WuBook',
                                                );
                                foreach ($options as $k => $v) {
                                    $selected = '';
                                    if ($k == $field['value']) {
                                        $selected = ' selected=selected';
                                    }
                                    ?>
                                    <option value="<?php echo esc_attr($k); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_html($v); ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <p class="description"><?php echo esc_html($field['description']); ?></p>
                        </td>
                    </tr>
                </table>

            </div>
        </div>


        <?php
        //5stelle
        include('tab-settings-5stelle.php');

        //ihotelier
        include('tab-settings-ihotelier.php');

        //beddy
        include('tab-settings-beddy.php');

        //begenius
        include('tab-settings-begenius.php');

        //blastness
        include('tab-settings-blastness.php');

        //bookingexpert
        include('tab-settings-bookingexpert.php');

        //cloudbeds
        include('tab-settings-cloudbeds.php');

        //datasistemi
        include('tab-settings-datasistemi.php');

        //dedge
        include('tab-settings-dedge.php');

        //ericsoft
        include('tab-settings-ericsoft.php');

        //ermeshotels
        include('tab-settings-ermeshotels.php');

        //guestline
        include('tab-settings-guestline.php');

        //hotelnetsolutions
        include('tab-settings-hotelnetsolutions.php');

        //iperbooking
        include('tab-settings-iperbooking.php');

        //journey
        include('tab-settings-journey.php');

        //mews
        include('tab-settings-mews.php');

        //mirai
        include('tab-settings-mirai.php');

        //myguestcare
        include('tab-settings-myguestcare.php');

        //octorate
        include('tab-settings-octorate.php');

        //passepartout
        include('tab-settings-passepartout.php');

        //reservit
        include('tab-settings-reservit.php');

        //resnexus
        include('tab-settings-resnexus.php');

        //revplus
        include('tab-settings-revplus.php');

        //roiback
        include('tab-settings-roiback.php');

        //synxis
        include('tab-settings-synxis.php');

        //scidoo
        include('tab-settings-scidoo.php');

        //simplebooking
        include('tab-settings-simplebooking.php');

        //siteminder
        include('tab-settings-siteminder.php');

        //thinkreservations
        include('tab-settings-thinkreservations.php');

        //verticalbooking
        include('tab-settings-verticalbooking.php');

        //witbooking
        include('tab-settings-witbooking.php');

        //wubook
        include('tab-settings-wubook.php');

        ?>

        <?php
        submit_button();
        ?>
    </form>

</div>

