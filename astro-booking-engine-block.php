<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Gutenberg block (server-side, from metadata).
 * Priority 20: the 'astro-booking-engine' style handle referenced by block.json
 * is registered by astro_be_enqueue_files() at the default priority 10.
 */
add_action( 'init', 'astro_be_register_block', 20 );
function astro_be_register_block() {

	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	wp_register_script(
		'astro-booking-engine-block-editor',
		plugin_dir_url( __FILE__ ) . 'blocks/booking-form/editor.js',
		array( 'wp-blocks', 'wp-element', 'wp-i18n', 'wp-block-editor', 'wp-components', 'wp-server-side-render' ),
		ASTRO_BE_VERSION,
		true
	);
	wp_set_script_translations( 'astro-booking-engine-block-editor', 'astro-booking-engine', plugin_dir_path( __FILE__ ) . 'languages' );

	register_block_type(
		plugin_dir_path( __FILE__ ) . 'blocks/booking-form',
		array( 'render_callback' => 'astro_be_block_render' )
	);

}

/**
 * Keep only values that are safe inside a CSS color declaration.
 */
function astro_be_block_sanitize_css_color( $value ) {
	$value = trim( (string) $value );
	if ( $value === '' ) {
		return '';
	}
	if ( strtolower( $value ) === 'transparent' ) {
		return 'transparent';
	}
	if ( preg_match( '/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{4}|[0-9a-fA-F]{6}|[0-9a-fA-F]{8})$/', $value ) ) {
		return $value;
	}
	if ( preg_match( '/^rgba?\([0-9,.\s%]+\)$/', $value ) ) {
		return $value;
	}
	if ( preg_match( '/^var\(--[a-zA-Z0-9\-]+\)$/', $value ) ) {
		return $value;
	}
	return '';
}

/**
 * Render the block: same output as the shortcode, plus the per-block overrides.
 */
function astro_be_block_render( $attributes ) {

	// Submit label override, applied while the template reads the option.
	$provider = get_option( ASTRO_BE_PREFIX . 'provider' );
	$submit_label = isset( $attributes['submitLabel'] ) ? trim( $attributes['submitLabel'] ) : '';
	$submit_label_filter = false;
	if ( $provider && ( $submit_label !== '' ) ) {
		$submit_label_filter = function() use ( $submit_label ) {
			return $submit_label;
		};
		add_filter( 'pre_option_' . ASTRO_BE_PREFIX . $provider . '_submit_label', $submit_label_filter );
	}

	$form = astro_be_shortcode_output();

	if ( $submit_label_filter ) {
		remove_filter( 'pre_option_' . ASTRO_BE_PREFIX . $provider . '_submit_label', $submit_label_filter );
	}

	if ( empty( $form ) ) {
		return '';
	}

	// Per-block layout overrides, scoped with a unique class so that other
	// blocks on the same page and the global Layout settings are not affected.
	$style = '';
	$scope_class = '';
	if ( ! empty( $attributes['customizeLayout'] ) ) {

		$scope_class = wp_unique_id( 'astro-be-block-' );
		$scope = '.' . $scope_class;
		$rules = array();

		// Form container: the .astro_be div that wraps the whole form.
		$widget = array();
		$widget_background_color = astro_be_block_sanitize_css_color( isset( $attributes['widgetBackgroundColor'] ) ? $attributes['widgetBackgroundColor'] : '' );
		if ( $widget_background_color ) {
			$widget[] = 'background-color:' . $widget_background_color;
		}
		if ( isset( $attributes['widgetBorderRadius'] ) && is_numeric( $attributes['widgetBorderRadius'] ) ) {
			$widget[] = 'border-radius:' . absint( $attributes['widgetBorderRadius'] ) . 'px';
		}
		if ( ! empty( $widget ) ) {
			$rules[] = $scope . ' .astro_be{' . implode( ';', $widget ) . ';}';
		}

		$label = array();
		$label_font_color = astro_be_block_sanitize_css_color( isset( $attributes['labelFontColor'] ) ? $attributes['labelFontColor'] : '' );
		if ( $label_font_color ) {
			$label[] = 'color:' . $label_font_color;
		}
		if ( ! empty( $label ) ) {
			$rules[] = $scope . ' .astro_be_label{' . implode( ';', $label ) . ';}';
		}

		$field = array();
		$field_font_color = astro_be_block_sanitize_css_color( isset( $attributes['fieldFontColor'] ) ? $attributes['fieldFontColor'] : '' );
		if ( $field_font_color ) {
			$field[] = 'color:' . $field_font_color;
		}
		$field_background_color = astro_be_block_sanitize_css_color( isset( $attributes['fieldBackgroundColor'] ) ? $attributes['fieldBackgroundColor'] : '' );
		if ( $field_background_color ) {
			$field[] = 'background-color:' . $field_background_color;
		}
		if ( isset( $attributes['fieldBorderRadius'] ) && is_numeric( $attributes['fieldBorderRadius'] ) ) {
			$field[] = 'border-radius:' . absint( $attributes['fieldBorderRadius'] ) . 'px';
		}
		if ( ! empty( $field ) ) {
			$rules[] = $scope . ' .astro_be_input:not(.astro_be_input-submit_button),' . $scope . ' .astro_be_select{' . implode( ';', $field ) . ';}';
		}

		$submit = array();
		$submit_font_color = astro_be_block_sanitize_css_color( isset( $attributes['submitFontColor'] ) ? $attributes['submitFontColor'] : '' );
		if ( $submit_font_color ) {
			$submit[] = 'color:' . $submit_font_color;
		}
		$submit_background_color = astro_be_block_sanitize_css_color( isset( $attributes['submitBackgroundColor'] ) ? $attributes['submitBackgroundColor'] : '' );
		if ( $submit_background_color ) {
			$submit[] = 'background-color:' . $submit_background_color;
		}
		if ( isset( $attributes['submitBorderRadius'] ) && is_numeric( $attributes['submitBorderRadius'] ) ) {
			$submit[] = 'border-radius:' . absint( $attributes['submitBorderRadius'] ) . 'px';
		}
		if ( ! empty( $submit ) ) {
			$rules[] = $scope . ' .astro_be_input-submit_button{' . implode( ';', $submit ) . ';}';
		}

		if ( ! empty( $rules ) ) {
			$style = '<style>' . implode( '', $rules ) . '</style>';
		}
	}

	$wrapper_args = array();
	if ( $scope_class && $style ) {
		$wrapper_args['class'] = $scope_class;
	}
	$wrapper_attributes = get_block_wrapper_attributes( $wrapper_args );

	return '<div ' . $wrapper_attributes . '>' . $style . $form . '</div>';

}
