<?php
/**
 * Contains all sanitization related functions
 * 
 * @package Profound
 * @subpackage Options
 * @since 1.0
 */

add_filter( 'mudthemes_panel_sanitize_text', 'sanitize_text_field' );

function mudthemes_panel_sanitize_textarea($input) {
	global $allowedposttags;
	$output = wp_kses( $input, $allowedposttags);
	return $output;
}

add_filter( 'mudthemes_panel_sanitize_textarea', 'mudthemes_panel_sanitize_textarea' );


/* Check that the key value sent is valid */

function mudthemes_panel_sanitize_enum( $input, $option ) {
	$output = '';
	if ( array_key_exists( $input, $option['options'] ) ) {
		$output = $input;
	}
	return $output;
}

add_filter( 'mudthemes_panel_sanitize_select', 'mudthemes_panel_sanitize_enum', 10, 2);

add_filter( 'mudthemes_panel_sanitize_radio', 'mudthemes_panel_sanitize_enum', 10, 2);

add_filter( 'mudthemes_panel_sanitize_images', 'mudthemes_panel_sanitize_enum', 10, 2);


/**
 * Checks whether the default value/stored value for a single option 
 * is also inside the $option['options'] array.
 * 
 * $option['options'] array contains all the icons.
 * 
 * @param string $input Contains either the default (std) value or the value saved in the database. Example: music, lock, download, dashboard
 * @param array $option Contains the individual array for an option. For example contains just a single '$options[] = array();' from push.options.php
 * @return string
 */
function mudthemes_panel_sanitize_radioicons($input, $option){
    if(in_array($input, $option['options'])){
        return $input;
    } else{
        return '';
    }
}

add_filter( 'mudthemes_panel_sanitize_radioicons', 'mudthemes_panel_sanitize_radioicons', 10, 2);


function mudthemes_panel_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = '1';
	} else {
		$output = false;
	}
	return $output;
}
add_filter( 'mudthemes_panel_sanitize_checkbox', 'mudthemes_panel_sanitize_checkbox' );



/* Uploader */

function mudthemes_panel_sanitize_upload( $input ) {
	$output = '';
	$filetype = wp_check_filetype($input);
	if ( $filetype["ext"] ) {
		$output = $input;
	}
	return $output;
}
add_filter( 'mudthemes_panel_sanitize_upload', 'mudthemes_panel_sanitize_upload' );


/* Allowed Post Tags */

function mudthemes_panel_sanitize_allowedposttags($input) {
	global $allowedposttags;
	$output = wpautop(wp_kses( $input, $allowedposttags));
	return $output;
}

add_filter( 'mudthemes_panel_sanitize_info', 'mudthemes_panel_sanitize_allowedposttags' );



/* Background */

function mudthemes_panel_sanitize_background( $input ) {
	$output = wp_parse_args( $input, array(
		'color' => '',
		'image'  => '',
		'repeat'  => 'repeat',
		'position' => 'top center',
		'attachment' => 'scroll'
	) );

	$output['color'] = apply_filters( 'mudthemes_panel_sanitize_hex', $input['color'] );
	$output['image'] = apply_filters( 'mudthemes_panel_sanitize_upload', $input['image'] );
	$output['repeat'] = apply_filters( 'mudthemes_panel_background_repeat', $input['repeat'] );
	$output['position'] = apply_filters( 'mudthemes_panel_background_position', $input['position'] );
	$output['attachment'] = apply_filters( 'mudthemes_panel_background_attachment', $input['attachment'] );

	return $output;
}
add_filter( 'mudthemes_panel_sanitize_background', 'mudthemes_panel_sanitize_background' );

function mudthemes_panel_sanitize_background_repeat( $value ) {
	$recognized = mudthemes_panel_recognized_background_repeat();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'mudthemes_panel_default_background_repeat', current( $recognized ) );
}
add_filter( 'mudthemes_panel_background_repeat', 'mudthemes_panel_sanitize_background_repeat' );

function mudthemes_panel_sanitize_background_position( $value ) {
	$recognized = mudthemes_panel_recognized_background_position();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'mudthemes_panel_default_background_position', current( $recognized ) );
}
add_filter( 'mudthemes_panel_background_position', 'mudthemes_panel_sanitize_background_position' );

function mudthemes_panel_sanitize_background_attachment( $value ) {
	$recognized = mudthemes_panel_recognized_background_attachment();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'mudthemes_panel_default_background_attachment', current( $recognized ) );
}
add_filter( 'mudthemes_panel_background_attachment', 'mudthemes_panel_sanitize_background_attachment' );


/* Typography */

function mudthemes_panel_sanitize_typography( $input, $option ) {

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
		$output['face']  = apply_filters( 'mudthemes_panel_font_face', $output['face'] );
	}

	$output['size']  = apply_filters( 'mudthemes_panel_font_size', $output['size'] );
	$output['style'] = apply_filters( 'mudthemes_panel_font_style', $output['style'] );
	$output['color'] = apply_filters( 'mudthemes_panel_color', $output['color'] );
	return $output;
}
add_filter( 'mudthemes_panel_sanitize_typography', 'mudthemes_panel_sanitize_typography', 10, 2 );

function mudthemes_panel_sanitize_font_size( $value ) {
	$recognized = mudthemes_panel_recognized_font_sizes();
	$value_check = preg_replace('/px/','', $value);
	if ( in_array( (int) $value_check, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'mudthemes_panel_default_font_size', $recognized );
}
add_filter( 'mudthemes_panel_font_size', 'mudthemes_panel_sanitize_font_size' );


function mudthemes_panel_sanitize_font_style( $value ) {
	$recognized = mudthemes_panel_recognized_font_styles();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'mudthemes_panel_default_font_style', current( $recognized ) );
}
add_filter( 'mudthemes_panel_font_style', 'mudthemes_panel_sanitize_font_style' );


function mudthemes_panel_sanitize_font_face( $value ) {
	$recognized = mudthemes_panel_recognized_font_faces();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'mudthemes_panel_default_font_face', current( $recognized ) );
}
add_filter( 'mudthemes_panel_font_face', 'mudthemes_panel_sanitize_font_face' );

/**
 * Get recognized background repeat settings
 *
 * @return   array
 *
 */
function mudthemes_panel_recognized_background_repeat() {
	$default = array(
                'repeat-mud' => __('repeat', 'profound'),
		'no-repeat' => __('No Repeat', 'profound'),
		'repeat-x'  => __('Repeat Horizontally', 'profound'),
		'repeat-y'  => __('Repeat Vertically', 'profound'),
		'repeat'    => __('Repeat All', 'profound'),
		);
	return apply_filters( 'mudthemes_panel_recognized_background_repeat', $default );
}

/**
 * Get recognized background positions
 *
 * @return   array
 *
 */
function mudthemes_panel_recognized_background_position() {
	$default = array(
                'top-left-mud' => __('top left', 'profound'),
		'top left'      => __('Top Left', 'profound'),
		'top center'    => __('Top Center', 'profound'),
		'top right'     => __('Top Right', 'profound'),
		'center left'   => __('Middle Left', 'profound'),
		'center center' => __('Middle Center', 'profound'),
		'center right'  => __('Middle Right', 'profound'),
		'bottom left'   => __('Bottom Left', 'profound'),
		'bottom center' => __('Bottom Center', 'profound'),
		'bottom right'  => __('Bottom Right', 'profound')
		);
	return apply_filters( 'mudthemes_panel_recognized_background_position', $default );
}

/**
 * Get recognized background attachment
 *
 * @return   array
 *
 */
function mudthemes_panel_recognized_background_attachment() {
	$default = array(
                'scroll-mud' => __('fixed', 'profound'),
		'scroll' => __('Scroll Normally', 'profound'),
		'fixed'  => __('Fixed in Place', 'profound')
		);
	return apply_filters( 'mudthemes_panel_reprofoundd_background_attachment', $default );
}

/**
 * Sanitize a color represented in hexidecimal notation.
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @param    string    The value that this function should return if it cannot be recognized as a color.
 * @return   string
 *
 */

function mudthemes_panel_sanitize_hex( $hex, $default = '' ) {
	if ( mudthemes_panel_validate_hex( $hex ) ) {
		return $hex;
	}
	return $default;
}

/* Color Picker */
add_filter( 'mudthemes_panel_sanitize_color', 'mudthemes_panel_sanitize_hex' );

/**
 * Get recognized font sizes.
 *
 * Returns an indexed array of all recognized font sizes.
 * Values are integers and represent a range of sizes from
 * smallest to largest.
 *
 * @return   array
 */

function mudthemes_panel_recognized_font_sizes() {
	$sizes = range( 9, 71 );
	$sizes = apply_filters( 'mudthemes_panel_recognized_font_sizes', $sizes );
	$sizes = array_map( 'absint', $sizes );
	return $sizes;
}

/**
 * Get recognized font faces.
 *
 * Returns an array of all recognized font faces.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 *
 */
function mudthemes_panel_recognized_font_faces() {
	$default = array(
		'arial'     => 'Arial',
		'verdana'   => 'Verdana, Geneva',
		'trebuchet' => 'Trebuchet',
		'georgia'   => 'Georgia',
		'times'     => 'Times New Roman',
		'tahoma'    => 'Tahoma, Geneva',
		'palatino'  => 'Palatino',
		'helvetica' => 'Helvetica*'
		);
	return apply_filters( 'mudthemes_panel_recognized_font_faces', $default );
}

/**
 * Get recognized font styles.
 *
 * Returns an array of all recognized font styles.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 *
 */
function mudthemes_panel_recognized_font_styles() {
	$default = array(
		'normal'      => __('Normal', 'profound'),
		'italic'      => __('Italic', 'profound'),
		'bold'        => __('Bold', 'profound'),
		'bold italic' => __('Bold Italic', 'profound')
		);
	return apply_filters( 'mudthemes_panel_recognized_font_styles', $default );
}

/**
 * Is a given string a color formatted in hexidecimal notation?
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @return   bool
 *
 */

function mudthemes_panel_validate_hex( $hex ) {
	$hex = trim( $hex );
	/* Strip recognized prefixes. */
	if ( 0 === strpos( $hex, '#' ) ) {
		$hex = substr( $hex, 1 );
	}
	elseif ( 0 === strpos( $hex, '%23' ) ) {
		$hex = substr( $hex, 3 );
	}
	/* Regex match. */
	if ( 0 === preg_match( '/^[0-9a-fA-F]{6}$/', $hex ) ) {
		return false;
	}
	else {
		return true;
	}
}