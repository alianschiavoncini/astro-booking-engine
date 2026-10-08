<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! is_admin() ) {
	return;
}

$provider = 'seekda';
?>
<!-- <?php echo esc_attr($provider); ?> -->
<div class="section-wrapper box <?php echo esc_attr($provider); ?>">
    <div class="section-wrapper-inner">

        <h2>Seekda</h2>

        <!-- hotelsettings -->
        <h3 id="hotelsettings"><?php esc_html_e( 'Hotel settings', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
			<?php
			$field = array(
				'label' => esc_html__( 'Booking engine address', 'astro-booking-engine' ),
				'description' => __( 'The address of your Seekda booking engine, as it is: https://s001234.officialbookings.com/', 'astro-booking-engine' ),
				'name' => ASTRO_BE_PREFIX.$provider.'_hotel',
				'value' => get_option(ASTRO_BE_PREFIX.$provider.'_hotel'),
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
                        <option value="<?php echo esc_attr($k); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_attr($v); ?></option>
                        <?php
                    }
                    ?>
                    </select>
                </td>
            </tr>

        </table>
        <!-- /formsetting -->

        <hr />

        <!-- coupon -->
        <h3 id="coupon"><?php esc_html_e( 'Coupon', 'astro-booking-engine' ); ?></h3>
        <table class="form-table">
		<?php
		$field_label = esc_html__( 'Enable', 'astro-booking-engine' );
		$field_description = __('Check to enable', 'astro-booking-engine' );
		$field_name = ASTRO_BE_PREFIX.$provider.'_coupon';
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
        <!-- /coupon -->

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
