<?php
/**
 * Smartness (Smartpms, formerly CiaoBooking).
 * Booking engine at https://<site>.bookpage.io[/it|/de]/properties/<property>, which opens on the rooms of the
 * search: sd and ed (Y-m-d), ad (adults), ch (children: their ages are asked on the booking engine) and coupon.
 * Only Italian and German have their own segment in the address: with the other languages the booking engine
 * opens in the main language of the site. The script copies the dates on submit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$provider = esc_attr('smartness');
$astro_be_prefix = esc_attr(ASTRO_BE_PREFIX);
// L'opzione tiene host e codice della struttura (yourhotel.bookpage.io/12345), oppure il solo host.
$smartness_site = astro_be_get_sanitized_option($astro_be_prefix.$provider.'_hotel');
$smartness_parts = explode( '/', $smartness_site, 2 );
?>
<div class="astro_be <?php echo esc_attr( $astro_be_prefix . $provider ); ?>">

    <form class="astro_be_form astro_be_form<?php echo esc_attr( '_'. esc_attr($provider) ); ?>"
          method="get"
          action="<?php echo esc_url( 'https://' . $smartness_parts[0] . astro_return_smartness_language_path() . '/properties' . ( isset( $smartness_parts[1] ) ? '/' . $smartness_parts[1] : '' ) ); ?>"
          target="<?php echo esc_attr( get_option($astro_be_prefix.$provider.'_form_target') ); ?>">

        <input type="hidden" id="astro_be_form<?php echo esc_attr( '_'. esc_attr($provider) ); ?>_sd" name="sd" value="" />
        <input type="hidden" id="astro_be_form<?php echo esc_attr( '_'. esc_attr($provider) ); ?>_ed" name="ed" value="" />

        <!-- <?php echo esc_attr(ASTRO_BE_PREFIX); ?>dates -->
        <div class="<?php echo esc_attr( $astro_be_prefix . 'row' ); ?> <?php echo esc_attr( $astro_be_prefix . 'dates' ); ?>">
            <?php
            $field_class = esc_attr('checkin');
            $field_label = __( 'Check-in', 'astro-booking-engine' );
            $field_date_format = astro_print_checkin_checkout_datepicker_format();
            ?>
            <!-- <?php echo esc_attr( $astro_be_prefix.$field_class ); ?> -->
            <div class="<?php echo esc_attr( $astro_be_prefix . 'column ' . $astro_be_prefix . 'column-' . $field_class ); ?>">
                <div class="<?php echo esc_attr( $astro_be_prefix . 'column-inner' ); ?>">
                    <label for="<?php echo esc_attr( $astro_be_prefix . $provider . '-' . $field_class ); ?>" class="<?php echo esc_attr( $astro_be_prefix . 'label' ); ?> <?php echo esc_attr( $astro_be_prefix . 'label-' . $field_class ); ?>"><?php echo esc_html($field_label); ?></label>
                    <input type="text" id="<?php echo esc_attr( $astro_be_prefix . $provider . '-' . $field_class ); ?>" class="datepicker <?php echo esc_attr( $astro_be_prefix . 'input' ); ?> <?php echo esc_attr( $astro_be_prefix . 'input-' . $field_class ); ?>" size="10" data-date-format="<?php echo esc_attr($field_date_format); ?>" readonly data-no-submit />
                    <input type="hidden" class="<?php echo esc_attr( $astro_be_prefix . 'input-' . $field_class ); ?>-js" value="<?php echo esc_attr( date_i18n("Y-m-d") ); ?>" />
                </div>
            </div>
            <!-- /<?php echo esc_attr( $astro_be_prefix.$field_class ); ?> -->

            <?php
            $field_class = esc_attr('checkout');
            $field_label = __( 'Check-out', 'astro-booking-engine' );
            $field_date_format = astro_print_checkin_checkout_datepicker_format();
            ?>
            <!-- <?php echo esc_attr( $astro_be_prefix.$field_class ); ?> -->
            <div class="<?php echo esc_attr( $astro_be_prefix . 'column ' . $astro_be_prefix . 'column-' . $field_class ); ?>">
                <div class="<?php echo esc_attr( $astro_be_prefix . 'column-inner' ); ?>">
                    <label for="<?php echo esc_attr( $astro_be_prefix . $provider . '-' . $field_class ); ?>" class="<?php echo esc_attr( $astro_be_prefix . 'label' ); ?> <?php echo esc_attr( $astro_be_prefix . 'label-' . $field_class ); ?>"><?php echo esc_html($field_label); ?></label>
                    <input type="text" id="<?php echo esc_attr( $astro_be_prefix . $provider . '-' . $field_class ); ?>" class="datepicker <?php echo esc_attr( $astro_be_prefix . 'input' ); ?> <?php echo esc_attr( $astro_be_prefix . 'input-' . $field_class ); ?>" size="10" data-date-format="<?php echo esc_attr($field_date_format); ?>" readonly data-no-submit />
                    <input type="hidden" class="<?php echo esc_attr( $astro_be_prefix . 'input-' . $field_class ); ?>-js" value="<?php echo esc_attr( date_i18n("Y-m-d", strtotime("+1 day")) ); ?>" />
                </div>
            </div>
            <!-- /<?php echo esc_attr( $astro_be_prefix.$field_class ); ?> -->
        </div>
        <!-- /<?php echo esc_attr( $astro_be_prefix.'dates' ); ?> -->

        <!-- <?php echo esc_attr( $astro_be_prefix.'occupancy' ); ?> -->
        <div class="<?php echo esc_attr( $astro_be_prefix . 'row' ); ?> <?php echo esc_attr( $astro_be_prefix . 'occupancy' ); ?>">
            <?php
            $adults_enable = get_option($astro_be_prefix.$provider.'_adults_enable');
            $adults_n_default = astro_be_get_count_option($astro_be_prefix.$provider.'_adults_n_default');
            $adults_n_max = astro_be_get_count_option($astro_be_prefix.$provider.'_adults_n_max');

            $field_class = esc_attr('adults');
            $field_label = __( 'Adults', 'astro-booking-engine' );
            if ($adults_enable) {
                ?>
                <!-- <?php echo esc_attr( $astro_be_prefix.$field_class ); ?> -->
                <div class="<?php echo esc_attr( $astro_be_prefix . 'column ' . $astro_be_prefix . 'column-' . $field_class ); ?>">
                    <div class="<?php echo esc_attr( $astro_be_prefix . 'column-inner' ); ?>">
                        <label for="<?php echo esc_attr( $astro_be_prefix . $provider . '-' . $field_class ); ?>" class="<?php echo esc_attr( $astro_be_prefix . 'label' ); ?> <?php echo esc_attr( $astro_be_prefix . 'label-' . $field_class ); ?>"><?php echo esc_html($field_label); ?></label>
                        <select name="ad" id="<?php echo esc_attr( $astro_be_prefix . $provider . '-' . $field_class ); ?>" class="<?php echo esc_attr( $astro_be_prefix . 'select' ); ?> <?php echo esc_attr( $astro_be_prefix . 'select-' . $field_class ); ?>">
                        <?php for ($i = 1; $i <= $adults_n_max; $i++) { ?>
                            <option value="<?php echo esc_attr($i); ?>" <?php if ($adults_n_default == $i) { echo ' selected=selected'; } ?>><?php echo esc_html($i); ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <!-- /<?php echo esc_attr( $astro_be_prefix.$field_class ); ?> -->
                <?php
            }else{
            ?>
                <input type="hidden" id="astro_be_form<?php echo esc_attr( '_'. esc_attr($provider) ); ?>_adults" name="ad" value="<?php echo esc_attr( max( 1, $adults_n_default ) ); ?>" />
            <?php
            }
            ?>

            <?php
            $children_enable = get_option($astro_be_prefix.$provider.'_children_enable');
            $children_n_default = astro_be_get_count_option($astro_be_prefix.$provider.'_children_n_default');
            $children_n_max = astro_be_get_count_option($astro_be_prefix.$provider.'_children_n_max');

            $field_class = esc_attr('children');
            $field_label = __( 'Children', 'astro-booking-engine' );
            if ($children_enable) {
                ?>
                <!-- <?php echo esc_attr( $astro_be_prefix.$field_class ); ?> -->
                <div class="<?php echo esc_attr( $astro_be_prefix . 'column ' . $astro_be_prefix . 'column-' . $field_class ); ?>">
                    <div class="<?php echo esc_attr( $astro_be_prefix . 'column-inner' ); ?>">
                        <label for="<?php echo esc_attr( $astro_be_prefix . $provider . '-' . $field_class ); ?>" class="<?php echo esc_attr( $astro_be_prefix . 'label' ); ?> <?php echo esc_attr( $astro_be_prefix . 'label-' . $field_class ); ?>"><?php echo esc_html($field_label); ?></label>
                        <select name="ch" id="<?php echo esc_attr( $astro_be_prefix . $provider . '-' . $field_class ); ?>" class="<?php echo esc_attr( $astro_be_prefix . 'select' ); ?> <?php echo esc_attr( $astro_be_prefix . 'select-' . $field_class ); ?>">
                        <?php for ($i = 0; $i <= $children_n_max; $i++) { ?>
                            <option value="<?php echo esc_attr($i); ?>" <?php if (($children_n_default == $i) && ($children_n_default > 0)) { echo ' selected=selected'; } ?>><?php echo esc_html($i); ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <!-- /<?php echo esc_attr( $astro_be_prefix.$field_class ); ?> -->
                <?php
            }else{
                ?>
                <input type="hidden" id="astro_be_form<?php echo esc_attr( '_'. esc_attr($provider) ); ?>_children" name="ch" value="0" />
            <?php
            }
            ?>

        </div>
        <!-- /<?php echo esc_attr( $astro_be_prefix.'occupancy' ); ?> -->

        <?php
        $coupon_code_enable = get_option($astro_be_prefix.$provider.'_coupon');
        if ($coupon_code_enable) {
            $field_class = esc_attr('coupon');
            $field_label = __( 'Coupon', 'astro-booking-engine' );
        ?>
        <!-- <?php echo esc_attr( $astro_be_prefix.$field_class ); ?> -->
        <div class="<?php echo esc_attr( $astro_be_prefix . 'row' ); ?> <?php echo esc_attr( $astro_be_prefix . $field_class ); ?>">
            <div class="<?php echo esc_attr( $astro_be_prefix . 'column ' . $astro_be_prefix . 'column-' . $field_class ); ?>">
                <div class="<?php echo esc_attr( $astro_be_prefix . 'column-inner' ); ?>">
                    <label for="<?php echo esc_attr( $astro_be_prefix . $provider . '-' . $field_class ); ?>" class="<?php echo esc_attr( $astro_be_prefix . 'label' ); ?> <?php echo esc_attr( $astro_be_prefix . 'label-' . $field_class ); ?>"><?php echo esc_html($field_label); ?></label>
                    <input type="text" name="coupon" id="<?php echo esc_attr( $astro_be_prefix . $provider . '-' . $field_class ); ?>" class="<?php echo esc_attr( $astro_be_prefix . 'input' ); ?> <?php echo esc_attr( $astro_be_prefix . 'input-' . $field_class ); ?>" size="5" />
                </div>
            </div>
        </div>
        <!-- /<?php echo esc_attr( $astro_be_prefix.$field_class ); ?> -->
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
        <!-- <?php echo esc_attr( $astro_be_prefix.$field_class ); ?> -->
        <div class="<?php echo esc_attr( $astro_be_prefix . 'row' ); ?> <?php echo esc_attr( $astro_be_prefix . $field_class ); ?>">
            <div class="<?php echo esc_attr( $astro_be_prefix . 'column ' . $astro_be_prefix . 'column-' . $field_class ); ?>">
                <div class="<?php echo esc_attr( $astro_be_prefix . 'column-inner' ); ?>">
                    <label class="<?php echo esc_attr( $astro_be_prefix . 'label' ); ?> <?php echo esc_attr( $astro_be_prefix . 'label-' . $field_class ); ?>" aria-hidden="true"><?php echo esc_html($field_label); ?></label>
                    <input type="submit" class="<?php echo esc_attr( $astro_be_prefix . 'input' ); ?> <?php echo esc_attr( $astro_be_prefix . 'input-' . $field_class ); ?>" value="<?php echo esc_attr($value); ?>" />
                </div>
            </div>
        </div>
        <!-- /<?php echo esc_attr( $astro_be_prefix.$field_class ); ?> -->

    </form>

</div>
