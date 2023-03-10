<?php
/**
 * Vertical booking.
 */
$provider = esc_attr('verticalbooking');
?>
<div class="astro_be <?php echo ASTRO_BE_PREFIX . $provider; ?>">

	<form class="astro_be_form astro_be_form<?php echo '_'. $provider; ?>"
          method="<?php echo esc_attr( get_option(ASTRO_BE_PREFIX.$provider.'_form_method') ); ?>"
          action="https://reservations.verticalbooking.com/reservations/risultato.html"
          target="<?php echo esc_attr( get_option(ASTRO_BE_PREFIX.$provider.'_form_target') ); ?>">

		<input type="hidden" name="id_albergo" value="<?php echo esc_attr( get_option(ASTRO_BE_PREFIX.$provider.'_id_albergo') ); ?>" />
		<input type="hidden" name="dc" value="<?php echo esc_attr( get_option(ASTRO_BE_PREFIX.$provider.'_dc') ); ?>" />
		<input type="hidden" name="id_stile" value="<?php echo esc_attr( get_option(ASTRO_BE_PREFIX.$provider.'_id_stile') ); ?>" />
		<input type="hidden" name="tot_camere" value="1" />

		<input type="hidden" name="lingua_int" value="<?php echo esc_attr( astro_return_verticalbooking_language() ); ?>" />

        <input name="gg" id="gg" value="" type="hidden">
        <input name="mm" id="mm" value="" type="hidden">
        <input name="aa" id="aa" value="" type="hidden">
        <input name="ggf" id="ggf" value="" type="hidden">
        <input name="mmf" id="mmf" value="" type="hidden">
        <input name="aaf" id="aaf" value="" type="hidden">

		<!-- <?php echo esc_attr(ASTRO_BE_PREFIX); ?>dates -->
		<?php
		$dates_hide_mobile = get_option(ASTRO_BE_PREFIX.$provider.'_checkin_checkout_hide_mobile');
		?>
		<div class="<?php echo ASTRO_BE_PREFIX . 'row'; ?> <?php echo ASTRO_BE_PREFIX . 'dates'; ?> <?php if ($dates_hide_mobile > 0) { echo ASTRO_BE_PREFIX . 'hide_mobile'; } ?>">
			<?php
			$field_class = esc_attr('checkin');
			$field_label = __( 'Check-in', 'astro-booking-engine' );
			$field_name = 'checkin';
			//$field_date_format = get_option(ASTRO_BE_PREFIX.$provider.'_Arrivo_date_format');
			$field_date_format = 'dd/mm/yy';
			?>
			<!-- <?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
			<div class="<?php echo ASTRO_BE_PREFIX . 'column ' . ASTRO_BE_PREFIX . 'column-' . $field_class; ?>">
				<div class="<?php echo ASTRO_BE_PREFIX . 'column-inner'; ?>">
					<label for="<?php echo esc_attr($field_name); ?>" class="<?php echo ASTRO_BE_PREFIX . 'label'; ?> <?php echo ASTRO_BE_PREFIX . 'label-' . $field_class; ?>"><?php echo $field_label; ?></label>
					<input type="text" name="<?php echo esc_attr($field_name); ?>" class="datepicker <?php echo ASTRO_BE_PREFIX . 'input'; ?> <?php echo ASTRO_BE_PREFIX . 'input-' . $field_class; ?>" size="10" data-date-format="<?php echo esc_attr($field_date_format); ?>" readonly />
				</div>
			</div>
			<!-- /<?php echo ASTRO_BE_PREFIX.$field_class; ?> -->

			<?php
			$field_class = esc_attr('checkout');
			$field_label = __( 'Check-out', 'astro-booking-engine' );
			$field_name = 'checkout'; //provider field name
			//$field_date_format = get_option(ASTRO_BE_PREFIX.$provider.'_Partenza_date_format');
			$field_date_format = 'dd/mm/yy';
			?>
			<!-- <?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
			<div class="<?php echo ASTRO_BE_PREFIX . 'column ' . ASTRO_BE_PREFIX . 'column-' . $field_class; ?>">
				<div class="<?php echo ASTRO_BE_PREFIX . 'column-inner'; ?>">
					<label for="<?php echo esc_attr($field_name); ?>" class="<?php echo ASTRO_BE_PREFIX . 'label'; ?> <?php echo ASTRO_BE_PREFIX . 'label-' . $field_class; ?>"><?php echo $field_label; ?></label>
					<input type="text" name="<?php echo esc_attr($field_name); ?>" class="datepicker <?php echo ASTRO_BE_PREFIX . 'input'; ?> <?php echo ASTRO_BE_PREFIX . 'input-' . $field_class; ?>" size="10" data-date-format="<?php echo esc_attr($field_date_format); ?>" readonly />
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
			$field_name = 'tot_adulti'; //provider field name
			if ($adults_enable) {
				$adults_hide_mobile = get_option(ASTRO_BE_PREFIX.$provider.'_adults_hide_mobile');
				?>
                <!-- <?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
                <div class="<?php echo ASTRO_BE_PREFIX . 'column ' . ASTRO_BE_PREFIX . 'column-' . $field_class; ?> <?php if ($adults_hide_mobile > 0) { echo ASTRO_BE_PREFIX . 'hide_mobile'; } ?>">
                    <div class="<?php echo ASTRO_BE_PREFIX . 'column-inner'; ?>">
                        <label for="<?php echo $field_name; ?>" class="<?php echo ASTRO_BE_PREFIX . 'label'; ?> <?php echo ASTRO_BE_PREFIX . 'label-' . $field_class; ?>"><?php echo $field_label; ?></label>
                        <select name="<?php echo esc_attr($field_name); ?>" class="<?php echo ASTRO_BE_PREFIX . 'select'; ?> <?php echo ASTRO_BE_PREFIX . 'select-' . $field_class; ?>">
						<?php for ($i = 1; $i <= $adults_n_max; $i++) { ?>
                            <option value="<?php echo $i; ?>" <?php if ($adults_n_default == $i) { echo ' selected="selected"'; } ?>><?php echo $i; ?></option>
						<?php } ?>
                        </select>
                    </div>
                </div>
                <!-- /<?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
				<?php
			}else{
            ?>
                <input type="hidden" name="<?php echo esc_attr($field_name); ?>" value="1" />
            <?php
            }
			?>

			<?php
			$children_enable = get_option(ASTRO_BE_PREFIX.$provider.'_children_enable');
			$children_n_default = get_option(ASTRO_BE_PREFIX.$provider.'_children_n_default');
			$children_n_max = get_option(ASTRO_BE_PREFIX.$provider.'_children_n_max');

			$field_class = esc_attr('children');
			$field_label = __( 'Children', 'astro-booking-engine' );
			$field_name = 'tot_bambini'; //provider field name
			if ($children_enable) {
				$children_hide_mobile = get_option(ASTRO_BE_PREFIX.$provider.'_children_hide_mobile');
				?>
                <!-- <?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
                <div class="<?php echo ASTRO_BE_PREFIX . 'column ' . ASTRO_BE_PREFIX . 'column-' . $field_class; ?> <?php if ($children_hide_mobile > 0) { echo ASTRO_BE_PREFIX . 'hide_mobile'; } ?>">
                    <div class="<?php echo ASTRO_BE_PREFIX . 'column-inner'; ?>">
                        <label for="<?php echo $field_name; ?>" class="<?php echo ASTRO_BE_PREFIX . 'label'; ?> <?php echo ASTRO_BE_PREFIX . 'label-' . $field_class; ?>"><?php echo $field_label; ?></label>
                        <select name="<?php echo esc_attr($field_name); ?>"" class="<?php echo ASTRO_BE_PREFIX . 'select'; ?> <?php echo ASTRO_BE_PREFIX . 'select-' . $field_class; ?>">
						<?php for ($i = 0; $i <= $children_n_max; $i++) { ?>
                            <option value="<?php echo $i; ?>" <?php if ($children_n_default == $i) { echo ' selected="selected"'; } ?>><?php echo $i; ?></option>
						<?php } ?>
                        </select>
                    </div>
                </div>
                <!-- /<?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
				<?php
			}else{
				?>
                <input type="hidden" name="<?php echo esc_attr($field_name); ?>" value="0" />
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
		$field_name = 'st1bamb'; //provider field name

		if ($childage_enable) {

			$childage_hide_mobile = get_option(ASTRO_BE_PREFIX.$provider.'_childage_hide_mobile');
			?>
            <!-- <?php echo ASTRO_BE_PREFIX.$field_class; ?> -->
            <div class="<?php echo ASTRO_BE_PREFIX . 'row'; ?> <?php echo ASTRO_BE_PREFIX . $field_class; ?> <?php if ($childage_hide_mobile > 0) { echo ASTRO_BE_PREFIX . 'hide_mobile'; } ?>">
				<?php
				for ($x = 1; $x <= $children_n_max; $x++) {
					?>
                    <div class="<?php echo ASTRO_BE_PREFIX . 'column ' . ASTRO_BE_PREFIX . 'column-' . $field_class; ?> <?php echo ASTRO_BE_PREFIX . 'column-' . $field_class . '-' . $x; ?>">
                        <div class="<?php echo ASTRO_BE_PREFIX . 'column-inner'; ?>">
                            <label for="<?php echo $field_name . '_' . $x; ?>" class="<?php echo ASTRO_BE_PREFIX . 'label'; ?> <?php echo ASTRO_BE_PREFIX . 'label-' . $field_class; ?>"><?php echo $field_label; ?> <?php echo $x; ?></label>
                            <select name="<?php echo $field_name . $x; ?>" class="<?php echo ASTRO_BE_PREFIX . 'select'; ?> <?php echo ASTRO_BE_PREFIX . 'select-' . $field_class; ?>" size="1">
								<?php for ($i = $childage_min; $i <= $childage_max; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
		$value = __('Send', 'astro-booking-engine' );
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
					<label class="<?php echo ASTRO_BE_PREFIX . 'label'; ?> <?php echo ASTRO_BE_PREFIX . 'label-' . $field_class; ?>"><?php echo $field_label; ?></label>
					<input type="submit" class="<?php echo ASTRO_BE_PREFIX . 'input'; ?> <?php echo ASTRO_BE_PREFIX . 'input-' . $field_class; ?>" value="<?php echo esc_attr($value); ?>" />
				</div>
			</div>
		</div>
		<!-- /<?php echo ASTRO_BE_PREFIX.$field_class; ?> -->

	</form>

</div>
