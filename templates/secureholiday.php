<?php
/**
 * Secure Holiday (Ctoutvert).
 * Booking engine for campsites and holiday villages at https://reservation.secureholiday.net/<language>/<id>/search/product-list:
 * dateStart and dateEnd (d/m/Y) and travelers, the guests as 2@;1@6;1@10 (the adults as <n>@, every child as
 * 1@<age>), plus discountCode. The script composes the dates and the travelers on submit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$provider = esc_attr('secureholiday');
$astro_be_prefix = esc_attr(ASTRO_BE_PREFIX);
// L'opzione tiene il solo codice della struttura (1234 per reservation.secureholiday.net/it/1234/).
$secureholiday_id = astro_be_get_sanitized_option($astro_be_prefix.$provider.'_hotel');
?>
<div class="astro_be <?php echo $astro_be_prefix . $provider; ?>">

    <form class="astro_be_form astro_be_form<?php echo '_'. esc_attr($provider); ?>"
          method="get"
          action="<?php echo esc_url( 'https://reservation.secureholiday.net/' . astro_return_secureholiday_language() . '/' . $secureholiday_id . '/search/product-list' ); ?>"
          target="<?php echo esc_attr( get_option($astro_be_prefix.$provider.'_form_target') ); ?>">

        <input type="hidden" id="astro_be_form<?php echo '_'. esc_attr($provider); ?>_dateStart" name="dateStart" value="" />
        <input type="hidden" id="astro_be_form<?php echo '_'. esc_attr($provider); ?>_dateEnd" name="dateEnd" value="" />
        <?php //gli ospiti, adulti e bambini con le eta': li compone il JS ?>
        <input type="hidden" id="astro_be_form<?php echo '_'. esc_attr($provider); ?>_travelers" name="travelers" value="" />

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
            <?php
            $adults_enable = get_option($astro_be_prefix.$provider.'_adults_enable');
            $adults_n_default = (int)get_option($astro_be_prefix.$provider.'_adults_n_default');
            $adults_n_max = (int)get_option($astro_be_prefix.$provider.'_adults_n_max');

            $field_class = esc_attr('adults');
            $field_label = __( 'Adults', 'astro-booking-engine' );
            if ($adults_enable) {
                ?>
                <!-- <?php echo $astro_be_prefix.$field_class; ?> -->
                <div class="<?php echo $astro_be_prefix . 'column ' . $astro_be_prefix . 'column-' . $field_class; ?>">
                    <div class="<?php echo $astro_be_prefix . 'column-inner'; ?>">
                        <label for="<?php echo $astro_be_prefix . $provider . '-' . $field_class; ?>" class="<?php echo $astro_be_prefix . 'label'; ?> <?php echo $astro_be_prefix . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?></label>
                        <select data-no-submit id="<?php echo $astro_be_prefix . $provider . '-' . $field_class; ?>" class="<?php echo $astro_be_prefix . 'select'; ?> <?php echo $astro_be_prefix . 'select-' . $field_class; ?>">
                        <?php for ($i = 1; $i <= $adults_n_max; $i++) { ?>
                            <option value="<?php echo esc_attr($i); ?>" <?php if ($adults_n_default == $i) { echo ' selected=selected'; } ?>><?php echo esc_html($i); ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <!-- /<?php echo $astro_be_prefix.$field_class; ?> -->
                <?php
            }else{
            ?>
                <input type="hidden" id="astro_be_form<?php echo '_'. esc_attr($provider); ?>_adults" value="<?php echo esc_attr( max( 1, $adults_n_default ) ); ?>" />
            <?php
            }
            ?>

            <?php
            $children_enable = get_option($astro_be_prefix.$provider.'_children_enable');
            $children_n_default = get_option($astro_be_prefix.$provider.'_children_n_default');
            $children_n_max = get_option($astro_be_prefix.$provider.'_children_n_max');

            $field_class = esc_attr('children');
            $field_label = __( 'Children', 'astro-booking-engine' );
            if ($children_enable) {
                ?>
                <!-- <?php echo $astro_be_prefix.$field_class; ?> -->
                <div class="<?php echo $astro_be_prefix . 'column ' . $astro_be_prefix . 'column-' . $field_class; ?>">
                    <div class="<?php echo $astro_be_prefix . 'column-inner'; ?>">
                        <label for="<?php echo $astro_be_prefix . $provider . '-' . $field_class; ?>" class="<?php echo $astro_be_prefix . 'label'; ?> <?php echo $astro_be_prefix . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?></label>
                        <select data-no-submit id="<?php echo $astro_be_prefix . $provider . '-' . $field_class; ?>" class="<?php echo $astro_be_prefix . 'select'; ?> <?php echo $astro_be_prefix . 'select-' . $field_class; ?>">
                        <?php for ($i = 0; $i <= $children_n_max; $i++) { ?>
                            <option value="<?php echo esc_attr($i); ?>" <?php if (($children_n_default == $i) && ($children_n_default > 0)) { echo ' selected=selected'; } ?>><?php echo esc_html($i); ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <!-- /<?php echo $astro_be_prefix.$field_class; ?> -->
                <?php
            }else{
                ?>
                <input type="hidden" id="astro_be_form<?php echo '_'. esc_attr($provider); ?>_children" value="0" />
            <?php
            }
            ?>

        </div>
        <!-- /<?php echo $astro_be_prefix.'occupancy'; ?> -->

        <?php
        $childage_enable = get_option($astro_be_prefix.$provider.'_childage_enable');
        $childage_min = (int)get_option($astro_be_prefix.$provider.'_childage_min');
        $childage_max = (int)get_option($astro_be_prefix.$provider.'_childage_max');

        $field_class = esc_attr('children_age');
        $field_label = __( 'Child Age', 'astro-booking-engine' );

        if ($childage_enable) {
            ?>
            <!-- <?php echo $astro_be_prefix.$field_class; ?> -->
            <div class="<?php echo $astro_be_prefix . 'row'; ?> <?php echo $astro_be_prefix . $field_class; ?>">
                <?php
                for ($x = 1; $x <= $children_n_max; $x++) {
                    ?>
                    <div class="<?php echo $astro_be_prefix . 'column ' . $astro_be_prefix . 'column-' . $field_class; ?> <?php echo $astro_be_prefix . 'column-' . $field_class . '-' . esc_attr($x); ?>">
                        <div class="<?php echo $astro_be_prefix . 'column-inner'; ?>">
                            <label for="<?php echo $astro_be_prefix . $provider . '-' . $field_class . '-' . esc_attr($x); ?>" class="<?php echo $astro_be_prefix . 'label'; ?> <?php echo $astro_be_prefix . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?> <?php echo esc_html($x); ?></label>
                            <?php //senza name: le eta' le compone il JS ?>
                            <select data-no-submit id="<?php echo $astro_be_prefix . $provider . '-' . $field_class . '-' . esc_attr($x); ?>" class="<?php echo $astro_be_prefix . 'select'; ?> <?php echo $astro_be_prefix . 'select-' . $field_class; ?>" size="1">
                                <?php for ($i = $childage_min; $i <= $childage_max; $i++) { ?>
                                    <option value="<?php echo esc_attr($i); ?>"><?php echo esc_html($i); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!-- /<?php echo $astro_be_prefix.$field_class; ?> -->
            <?php
        }
        ?>

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
                    <input type="text" name="discountCode" id="<?php echo $astro_be_prefix . $provider . '-' . $field_class; ?>" class="<?php echo $astro_be_prefix . 'input'; ?> <?php echo $astro_be_prefix . 'input-' . $field_class; ?>" size="5" />
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
