<?php
/**
 * Ericsoft.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$provider = esc_attr('ericsoft');
$astro_be_prefix = esc_attr(ASTRO_BE_PREFIX);

// pax format: adults_0_children_infants (counts per age category, no ages)
$pax_adults = 1;
if (get_option($astro_be_prefix.$provider.'_adults_enable')) {
	$pax_adults = (int)get_option($astro_be_prefix.$provider.'_adults_n_default');
	if ($pax_adults < 1) { $pax_adults = 1; }
}
$pax_children = 0;
if (get_option($astro_be_prefix.$provider.'_children_enable')) {
	$pax_children = (int)get_option($astro_be_prefix.$provider.'_children_n_default');
}
$pax_infants = 0;
if (get_option($astro_be_prefix.$provider.'_infants_enable')) {
	$pax_infants = (int)get_option($astro_be_prefix.$provider.'_infants_n_default');
}
$pax_value = $pax_adults . '_0_' . $pax_children . '_' . $pax_infants;
?>
<div class="astro_be <?php echo $astro_be_prefix . $provider; ?>">

    <form class="astro_be_form astro_be_form<?php echo '_'. esc_attr($provider); ?>"
          method="<?php echo esc_attr( get_option($astro_be_prefix.$provider.'_form_method') ); ?>"
          action="https://booking.ericsoft.com/BookingEngine/Book"
          target="<?php echo esc_attr( get_option($astro_be_prefix.$provider.'_form_target') ); ?>">

        <input type="hidden" name="idh" value="<?php echo esc_attr( get_option($astro_be_prefix.$provider.'_idh') ); ?>" />
        <input type="hidden" name="lang" value="<?php echo esc_attr( astro_return_post_language() ); ?>" />
        <input type="hidden" name="cur" value="<?php echo esc_attr( get_option($astro_be_prefix.$provider.'_currency') ); ?>" />
        <input type="hidden" id="astro_be_form<?php echo '_'. esc_attr($provider); ?>_arrival" name="arrival" value="" />
        <input type="hidden" id="astro_be_form<?php echo '_'. esc_attr($provider); ?>_departure" name="departure" value="" />
        <input type="hidden" id="astro_be_form<?php echo '_'. esc_attr($provider); ?>_pax" name="pax" value="<?php echo esc_attr($pax_value); ?>" />
        <input type="hidden" name="ragazzi" value="0" />

        <!-- <?php echo esc_attr(ASTRO_BE_PREFIX); ?>dates -->
        <div class="<?php echo $astro_be_prefix . 'row'; ?> <?php echo $astro_be_prefix . 'dates'; ?>">
            <?php
            $field_class = esc_attr('checkin');
            $field_label = __( 'Check-in', 'astro-booking-engine' );
            $field_name = 'checkin';
            $field_date_format = astro_print_checkin_checkout_datepicker_format();
            ?>
            <!-- <?php echo $astro_be_prefix.$field_class; ?> -->
            <div class="<?php echo $astro_be_prefix . 'column ' . $astro_be_prefix . 'column-' . $field_class; ?>">
                <div class="<?php echo $astro_be_prefix . 'column-inner'; ?>">
                    <label for="<?php echo esc_attr($field_name); ?>" class="<?php echo $astro_be_prefix . 'label'; ?> <?php echo $astro_be_prefix . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?></label>
                    <input type="text" class="datepicker <?php echo $astro_be_prefix . 'input'; ?> <?php echo $astro_be_prefix . 'input-' . $field_class; ?>" size="10" data-date-format="<?php echo esc_attr($field_date_format); ?>" readonly data-no-submit />
                    <input type="hidden" class="<?php echo $astro_be_prefix . 'input-' . $field_class; ?>-js" value="<?php echo date_i18n("Y-m-d"); ?>" />
                </div>
            </div>
            <!-- /<?php echo $astro_be_prefix.$field_class; ?> -->

            <?php
            $field_class = esc_attr('checkout');
            $field_label = __( 'Check-out', 'astro-booking-engine' );
            $field_name = 'checkout';
            $field_date_format = astro_print_checkin_checkout_datepicker_format();
            ?>
            <!-- <?php echo $astro_be_prefix.$field_class; ?> -->
            <div class="<?php echo $astro_be_prefix . 'column ' . $astro_be_prefix . 'column-' . $field_class; ?>">
                <div class="<?php echo $astro_be_prefix . 'column-inner'; ?>">
                    <label for="<?php echo esc_attr($field_name); ?>" class="<?php echo $astro_be_prefix . 'label'; ?> <?php echo $astro_be_prefix . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?></label>
                    <input type="text" class="datepicker <?php echo $astro_be_prefix . 'input'; ?> <?php echo $astro_be_prefix . 'input-' . $field_class; ?>" size="10" data-date-format="<?php echo esc_attr($field_date_format); ?>" readonly data-no-submit />
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
                        <label class="<?php echo $astro_be_prefix . 'label'; ?> <?php echo $astro_be_prefix . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?></label>
                        <select class="<?php echo $astro_be_prefix . 'select'; ?> <?php echo $astro_be_prefix . 'select-' . $field_class; ?>" data-no-submit>
                        <?php for ($i = 1; $i <= $adults_n_max; $i++) { ?>
                            <option value="<?php echo esc_attr($i); ?>" <?php if ($adults_n_default == $i) { echo ' selected=selected'; } ?>><?php echo esc_html($i); ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <!-- /<?php echo $astro_be_prefix.$field_class; ?> -->
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
                        <label class="<?php echo $astro_be_prefix . 'label'; ?> <?php echo $astro_be_prefix . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?></label>
                        <select class="<?php echo $astro_be_prefix . 'select'; ?> <?php echo $astro_be_prefix . 'select-' . $field_class; ?>" data-no-submit>
                        <?php for ($i = 0; $i <= $children_n_max; $i++) { ?>
                            <option value="<?php echo esc_attr($i); ?>" <?php if (($children_n_default == $i) && ($children_n_default > 0)) { echo ' selected=selected'; } ?>><?php echo esc_html($i); ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <!-- /<?php echo $astro_be_prefix.$field_class; ?> -->
            <?php
            }
            ?>

            <?php
            $infants_enable = get_option($astro_be_prefix.$provider.'_infants_enable');
            $infants_n_default = get_option($astro_be_prefix.$provider.'_infants_n_default');
            $infants_n_max = get_option($astro_be_prefix.$provider.'_infants_n_max');

            $field_class = esc_attr('infants');
            $field_label = __( 'Infants', 'astro-booking-engine' );
            if ($infants_enable) {
            ?>
                <!-- <?php echo $astro_be_prefix.$field_class; ?> -->
                <div class="<?php echo $astro_be_prefix . 'column ' . $astro_be_prefix . 'column-' . $field_class; ?>">
                    <div class="<?php echo $astro_be_prefix . 'column-inner'; ?>">
                        <label class="<?php echo $astro_be_prefix . 'label'; ?> <?php echo $astro_be_prefix . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?></label>
                        <select class="<?php echo $astro_be_prefix . 'select'; ?> <?php echo $astro_be_prefix . 'select-' . $field_class; ?>" data-no-submit>
                        <?php for ($i = 0; $i <= $infants_n_max; $i++) { ?>
                            <option value="<?php echo esc_attr($i); ?>" <?php if (($infants_n_default == $i) && ($infants_n_default > 0)) { echo ' selected=selected'; } ?>><?php echo esc_html($i); ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <!-- /<?php echo $astro_be_prefix.$field_class; ?> -->
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
                    <label class="<?php echo $astro_be_prefix . 'label'; ?> <?php echo $astro_be_prefix . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?></label>
                    <input type="submit" class="<?php echo $astro_be_prefix . 'input'; ?> <?php echo $astro_be_prefix . 'input-' . $field_class; ?>" value="<?php echo esc_attr($value); ?>" />
                </div>
            </div>
        </div>
        <!-- /<?php echo $astro_be_prefix.$field_class; ?> -->

    </form>

</div>
