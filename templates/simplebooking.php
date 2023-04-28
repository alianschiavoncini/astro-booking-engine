<?php
/**
 * Simple booking.
 */
$provider = esc_attr('simplebooking');
?>
<div class="astro_be <?php echo ASTRO_BE_PREFIX . $provider; ?>">

    <form class="astro_be_form astro_be_form<?php echo '_'. $provider; ?>"
          method="<?php echo esc_attr( get_option(ASTRO_BE_PREFIX.$provider.'_form_method') ); ?>"
          action="https://www.simplebooking.it/ibe/hotelbooking/search"
          target="<?php echo esc_attr( get_option(ASTRO_BE_PREFIX.$provider.'_form_target') ); ?>">

        <input type="hidden" name="hid" value="<?php echo esc_attr( get_option(ASTRO_BE_PREFIX.$provider.'_hid') ); ?>" />
        <input type="hidden" name="cur" value="<?php echo esc_attr( get_option(ASTRO_BE_PREFIX.$provider.'_currency') ); ?>" />
        <input type="hidden" name="lang" value="<?php echo esc_attr( astro_return_post_language() ); ?>" />
        <input type="hidden" id="astro_be_form<?php echo '_'. $provider; ?>_in" name="in" value="" />
        <input type="hidden" id="astro_be_form<?php echo '_'. $provider; ?>_out" name="out" value="" />
        <input type="hidden" id="astro_be_form<?php echo '_'. $provider; ?>_guests" name="guests" value="A" />

        <!-- <?php echo esc_attr(ASTRO_BE_PREFIX); ?>dates -->
        <div class="<?php echo ASTRO_BE_PREFIX . 'row'; ?> <?php echo ASTRO_BE_PREFIX . 'dates'; ?>">
            <?php
            $field_class = esc_attr('checkin');
            $field_label = __( 'Check-in', 'astro-booking-engine' );
            $field_name = 'checkin';
            //$field_date_format = get_option(ASTRO_BE_PREFIX.$provider.'_checkin_date_format');
			$field_date_format = astro_print_checkin_checkout_datepicker_format();
            ?>
            <!-- <?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
            <div class="<?php echo ASTRO_BE_PREFIX . 'column ' . ASTRO_BE_PREFIX . 'column-' . $field_class; ?>">
                <div class="<?php echo ASTRO_BE_PREFIX . 'column-inner'; ?>">
                    <label for="<?php echo esc_attr($field_name); ?>" class="<?php echo ASTRO_BE_PREFIX . 'label'; ?> <?php echo ASTRO_BE_PREFIX . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?></label>
                    <input type="text" class="datepicker <?php echo ASTRO_BE_PREFIX . 'input'; ?> <?php echo ASTRO_BE_PREFIX . 'input-' . $field_class; ?>" size="10" data-date-format="<?php echo esc_attr($field_date_format); ?>" readonly data-no-submit />
                    <input type="hidden" class="<?php echo ASTRO_BE_PREFIX . 'input-' . $field_class; ?>-js" value="<?php echo date("Y-m-d"); ?>" />
                </div>
            </div>
            <!-- /<?php echo ASTRO_BE_PREFIX.$field_class; ?> -->

            <?php
            $field_class = esc_attr('checkout');
            $field_label = __( 'Check-out', 'astro-booking-engine' );
            $field_name = 'checkout';
            //$field_date_format = get_option(ASTRO_BE_PREFIX.$provider.'_checkout_date_format');
			$field_date_format = astro_print_checkin_checkout_datepicker_format();
            ?>
            <!-- <?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
            <div class="<?php echo ASTRO_BE_PREFIX . 'column ' . ASTRO_BE_PREFIX . 'column-' . $field_class; ?>">
                <div class="<?php echo ASTRO_BE_PREFIX . 'column-inner'; ?>">
                    <label for="<?php echo esc_attr($field_name); ?>" class="<?php echo ASTRO_BE_PREFIX . 'label'; ?> <?php echo ASTRO_BE_PREFIX . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?></label>
                    <input type="text" class="datepicker <?php echo ASTRO_BE_PREFIX . 'input'; ?> <?php echo ASTRO_BE_PREFIX . 'input-' . $field_class; ?>" size="10" data-date-format="<?php echo esc_attr($field_date_format); ?>" readonly data-no-submit />
                    <input type="hidden" class="<?php echo ASTRO_BE_PREFIX . 'input-' . $field_class; ?>-js" value="<?php echo date("Y-m-d", strtotime("+1 day")); ?>" />
                </div>
            </div>
            <!-- /<?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
        </div>
        <!-- /<?php echo ASTRO_BE_PREFIX.'dates'; ?> -->

        <!-- <?php echo ASTRO_BE_PREFIX.'occupancy'; ?> -->
        <div class="<?php echo ASTRO_BE_PREFIX . 'row'; ?> <?php echo ASTRO_BE_PREFIX . 'occupancy'; ?>">
            <?php
            $adults_enable = get_option(ASTRO_BE_PREFIX.$provider.'_adults_enable');
            $adults_n_default = (int)get_option(ASTRO_BE_PREFIX.$provider.'_adults_n_default');
            $adults_n_max = (int)get_option(ASTRO_BE_PREFIX.$provider.'_adults_n_max');

            $field_class = esc_attr('adults');
            $field_label = __( 'Adults', 'astro-booking-engine' );
            $field_name = 'adults'; //provider field name
            if ($adults_enable) {
            ?>
                <!-- <?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
                <div class="<?php echo ASTRO_BE_PREFIX . 'column ' . ASTRO_BE_PREFIX . 'column-' . $field_class; ?>">
                    <div class="<?php echo ASTRO_BE_PREFIX . 'column-inner'; ?>">
                        <label for="<?php echo esc_attr($field_name); ?>" class="<?php echo ASTRO_BE_PREFIX . 'label'; ?> <?php echo ASTRO_BE_PREFIX . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?></label>
                        <select class="<?php echo ASTRO_BE_PREFIX . 'select'; ?> <?php echo ASTRO_BE_PREFIX . 'select-' . $field_class; ?>" data-no-submit>
                        <?php for ($i = 1; $i <= $adults_n_max; $i++) { ?>
                            <option value="<?php echo esc_attr($i); ?>" <?php if ($adults_n_default == $i) { echo ' selected=selected'; } ?>><?php echo esc_html($i); ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <!-- /<?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
            <?php
            }
            ?>

            <?php
            $children_enable = get_option(ASTRO_BE_PREFIX.$provider.'_children_enable');
            $children_n_default = get_option(ASTRO_BE_PREFIX.$provider.'_children_n_default');
            $children_n_max = get_option(ASTRO_BE_PREFIX.$provider.'_children_n_max');

            $field_class = esc_attr('children');
            $field_label = __( 'Children', 'astro-booking-engine' );
            $field_name = 'children'; //provider field name
            if ($children_enable) {
            ?>
                <!-- <?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
                <div class="<?php echo ASTRO_BE_PREFIX . 'column ' . ASTRO_BE_PREFIX . 'column-' . $field_class; ?>">
                    <div class="<?php echo ASTRO_BE_PREFIX . 'column-inner'; ?>">
                        <label for="<?php echo esc_attr($field_name); ?>" class="<?php echo ASTRO_BE_PREFIX . 'label'; ?> <?php echo ASTRO_BE_PREFIX . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?></label>
                        <select class="<?php echo ASTRO_BE_PREFIX . 'select'; ?> <?php echo ASTRO_BE_PREFIX . 'select-' . $field_class; ?>" data-no-submit>
                        <?php for ($i = 0; $i <= $children_n_max; $i++) { ?>
                            <option value="<?php echo esc_attr($i); ?>" <?php if (($children_n_default == $i) && ($children_n_default > 0)) { echo ' selected=selected'; } ?>><?php echo esc_html($i); ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <!-- /<?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
            <?php
            }
            ?>

        </div>
        <!-- /<?php echo ASTRO_BE_PREFIX.'occupancy'; ?> -->

        <?php
        $childage_enable = get_option(ASTRO_BE_PREFIX.$provider.'_childage_enable');
        $childage_min = (int)get_option(ASTRO_BE_PREFIX.$provider.'_childage_min');
        $childage_max = (int)get_option(ASTRO_BE_PREFIX.$provider.'_childage_max');

        $field_class = esc_attr('children_age');
        $field_label = __( 'Child Age', 'astro-booking-engine' );
        $field_name = 'childage'; //provider field name

        if ($childage_enable) {
            ?>
            <!-- <?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
            <div class="<?php echo ASTRO_BE_PREFIX . 'row'; ?> <?php echo ASTRO_BE_PREFIX . $field_class; ?>">
                <?php
                for ($x = 1; $x <= $children_n_max; $x++) {
                    ?>
                    <div class="<?php echo ASTRO_BE_PREFIX . 'column ' . ASTRO_BE_PREFIX . 'column-' . $field_class; ?> <?php echo ASTRO_BE_PREFIX . 'column-' . $field_class . '-' . $x; ?>">
                        <div class="<?php echo ASTRO_BE_PREFIX . 'column-inner'; ?>">
                            <label for="<?php echo esc_attr($field_name . '_' . $x); ?>" class="<?php echo ASTRO_BE_PREFIX . 'label'; ?> <?php echo ASTRO_BE_PREFIX . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?> <?php echo esc_html($x); ?></label>
                            <select class="<?php echo ASTRO_BE_PREFIX . 'select'; ?> <?php echo ASTRO_BE_PREFIX . 'select-' . $field_class; ?>" size="1" data-no-submit>
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
            <!-- /<?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
            <?php
        }
        ?>

        <?php
        $coupon_code_enable = get_option(ASTRO_BE_PREFIX.$provider.'_coupon');
        if ($coupon_code_enable) {
            $field_class = esc_attr('coupon');
            $field_label = __( 'Coupon', 'astro-booking-engine' );
            $field_name = 'coupon'; //provider field name
        ?>
        <!-- <?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
        <div class="<?php echo ASTRO_BE_PREFIX . 'row'; ?> <?php echo ASTRO_BE_PREFIX . $field_class; ?>">
            <div class="<?php echo ASTRO_BE_PREFIX . 'column ' . ASTRO_BE_PREFIX . 'column-' . $field_class; ?>">
                <div class="<?php echo ASTRO_BE_PREFIX . 'column-inner'; ?>">
                    <label for="<?php echo esc_attr($field_name); ?>" class="<?php echo ASTRO_BE_PREFIX . 'label'; ?> <?php echo ASTRO_BE_PREFIX . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?></label>
                    <input type="text" name="<?php echo esc_attr($field_name); ?>" class="<?php echo ASTRO_BE_PREFIX . 'input'; ?> <?php echo ASTRO_BE_PREFIX . 'input-' . $field_class; ?>" size="5" />
                </div>
            </div>
        </div>
        <!-- /<?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
        <?php
        }else{
        ?>
            <input type="hidden" name="<?php echo esc_attr($field_name); ?>" value="" />
        <?php
        }
        ?>

        <?php
        $value = __('Search', 'astro-booking-engine' );
        $submit_label = get_option(ASTRO_BE_PREFIX.$provider.'_submit_label');
        if (!empty($submit_label)) {
            $value = $submit_label;
        }

        $field_class = esc_attr('submit_button');
        $field_label = $value;
        ?>
        <!-- <?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
        <div class="<?php echo ASTRO_BE_PREFIX . 'row'; ?> <?php echo ASTRO_BE_PREFIX . $field_class; ?>">
            <div class="<?php echo ASTRO_BE_PREFIX . 'column ' . ASTRO_BE_PREFIX . 'column-' . $field_class; ?>">
                <div class="<?php echo ASTRO_BE_PREFIX . 'column-inner'; ?>">
                    <label class="<?php echo ASTRO_BE_PREFIX . 'label'; ?> <?php echo ASTRO_BE_PREFIX . 'label-' . $field_class; ?>"><?php echo esc_html($field_label); ?></label>
                    <input type="submit" class="<?php echo ASTRO_BE_PREFIX . 'input'; ?> <?php echo ASTRO_BE_PREFIX . 'input-' . $field_class; ?>" value="<?php echo esc_attr($value); ?>" />
                </div>
            </div>
        </div>
        <!-- /<?php echo ASTRO_BE_PREFIX.$field_class; ?> -->

    </form>

</div>
