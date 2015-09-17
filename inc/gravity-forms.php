<?php
/**
 * Gravity Forms Bootstrap Styles
 *
 * Applies bootstrap classes to various common field types. Using this function allows use of Gravity Forms default CSS in conjunction with Bootstrap (benefit for fields types such as Address).
 *
 * Contributed to Blankout by Geet Jacobs - https://github.com/Jeradin
 *
 * @created   3/17/15 11:14 AM
 * @author    Mindshare Studios, Inc.
 * @copyright Copyright (c) 2006-2015
 * @link      https://mindsharelabs.com/
 */

if (!is_admin()) {
	//add_filter("gform_field_content", "blankout_bootstrap_styles_for_gravityforms_fields", 10, 5);
	add_action('gform_field_container', 'blankout_field_container', 10, 6);
	add_filter("gform_submit_button", "blankout_form_submit_button", 10, 2);
	add_filter('gform_next_button', 'blankout_next_button_markup', 10, 2);
	add_filter('gform_previous_button', 'blankout_previous_button_markup', 10, 2);
	add_filter("gform_validation_message", "blankout_change_message", 10, 2);
	add_filter("gform_field_validation", "blankout_custom_validation", 10, 4);
	//add_action("gform_enqueue_scripts", "blankout_enqueue_custom_script", 10, 2);
};

/**
 * @param $content
 * @param $field
 * @param $value
 * @param $lead_id
 * @param $form_id
 *
 * @see  gform_field_content
 * @link http://www.gravityhelp.com/documentation/page/Gform_field_content
 *
 * @return string Modified field content
 *
 */
function blankout_bootstrap_styles_for_gravityforms_fields($content, $field, $value, $lead_id, $form_id) {

	// Currently only applies to most common field types, but could be expanded.
	if ($field[ "type" ] != 'hidden' && $field[ "type" ] != 'list' && $field[ "type" ] != 'multiselect' && $field[ "type" ] != 'checkbox' && $field[ "type" ] != 'fileupload' && $field[ "type" ] != 'date' && $field[ "type" ] != 'html' && $field[ "type" ] != 'address') {
		$content = str_replace('class=\'medium', 'class=\'form-control medium', $content);
	}

	if ($field[ "type" ] == 'list') {
		$content = str_replace('<input ', '<input class=\'form-control\' ', $content);
	}

	if ($field[ "type" ] == 'multiselect') {
		$content = str_replace('<select ', '<select class=\'form-control\' ', $content);
	}

	if ($field[ "type" ] == 'name') {
		$content = str_replace('<input ', '<input class=\'form-control\' ', $content);
		//$content = str_replace('<select ', '<select class=\'form-control\' ', $content);
	}

	if ($field[ "type" ] == 'address') {
		$content = str_replace('<input ', '<input class=\'form-control\' ', $content);
		$content = str_replace('<select ', '<select class=\'form-control\' ', $content);
	}

	if ($field[ "type" ] == 'textarea' || ($field[ "type" ] == 'survey' && $field[ "inputType" ] = 'textarea')) {
		$content = str_replace('class=\'textarea', 'class=\'form-control textarea', $content);
	}

	if (($field[ "type" ] == 'survey' && $field[ "inputType" ] = 'checkbox' && !empty($field[ "inputs" ]))) {
		//echo '<pre>';var_dump($field);echo '</pre>';
		$content = str_replace('li class=\'', 'li class=\'checkbox ', $content);
		$content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
	}

	if (($field[ "type" ] == 'survey' && empty($field[ "inputType" ]))) {

		$content = str_replace('li class=\'', 'li class=\'radio ', $content);
		$content = str_replace('type=\'radio\' ', 'type=\'radio\' style=\'margin-left:1px;\' ', $content);
		$content = str_replace('type=\'text\' ', 'type=\'text\' style=\'margin-left:20px;\' ', $content);
	}

	if ($field[ "type" ] == 'checkbox') {
		if ($field[ "cssClass" ] == 'display-inline') {
			$content = str_replace('li class=\'', 'li class=\'checkbox-inline ', $content);
		} else {
			$content = str_replace('li class=\'', 'li class=\'checkbox ', $content);
			$content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
		};
	}

	if ($field[ "type" ] == 'radio') {

		if ($field[ "cssClass" ] == 'display-inline') {
			$content = str_replace('li class=\'', 'li class=\'radio-inline ', $content);
		} else {
			$content = str_replace('li class=\'', 'li class=\'radio ', $content);
			$content = str_replace('type=\'radio\' ', 'type=\'radio\' style=\'margin-left:1px;\' ', $content);
		};

		//this is for the other option
		$content = str_replace('type=\'text\' ', 'type=\'text\' style=\'margin-left:20px;\' ', $content);
	}

	if ($field[ "isRequired" ] == TRUE && !($field[ "type" ] == 'checkbox' || $field[ "type" ] == 'survey' || $field[ "type" ] == 'radio')) {
		$content = str_replace('<input ', '<input required="required" ', $content);
	}

	if ($field[ "type" ] == 'creditcard') {

		//echo '<pre>';var_dump($content);echo '</pre>';
		$content = str_replace('<input ', '<input class=\'form-control\' ', $content);
		$content = str_replace('<select ', '<select class=\'form-control\' ', $content);
	}

	return $content;
} // End bootstrap_styles_for_gravityforms_fields()

/**
 * replace class for container block
 *
 * @param $field_container
 * @param $field
 * @param $form
 * @param $class_attr
 * @param $style
 * @param $field_content
 *
 * @return string
 */
function blankout_field_container($field_container, $field, $form, $class_attr, $style, $field_content) {

	if ($field[ "type" ] == 'name') {
		//echo '<pre>';var_dump($field);echo '</pre>';
		//$field_content = preg_replace('~<span(.*?) class=\'(.*?)\'>~i', '<span$1 class="col-sm-6">', $field_content);
		$field_content = str_replace('name_prefix_select', 'name_prefix_select col-sm-12', $field_content);
		if (strpos($field_content, 'name_middle') !== FALSE) {
			$field_content = str_replace('name_middle', 'name_middle col-sm-4', $field_content);
			$field_content = str_replace('name_first', 'name_first col-sm-4', $field_content);
			$field_content = str_replace('name_last', 'name_last col-sm-4', $field_content);
		} else {
			$field_content = str_replace('name_first', 'name_first col-sm-6', $field_content);
			$field_content = str_replace('name_last', 'name_last col-sm-6', $field_content);
		}
		$field_content = str_replace('name_suffix ', 'name_suffix  col-sm-1', $field_content);
	}
	if ($field[ "type" ] == 'address') {
		//echo '<pre>';var_dump($field_content);echo '</pre>';
		//$field_content = preg_replace('~<span(.*?) class=(.*?)(.*?)(.*?)>~i', '<span$1 class="col-sm-6">', $field_content);
		$field_content = str_replace('ginput_full', 'ginput_full col-sm-12', $field_content);
		$field_content = str_replace('ginput_left', 'ginput_left col-sm-6', $field_content);
		$field_content = str_replace('ginput_right', 'ginput_right col-sm-6', $field_content);
	}

	if ($field[ "isRequired" ] == TRUE) {

		$class_attr = str_replace('gfield_error', 'gfield_error has-error', $class_attr);
	}

	if ($field[ "type" ] == 'creditcard') {

		// echo '<pre>';var_dump($field);echo '</pre>';
		//$field_content = str_replace('ginput_complex', 'ginput_complex', $field_content);

		$field_content = str_replace('gform_card_icon_container ', ' gform_card_icon_container btn-toolbar ', $field_content);

		$field_content = str_replace('gform_card_icon ', ' gform_card_icon btn btn-default ', $field_content);

		$field_content = str_replace('ginput_card_security_code_icon', 'ginput_card_security_code_icon glyphicon glyphicon-credit-card', $field_content);

		//  $field_content = str_replace('gform_card_icon_', 'card-logo ', $field_content);

		$field_content = str_replace('ginput_cardextras', 'ginput_cardextras clearfix', $field_content);

		//$field_content = str_replace('ginput_cardinfo_left', 'ginput_cardinfo_left pull-left', $field_content);
		//$field_content = str_replace('ginput_cardinfo_right', 'ginput_cardinfo_right pull-right', $field_content);

		$field_content = str_replace('<select', '<div class="col-xs-6"><div class="form-group"><select', $field_content);
		$field_content = str_replace('</select>', '</select></div></div>', $field_content);

		$field_content = str_replace('gfield_creditcard_warning_message', 'gfield_creditcard_warning_message alert alert-danger', $field_content);

		//$field_content = str_replace('ginput_cardextras', 'ginput_cardextras form-inline', $field_content);
		//$field_content = str_replace('ginput_full', 'ginput_full col-md-12', $field_content);
		//$field_content = '<div class="col-md-4">'.$field_content.'</div>';
		$field_content = '<div class="row"><div class="col-md-4"><div class=" panel panel-default "><div class="panel-body">' . $field_content . '<div class="card-wrapper"></div></div></div></div></div>';
	} else {
		$field_content = str_replace('ginput_complex', 'ginput_complex row', $field_content);
	}

	if ($field[ "size" ] == 'number') {
		$field_content = '<div class="row"><div class="col-md-4">' . $field_content . '</div></div>';
	}

	return '<li id="field_' . $form[ 'id' ] . '_' . $field[ 'id' ] . '" class="' . $class_attr . ' form-group">' . $field_content . '</li>';
}

/**
 * Filter the Gravity Forms button type
 *
 * @param $button
 * @param $form
 *
 * @return mixed
 */
function blankout_form_submit_button($button, $form) {
	$button = str_replace('gform_button', 'gform_button btn', $button);

	return $button;
}

/**
 * Next button
 *
 * @param $next_button
 * @param $form
 *
 * @return mixed
 */
function blankout_next_button_markup($next_button, $form) {
	$next_button = str_replace('gform_next_button', 'gform_next_button btn', $next_button);

	return $next_button;
}

/**
 * previous button
 *
 * @param $previous_button
 * @param $form
 *
 * @return mixed
 */
function blankout_previous_button_markup($previous_button, $form) {
	$previous_button = str_replace('gform_previous_button', 'gform_previous_button btn', $previous_button);

	return $previous_button;
}

/**
 *
 * Validation message
 *
 * @param $message
 * @param $form
 *
 * @return mixed
 */
function blankout_change_message($message, $form) {
	$message = str_replace('validation_error', 'validation_error alert alert-danger', $message);

	return $message;
}

/**
 * @param $result
 * @param $value
 * @param $form
 * @param $field
 *
 * @return mixed
 */
function blankout_custom_validation($result, $value, $form, $field) {
	$result[ 'message' ] = '<span class="help-block">This field is required.</span>';

	return $result;
}

/**
 *
 * Only enqueue scripts if the current page has a Gravity Form.
 * (not currently used)
 *
 * @param $form
 * @param $is_ajax
 */
function blankout_enqueue_custom_script($form, $is_ajax) {

	// add custom theme scripts
	wp_enqueue_script('custom', (get_template_directory_uri() . "/js/gforms-custom.js"), 'jquery');

	foreach ($form[ 'fields' ] as $field) {
		if ($field->type == 'custom') {
			// do something custom
		}
	}
}
