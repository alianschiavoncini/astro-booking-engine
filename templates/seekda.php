<?php
/**
 * Seekda.
 * Booking engine at https://<code>.officialbookings.com/: skd-checkin and skd-checkout (Y-m-d), skd-promotion-code and skd-language-code. The script copies
 * the dates on submit. The guests are chosen on the booking engine.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$provider = esc_attr('seekda');
$astro_be_prefix = esc_attr(ASTRO_BE_PREFIX);
// L'opzione tiene il solo codice della struttura (s001234).
$seekda_hotel = astro_be_get_sanitized_option($astro_be_prefix.$provider.'_hotel');
?>
<div class="astro_be <?php echo $astro_be_prefix . $provider; ?>">

    <form class="astro_be_form astro_be_form<?php echo '_'. esc_attr($provider); ?>"
          method="get"
          action="<?php echo esc_url( 'https://' . $seekda_hotel . '.officialbookings.com/' ); ?>"
          target="<?php echo esc_attr( get_option($astro_be_prefix.$provider.'_form_target') ); ?>">

        <input type="hidden" name="skd-language-code" value="<?php echo esc_attr( astro_return_seekda_language() ); ?>" />
        <input type="hidden" id="astro_be_form<?php echo '_'. esc_attr($provider); ?>_checkin" name="skd-checkin" value="" />
        <input type="hidden" id="astro_be_form<?php echo '_'. esc_attr($provider); ?>_checkout" name="skd-checkout" value="" />

        <!-- <?php echo esc_attr(ASTRO_BE_PREFIX); ?>dates -->
        <div class="<?php echo $astro_be_prefix . 'row'; ?> <?php echo $astro_be_prefix . 'dates'; ?>">
            <?php
            $field_class = esc_attr('checkin');
            $field_label = __( 'Check-in', 'astro-booking-engine' );
            $field_date_format = astro_print_checkin_checkout_datepicker_format();
            ?>
            <!-- <?php echo $astro_be_prefix.$field_class; ?> -->
            <div class="<?php echo $astro_be_prefix . 'column ' . $astro_be_prefix . 'column-' . $field_class; ?>">
                <div class="<?php echo $astro_be_prefix . 'column-inner'; ?>">
                    <label for="<?php echo $astro_be_prefix . $provider . '-' . $field_class; ?>" class="<?php echo $astro_be_prefix . 'label'; ?> <?php echo $astro_be_prefix . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?></label>
                    <input type="text" id="<?php echo $astro_be_prefix . $provider . '-' . $field_class; ?>" class="datepicker <?php echo $astro_be_prefix . 'input'; ?> <?php echo $astro_be_prefix . 'input-' . $field_class; ?>" size="10" data-date-format="<?php echo esc_attr($field_date_format); ?>" readonly data-no-submit />
                    <input type="hidden" class="<?php echo $astro_be_prefix . 'input-' . $field_class; ?>-js" value="<?php echo date_i18n("Y-m-d"); ?>" />
                </div>
            </div>
            <!-- /<?php echo $astro_be_prefix.$field_class; ?> -->

            <?php
            $field_class = esc_attr('checkout');
            $field_label = __( 'Check-out', 'astro-booking-engine' );
            $field_date_format = astro_print_checkin_checkout_datepicker_format();
            ?>
            <!-- <?php echo $astro_be_prefix.$field_class; ?> -->
            <div class="<?php echo $astro_be_prefix . 'column ' . $astro_be_prefix . 'column-' . $field_class; ?>">
                <div class="<?php echo $astro_be_prefix . 'column-inner'; ?>">
                    <label for="<?php echo $astro_be_prefix . $provider . '-' . $field_class; ?>" class="<?php echo $astro_be_prefix . 'label'; ?> <?php echo $astro_be_prefix . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?></label>
                    <input type="text" id="<?php echo $astro_be_prefix . $provider . '-' . $field_class; ?>" class="datepicker <?php echo $astro_be_prefix . 'input'; ?> <?php echo $astro_be_prefix . 'input-' . $field_class; ?>" size="10" data-date-format="<?php echo esc_attr($field_date_format); ?>" readonly data-no-submit />
                    <input type="hidden" class="<?php echo $astro_be_prefix . 'input-' . $field_class; ?>-js" value="<?php echo date_i18n("Y-m-d", strtotime("+1 day")); ?>" />
                </div>
            </div>
            <!-- /<?php echo $astro_be_prefix.$field_class; ?> -->
        </div>
        <!-- /<?php echo $astro_be_prefix.'dates'; ?> -->

        <!-- <?php echo $astro_be_prefix.'occupancy'; ?> -->
        <div class="<?php echo $astro_be_prefix . 'row'; ?> <?php echo $astro_be_prefix . 'occupancy'; ?>">
        </div>
        <!-- /<?php echo $astro_be_prefix.'occupancy'; ?> -->

        <?php
        $coupon_code_enable = get_option($astro_be_prefix.$provider.'_coupon');
        if ($coupon_code_enable) {
            $field_class = esc_attr('coupon');
            $field_label = __( 'Coupon', 'astro-booking-engine' );
        ?>
        <!-- <?php echo $astro_be_prefix.$field_class; ?> -->
        <div class="<?php echo $astro_be_prefix . 'row'; ?> <?php echo $astro_be_prefix . $field_class; ?>">
            <div class="<?php echo $astro_be_prefix . 'column ' . $astro_be_prefix . 'column-' . $field_class; ?>">
                <div class="<?php echo $astro_be_prefix . 'column-inner'; ?>">
                    <label for="<?php echo $astro_be_prefix . $provider . '-' . $field_class; ?>" class="<?php echo $astro_be_prefix . 'label'; ?> <?php echo $astro_be_prefix . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?></label>
                    <input type="text" name="skd-promotion-code" id="<?php echo $astro_be_prefix . $provider . '-' . $field_class; ?>" class="<?php echo $astro_be_prefix . 'input'; ?> <?php echo $astro_be_prefix . 'input-' . $field_class; ?>" size="5" />
                </div>
            </div>
        </div>
        <!-- /<?php echo $astro_be_prefix.$field_class; ?> -->
        <?php
        }
        ?>

        <?php
        $value = __('Search', 'astro-booking-engine' );
        $submit_label = get_option($astro_be_prefix.$provider.'_submit_label');
        if (!empty($submit_label)) {
            $value = $submit_label;
        }

        $field_class = esc_attr('submit_button');
        $field_label = $value;
        ?>
        <!-- <?php echo $astro_be_prefix.$field_class; ?> -->
        <div class="<?php echo $astro_be_prefix . 'row'; ?> <?php echo $astro_be_prefix . $field_class; ?>">
            <div class="<?php echo $astro_be_prefix . 'column ' . $astro_be_prefix . 'column-' . $field_class; ?>">
                <div class="<?php echo $astro_be_prefix . 'column-inner'; ?>">
                    <label class="<?php echo $astro_be_prefix . 'label'; ?> <?php echo $astro_be_prefix . 'label-' . $field_class; ?>" aria-hidden="true"><?php echo esc_html($field_label); ?></label>
                    <input type="submit" class="<?php echo $astro_be_prefix . 'input'; ?> <?php echo $astro_be_prefix . 'input-' . $field_class; ?>" value="<?php echo esc_attr($value); ?>" />
                </div>
            </div>
        </div>
        <!-- /<?php echo $astro_be_prefix.$field_class; ?> -->

    </form>

</div>
