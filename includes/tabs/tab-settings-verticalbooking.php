<?php
if( ! is_admin() ) {
	return;
}

$provider = 'verticalbooking';
?>
<!-- <?php echo esc_attr($provider); ?> -->
<div class="section-wrapper box <?php echo esc_attr($provider); ?>">
    <div class="section-wrapper-inner">

        <h2>Vertical booking</h2>

        <!-- hotelsettings -->
        <h3 id="hotelsettings"><?php _e( 'Hotel settings', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
			<?php
			$field = array(
				'label' => esc_html__( 'id_albergo', 'astro-booking-engine' ),
				'description' => false,
				'name' => ASTRO_BE_PREFIX.$provider.'_id_albergo',
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_id_albergo'),
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

			<?php
			$field = array(
				'label' => esc_html__( 'dc', 'astro-booking-engine' ),
				'description' => false,
				'name' => ASTRO_BE_PREFIX.$provider.'_dc',
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_dc'),
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

			<?php
			$field = array(
				'label' => esc_html__( 'id_stile', 'astro-booking-engine' ),
				'description' => false,
				'name' => ASTRO_BE_PREFIX.$provider.'_id_stile',
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_id_stile'),
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

        </table>
        <!-- /formsetting -->

        <hr />

        <!-- dates -->
        <h3 id="dates"><?php _e( 'Check-in and Check-out', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
            <?php
            $field = array(
                'label' => esc_html__( 'Check-in day format', 'astro-booking-engine' ),
                'description' => 'not editable; this is the only value accepted by the provider.',
                'name' => ASTRO_BE_PREFIX.$provider.'_gg',
                'fixed_value' => esc_attr('gg'),
                'value' => get_option(ASTRO_BE_PREFIX.$provider.'_gg'),
                'placeholder' => esc_attr('gg'),
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
                'label' => esc_html__( 'Check-in month format', 'astro-booking-engine' ),
                'description' => 'not editable; this is the only value accepted by the provider.',
                'name' => ASTRO_BE_PREFIX.$provider.'_mm',
                'fixed_value' => esc_attr('mm'),
                'value' => get_option(ASTRO_BE_PREFIX.$provider.'_mm'),
                'placeholder' => esc_attr('mm'),
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
                'label' => esc_html__( 'Check-in year format', 'astro-booking-engine' ),
                'description' => 'not editable; this is the only value accepted by the provider.',
                'name' => ASTRO_BE_PREFIX.$provider.'_aa',
                'fixed_value' => esc_attr('aa'),
                'value' => get_option(ASTRO_BE_PREFIX.$provider.'_aa'),
                'placeholder' => esc_attr('aa'),
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
                'label' => esc_html__( 'Check-out day format', 'astro-booking-engine' ),
                'description' => 'not editable; this is the only value accepted by the provider.',
                'name' => ASTRO_BE_PREFIX.$provider.'_ggf',
                'fixed_value' => esc_attr('ggf'),
                'value' => get_option(ASTRO_BE_PREFIX.$provider.'_ggf'),
                'placeholder' => esc_attr('ggf'),
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
                'label' => esc_html__( 'Check-out month format', 'astro-booking-engine' ),
                'description' => 'not editable; this is the only value accepted by the provider.',
                'name' => ASTRO_BE_PREFIX.$provider.'_mmf',
                'fixed_value' => esc_attr('mmf'),
                'value' => get_option(ASTRO_BE_PREFIX.$provider.'_mmf'),
                'placeholder' => esc_attr('mmf'),
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
                'label' => esc_html__( 'Check-out year format', 'astro-booking-engine' ),
                'description' => 'not editable; this is the only value accepted by the provider.',
                'name' => ASTRO_BE_PREFIX.$provider.'_aaf',
                'fixed_value' => esc_attr('aaf'),
                'value' => get_option(ASTRO_BE_PREFIX.$provider.'_aaf'),
                'placeholder' => esc_attr('aaf'),
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
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_tot_adulti_n_default'),
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
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_tot_adulti_n_max'),
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
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_tot_bambini_n_default'),
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
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_tot_bambini_n_max'),
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
				'label' => esc_html__( 'Min children age', 'astro-booking-engine' ),
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
				'label' => esc_html__( 'Max children age', 'astro-booking-engine' ),
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

        <?php /*
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
 */ ?>

        <!-- submitbutton -->
        <h3 id="submitbutton"><?php _e( 'Submit button', 'astro-booking-engine' ); ?></h3>
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
