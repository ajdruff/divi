<?php
/**
 * Sanitize float number
 * @param mixed
 * @return float
 */
function et_sanitize_float_number( $number ) {
	return floatval( $number );
}

/**
 * Sanitize integer number
 * @param mixed
 * @return int
 */
function et_sanitize_int_number( $number ) {
	return intval( $number );
}

/**
 * Sanitize choosen option based on options' key
 * @param string
 * @param array
 * @return string|bool
 */
function et_sanitize_key_based_option( $choosen, $options ) {
	// Validate choosen option based on available options
	if ( ! isset( $options[ $choosen ] ) ) {
		return false;
	}

	return $choosen;
}

/**
 * Sanitize font choice
 * @param string
 * @return string|bool
 */
function et_sanitize_font_choices( $choosen ) {
	return et_sanitize_key_based_option( $choosen, et_get_google_fonts() );
}

/**
 * Sanitize color scheme
 * @param string
 * @return string|bool
 */
function et_sanitize_color_scheme( $choosen ) {
	return et_sanitize_key_based_option( $choosen, et_theme_color_scheme_choices() );
}

/**
 * Sanitize header styles
 * @param string
 * @return string|bool
 */
function et_divi_legacy_sanitize_header_styles( $choosen ) {
	return et_sanitize_key_based_option( $choosen, et_divi_legacy_get_header_styles() );
}

/**
 * Sanitize dark/light color
 * @param string
 * @return string|bool
 */
function et_divi_legacy_sanitize_dark_light_colors( $choosen ) {
	return et_sanitize_key_based_option( $choosen, et_divi_legacy_get_dark_light_color() );
}