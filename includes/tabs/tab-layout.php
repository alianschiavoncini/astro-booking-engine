<?php
if( ! is_admin() ) {
	return;
}

$tab = 'layout';
$option_group = ASTRO_BE_PREFIX . $tab;
?>
<div class="<?php echo ASTRO_BE_PREFIX . 'wrapper'; ?>  <?php echo esc_attr( $option_group ); ?>">

    <form method="post" action="options.php">
    <?php
    settings_fields($option_group);
    do_settings_sections($option_group);
    ?>

        <div class="section-wrapper">
            <div class="section-wrapper-inner">

                <h2 id="layout"><?php esc_html_e( 'Layout', 'astro-booking-engine' ); ?></h2>

                <h3 id="widget"><?php esc_html_e( 'Widget', 'astro-booking-engine' ); ?></h3>
                <table class="form-table">
					<?php
					$field = array(
						'label' => esc_html__( 'Background color', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'widget-background-color',
						'value' => get_option(ASTRO_BE_PREFIX.'widget-background-color'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text colorpicker" value="<?php echo esc_attr($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>" />
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php } ?>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Border radius', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'widget-border-radius',
						'value' => get_option(ASTRO_BE_PREFIX.'widget-border-radius'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
                                <option value=""><?php esc_html_e( 'inherit', 'astro-booking-engine' ); ?></option>
								<?php
								if (!($field['value'])) {
									$field['value'] = 0;
								}
								for ($i = 0; $i <= 100; $i++) {
									$selected = '';
									if ($i == $field['value']) {
										$selected = ' selected=selected';
									}
									?>
                                    <option value="<?php echo esc_attr($i); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_attr($i); ?> <span class="select-option-suffix-px"><?php esc_html_e( 'px', 'astro-booking-engine' ); ?></span></option>
									<?php
								}
								?>
                            </select>
                        </td>
                    </tr>
                </table>

                <hr />

                <h3 id="labels"><?php esc_html_e( 'Labels', 'astro-booking-engine' ); ?></h3>
                <table class="form-table">
					<?php
					$field = array(
						'label' => esc_html__( 'Font color', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'label-font-color',
						'value' => get_option(ASTRO_BE_PREFIX.'label-font-color'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text colorpicker" value="<?php echo esc_html($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>">
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php } ?>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Font size', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'label-font-size',
						'value' => get_option(ASTRO_BE_PREFIX.'label-font-size'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
                                <option value=""><?php esc_html_e( 'inherit', 'astro-booking-engine' ); ?></option>
								<?php
								if (!($field['value'])) {
									$field['value'] = '';
								}
								for ($i = 6; $i <= 40; $i++) {
									$selected = '';
									if ($i == $field['value']) {
										$selected = ' selected=selected';
									}
									?>
                                    <option value="<?php echo esc_attr($i); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_attr($i); ?> <span class="select-option-suffix-px"><?php esc_html_e( 'px', 'astro-booking-engine' ); ?></span></option>
									<?php
								}
								?>
                            </select>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Font weight', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'label-font-weight',
						'value' => get_option(ASTRO_BE_PREFIX.'label-font-weight'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
								<?php
								if (!($field['value'])) {
									$field['value'] = 'normal';
								}
								?>
                                <option value="normal"<?php if ($field['value'] == 'normal') { echo ' selected=selected'; } ?>><?php echo esc_attr(__( 'normal', 'astro-booking-engine' )); ?></option>
                                <option value="bold"<?php if ($field['value'] == 'bold') { echo ' selected=selected'; } ?>><?php echo esc_attr(__( 'bold', 'astro-booking-engine' )); ?></option>
                            </select>
                        </td>
                    </tr>
                </table>

                <hr />

                <h3 id="fields"><?php esc_html_e( 'Fields', 'astro-booking-engine' ); ?></h3>
                <table class="form-table">
					<?php
					$field = array(
						'label' => esc_html__( 'Font color', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'field-font-color',
						'value' => get_option(ASTRO_BE_PREFIX.'field-font-color'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text colorpicker" value="<?php echo esc_html($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>" />
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php } ?>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Font size', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'field-font-size',
						'value' => get_option(ASTRO_BE_PREFIX.'field-font-size'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
                                <option value=""><?php esc_html_e( 'inherit', 'astro-booking-engine' ); ?></option>
								<?php
								if (!($field['value'])) {
									$field['value'] = '';
								}
								for ($i = 6; $i <= 40; $i++) {
									$selected = '';
									if ($i == $field['value']) {
										$selected = ' selected=selected';
									}
									?>
                                    <option value="<?php echo esc_attr($i); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_attr($i); ?> <span class="select-option-suffix-px"><?php esc_html_e( 'px', 'astro-booking-engine' ); ?></span></option>
									<?php
								}
								?>
                            </select>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Font weight', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'field-font-weight',
						'value' => get_option(ASTRO_BE_PREFIX.'field-font-weight'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
								<?php
								if (!($field['value'])) {
									$field['value'] = 'normal';
								}
								?>
                                <option value="normal"<?php if ($field['value'] == 'normal') { echo ' selected=selected'; } ?>><?php echo esc_attr(__( 'normal', 'astro-booking-engine' )); ?></option>
                                <option value="bold"<?php if ($field['value'] == 'bold') { echo ' selected=selected'; } ?>><?php echo esc_attr(__( 'bold', 'astro-booking-engine' )); ?></option>
                            </select>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Background color', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'field-background-color',
						'value' => get_option(ASTRO_BE_PREFIX.'field-background-color'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text colorpicker" value="<?php echo esc_html($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>" />
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php } ?>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Border width', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'field-border-width',
						'value' => get_option(ASTRO_BE_PREFIX.'field-border-width'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
                                <option value=""><?php esc_html_e( 'inherit', 'astro-booking-engine' ); ?></option>
								<?php
								if (!($field['value'])) {
									$field['value'] = 0;
								}
								for ($i = 0; $i <= 10; $i++) {
									$selected = '';
									if ($i == $field['value']) {
										$selected = ' selected=selected';
									}
									?>
                                    <option value="<?php echo esc_attr($i); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_attr($i); ?> <span class="select-option-suffix-px"><?php esc_html_e( 'px', 'astro-booking-engine' ); ?></span></option>
									<?php
								}
								?>
                            </select>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Border style', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'field-border-style',
						'value' => get_option(ASTRO_BE_PREFIX.'field-border-style'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
                            <?php
							if (!($field['value'])) {
								$field['value'] = 'none';
							}
                            $border_styles = array('none', 'dashed', 'dotted', 'double', 'groove', 'hidden', 'inset', 'outset', 'ridge', 'solid');
                            foreach ($border_styles as $border_style) {
								$selected = '';
								if ($border_style == $field['value']) {
									$selected = ' selected=selected';
								}
                            ?>
                                <option value="<?php echo esc_attr($border_style); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_attr($border_style); ?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Border color', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'field-border-color',
						'value' => get_option(ASTRO_BE_PREFIX.'field-border-color'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text colorpicker" value="<?php echo esc_html($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>" />
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php } ?>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Border radius', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'field-border-radius',
						'value' => get_option(ASTRO_BE_PREFIX.'field-border-radius'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
                                <option value=""><?php esc_html_e( 'inherit', 'astro-booking-engine' ); ?></option>
                                <?php
                                if (!($field['value'])) {
                                    $field['value'] = 0;
                                }
                                for ($i = 0; $i <= 100; $i++) {
                                    $selected = '';
                                    if ($i == $field['value']) {
                                        $selected = ' selected=selected';
                                    }
                                    ?>
                                    <option value="<?php echo esc_attr($i); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_attr($i); ?> <span class="select-option-suffix-px"><?php esc_html_e( 'px', 'astro-booking-engine' ); ?></span></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Calendar theme', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'calendar',
						'value' => get_option(ASTRO_BE_PREFIX.'calendar'),
						'placeholder' => false
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
								<?php
								$options = array('base', 'black-tie', 'blitzer', 'cupertino', 'dark-hive', 'dot-luv', 'eggplant', 'excite-bike', 'flick', 'hot-sneaks', 'humanity', 'le-frog', 'mint-choc', 'overcast', 'pepper-grinder', 'redmond', 'smoothness', 'south-street', 'start', 'sunny', 'swanky-purse', 'trontastic', 'ui-darkness', 'ui-lightness', 'vader');
								foreach ($options as $value) {
									$selected = '';
									if ($value == $field['value']) {
										$selected = ' selected=selected';
									}
									?>
                                    <option value="<?php echo esc_attr($value); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_html($value); ?></option>
									<?php
								}
								?>
                            </select>
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php } ?>
                        </td>
                    </tr>
                </table>

                <hr />

                <h3 id="submitbutton"><?php esc_html_e( 'Submit button', 'astro-booking-engine' ); ?></h3>
                <table class="form-table">
					<?php
					$field = array(
						'label' => esc_html__( 'Font color', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'submit-font-color',
						'value' => get_option(ASTRO_BE_PREFIX.'submit-font-color'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text colorpicker" value="<?php echo esc_html($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>" />
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php } ?>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Font size', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'submit-font-size',
						'value' => get_option(ASTRO_BE_PREFIX.'submit-font-size'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
                                <option value=""><?php esc_html_e( 'inherit', 'astro-booking-engine' ); ?></option>
								<?php
								if (!($field['value'])) {
									$field['value'] = '';
								}
								for ($i = 6; $i <= 40; $i++) {
									$selected = '';
									if ($i == $field['value']) {
										$selected = ' selected=selected';
									}
									?>
                                    <option value="<?php echo esc_attr($i); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_attr($i); ?> <span class="select-option-suffix-px"><?php esc_html_e( 'px', 'astro-booking-engine' ); ?></span></option>
									<?php
								}
								?>
                            </select>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Font weight', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'submit-font-weight',
						'value' => get_option(ASTRO_BE_PREFIX.'submit-font-weight'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
								<?php
								if (!($field['value'])) {
									$field['value'] = 'normal';
								}
								?>
                                <option value="normal"<?php if ($field['value'] == 'normal') { echo ' selected=selected'; } ?>><?php echo esc_attr(__( 'normal', 'astro-booking-engine' )); ?></option>
                                <option value="bold"<?php if ($field['value'] == 'bold') { echo ' selected=selected'; } ?>><?php echo esc_attr(__( 'bold', 'astro-booking-engine' )); ?></option>
                            </select>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Background color', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'submit-background-color',
						'value' => get_option(ASTRO_BE_PREFIX.'submit-background-color'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text colorpicker" value="<?php echo esc_html($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>" />
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php } ?>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Border width', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'submit-border-width',
						'value' => get_option(ASTRO_BE_PREFIX.'submit-border-width'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
                                <option value=""><?php esc_html_e( 'inherit', 'astro-booking-engine' ); ?></option>
								<?php
								if (!($field['value'])) {
									$field['value'] = 0;
								}
								for ($i = 0; $i <= 10; $i++) {
									$selected = '';
									if ($i == $field['value']) {
										$selected = ' selected=selected';
									}
									?>
                                    <option value="<?php echo esc_attr($i); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_attr($i); ?> <span class="select-option-suffix-px"><?php esc_html_e( 'px', 'astro-booking-engine' ); ?></span></option>
									<?php
								}
								?>
                            </select>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Border style', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'submit-border-style',
						'value' => get_option(ASTRO_BE_PREFIX.'submit-border-style'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
								<?php
								if (!($field['value'])) {
									$field['value'] = 'none';
								}
								$border_styles = array('none', 'dashed', 'dotted', 'double', 'groove', 'hidden', 'inset', 'outset', 'ridge', 'solid');
								foreach ($border_styles as $border_style) {
									$selected = '';
									if ($border_style == $field['value']) {
										$selected = ' selected=selected';
									}
									?>
                                    <option value="<?php echo esc_attr($border_style); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_attr($border_style); ?></option>
									<?php
								}
								?>
                            </select>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Border color', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'submit-border-color',
						'value' => get_option(ASTRO_BE_PREFIX.'submit-border-color'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text colorpicker" value="<?php echo esc_html($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>" />
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php } ?>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Border radius', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'submit-border-radius',
						'value' => get_option(ASTRO_BE_PREFIX.'submit-border-radius'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <select name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>">
                                <option value=""><?php esc_html_e( 'inherit', 'astro-booking-engine' ); ?></option>
								<?php
								if (!($field['value'])) {
									$field['value'] = 0;
								}
								for ($i = 0; $i <= 100; $i++) {
									$selected = '';
									if ($i == $field['value']) {
										$selected = ' selected=selected';
									}
									?>
                                    <option value="<?php echo esc_attr($i); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_attr($i); ?> <span class="select-option-suffix-px"><?php esc_html_e( 'px', 'astro-booking-engine' ); ?></span></option>
									<?php
								}
								?>
                            </select>
                        </td>
                    </tr>
                </table>

                <hr />

                <h3 id="advanced"><?php esc_html_e( 'Advanced settings', 'astro-booking-engine' ); ?></h3>
                <table class="form-table">
					<?php
					$field = array(
						'label' => esc_html__( 'Custom CSS', 'astro-booking-engine' ),
						'description' => false,
						'name' => ASTRO_BE_PREFIX.'custom-css',
						'value' => get_option(ASTRO_BE_PREFIX.'custom-css'),
						'placeholder' => false,
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <textarea id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text" placeholder="<?php echo esc_attr($field['placeholder']); ?>" rows="10"><?php echo esc_html($field['value']); ?></textarea>
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php } ?>
                        </td>
                    </tr>
                </table>

            </div>
        </div>

    <?php
        submit_button();
    ?>
    </form>

</div>
