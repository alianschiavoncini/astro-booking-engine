<?php
/**
 * Sirvoy.
 * The Sirvoy booking engine runs in a widget placed on a page of the hotel website, which reads the
 * search from the address of that page: check_in and check_out (Y-m-d), adults (the guests, adults and
 * children together), code, language and target=results, which opens the widget on the rooms. The form
 * goes to that page.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$provider = esc_attr('sirvoy');
$astro_be_prefix = esc_attr(ASTRO_BE_PREFIX);
// L'opzione tiene l'indirizzo della pagina del sito con il widget di Sirvoy.
$sirvoy_page = astro_be_get_sanitized_option($astro_be_prefix.$provider.'_hotel');
$sirvoy_language = astro_return_sirvoy_language();
?>
<div class="astro_be <?php echo $astro_be_prefix . $provider; ?>">

    <form class="astro_be_form astro_be_form<?php echo '_'. esc_attr($provider); ?>"
          method="get"
          action="<?php echo esc_url( $sirvoy_page ); ?>"
          target="<?php echo esc_attr( get_option($astro_be_prefix.$provider.'_form_target') ); ?>">

        <input type="hidden" id="astro_be_form<?php echo '_'. esc_attr($provider); ?>_check_in" name="check_in" value="" />
        <input type="hidden" id="astro_be_form<?php echo '_'. esc_attr($provider); ?>_check_out" name="check_out" value="" />
        <input type="hidden" name="target" value="results" />
        <?php
        //un form GET sostituisce la query dell'action: i parametri gia' presenti nell'indirizzo della
        //pagina (come page_id) vengono ripetuti come campi nascosti
        $sirvoy_query = wp_parse_url( $sirvoy_page, PHP_URL_QUERY );
        if ( $sirvoy_query ) {
            parse_str( $sirvoy_query, $sirvoy_query_args );
            foreach ( $sirvoy_query_args as $sirvoy_key => $sirvoy_value ) {
                if ( is_scalar( $sirvoy_value ) ) {
                    ?>
        <input type="hidden" name="<?php echo esc_attr( $sirvoy_key ); ?>" value="<?php echo esc_attr( $sirvoy_value ); ?>" />
                    <?php
                }
            }
        }
        ?>
        <?php if ( '' !== $sirvoy_language ) { ?>
        <input type="hidden" name="language" value="<?php echo esc_attr( $sirvoy_language ); ?>" />
        <?php } ?>

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
                        <select name="adults" id="<?php echo $astro_be_prefix . $provider . '-' . $field_class; ?>" class="<?php echo $astro_be_prefix . 'select'; ?> <?php echo $astro_be_prefix . 'select-' . $field_class; ?>">
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
                <input type="hidden" id="astro_be_form<?php echo '_'. esc_attr($provider); ?>_adults" name="adults" value="<?php echo esc_attr( max( 1, $adults_n_default ) ); ?>" />
            <?php
            }
            ?>

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
                    <input type="text" name="code" id="<?php echo $astro_be_prefix . $provider . '-' . $field_class; ?>" class="<?php echo $astro_be_prefix . 'input'; ?> <?php echo $astro_be_prefix . 'input-' . $field_class; ?>" size="5" />
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
