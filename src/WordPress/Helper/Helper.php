<?php

namespace Dot\WordPress\Helper;

!defined('WPINC ') or die();

/**
 * Add extra layer for WordPress functions
 *
 * @package    Dot
 * @subpackage Dot\WordPress
 */

class Helper
{
	/** Load WP Trait */
	use API;
	use Asset;
	use Model;
	use Option;
	use Page;
	use Shortcode;
	use Template;
	use Validate;
	use User;

	/**
	 * WordPress debug function.
	 * - Please don't forget to turn on WP_DEBUG_LOG to true otherwise this function will not work.
	 */
	public function debug($log)
	{
		if (is_array($log) || is_object($log)) {
			error_log(print_r($log, true));
		} else {
			error_log($log);
		}
	}
}
