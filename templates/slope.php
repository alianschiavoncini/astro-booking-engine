<?php
/**
 * Slope.
 * Booking engine at https://booking.slope.it/<property>, where the property is a code such as
 * 0a1b2c3d-4e5f-6a7b-8c9d-0e1f2a3b4c5d. The search is posted to /widgets/search/<property>, as the Slope
 * widget does: reservation[stay][arrival] and [departure] (d/m/Y), reservation[guests][adults] and
 * [children]. The booking engine answers with the choice of the rooms, in the language of the browser;
 * the ages of the children are asked there.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$provider = esc_attr('slope');
$astro_be_prefix = esc_attr(ASTRO_BE_PREFIX);
// L'opzione tiene il solo codice della struttura, quello dopo booking.slope.it/.
$slope_property = astro_be_get_sanitized_option($astro_be_prefix.$provider.'_hotel');
?>
<div class="astro_be <?php echo $astro_be_prefix . $provider; ?>">

    <form class="astro_be_form astro_be_form<?php echo '_'. esc_attr($provider); ?>"
          method="post"
          action="<?php echo esc_url( 'https://booking.slope.it/widgets/search/' . $slope_property ); ?>"
          target="<?php echo esc_attr( get_option($astro_be_prefix.$provider.'_form_target') ); ?>">

        <?php //date in d/m/Y: le copia il JS dai campi nascosti in Y-m-d ?>
        <input type="hidden" id="astro_be_form<?php echo '_'. esc_attr($provider); ?>_arrival" name="reservation[stay][arrival]" value="" />
        <input type="hidden" id="astro_be_form<?php echo '_'. esc_attr($provider); ?>_departure" name="reservation[stay][departure]" value="" />
        <input type="hidden" name="reservation[next]" value="" />

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
                        <select name="reservation[guests][adults]" id="<?php echo $astro_be_prefix . $provider . '-' . $field_class; ?>" class="<?php echo $astro_be_prefix . 'select'; ?> <?php echo $astro_be_prefix . 'select-' . $field_class; ?>">
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
                <input type="hidden" id="astro_be_form<?php echo '_'. esc_attr($provider); ?>_adults" name="reservation[guests][adults]" value="<?php echo esc_attr( max( 1, $adults_n_default ) ); ?>" />
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
                        <select name="reservation[guests][children]" id="<?php echo $astro_be_prefix . $provider . '-' . $field_class; ?>" class="<?php echo $astro_be_prefix . 'select'; ?> <?php echo $astro_be_prefix . 'select-' . $field_class; ?>">
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
                <input type="hidden" id="astro_be_form<?php echo '_'. esc_attr($provider); ?>_children" name="reservation[guests][children]" value="0" />
            <?php
            }
            ?>

        </div>
        <!-- /<?php echo $astro_be_prefix.'occupancy'; ?> -->

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
