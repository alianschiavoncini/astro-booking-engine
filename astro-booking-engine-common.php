<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the Plugin Data.
 */
function astro_be_plugin_data($var = false) {
	$plugin_file = plugin_dir_path(__FILE__) . 'astro-booking-engine.php';
	if( !function_exists('get_plugin_data') ){
		require_once(ABSPATH . 'wp-admin/includes/plugin.php');
	}
	$get_plugin_data = get_plugin_data( $plugin_file );
	if ($var) { $get_plugin_data = $get_plugin_data[$var]; }
	return $get_plugin_data;
}

/**
 * Set the Booking Form options names.
 */
function astro_be_option_names($tab = false) {

	$option_names = false;

	switch ($tab) {
		case 'settings' :
			$option_names = array(
				'provider' => ASTRO_BE_PREFIX . 'provider',

				/**
				 * 5Stelle
				 */
				ASTRO_BE_PREFIX . '5stelle_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . '5stelle_form_target' => ASTRO_BE_PREFIX . '5stelle_form_target',
				ASTRO_BE_PREFIX . '5stelle_rooms' => esc_attr('1'), //required >= 1; default value = 1
				ASTRO_BE_PREFIX . '5stelle_adults_enable' => ASTRO_BE_PREFIX . '5stelle_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . '5stelle_adults_n_default' => ASTRO_BE_PREFIX . '5stelle_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . '5stelle_adults_n_max' => ASTRO_BE_PREFIX . '5stelle_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . '5stelle_children_enable' => ASTRO_BE_PREFIX . '5stelle_children_enable', //enable/disable
				ASTRO_BE_PREFIX . '5stelle_children_n_default' => ASTRO_BE_PREFIX . '5stelle_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . '5stelle_children_n_max' => ASTRO_BE_PREFIX . '5stelle_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . '5stelle_childage_enable' => ASTRO_BE_PREFIX . '5stelle_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . '5stelle_childage_min' => ASTRO_BE_PREFIX . '5stelle_childage_min', //conditional
				ASTRO_BE_PREFIX . '5stelle_childage_max' => ASTRO_BE_PREFIX . '5stelle_childage_max', //conditional
				ASTRO_BE_PREFIX . '5stelle_submit_label' => ASTRO_BE_PREFIX . '5stelle_submit_label', //optional

				//5Stelle custom fields
				ASTRO_BE_PREFIX . '5stelle_portal' => ASTRO_BE_PREFIX . '5stelle_portal', //required

				/**
				 * Iperbooking
				 */
				ASTRO_BE_PREFIX . 'iperbooking_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'iperbooking_form_target' => ASTRO_BE_PREFIX . 'iperbooking_form_target',
				ASTRO_BE_PREFIX . 'iperbooking_rooms' => esc_attr('1'), //required >= 1; default value = 1
				ASTRO_BE_PREFIX . 'iperbooking_adults_enable' => ASTRO_BE_PREFIX . 'iperbooking_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'iperbooking_adults_n_default' => ASTRO_BE_PREFIX . 'iperbooking_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'iperbooking_adults_n_max' => ASTRO_BE_PREFIX . 'iperbooking_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'iperbooking_children_enable' => ASTRO_BE_PREFIX . 'iperbooking_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'iperbooking_children_n_default' => ASTRO_BE_PREFIX . 'iperbooking_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'iperbooking_children_n_max' => ASTRO_BE_PREFIX . 'iperbooking_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'iperbooking_childage_enable' => ASTRO_BE_PREFIX . 'iperbooking_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . 'iperbooking_childage_min' => ASTRO_BE_PREFIX . 'iperbooking_childage_min', //conditional
				ASTRO_BE_PREFIX . 'iperbooking_childage_max' => ASTRO_BE_PREFIX . 'iperbooking_childage_max', //conditional
				ASTRO_BE_PREFIX . 'iperbooking_submit_label' => ASTRO_BE_PREFIX . 'iperbooking_submit_label', //optional

				//Iperbooking custom fields
				ASTRO_BE_PREFIX . 'iperbooking_idHotel' => ASTRO_BE_PREFIX . 'iperbooking_idHotel', //required
				ASTRO_BE_PREFIX . 'iperbooking_language' => ASTRO_BE_PREFIX . 'iperbooking_language', //required; one at least
				ASTRO_BE_PREFIX . 'iperbooking_language_default' => ASTRO_BE_PREFIX . 'iperbooking_language_default',
				ASTRO_BE_PREFIX . 'iperbooking_idTrattamento' => ASTRO_BE_PREFIX . 'iperbooking_idTrattamento', //required; default value = 4
				ASTRO_BE_PREFIX . 'iperbooking_idTrattamento_default' => ASTRO_BE_PREFIX . 'iperbooking_idTrattamento_default',
				ASTRO_BE_PREFIX . 'iperbooking_idTrattamento_visible' => ASTRO_BE_PREFIX . 'iperbooking_idTrattamento_visible',
				ASTRO_BE_PREFIX . 'iperbooking_codiceSconto' => ASTRO_BE_PREFIX . 'iperbooking_codiceSconto', //enable/disable

				/**
				 * Passepartout
				 */
				ASTRO_BE_PREFIX . 'passepartout_form_method' => esc_attr('get'),
				ASTRO_BE_PREFIX . 'passepartout_form_target' => ASTRO_BE_PREFIX . 'passepartout_form_target',
				ASTRO_BE_PREFIX . 'passepartout_rooms' => esc_attr('1'), //required >= 1; default value = 1
				ASTRO_BE_PREFIX . 'passepartout_adults_enable' => ASTRO_BE_PREFIX . 'passepartout_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'passepartout_adults_n_default' => ASTRO_BE_PREFIX . 'passepartout_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'passepartout_adults_n_max' => ASTRO_BE_PREFIX . 'passepartout_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'passepartout_children_enable' => ASTRO_BE_PREFIX . 'passepartout_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'passepartout_children_n_default' => ASTRO_BE_PREFIX . 'passepartout_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'passepartout_children_n_max' => ASTRO_BE_PREFIX . 'passepartout_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'passepartout_childage_enable' => ASTRO_BE_PREFIX . 'passepartout_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . 'passepartout_childage_min' => ASTRO_BE_PREFIX . 'passepartout_childage_min', //conditional
				ASTRO_BE_PREFIX . 'passepartout_childage_max' => ASTRO_BE_PREFIX . 'passepartout_childage_max', //conditional
				ASTRO_BE_PREFIX . 'passepartout_submit_label' => ASTRO_BE_PREFIX . 'passepartout_submit_label', //optional

				//passepartout custom fields
				ASTRO_BE_PREFIX . 'passepartout_Albergo' => ASTRO_BE_PREFIX . 'passepartout_Albergo', //required
				ASTRO_BE_PREFIX . 'passepartout_OidPortaleXAlbergo' => ASTRO_BE_PREFIX . 'passepartout_OidPortaleXAlbergo', //required
				ASTRO_BE_PREFIX . 'passepartout_CodicePromozione' => ASTRO_BE_PREFIX . 'passepartout_CodicePromozione',

				/**
				 * Simple booking
				 */
				ASTRO_BE_PREFIX . 'simplebooking_form_method' => esc_attr('get'), //required
				ASTRO_BE_PREFIX . 'simplebooking_form_target' => ASTRO_BE_PREFIX . 'simplebooking_form_target', //required
				ASTRO_BE_PREFIX . 'simplebooking_hid' => ASTRO_BE_PREFIX . 'simplebooking_hid', //required
				ASTRO_BE_PREFIX . 'simplebooking_currency' => ASTRO_BE_PREFIX . 'simplebooking_currency', //required
				ASTRO_BE_PREFIX . 'simplebooking_rooms' => ASTRO_BE_PREFIX . 'simplebooking_rooms', //default value = 1
				ASTRO_BE_PREFIX . 'simplebooking_adults_enable' => ASTRO_BE_PREFIX . 'simplebooking_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'simplebooking_adults_n_default' => ASTRO_BE_PREFIX . 'simplebooking_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'simplebooking_adults_n_max' => ASTRO_BE_PREFIX . 'simplebooking_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'simplebooking_children_enable' => ASTRO_BE_PREFIX . 'simplebooking_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'simplebooking_children_n_default' => ASTRO_BE_PREFIX . 'simplebooking_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'simplebooking_children_n_max' => ASTRO_BE_PREFIX . 'simplebooking_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'simplebooking_childage_enable' => ASTRO_BE_PREFIX . 'simplebooking_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . 'simplebooking_childage_min' => ASTRO_BE_PREFIX . 'simplebooking_childage_min', //conditional
				ASTRO_BE_PREFIX . 'simplebooking_childage_max' => ASTRO_BE_PREFIX . 'simplebooking_childage_max', //conditional
				ASTRO_BE_PREFIX . 'simplebooking_coupon' => ASTRO_BE_PREFIX . 'simplebooking_coupon',
				ASTRO_BE_PREFIX . 'simplebooking_submit_label' => ASTRO_BE_PREFIX . 'simplebooking_submit_label', //optional


				/**
				 * Vertical booking
				 */
				ASTRO_BE_PREFIX . 'verticalbooking_form_method' => esc_attr('get'), //required
				ASTRO_BE_PREFIX . 'verticalbooking_form_target' => ASTRO_BE_PREFIX . 'verticalbooking_form_target', //required
				ASTRO_BE_PREFIX . 'verticalbooking_id_albergo' => ASTRO_BE_PREFIX . 'verticalbooking_id_albergo', //required
				ASTRO_BE_PREFIX . 'verticalbooking_dc' => ASTRO_BE_PREFIX . 'verticalbooking_dc', //required
				ASTRO_BE_PREFIX . 'verticalbooking_id_stile' => ASTRO_BE_PREFIX . 'verticalbooking_id_stile',

				ASTRO_BE_PREFIX . 'verticalbooking_adults_enable' => ASTRO_BE_PREFIX . 'verticalbooking_adults_enable', //enable/disable
				ASTRO_BE_PREFIX . 'verticalbooking_adults_n_default' => ASTRO_BE_PREFIX . 'verticalbooking_adults_n_default', //required >= 1
				ASTRO_BE_PREFIX . 'verticalbooking_adults_n_max' => ASTRO_BE_PREFIX . 'verticalbooking_adults_n_max', //required >= 1
				ASTRO_BE_PREFIX . 'verticalbooking_children_enable' => ASTRO_BE_PREFIX . 'verticalbooking_children_enable', //enable/disable
				ASTRO_BE_PREFIX . 'verticalbooking_children_n_default' => ASTRO_BE_PREFIX . 'verticalbooking_children_n_default', //required >= 0
				ASTRO_BE_PREFIX . 'verticalbooking_children_n_max' => ASTRO_BE_PREFIX . 'verticalbooking_children_n_max', //required >= 0
				ASTRO_BE_PREFIX . 'verticalbooking_childage_enable' => ASTRO_BE_PREFIX . 'verticalbooking_childage_enable', //enable/disable
				ASTRO_BE_PREFIX . 'verticalbooking_childage_min' => ASTRO_BE_PREFIX . 'verticalbooking_childage_min', //conditional
				ASTRO_BE_PREFIX . 'verticalbooking_childage_max' => ASTRO_BE_PREFIX . 'verticalbooking_childage_max', //conditional
				ASTRO_BE_PREFIX . 'verticalbooking_submit_label' => ASTRO_BE_PREFIX . 'verticalbooking_submit_label', //optional
			);
			break;

		case 'layout' :
			$option_names = array(
				ASTRO_BE_PREFIX . 'widget-background-color' => ASTRO_BE_PREFIX . 'widget-background-color',
				ASTRO_BE_PREFIX . 'widget-border-radius' => ASTRO_BE_PREFIX . 'widget-border-radius',

				ASTRO_BE_PREFIX . 'label-font-color' => ASTRO_BE_PREFIX . 'label-font-color',
				ASTRO_BE_PREFIX . 'label-font-size' => ASTRO_BE_PREFIX . 'label-font-size',
				ASTRO_BE_PREFIX . 'label-font-weight' => ASTRO_BE_PREFIX . 'label-font-weight',

				ASTRO_BE_PREFIX . 'field-font-color' => ASTRO_BE_PREFIX . 'field-font-color',
				ASTRO_BE_PREFIX . 'field-font-size' => ASTRO_BE_PREFIX . 'field-font-size',
				ASTRO_BE_PREFIX . 'field-font-weight' => ASTRO_BE_PREFIX . 'field-font-weight',
				ASTRO_BE_PREFIX . 'field-background-color' => ASTRO_BE_PREFIX . 'field-background-color',
				ASTRO_BE_PREFIX . 'field-border-width' => ASTRO_BE_PREFIX . 'field-border-width',
				ASTRO_BE_PREFIX . 'field-border-style' => ASTRO_BE_PREFIX . 'field-border-style',
				ASTRO_BE_PREFIX . 'field-border-color' => ASTRO_BE_PREFIX . 'field-border-color',
				ASTRO_BE_PREFIX . 'field-border-radius' => ASTRO_BE_PREFIX . 'field-border-radius',
				ASTRO_BE_PREFIX . 'calendar' => ASTRO_BE_PREFIX . 'calendar',

				ASTRO_BE_PREFIX . 'submit-font-color' => ASTRO_BE_PREFIX . 'submit-font-color',
				ASTRO_BE_PREFIX . 'submit-font-size' => ASTRO_BE_PREFIX . 'submit-font-size',
				ASTRO_BE_PREFIX . 'submit-font-weight' => ASTRO_BE_PREFIX . 'submit-font-weight',
				ASTRO_BE_PREFIX . 'submit-background-color' => ASTRO_BE_PREFIX . 'submit-background-color',
				ASTRO_BE_PREFIX . 'submit-border-width' => ASTRO_BE_PREFIX . 'submit-border-width',
				ASTRO_BE_PREFIX . 'submit-border-style' => ASTRO_BE_PREFIX . 'submit-border-style',
				ASTRO_BE_PREFIX . 'submit-border-color' => ASTRO_BE_PREFIX . 'submit-border-color',
				ASTRO_BE_PREFIX . 'submit-border-radius' => ASTRO_BE_PREFIX . 'submit-border-radius',

				ASTRO_BE_PREFIX . 'custom-css' => ASTRO_BE_PREFIX . 'custom-css',
			);
			break;
	}


	return $option_names;
}

/**
 * Unregister the option names if the plugin will delete.
 */
register_uninstall_hook(__FILE__, 'astro_be_unregister_option_names');
function astro_be_unregister_option_names() {
	$tab = 'settings';
	$option_group = ASTRO_BE_PREFIX . '_' . $tab;
	$option_names = astro_be_option_names($tab);

	foreach ($option_names as $option_name) {
		register_setting( $option_group, $option_name );
	}
}

/**
 * Return the Astro Booking Engine shortcode.
 */
function astro_be_shortcode_output() {
	// Get the Template
	$provider = get_option(ASTRO_BE_PREFIX.'provider');
	if (($provider == '') && user_can( wp_get_current_user(), 'administrator' )) {
		$plugin_settings_url = admin_url('admin.php?page=astro-booking-engine');
		$str = '<div class="astro-error astro-error-no-provider">';
		$str .= __( 'This message is visible only to the site administrator.', 'astro-booking-engine' );
		$str .= '<br />';
		$str .= __( 'No provider has been selected in Astro Booking Engine plugin.', 'astro-booking-engine' );
		$str .= '<br />';
		$str .= __('Choose your provider at plugin', 'astro-booking-engine' );
		$str .= ' <a href="'.$plugin_settings_url.'">';
		$str .= __('settings page', 'astro-booking-engine' );
		$str .= '</a>.';
		$str .= '</div>';
		return $str;
	}

	$template_file = plugin_dir_path(__FILE__) . 'templates/' .$provider.'.php';
	if (file_exists($template_file)) { // Check if the template file exists.
		ob_start();
		include($template_file);
		$content = ob_get_clean();
		return $content;
	}
}
add_shortcode('astro-booking-engine', 'astro_be_shortcode_output');

/**
 * Return the form action URL based on language.
 */
function astro_be_get_provider_form_action_url_language() {
	$provider = get_option(ASTRO_BE_PREFIX.'provider');

	$form_urls = get_option(ASTRO_BE_PREFIX.$provider.'_language');
	$form_url = false;

	if ( class_exists( 'SitePress' ) ) { //check if WPML is active
		$current_post_language = apply_filters( 'wpml_current_language', NULL );
		foreach ($form_urls as $arr) {
			if (strtolower($arr['code']) == strtolower($current_post_language)) {
				$form_url = $arr['url'];
				break;
			}
		}
	}else{ //No WPML; get WP language setting
		$current_post_language = get_bloginfo("language");
		$current_post_language = substr($current_post_language, 0, 2);
		foreach ($form_urls as $form_url) {
			if (strtolower($form_url['code']) == strtolower($current_post_language)) {
				$form_url = $form_url['url'];
				break;
			}
		}
	}

	if (!$form_url) { //no language detected => set the default language provided
		$languages = get_option(ASTRO_BE_PREFIX.$provider.'_language');
		$defalut_language_option = get_option(ASTRO_BE_PREFIX.$provider.'_language_default');
		$form_url = $languages[$defalut_language_option]['url'];
	}

	return $form_url;
}

/**
 * Return the custom Layout CSS classes.
 */
function astro_be_get_custom_layout() {

	$arr = array();

	//Widget
	$widget = array();
	$widget_background_color = get_option(ASTRO_BE_PREFIX.'widget-background-color');
	if (!empty($widget_background_color)) {
		$widget[] = 'background-color:'.$widget_background_color;
	}
	$widget_border_radius = get_option(ASTRO_BE_PREFIX.'widget-border-radius');
	if (!empty($widget_border_radius)) {
		$widget[] = 'border-radius:'.$widget_border_radius.'px';
	}
	if (!empty($widget)) {
		$widget = implode(';', $widget);
		$arr[] = array('class' => '.astro_be', 'prop' => $widget);
	}

	//Label
	$label = array();
	$label_font_color = get_option(ASTRO_BE_PREFIX.'label-font-color');
	if (!empty($label_font_color)) {
		$label[] = 'color:'.$label_font_color;
	}
	$label_font_size = get_option(ASTRO_BE_PREFIX.'label-font-size');
	if (!empty($label_font_size)) {
		$label[] = 'font-size:'.$label_font_size.'px';
	}
	$label_font_weight = get_option(ASTRO_BE_PREFIX.'label-font-weight');
	if (!empty($label_font_weight)) {
		$label[] = 'font-weight:'.$label_font_weight;
	}
	if (!empty($label)) {
		$label = implode(';', $label);
		$arr[] = array('class' => '.astro_be .astro_be_label', 'prop' => $label);
	}

	//Field
	$field = array();
	$field_font_color = get_option(ASTRO_BE_PREFIX.'field-font-color');
	if (!empty($field_font_color)) {
		$field[] = 'color:'.$field_font_color;
	}
	$field_font_size = get_option(ASTRO_BE_PREFIX.'field-font-size');
	if (!empty($field_font_size)) {
		$field[] = 'font-size:'.$field_font_size.'px';
	}
	$field_font_weight = get_option(ASTRO_BE_PREFIX.'field-font-weight');
	if (!empty($field_font_weight)) {
		$field[] = 'font-weight:'.$field_font_weight;
	}
	$field_background_color = get_option(ASTRO_BE_PREFIX.'field-background-color');
	if (!empty($field_background_color)) {
		$field[] = 'background-color:'.$field_background_color;
	}
	$field_border_width = get_option(ASTRO_BE_PREFIX.'field-border-width');
	if (!empty($field_border_width)) {
		$field[] = 'border-width:'.$field_border_width.'px';
	}
	$field_border_style = get_option(ASTRO_BE_PREFIX.'field-border-style');
	if (!empty($field_border_style)) {
		$field[] = 'border-style:'.$field_border_style;
	}
	$field_border_color = get_option(ASTRO_BE_PREFIX.'field-border-color');
	if (!empty($field_border_color)) {
		$field[] = 'border-color:'.$field_border_color;
	}
	$field_border_radius = get_option(ASTRO_BE_PREFIX.'field-border-radius');
	if (!empty($field_border_radius)) {
		$field[] = 'border-radius:'.$field_border_radius.'px';
	}
	if (!empty($field)) {
		$field = implode(';', $field);
		$arr[] = array('class' => '.astro_be .astro_be_input:not(.astro_be_input-submit_button),.astro_be_select', 'prop' => $field);
	}

	//Submit
	$submit = array();
	$submit_font_color = get_option(ASTRO_BE_PREFIX.'submit-font-color');
	if (!empty($submit_font_color)) {
		$submit[] = 'color:'.$submit_font_color;
	}
	$submit_font_size = get_option(ASTRO_BE_PREFIX.'submit-font-size');
	if (!empty($submit_font_size)) {
		$submit[] = 'font-size:'.$submit_font_size.'px';
	}
	$submit_font_weight = get_option(ASTRO_BE_PREFIX.'submit-font-weight');
	if (!empty($submit_font_weight)) {
		$submit[] = 'font-weight:'.$submit_font_weight;
	}
	$submit_background_color = get_option(ASTRO_BE_PREFIX.'submit-background-color');
	if (!empty($submit_background_color)) {
		$submit[] = 'background-color:'.$submit_background_color;
	}
	$submit_border_width = get_option(ASTRO_BE_PREFIX.'submit-border-width');
	if (!empty($submit_border_width)) {
		$submit[] = 'border-width:'.$submit_border_width.'px';
	}
	$submit_border_style = get_option(ASTRO_BE_PREFIX.'submit-border-style');
	if (!empty($submit_border_style)) {
		$submit[] = 'border-style:'.$submit_border_style;
	}
	$submit_border_color = get_option(ASTRO_BE_PREFIX.'submit-border-color');
	if (!empty($submit_border_color)) {
		$submit[] = 'border-color:'.$submit_border_color;
	}
	$submit_border_radius = get_option(ASTRO_BE_PREFIX.'submit-border-radius');
	if (!empty($submit_border_radius)) {
		$submit[] = 'border-radius:'.$submit_border_radius.'px';
	}
	if (!empty($submit)) {
		$submit = implode(';', $submit);
		$arr[] = array('class' => '.astro_be .astro_be_input-submit_button', 'prop' => $submit);
	}

	$custom_css = get_option(ASTRO_BE_PREFIX.'custom-css');

	$str = false;
	if (!empty($arr) || !empty($custom_css)) {
		foreach ($arr as $item) {
			$str .= $item['class'].'{'.$item['prop'].';}';
		}
		$str .= $custom_css;
	}

	return $str;
}

/**
 * Return the post language.
 */
function astro_get_post_language() {
	$wp_page_language = get_bloginfo("language");

	if (str_contains($wp_page_language, '-')) {
		$wp_page_language = explode('-', $wp_page_language);
		$wp_page_language = $wp_page_language[0];
	}

	return $wp_page_language;
}

/**
 * Return the post language.
 */
function astro_return_post_language() {
	$lang = astro_get_post_language();
	$lang = strtolower($lang);

	return $lang;
}

/**
 * Vertical booking: return the language.
 */
function astro_return_verticalbooking_language() {

	$lang = astro_get_post_language();
	$lang = strtolower($lang);

	switch ($lang) {
		case 'it' :  $lang = 'ita'; break;
		case 'de' :  $lang = 'deu'; break;
		case 'fr' :  $lang = 'fra'; break;
		case 'es' :  $lang = 'esp'; break;
		case 'ru' :  $lang = 'rus'; break;
		case 'nl' :  $lang = 'dut'; break;
		case 'pt' :  $lang = 'por'; break;
		case 'fi' :  $lang = 'fin'; break;
		case 'el' :  $lang = 'ell'; break;
		case 'zh' :  $lang = 'chi'; break;
		case 'ko' :  $lang = 'kor'; break;
		case 'ja' :  $lang = 'jpn'; break;
		case 'th' :  $lang = 'tha'; break;
		case 'vi' :  $lang = 'vie'; break;
		case 'bg' :  $lang = 'bul'; break;
		case 'no' :  $lang = 'nor'; break;
		case 'nb' :  $lang = 'nor'; break; //Norwegian Bokmål
		case 'nn' :  $lang = 'nor'; break; //Norwegian Nynorsk
		case 'sv' :  $lang = 'sve'; break;
		case 'ro' :  $lang = 'ron'; break;
		case 'pl' :  $lang = 'pls'; break;
		case 'hu' :  $lang = 'hun'; break;
		case 'sl' :  $lang = 'slo'; break;
		case 'cz' :  $lang = 'cze'; break;
		case 'da' :  $lang = 'dan'; break;
		case 'ca' :  $lang = 'cat'; break;
		default : //'eng', 'usa', 'etn', 'bra'
			$lang = 'eng';
	}

	return $lang;
}


/**
 * Return the list of currencies.
 * Generated from https://www.html-code-generator.com/php/array/currency-names
 */
function astro_return_currencies() {
	$currency_list = array(
		"EUR","USD","AED","AFA","ALL","AMD","ANG","AOA","ARS","AUD","AWG","AZN","BAM","BBD","BDT","BEF","BGN","BHD","BIF","BMD","BND","BOB","BRL","BSD","BTC","BTN","BWP","BYR","BZD",
		"CAD","CDF","CHF","CLF","CLP","CNY","COP","CRC","CUC","CVE","CZK","DEM","DJF","DKK","DOP","DZD","EEK","EGP","ERN","ETB","FJD","FKP","GBP","GEL","GHS","GIP","GMD","GNF","GRD",
		"GTQ","GYD","HKD","HNL","HRK","HTG","HUF","IDR","ILS","INR","IQD","IRR","ISK","ITL","JMD","JOD","JPY","KES","KGS","KHR","KMF","KPW","KRW","KWD","KYD","KZT","LAK","LBP","LKR",
		"LRD","LSL","LTC","LTL","LVL","LYD","MAD","MDL","MGA","MKD","MMK","MNT","MOP","MRO","MUR","MVR","MWK","MXN","MYR","MZM","NAD","NGN","NIO","NOK","NPR","NZD","OMR","PAB","PEN",
		"PGK","PHP","PKR","PLN","PYG","QAR","RON","RSD","RUB","RWF","SAR","SBD","SCR","SDG","SEK","SGD","SHP","SKK","SLL","SOS","SRD","SSP","STD","SVC","SYP","SZL","THB","TJS","TMT",
		"TND","TOP","TRY","TTD","TWD","TZS","UAH","UGX","UYU","UZS","VEF","VND","VUV","WST","XAF","XCD","XDR","XOF","XPF","YER","ZAR","ZMK","ZWL"
	);
	return $currency_list;
}


function astro_print_checkin_checkout_datepicker_format() {
	/*
	Formats:
		01 march 2023 -> dd MM yy
		2023-03-01 -> yy-mm-dd
		01/03/2023 -> dd/mm/yy
		03/01/2023 -> mm/dd/yy

	PHP to JS:
		Y -> yy
		m -> mm
		j -> dd
		F -> MM

	Combination for select dropdown:
			j F Y day Month year
			Y-m-d year-month-day
			m/d/Y month/day/year
			d/m/Y day/month/year
	*/

	$wp_date_format = get_option('date_format');
	$wp_date_format = str_replace('F', 'MM', $wp_date_format);
	$wp_date_format = str_replace('j', 'dd', $wp_date_format);
	$wp_date_format = str_replace('Y', 'yy', $wp_date_format);
	$wp_date_format = str_replace('m', 'mm', $wp_date_format);

	return $wp_date_format;
}
