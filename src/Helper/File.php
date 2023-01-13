<?php

namespace Dot\Helper;

!defined('WPINC ') or die();

/**
 * Helper library for Dot framework
 *
 * @package    Dot
 * @subpackage Dot\Includes
 */

trait File
{
	/**
	 * Sanitize file input upload customizer
	 */
	function sanitize_file($file, $setting)
	{
		//allowed file types
		$mimes = [
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif' => 'image/gif',
			'png' => 'image/png',
		];

		//check file type from file name
		$file_ext = wp_check_filetype($file, $mimes);

		//if file has a valid mime type return it, otherwise return default
		return $file_ext['ext'] ? $file : $setting->default;
	}
}
