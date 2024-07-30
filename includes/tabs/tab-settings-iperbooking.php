<?php
if( ! is_admin() ) {
	return;
}

$provider = 'iperbooking';
?>
<!-- <?php echo esc_attr($provider); ?> -->
<div class="section-wrapper box <?php echo esc_attr($provider); ?>">
    <div class="section-wrapper-inner">

        <h2>Iperbooking</h2>

        <!-- hotelsettings -->
        <h3 id="hotelsettings"><?php esc_html_e( 'Hotel settings', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
			<?php
			$field = array(
				'label' => esc_html__( 'idHotel', 'astro-booking-engine' ),
				'description' => false,
				'name' => ASTRO_BE_PREFIX.$provider.'_idHotel',
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_idHotel'),
				'placeholder' => false,
			);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                <td>
                    <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text" value="<?php echo esc_attr($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>" />
                    <?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php }?>
                </td>
            </tr>
        </table>
        <!-- /hotelsettings -->

        <hr />

        <!-- formsetting -->
        <h3 id="formsetting"><?php esc_html_e( 'Form settings', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
			<?php
			$field = array(
				'label' => esc_html__( 'Target', 'astro-booking-engine' ),
				'description' => false,
				'name' => ASTRO_BE_PREFIX.$provider.'_form_target',
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_form_target'),
				'placeholder' => false
			);

            $arr_targets = array(
                                '_blank' =>  __('New window or tab', 'astro-booking-engine' ),
                                '_self' =>  __('Same window or tab', 'astro-booking-engine' ),
                                );
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                <td>
                    <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
                    <?php
                    foreach ($arr_targets as $k => $v) {
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
                </td>
            </tr>

			<?php
			$field = array(
				'label' => esc_html__( 'Language settings', 'astro-booking-engine' ),
				'description' => false,
				'name' => ASTRO_BE_PREFIX.$provider.'_language',
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_language'),
				'placeholder' => false
			);
			?>
            <tr>
                <th scope="row">
					<?php esc_html_e( 'Language options', 'astro-booking-engine' ); ?>
                    <p class="description"><strong>Option example</strong><br>
						<?php esc_html_e( 'Lang code', 'astro-booking-engine' ); ?>: EN<br>
						<?php esc_html_e( 'URL', 'astro-booking-engine' ); ?>: https://secure.iperbooking.net/be/en/your-hotel-name/</p>
                </th>
                <td class="<?php echo esc_attr($provider); ?>-language">
                    <button class="button <?php echo esc_attr($provider); ?>-language-options-add-field"><?php esc_html_e( 'Add new option', 'astro-booking-engine' ); ?></button>
					<?php
					$i = 1;

					$check_option = get_option($field['name']);
					if ($check_option) {
						$n_check_option = count($check_option);
                        $default_option = get_option($field['name'].'_default');
						foreach ($check_option as $option) {
							?>
                            <fieldset class="provider-fieldset provider-fieldset-<?php echo esc_attr($i); ?>">
                                <legend class="provider-fieldset-legend"><?php esc_html_e( 'Language option', 'astro-booking-engine' ); ?> #<?php echo esc_attr($i); ?></legend>
                                <div class="provider-fieldset-content">
                                    <div class="provider-fieldset-row">
                                        <span class="provider-fieldset-label"><?php esc_html_e( 'Lang code', 'astro-booking-engine' ); ?>:</span>
                                        <input type="text" name="<?php echo esc_attr($field['name']).'[option_'.esc_attr($i).'][code]'; ?>" class="regular-text" value="<?php echo esc_attr($option['code']); ?>" />
                                    </div>
                                    <div class="provider-fieldset-row">
                                        <span class="provider-fieldset-label"><?php esc_html_e( 'URL', 'astro-booking-engine' ); ?>:</span>
                                        <input type="text" name="<?php echo esc_attr($field['name']).'[option_'.esc_attr($i).'][url]'; ?>" class="regular-text" value="<?php echo esc_attr($option['url']); ?>" />
                                    </div>
                                    <div class="provider-fieldset-row">
                                        <span class="provider-fieldset-label"><?php esc_html_e( 'Default', 'astro-booking-engine' ); ?>:</span>
                                        <input type="radio"
                                               name="<?php echo esc_attr($field['name']).'_default'; ?>"
                                               class="<?php echo esc_attr($provider); ?>-language-option-default <?php echo esc_attr($provider); ?>-language-option-<?php echo esc_attr($i); ?>"
                                               value="option_<?php echo esc_attr($i); ?>"
											<?php
											if ($default_option == 'option_'.$i) {
												echo ' checked';
											}
											?> />
                                    </div>
                                </div>
								<?php if ($i > 1) { ?>
                                    <button class="button iperbooking-language-options-delete-field"><?php esc_html_e( 'Delete', 'astro-booking-engine' ); ?></button>
								<?php } ?>
                            </fieldset>
							<?php
							$i++;
						}
					}else{
						?>
                        <fieldset class="provider-fieldset provider-fieldset-<?php echo esc_attr($i); ?>">
                            <legend class="provider-fieldset-legend"><?php esc_html_e( 'Language option', 'astro-booking-engine' ); ?> #<?php echo esc_attr($i); ?></legend>
                            <div class="provider-fieldset-content">
                                <div class="provider-fieldset-row">
                                    <span class="provider-fieldset-label">Lang code:</span>
                                    <input type="text" name="<?php echo esc_attr($field['name']).'[option_'.esc_attr($i).'][code]'; ?>" class="regular-text" value="" />
                                </div>
                                <div class="provider-fieldset-row">
                                    <span class="provider-fieldset-label">URL:</span>
                                    <input type="text" name="<?php echo esc_attr($field['name']).'[option_'.esc_attr($i).'][url]'; ?>" class="regular-text" value="" />
                                </div>
                                <div class="provider-fieldset-row">
                                    <span class="provider-fieldset-label"><?php esc_html_e( 'Default', 'astro-booking-engine' ); ?>:</span>
                                    <input type="radio"
                                           name="<?php echo esc_attr($field['name']).'_default'; ?>"
                                           class="regular-text <?php echo esc_attr($provider); ?>-language-option-default <?php echo esc_attr($provider); ?>-language-option-<?php echo esc_attr($i); ?>"
                                           value="option_1" checked />
                                </div>
                            </div>
                        </fieldset>
						<?php
					}
					?>
                </td>
            </tr>

        </table>
        <!-- /formsetting -->

        <hr />

        <!-- treatment -->
        <h3 id="treatment"><?php esc_html_e( 'Treatments', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
			<?php
			$field_label = esc_html__( 'Visible', 'astro-booking-engine' );
			$field_description = __('Check to show', 'astro-booking-engine' );
			$field_name = ASTRO_BE_PREFIX.$provider.'_idTrattamento_visible';
			$field_value = get_option($field_name);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field_name); ?>"><?php echo esc_html($field_label); ?></label></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html($field_label); ?></span></legend>
                        <label for="<?php echo esc_attr($field_name); ?>"><input id="<?php echo esc_attr($field_name); ?>"
                                                                                 name="<?php echo esc_attr($field_name); ?>" type="checkbox"
                                                                                 value="1" <?php if ($field_value == "1") {
								echo 'checked="checked"';
							} ?>><?php echo esc_html($field_description); ?></label>
                    </fieldset>
                </td>
            </tr>

            <?php
            $field = array(
                'label' => esc_html__( 'Treatment options', 'astro-booking-engine' ),
                'description' => false,
                'name' => ASTRO_BE_PREFIX.$provider.'_idTrattamento',
                'value' => get_option(ASTRO_BE_PREFIX.$provider.'_idTrattamento'),
                'placeholder' => false
            );
            ?>
            <tr>
                <th scope="row">
                    <?php esc_html_e( 'Options', 'astro-booking-engine' ); ?>
                    <p class="description"><strong><?php esc_html_e( 'Option example', 'astro-booking-engine' ); ?></strong><br>
						<?php esc_html_e( 'Value', 'astro-booking-engine' ); ?>: 4<br>
						<?php esc_html_e( 'Label', 'astro-booking-engine' ); ?>: Bed & Breakfast</p>
                </th>
                <td class="<?php echo esc_attr($provider); ?>-treatment">
                    <button class="button <?php echo esc_attr($provider); ?>-treatment-options-add-field"><?php esc_html_e( 'Add new option', 'astro-booking-engine' ); ?></button>
                    <?php
                    $i = 1;

                    $check_option = get_option($field['name']);
                    if ($check_option) {
						$n_check_option = count($check_option);
                        $default_option = get_option($field['name'].'_default');
                        foreach ($check_option as $option) {
                    ?>
                    <fieldset class="provider-fieldset provider-fieldset-<?php echo esc_attr($i); ?>">
                        <legend class="provider-fieldset-legend">Treatment option #<?php echo esc_html($i); ?></legend>
                        <div class="provider-fieldset-content">
                            <div class="provider-fieldset-row">
                                <span class="provider-fieldset-label">Value:</span>
                                <input type="text" name="<?php echo esc_attr($field['name']).'[option_'.esc_attr($i).'][value]'; ?>" class="regular-text" value="<?php echo esc_attr($option['value']); ?>" />
                            </div>
                            <div class="provider-fieldset-row">
                                <span class="provider-fieldset-label">Label:</span>
                                <input type="text" name="<?php echo esc_attr($field['name']).'[option_'.esc_attr($i).'][label]'; ?>" class="regular-text" value="<?php echo esc_attr($option['label']); ?>" />
                            </div>
                            <div class="provider-fieldset-row">
                                <span class="provider-fieldset-label"><?php esc_html_e( 'Default', 'astro-booking-engine' ); ?>:</span>
                                <input type="radio"
                                       name="<?php echo esc_attr($field['name']).'_default'; ?>"
                                       class="<?php echo esc_attr($provider); ?>-treatment-option-default <?php echo esc_attr($provider); ?>-treatment-option-<?php echo esc_attr($i); ?>"
                                       value="option_<?php echo esc_attr($i); ?>"
                                <?php
                                   if ( $default_option == 'option_'.$i) {
                                       echo ' checked';
                                   }
                                ?> />
                            </div>
                        </div>
                        <?php if ($i > 1) { ?>
                        <button class="button iperbooking-treatment-options-delete-field"><?php esc_html_e( 'Delete', 'astro-booking-engine' ); ?></button>
                        <?php } ?>
                    </fieldset>
                    <?php
                            $i++;
                        }
                    }else{
                    ?>
                    <fieldset class="provider-fieldset provider-fieldset-<?php echo esc_attr($i); ?>">
                        <legend class="provider-fieldset-legend">Treatment option #<?php echo esc_html($i); ?></legend>
                        <div class="provider-fieldset-content">
                            <div class="provider-fieldset-row">
                                <span class="provider-fieldset-label"><?php esc_html_e( 'Value', 'astro-booking-engine' ); ?>:</span>
                                <input type="text" name="<?php echo esc_attr($field['name']).'[option_'.esc_attr($i).'][value]'; ?>" class="regular-text" value="" />
                            </div>
                            <div class="provider-fieldset-row">
                                <span class="provider-fieldset-label"><?php esc_html_e( 'Label', 'astro-booking-engine' ); ?>:</span>
                                <input type="text" name="<?php echo esc_attr($field['name']).'[option_'.esc_attr($i).'][label]'; ?>" class="regular-text" value="" />
                            </div>
                            <div class="provider-fieldset-row">
                                <span class="provider-fieldset-label"><?php esc_html_e( 'Default', 'astro-booking-engine' ); ?>:</span>
                                <input type="radio"
                                       name="<?php echo esc_attr($field['name']).'_default'; ?>"
                                       class="regular-text <?php echo esc_attr($provider); ?>-treatment-option-default <?php echo esc_attr($provider); ?>-treatment-option-<?php echo esc_attr($i); ?>"
                                       value="option_1" checked />
                            </div>
                        </div>
                    </fieldset>
                    <?php
                    }
                    ?>
                </td>
            </tr>

        </table>
        <!-- /treatment -->

        <hr />

        <!-- adults -->
        <h3 id="adults"><?php esc_html_e( 'Adults', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
			<?php
			$field_label = esc_html__( 'Enable', 'astro-booking-engine' );
			$field_description = __('Check to enable', 'astro-booking-engine' );
			$field_name = ASTRO_BE_PREFIX.$provider.'_adults_enable';
			$field_value = get_option($field_name);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field_name); ?>"><?php echo esc_html($field_label); ?></label></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html($field_label); ?></span></legend>
                        <label for="<?php echo esc_attr($field_name); ?>"><input id="<?php echo esc_attr($field_name); ?>"
                                                                                 name="<?php echo esc_attr($field_name); ?>"
                                                                                 type="checkbox"
                                                                                 value="1" <?php if ($field_value == "1") {
								echo 'checked="checked"';
							} ?>><?php echo esc_html($field_description); ?></label>
                    </fieldset>
                </td>
            </tr>

			<?php
			$field = array(
				'label' => esc_html__( 'Default Adults', 'astro-booking-engine' ),
				'description' => false,
				'name' => ASTRO_BE_PREFIX.$provider.'_adults_n_default',
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_adults_n_default'),
				'placeholder' => false
			);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                <td>
                    <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
						<?php
						for ($i = 1; $i <= 10; $i++) {
							$selected = '';
							if ($i == $field['value']) {
								$selected = ' selected=selected';
							}
							?>
                            <option value="<?php echo esc_attr($i); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_html($i); ?></option>
							<?php
						}
						?>
                    </select>
                </td>
            </tr>

			<?php
			$field = array(
				'label' => esc_html__( 'Max Adults', 'astro-booking-engine' ),
				'description' => false,
				'name' => ASTRO_BE_PREFIX.$provider.'_adults_n_max',
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_adults_n_max'),
				'placeholder' => false
			);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                <td>
                    <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
						<?php
                        if (!($field['value'])) {
							$field['value'] = 2;
                        }
						for ($i = 1; $i <= 10; $i++) {
							$selected = '';
							if ($i == $field['value']) {
								$selected = ' selected=selected';
							}
							?>
                            <option value="<?php echo esc_attr($i); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_html($i); ?></option>
							<?php
						}
						?>
                    </select>
                </td>
            </tr>

        </table>
        <!-- /adults -->

        <hr />

        <!-- children -->
        <h3 id="children"><?php esc_html_e( 'Children', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
			<?php
			$field_label = esc_html__( 'Enable', 'astro-booking-engine' );
			$field_description = __('Check to enable', 'astro-booking-engine' );
			$field_name = ASTRO_BE_PREFIX.$provider.'_children_enable';
			$field_value = get_option($field_name);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field_name); ?>"><?php echo esc_html($field_label); ?></label></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html($field_label); ?></span></legend>
                        <label for="<?php echo esc_attr($field_name); ?>"><input id="<?php echo esc_attr($field_name); ?>"
                                                                                 name="<?php echo esc_attr($field_name); ?>"
                                                                                 type="checkbox"
                                                                                 value="1" <?php if ($field_value == "1") {
								echo 'checked="checked"';
							} ?>><?php echo esc_html($field_description); ?></label>
                    </fieldset>
                </td>
            </tr>

			<?php
			$field = array(
				'label' => esc_html__( 'Default children', 'astro-booking-engine' ),
				'description' => false,
				'name' => ASTRO_BE_PREFIX.$provider.'_children_n_default',
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_children_n_default'),
				'placeholder' => false
			);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                <td>
                    <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
						<?php
						for ($i = 0; $i <= 10; $i++) {
							$selected = '';
							if ($i == $field['value']) {
								$selected = ' selected=selected';
							}
							?>
                            <option value="<?php echo esc_attr($i); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_html($i); ?></option>
							<?php
						}
						?>
                    </select>
                </td>
            </tr>

            <?php
			$field = array(
				'label' => esc_html__( 'Max children', 'astro-booking-engine' ),
				'description' => false,
				'name' => ASTRO_BE_PREFIX.$provider.'_children_n_max',
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_children_n_max'),
				'placeholder' => false
			);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                <td>
                    <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
						<?php
						if (!($field['value'])) {
							$field['value'] = 2;
						}
						for ($i = 1; $i <= 10; $i++) {
							$selected = '';
							if ($i == $field['value']) {
								$selected = ' selected=selected';
							}
							?>
                            <option value="<?php echo esc_attr($i); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_html($i); ?></option>
							<?php
						}
						?>
                    </select>
                </td>
            </tr>

        </table>
        <!-- /children -->

        <hr />

        <!-- childrenage -->
        <h3 id="childrenage"><?php esc_html_e( 'Children age', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
			<?php
			$field_label = esc_html__( 'Enable', 'astro-booking-engine' );
			$field_description = __('Check to enable', 'astro-booking-engine' );
			$field_name = ASTRO_BE_PREFIX.$provider.'_childage_enable';
			$field_value = get_option($field_name);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field_name); ?>"><?php echo esc_html($field_label); ?></label></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo esc_html($field_label); ?></span></legend>
                        <label for="<?php echo esc_attr($field_name); ?>"><input id="<?php echo esc_attr($field_name); ?>"
                                                                                 name="<?php echo esc_attr($field_name); ?>"
                                                                                 type="checkbox"
                                                                                 value="1" <?php if ($field_value == "1") {
								echo 'checked="checked"';
							} ?>><?php echo esc_html($field_description); ?></label>
                    </fieldset>
                </td>
            </tr>

			<?php
			$field = array(
				'label' => esc_html__( 'Min child age', 'astro-booking-engine' ),
				'description' => false,
				'name' => ASTRO_BE_PREFIX.$provider.'_childage_min',
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_childage_min'),
				'placeholder' => false
			);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                <td>
                    <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
						<?php
						if (!($field['value'])) {
							$field['value'] = 0;
						}
						for ($i = 0; $i <= 18; $i++) {
							$selected = '';
							if ($i == $field['value']) {
								$selected = ' selected=selected';
							}
							?>
                            <option value="<?php echo esc_attr($i); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_html($i); ?></option>
							<?php
						}
						?>
                    </select>
                </td>
            </tr>

			<?php
			$field = array(
				'label' => esc_html__( 'Max child age', 'astro-booking-engine' ),
				'description' => false,
				'name' => ASTRO_BE_PREFIX.$provider.'_childage_max',
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_childage_max'),
				'placeholder' => false
			);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                <td>
                    <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
						<?php
						if (!($field['value'])) {
							$field['value'] = 12;
						}
						for ($i = 0; $i <= 18; $i++) {
							$selected = '';
							if ($i == $field['value']) {
								$selected = ' selected=selected';
							}
							?>
                            <option value="<?php echo esc_attr($i); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_html($i); ?></option>
							<?php
						}
						?>
                    </select>
                </td>
            </tr>

        </table>
        <!-- /childrenage -->

        <hr />

        <!-- discountcode -->
        <h3 id="discountcode"><?php esc_html_e( 'Discount code', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
		<?php
		$field_label = esc_html__( 'Enable', 'astro-booking-engine' );
		$field_description = __('Check to enable', 'astro-booking-engine' );
		$field_name = ASTRO_BE_PREFIX.$provider.'_codiceSconto';
		$field_value = get_option($field_name);
		?>
        <tr>
            <th scope="row"><label for="<?php echo esc_attr($field_name); ?>"><?php echo esc_html($field_label); ?></label></th>
            <td>
                <fieldset>
                    <legend class="screen-reader-text"><span><?php echo esc_html($field_label); ?></span></legend>
                    <label for="<?php echo esc_attr($field_name); ?>"><input id="<?php echo esc_attr($field_name); ?>"
                                                                             name="<?php echo esc_attr($field_name); ?>"
                                                                             type="checkbox"
                                                                             value="1" <?php if ($field_value == "1") {
							echo 'checked="checked"';
						} ?>><?php echo esc_html($field_description); ?></label>
                </fieldset>
            </td>
        </tr>

        </table>
        <!-- /discountcode -->

        <hr />

        <!-- submitbutton -->
        <h3 id="submitbutton"><?php esc_html_e( 'Submit button', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
		<?php
		$field = array(
			'label' => esc_html__( 'Label', 'astro-booking-engine' ),
			'description' => __('The default value is Search.', 'astro-booking-engine' ),
			'name' => ASTRO_BE_PREFIX.$provider.'_submit_label',
			'value' => get_option(ASTRO_BE_PREFIX.$provider.'_submit_label'),
			'placeholder' => __('Search', 'astro-booking-engine' ),
		);
		?>
        <tr>
            <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
            <td>
                <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text" value="<?php echo esc_attr($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>">
				<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php }?>
            </td>
        </tr>
        </table>
        <!-- /submitbutton -->

    </div>
</div>
<!-- /<?php echo esc_attr($provider); ?> -->
