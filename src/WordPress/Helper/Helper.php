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
}
