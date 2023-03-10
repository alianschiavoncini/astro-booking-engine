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
        <h3 id="hotelsettings"><?php _e( 'Hotel settings', 'astro-booking-engine' ); ?></h3>
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
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo $field['label']; ?></label></th>
                <td>
                    <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text" value="<?php echo $field['value']; ?>" placeholder="<?php echo $field['placeholder']; ?>" />
                    <?php if ($field['description']) { ?><p class="description"><?php echo $field['description']; ?></p><?php }?>
                </td>
            </tr>
        </table>
        <!-- /hotelsettings -->

        <hr />

        <!-- formsetting -->
        <h3 id="formsetting"><?php _e( 'Form settings', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
			<?php
			$field = array(
				'label' => esc_html__( 'Method', 'astro-booking-engine' ),
				'description' => esc_html__( 'not editable; this is the value requested by the provider.', 'astro-booking-engine' ),
				'name' => ASTRO_BE_PREFIX.$provider.'_form_method',
				'fixed_value' => esc_attr('get'),
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_form_method'),
				'placeholder' => esc_attr('get'),
				'readonly' => true,
			);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo $field['label']; ?></label></th>
                <td>
                    <input type="text"
                           id="<?php echo esc_attr($field['name']); ?>"
                           class="regular-text"
                           name="<?php echo esc_attr($field['name']); ?>"
                           placeholder="<?php echo $field['placeholder']; ?>"
                           value="<?php if ($field['fixed_value']) { echo $field['fixed_value']; }else{ echo $field['value']; } ?>"
						<?php if ($field['readonly']) { echo " readonly"; } ?>
                    />
					<?php if ($field['description']) { ?><p class="description"><?php echo $field['description']; ?></p><?php }?>
					<?php if ($field['readonly']) { ?>
                        <input type="hidden" name="<?php echo esc_attr($field['name']); ?>" value="<?php echo $field['fixed_value']; ?>" />
					<?php } ?>
                </td>
            </tr>

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
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo $field['label']; ?></label></th>
                <td>
                    <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
                    <?php
                    foreach ($arr_targets as $k => $v) {
                        $selected = '';
                        if ($k == $field['value']) {
                            $selected = ' selected="selected"';
                        }
                        ?>
                        <option value="<?php echo esc_attr($k); ?>"<?php echo $selected; ?>><?php echo esc_attr($v); ?></option>
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
					<?php _e( 'Language options', 'astro-booking-engine' ); ?>
                    <p class="description"><strong>Option example</strong><br>
						<?php _e( 'Lang code', 'astro-booking-engine' ); ?>: EN<br>
						<?php _e( 'URL', 'astro-booking-engine' ); ?>: https://secure.iperbooking.net/be/en/your-hotel-name/</p>
                </th>
                <td class="<?php echo $provider; ?>-language">
                    <button class="button <?php echo $provider; ?>-language-options-add-field"><?php _e( 'Add new option', 'astro-booking-engine' ); ?></button>
					<?php
					$i = 1;

					$check_option = get_option($field['name']);
					if ($check_option) {
						$n_check_option = count($check_option);
                        $default_option = get_option($field['name'].'_default');
						foreach ($check_option as $option) {
							?>
                            <fieldset class="provider-fieldset provider-fieldset-<?php echo $i; ?>">
                                <legend class="provider-fieldset-legend"><?php _e( 'Language option', 'astro-booking-engine' ); ?> #<?php echo $i; ?></legend>
                                <div class="provider-fieldset-content">
                                    <div class="provider-fieldset-row">
                                        <span class="provider-fieldset-label"><?php _e( 'Lang code', 'astro-booking-engine' ); ?>:</span>
                                        <input type="text" name="<?php echo $field['name'].'[option_'.$i.'][code]'; ?>" class="regular-text" value="<?php echo esc_attr($option['code']); ?>" />
                                    </div>
                                    <div class="provider-fieldset-row">
                                        <span class="provider-fieldset-label"><?php _e( 'URL', 'astro-booking-engine' ); ?>:</span>
                                        <input type="text" name="<?php echo $field['name'].'[option_'.$i.'][url]'; ?>" class="regular-text" value="<?php echo esc_attr($option['url']); ?>" />
                                    </div>
                                    <div class="provider-fieldset-row">
                                        <span class="provider-fieldset-label"><?php _e( 'Default', 'astro-booking-engine' ); ?>:</span>
                                        <input type="radio"
                                               name="<?php echo $field['name'].'_default'; ?>"
                                               class="<?php echo $provider; ?>-language-option-default <?php echo $provider; ?>-language-option-<?php echo $i; ?>"
                                               value="option_<?php echo $i; ?>"
											<?php
											if ($default_option == 'option_'.$i) {
												echo ' checked';
											}
											?> />
                                    </div>
                                </div>
								<?php if ($i > 1) { ?>
                                    <button class="button iperbooking-language-options-delete-field"><?php _e( 'Delete', 'astro-booking-engine' ); ?></button>
								<?php } ?>
                            </fieldset>
							<?php
							$i++;
						}
					}else{
						?>
                        <fieldset class="provider-fieldset provider-fieldset-<?php echo $i; ?>">
                            <legend class="provider-fieldset-legend"><?php _e( 'Language option', 'astro-booking-engine' ); ?> #<?php echo $i; ?></legend>
                            <div class="provider-fieldset-content">
                                <div class="provider-fieldset-row">
                                    <span class="provider-fieldset-label">Lang code:</span>
                                    <input type="text" name="<?php echo $field['name'].'[option_'.$i.'][code]'; ?>" class="regular-text" value="" />
                                </div>
                                <div class="provider-fieldset-row">
                                    <span class="provider-fieldset-label">URL:</span>
                                    <input type="text" name="<?php echo $field['name'].'[option_'.$i.'][url]'; ?>" class="regular-text" value="" />
                                </div>
                                <div class="provider-fieldset-row">
                                    <span class="provider-fieldset-label"><?php _e( 'Default', 'astro-booking-engine' ); ?>:</span>
                                    <input type="radio"
                                           name="<?php echo $field['name'].'_default'; ?>"
                                           class="regular-text <?php echo $provider; ?>-language-option-default <?php echo $provider; ?>-language-option-<?php echo $i; ?>"
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

        <!-- dates -->
        <h3 id="dates"><?php _e( 'Check-in and Check-out', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
            <?php
            $field = array(
                'label' => esc_html__( 'Check-in date format', 'astro-booking-engine' ),
                'description' => 'not editable; this is the only value accepted by the provider.',
                'name' => ASTRO_BE_PREFIX.$provider.'_checkin_date_format',
                'fixed_value' => esc_attr('dd/mm/yy'),
                'value' => get_option(ASTRO_BE_PREFIX.$provider.'_checkin_date_format'),
                'placeholder' => esc_attr('dd/mm/yy'),
                'readonly' => true,
            );
            ?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo $field['label']; ?></label></th>
                <td>
                    <input type="text"
                           id="<?php echo esc_attr($field['name']); ?>"
                           class="regular-text"
                           name="<?php echo esc_attr($field['name']); ?>"
                           placeholder="<?php echo $field['placeholder']; ?>"
                           value="<?php if ($field['fixed_value']) { echo $field['fixed_value']; }else{ echo $field['value']; } ?>"
                        <?php if ($field['readonly']) { echo " readonly"; } ?>
                    />
                    <?php if ($field['description']) { ?><p class="description"><?php echo $field['description']; ?></p><?php }?>
                    <?php if ($field['readonly']) { ?>
                        <input type="hidden" name="<?php echo esc_attr($field['name']); ?>" value="<?php echo $field['fixed_value']; ?>" />
                    <?php } ?>
                </td>
            </tr>

            <?php
            $field = array(
                'label' => esc_html__( 'Check-out date format', 'astro-booking-engine' ),
                'description' => 'not editable; this is the only value accepted by the provider.',
                'name' => ASTRO_BE_PREFIX.$provider.'_checkout_date_format',
                'fixed_value' => esc_attr('dd/mm/yy'),
                'value' => get_option(ASTRO_BE_PREFIX.$provider.'_checkout_date_format'),
                'placeholder' => esc_attr('dd/mm/yy'),
                'readonly' => true,
            );
            ?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo $field['label']; ?></label></th>
                <td>
                    <input type="text"
                           id="<?php echo esc_attr($field['name']); ?>"
                           class="regular-text"
                           name="<?php echo esc_attr($field['name']); ?>"
                           placeholder="<?php echo $field['placeholder']; ?>"
                           value="<?php if ($field['fixed_value']) { echo $field['fixed_value']; }else{ echo $field['value']; } ?>"
                        <?php if ($field['readonly']) { echo " readonly"; } ?>
                    />
                    <?php if ($field['description']) { ?><p class="description"><?php echo $field['description']; ?></p><?php }?>
                    <?php if ($field['readonly']) { ?>
                        <input type="hidden" name="<?php echo esc_attr($field['name']); ?>" value="<?php echo $field['fixed_value']; ?>" />
                    <?php } ?>
                </td>
            </tr>

			<?php
			$field_label = esc_html__( 'Hide in mobile view', 'astro-booking-engine' );
			$field_description = false;
			$field_name = ASTRO_BE_PREFIX.$provider.'_checkin_checkout_hide_mobile';
			$field_value = get_option($field_name);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field_name); ?>"><?php echo $field_label; ?></label></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo $field_label; ?></span></legend>
                        <label for="<?php echo esc_attr($field_name); ?>"><input id="<?php echo esc_attr($field_name); ?>"
                                                                                 name="<?php echo esc_attr($field_name); ?>" type="checkbox"
                                                                                 value="1" <?php if ($field_value == "1") {
								echo 'checked="checked"';
							} ?>><?php echo $field_description; ?></label>
                    </fieldset>
                </td>
            </tr>
        </table>
        <!-- /dates -->

        <hr />

        <!-- treatment -->
        <h3 id="treatment"><?php _e( 'Treatments', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
			<?php
			$field_label = esc_html__( 'Visible', 'astro-booking-engine' );
			$field_description = __('Check to show', 'astro-booking-engine' );
			$field_name = ASTRO_BE_PREFIX.$provider.'_idTrattamento_visible';
			$field_value = get_option($field_name);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field_name); ?>"><?php echo $field_label; ?></label></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo $field_label; ?></span></legend>
                        <label for="<?php echo esc_attr($field_name); ?>"><input id="<?php echo esc_attr($field_name); ?>"
                                                                                 name="<?php echo esc_attr($field_name); ?>" type="checkbox"
                                                                                 value="1" <?php if ($field_value == "1") {
								echo 'checked="checked"';
							} ?>><?php echo $field_description; ?></label>
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
                    <?php _e( 'Options', 'astro-booking-engine' ); ?>
                    <p class="description"><strong><?php _e( 'Option example', 'astro-booking-engine' ); ?></strong><br>
						<?php _e( 'Value', 'astro-booking-engine' ); ?>: 4<br>
						<?php _e( 'Label', 'astro-booking-engine' ); ?>: Bed & Breakfast</p>
                </th>
                <td class="<?php echo $provider; ?>-treatment">
                    <button class="button <?php echo $provider; ?>-treatment-options-add-field"><?php _e( 'Add new option', 'astro-booking-engine' ); ?></button>
                    <?php
                    $i = 1;

                    $check_option = get_option($field['name']);
                    if ($check_option) {
						$n_check_option = count($check_option);
                        $default_option = get_option($field['name'].'_default');
                        foreach ($check_option as $option) {
                    ?>
                    <fieldset class="provider-fieldset provider-fieldset-<?php echo $i; ?>">
                        <legend class="provider-fieldset-legend">Treatment option #<?php echo $i; ?></legend>
                        <div class="provider-fieldset-content">
                            <div class="provider-fieldset-row">
                                <span class="provider-fieldset-label">Value:</span>
                                <input type="text" name="<?php echo $field['name'].'[option_'.$i.'][value]'; ?>" class="regular-text" value="<?php echo esc_attr($option['value']); ?>" />
                            </div>
                            <div class="provider-fieldset-row">
                                <span class="provider-fieldset-label">Label:</span>
                                <input type="text" name="<?php echo $field['name'].'[option_'.$i.'][label]'; ?>" class="regular-text" value="<?php echo esc_attr($option['label']); ?>" />
                            </div>
                            <div class="provider-fieldset-row">
                                <span class="provider-fieldset-label"><?php _e( 'Default', 'astro-booking-engine' ); ?>:</span>
                                <input type="radio"
                                       name="<?php echo $field['name'].'_default'; ?>"
                                       class="<?php echo $provider; ?>-treatment-option-default <?php echo $provider; ?>-treatment-option-<?php echo $i; ?>"
                                       value="option_<?php echo $i; ?>"
                                <?php
                                   if ( $default_option == 'option_'.$i) {
                                       echo ' checked';
                                   }
                                ?> />
                            </div>
                        </div>
                        <?php if ($i > 1) { ?>
                        <button class="button iperbooking-treatment-options-delete-field"><?php _e( 'Delete', 'astro-booking-engine' ); ?></button>
                        <?php } ?>
                    </fieldset>
                    <?php
                            $i++;
                        }
                    }else{
                    ?>
                    <fieldset class="provider-fieldset provider-fieldset-<?php echo $i; ?>">
                        <legend class="provider-fieldset-legend">Treatment option #<?php echo $i; ?></legend>
                        <div class="provider-fieldset-content">
                            <div class="provider-fieldset-row">
                                <span class="provider-fieldset-label"><?php _e( 'Value', 'astro-booking-engine' ); ?>:</span>
                                <input type="text" name="<?php echo $field['name'].'[option_'.$i.'][value]'; ?>" class="regular-text" value="" />
                            </div>
                            <div class="provider-fieldset-row">
                                <span class="provider-fieldset-label"><?php _e( 'Label', 'astro-booking-engine' ); ?>:</span>
                                <input type="text" name="<?php echo $field['name'].'[option_'.$i.'][label]'; ?>" class="regular-text" value="" />
                            </div>
                            <div class="provider-fieldset-row">
                                <span class="provider-fieldset-label"><?php _e( 'Default', 'astro-booking-engine' ); ?>:</span>
                                <input type="radio"
                                       name="<?php echo $field['name'].'_default'; ?>"
                                       class="regular-text <?php echo $provider; ?>-treatment-option-default <?php echo $provider; ?>-treatment-option-<?php echo $i; ?>"
                                       value="option_1" checked />
                            </div>
                        </div>
                    </fieldset>
                    <?php
                    }
                    ?>
                </td>
            </tr>

			<?php
			$field_label = esc_html__( 'Hide in mobile view', 'astro-booking-engine' );
			$field_description = false;
			$field_name = ASTRO_BE_PREFIX.$provider.'_idTrattamento_hide_mobile';
			$field_value = get_option($field_name);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field_name); ?>"><?php echo $field_label; ?></label></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo $field_label; ?></span></legend>
                        <label for="<?php echo esc_attr($field_name); ?>"><input id="<?php echo esc_attr($field_name); ?>"
                                                                                 name="<?php echo esc_attr($field_name); ?>" type="checkbox"
                                                                                 value="1" <?php if ($field_value == "1") {
								echo 'checked="checked"';
							} ?>><?php echo $field_description; ?></label>
                    </fieldset>
                </td>
            </tr>
        </table>
        <!-- /treatment -->

        <hr />

        <!-- rooms -->
        <h3 id="rooms"><?php _e( 'Rooms', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
		<?php
		$field = array(
			'label' => esc_html__( 'Max rooms', 'astro-booking-engine' ),
			'description' => 'not editable.',
			'name' => ASTRO_BE_PREFIX.$provider.'_rooms',
			'fixed_value' => esc_attr('1'),
			'value' => get_option(ASTRO_BE_PREFIX.$provider.'_rooms'),
			'placeholder' => esc_attr('1'),
			'readonly' => true,
		);
		?>
        <tr>
            <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo $field['label']; ?></label></th>
            <td>
                <input type="text"
                       id="<?php echo esc_attr($field['name']); ?>"
                       class="regular-text"
                       name="<?php echo esc_attr($field['name']); ?>"
                       placeholder="<?php echo $field['placeholder']; ?>"
                       value="<?php if ($field['fixed_value']) { echo $field['fixed_value']; }else{ echo $field['value']; } ?>"
					<?php if ($field['readonly']) { echo " readonly"; } ?>
                />
				<?php if ($field['description']) { ?><p class="description"><?php echo $field['description']; ?></p><?php }?>
				<?php if ($field['readonly']) { ?>
                    <input type="hidden" name="<?php echo esc_attr($field['name']); ?>" value="<?php echo $field['fixed_value']; ?>" />
				<?php } ?>
            </td>
        </tr>
        </table>
        <!-- /rooms -->

        <hr />

        <!-- adults -->
        <h3 id="adults"><?php _e( 'Adults', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
			<?php
			$field_label = esc_html__( 'Enable', 'astro-booking-engine' );
			$field_description = __('Check to enable', 'astro-booking-engine' );
			$field_name = ASTRO_BE_PREFIX.$provider.'_adults_enable';
			$field_value = get_option($field_name);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field_name); ?>"><?php echo $field_label; ?></label></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo $field_label; ?></span></legend>
                        <label for="<?php echo esc_attr($field_name); ?>"><input id="<?php echo esc_attr($field_name); ?>"
                                                                                 name="<?php echo esc_attr($field_name); ?>"
                                                                                 type="checkbox"
                                                                                 value="1" <?php if ($field_value == "1") {
								echo 'checked="checked"';
							} ?>><?php echo $field_description; ?></label>
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
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo $field['label']; ?></label></th>
                <td>
                    <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
						<?php
						for ($i = 1; $i <= 10; $i++) {
							$selected = '';
							if ($i == $field['value']) {
								$selected = ' selected="selected"';
							}
							?>
                            <option value="<?php echo esc_attr($i); ?>"<?php echo $selected; ?>><?php echo esc_attr($i); ?></option>
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
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo $field['label']; ?></label></th>
                <td>
                    <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
						<?php
                        if (!($field['value'])) {
							$field['value'] = 2;
                        }
						for ($i = 1; $i <= 10; $i++) {
							$selected = '';
							if ($i == $field['value']) {
								$selected = ' selected="selected"';
							}
							?>
                            <option value="<?php echo esc_attr($i); ?>"<?php echo $selected; ?>><?php echo esc_attr($i); ?></option>
							<?php
						}
						?>
                    </select>
                </td>
            </tr>

			<?php
			$field_label = esc_html__( 'Hide in mobile view', 'astro-booking-engine' );
			$field_description = false;
			$field_name = ASTRO_BE_PREFIX.$provider.'_adults_hide_mobile';
			$field_value = get_option($field_name);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field_name); ?>"><?php echo $field_label; ?></label></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo $field_label; ?></span></legend>
                        <label for="<?php echo esc_attr($field_name); ?>"><input id="<?php echo esc_attr($field_name); ?>"
                                                                                 name="<?php echo esc_attr($field_name); ?>" type="checkbox"
                                                                                 value="1" <?php if ($field_value == "1") {
								echo 'checked="checked"';
							} ?>><?php echo $field_description; ?></label>
                    </fieldset>
                </td>
            </tr>
        </table>
        <!-- /adults -->

        <hr />

        <!-- children -->
        <h3 id="children"><?php _e( 'Children', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
			<?php
			$field_label = esc_html__( 'Enable', 'astro-booking-engine' );
			$field_description = __('Check to enable', 'astro-booking-engine' );
			$field_name = ASTRO_BE_PREFIX.$provider.'_children_enable';
			$field_value = get_option($field_name);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field_name); ?>"><?php echo $field_label; ?></label></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo $field_label; ?></span></legend>
                        <label for="<?php echo esc_attr($field_name); ?>"><input id="<?php echo esc_attr($field_name); ?>"
                                                                                 name="<?php echo esc_attr($field_name); ?>"
                                                                                 type="checkbox"
                                                                                 value="1" <?php if ($field_value == "1") {
								echo 'checked="checked"';
							} ?>><?php echo $field_description; ?></label>
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
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo $field['label']; ?></label></th>
                <td>
                    <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
						<?php
						for ($i = 0; $i <= 10; $i++) {
							$selected = '';
							if ($i == $field['value']) {
								$selected = ' selected="selected"';
							}
							?>
                            <option value="<?php echo esc_attr($i); ?>"<?php echo $selected; ?>><?php echo esc_attr($i); ?></option>
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
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo $field['label']; ?></label></th>
                <td>
                    <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
						<?php
						if (!($field['value'])) {
							$field['value'] = 2;
						}
						for ($i = 1; $i <= 10; $i++) {
							$selected = '';
							if ($i == $field['value']) {
								$selected = ' selected="selected"';
							}
							?>
                            <option value="<?php echo esc_attr($i); ?>"<?php echo $selected; ?>><?php echo esc_attr($i); ?></option>
							<?php
						}
						?>
                    </select>
                </td>
            </tr>

			<?php
			$field_label = esc_html__( 'Hide in mobile view', 'astro-booking-engine' );
			$field_description = false;
			$field_name = ASTRO_BE_PREFIX.$provider.'_children_hide_mobile';
			$field_value = get_option($field_name);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field_name); ?>"><?php echo $field_label; ?></label></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo $field_label; ?></span></legend>
                        <label for="<?php echo esc_attr($field_name); ?>"><input id="<?php echo esc_attr($field_name); ?>"
                                                                                 name="<?php echo esc_attr($field_name); ?>"
                                                                                 type="checkbox"
                                                                                 value="1" <?php if ($field_value == "1") {
								echo 'checked="checked"';
							} ?>><?php echo $field_description; ?></label>
                    </fieldset>
                </td>
            </tr>
        </table>
        <!-- /children -->

        <hr />

        <!-- childrenage -->
        <h3 id="childrenage"><?php _e( 'Children age', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
			<?php
			$field_label = esc_html__( 'Enable', 'astro-booking-engine' );
			$field_description = __('Check to enable', 'astro-booking-engine' );
			$field_name = ASTRO_BE_PREFIX.$provider.'_childage_enable';
			$field_value = get_option($field_name);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field_name); ?>"><?php echo $field_label; ?></label></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo $field_label; ?></span></legend>
                        <label for="<?php echo esc_attr($field_name); ?>"><input id="<?php echo esc_attr($field_name); ?>"
                                                                                 name="<?php echo esc_attr($field_name); ?>"
                                                                                 type="checkbox"
                                                                                 value="1" <?php if ($field_value == "1") {
								echo 'checked="checked"';
							} ?>><?php echo $field_description; ?></label>
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
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo $field['label']; ?></label></th>
                <td>
                    <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
						<?php
						if (!($field['value'])) {
							$field['value'] = 0;
						}
						for ($i = 0; $i <= 18; $i++) {
							$selected = '';
							if ($i == $field['value']) {
								$selected = ' selected="selected"';
							}
							?>
                            <option value="<?php echo esc_attr($i); ?>"<?php echo $selected; ?>><?php echo esc_attr($i); ?></option>
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
                <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo $field['label']; ?></label></th>
                <td>
                    <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
						<?php
						if (!($field['value'])) {
							$field['value'] = 12;
						}
						for ($i = 0; $i <= 18; $i++) {
							$selected = '';
							if ($i == $field['value']) {
								$selected = ' selected="selected"';
							}
							?>
                            <option value="<?php echo esc_attr($i); ?>"<?php echo $selected; ?>><?php echo esc_attr($i); ?></option>
							<?php
						}
						?>
                    </select>
                </td>
            </tr>

			<?php
			$field_label = esc_html__( 'Hide in mobile view', 'astro-booking-engine' );
			$field_description = false;
			$field_name = ASTRO_BE_PREFIX.$provider.'_childage_hide_mobile';
			$field_value = get_option($field_name);
			?>
            <tr>
                <th scope="row"><label for="<?php echo esc_attr($field_name); ?>"><?php echo $field_label; ?></label></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php echo $field_label; ?></span></legend>
                        <label for="<?php echo esc_attr($field_name); ?>"><input id="<?php echo esc_attr($field_name); ?>"
                                                                                 name="<?php echo esc_attr($field_name); ?>"
                                                                                 type="checkbox"
                                                                                 value="1" <?php if ($field_value == "1") {
								echo 'checked="checked"';
							} ?>><?php echo $field_description; ?></label>
                    </fieldset>
                </td>
            </tr>
        </table>
        <!-- /childrenage -->

        <hr />

        <!-- discountcode -->
        <h3 id="discountcode"><?php _e( 'Discount code', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
		<?php
		$field_label = esc_html__( 'Enable', 'astro-booking-engine' );
		$field_description = __('Check to enable', 'astro-booking-engine' );
		$field_name = ASTRO_BE_PREFIX.$provider.'_codiceSconto';
		$field_value = get_option($field_name);
		?>
        <tr>
            <th scope="row"><label for="<?php echo esc_attr($field_name); ?>"><?php echo $field_label; ?></label></th>
            <td>
                <fieldset>
                    <legend class="screen-reader-text"><span><?php echo $field_label; ?></span></legend>
                    <label for="<?php echo esc_attr($field_name); ?>"><input id="<?php echo esc_attr($field_name); ?>"
                                                                             name="<?php echo esc_attr($field_name); ?>"
                                                                             type="checkbox"
                                                                             value="1" <?php if ($field_value == "1") {
							echo 'checked="checked"';
						} ?>><?php echo $field_description; ?></label>
                </fieldset>
            </td>
        </tr>

		<?php
		$field_label = esc_html__( 'Hide in mobile view', 'astro-booking-engine' );
		$field_description = false;
		$field_name = ASTRO_BE_PREFIX.$provider.'_codiceSconto_hide_mobile';
		$field_value = get_option($field_name);
		?>
        <tr>
            <th scope="row"><label for="<?php echo esc_attr($field_name); ?>"><?php echo $field_label; ?></label></th>
            <td>
                <fieldset>
                    <legend class="screen-reader-text"><span><?php echo $field_label; ?></span></legend>
                    <label for="<?php echo esc_attr($field_name); ?>"><input id="<?php echo esc_attr($field_name); ?>"
                                                                             name="<?php echo esc_attr($field_name); ?>"
                                                                             type="checkbox"
                                                                             value="1" <?php if ($field_value == "1") {
							echo 'checked="checked"';
						} ?>><?php echo $field_description; ?></label>
                </fieldset>
            </td>
        </tr>
        </table>
        <!-- /discountcode -->

        <hr />

        <!-- submitbutton -->
        <h3 id="submitbutton"><?php _e( 'Submit button', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
		<?php
		$field = array(
			'label' => esc_html__( 'Label', 'astro-booking-engine' ),
			'description' => __('The default value is Send.', 'astro-booking-engine' ),
			'name' => ASTRO_BE_PREFIX.$provider.'_submit_label',
			'value' => get_option(ASTRO_BE_PREFIX.$provider.'_submit_label'),
			'placeholder' => __('Send', 'astro-booking-engine' ),
		);
		?>
        <tr>
            <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo $field['label']; ?></label></th>
            <td>
                <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text" value="<?php echo $field['value']; ?>" placeholder="<?php echo $field['placeholder']; ?>">
				<?php if ($field['description']) { ?><p class="description"><?php echo $field['description']; ?></p><?php }?>
            </td>
        </tr>
        </table>
        <!-- /submitbutton -->

    </div>
</div>
<!-- /<?php echo esc_attr($provider); ?> -->
