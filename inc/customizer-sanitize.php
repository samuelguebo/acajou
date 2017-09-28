<?php
/**
 * Acajou Customizer functions for sanitizing inputs
 *
 * @package Acajou
 */


function acajou_sanitize_textarea($input) {
	global $allowedposttags;
	$output = wp_kses( $input, $allowedposttags);
	return $output;
}
/* Checkbox */

function acajou_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = '1';
	} else {
		$output = false;
	}
	return $output;
}
/* Radio, select, option */

function acajou_sanitize_colors( $input, $setting ) {
	$color = $setting->default;
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Make sure the chosen colors exists among the available ones.
    $colors = array('chocolate','blue', 'green', 'purple', 'red','yellow');
    if (in_array($input, $colors)) {
        $color = $input;
    }
	return $color;
}

/* Multicheck */
function acajou_sanitize_multicheck( $input, $option ) {
	$output = '';
	if ( is_array( $input ) ) {
		foreach( $option['options'] as $key => $value ) {
			$output[$key] = "0";
		}
		foreach( $input as $key => $value ) {
			if ( array_key_exists( $key, $option['options'] ) && $value ) {
				$output[$key] = "1";
			}
		}
	}
	return $output;
}

/* Uploader */

function acajou_sanitize_upload( $input ) {
	$output = '';
	$filetype = wp_check_filetype($input);
	if ( $filetype["ext"] ) {
		$output = $input;
	}
	return $output;
}

/* Editor */

function acajou_sanitize_editor($input) {
	if ( current_user_can( 'unfiltered_html' ) ) {
		$output = $input;
	}
	else {
		global $allowedtags;
		$output = wpautop(wp_kses( $input, $allowedtags));
	}
	return $output;
}

/* Allowed Tags */

function acajou_sanitize_allowedtags($input) {
	global $allowedtags;
	$output = wpautop(wp_kses( $input, $allowedtags));
	return $output;
}

/* Allowed Post Tags */

function acajou_sanitize_allowedposttags($input) {
	global $allowedposttags;
	$output = wpautop(wp_kses( $input, $allowedposttags));
	return $output;
}


/* Check that the key value sent is valid */

function acajou_sanitize_enum( $input, $option ) {
	$output = '';
	if ( array_key_exists( $input, $option['options'] ) ) {
		$output = $input;
	}
	return $output;
}

/* Typography */

function acajou_sanitize_typography( $input, $option ) {

	$output = wp_parse_args( $input, array(
		'size'  => '',
		'face'  => '',
		'style' => '',
		'color' => ''
	) );

	if ( isset( $option['options']['faces'] ) && isset( $input['face'] ) ) {
		if ( !( array_key_exists( $input['face'], $option['options']['faces'] ) ) ) {
			$output['face'] = '';
		}
	}
	else {
		$output['face']  = apply_filters( 'of_font_face', $output['face'] );
	}

	$output['size']  = apply_filters( 'of_font_size', $output['size'] );
	$output['style'] = apply_filters( 'of_font_style', $output['style'] );
	$output['color'] = apply_filters( 'acajou_sanitize_color', $output['color'] );
	return $output;
}