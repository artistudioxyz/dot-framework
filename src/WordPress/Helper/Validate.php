<?php

namespace Dot\WordPress\Helper;

! defined( 'WPINC ' ) or die;

/**
 * Add extra layer for WordPress functions
 *
 * @package    Dot
 * @subpackage Dot\WordPress
 */

trait Validate {

	/**
	 * Recurse function to sanitize text field
	 */
	public function sanitizeTextField( $params ) {
		foreach ( $params as $key => &$value ) {
			if ( is_array( $value ) ) {
				$value = $this->sanitizeTextField( $value );
			} else {
				$value = sanitize_text_field( $value );
			}
		}
		return $params;
	}

	/**
	 * Validate $_POST Params
	 *
	 * @var     array   $_POST      $_POST parameters
	 * @var     array   $default    Default value config
	 * @return  bool    Validation result
	 */
	public function validateParams( $params, $default, $validated = true ) {
		foreach ( $default as $index => $key ) {
			if ( ! isset( $params[ $key ] ) && ! is_array( $key ) ) {
				$validated = false;
				break; }
			if ( is_array( $key ) ) {
				$validated = $this->validateParams( $params[ $index ], $key, $validated );
			}
		}
		return $validated;
	}

}
