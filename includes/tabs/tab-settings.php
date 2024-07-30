<?php
if( ! is_admin() ) {
	return;
}

$tab = 'settings';
$option_group = ASTRO_BE_PREFIX . $tab;
?>
<div class="<?php echo ASTRO_BE_PREFIX . 'wrapper'; ?> <?php echo esc_attr( $option_group ); ?>">

    <div class="section-wrapper">
        <div class="section-wrapper-inner">

            <h2 id="settings" class="title"><?php esc_html_e('Settings', 'astro-booking-engine' ); ?></h2>
            <p><?php esc_html_e('Astro Booking Engine displays the booking form using the shortcode <strong>[astro-booking-engine]</strong>.', 'astro-booking-engine'); ?></p>
            <p><?php esc_html_e( 'For installation details, read more at the', 'astro-booking-engine'); ?>
                <?php printf( '<a href="%1$s">%2$s</a>',
                    '?page='.ASTRO_BE_TEXTDOMAIN.'&amp;tab=support',
                      __('support page', 'astro-booking-engine')
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
                                                'iperbooking' => 'Iperbooking',
                                                'passepartout' => 'Passepartout',
                                                'simplebooking' => 'Simple booking',
                                                'verticalbooking' => 'Vertical booking',
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

        //iperbooking
        include('tab-settings-iperbooking.php');

        //passepartout
        include('tab-settings-passepartout.php');

        //simplebooking
        include('tab-settings-simplebooking.php');

        //verticalbooking
        include('tab-settings-verticalbooking.php');
        ?>

        <?php
        submit_button();
        ?>
    </form>

</div>

