<?php

namespace Dot\WordPress\Helper;

!defined('WPINC ') or die();

/**
 * Add extra layer for WordPress functions
 *
 * @package    Dot
 * @subpackage Dot\WordPress
 */
trait Asset
{
	/**
	 * WordPress enqueue style
	 *
	 * @var   string    $handle     Name of the script. Should be unique
	 * @var   string    $src        Full URL of the script, or path of the script relative to the WordPress root directory
	 * @var   array     $deps       An array of registered script handles this script depends on
	 * @var   string    $ver        String specifying script version number, if it has one, which is added to the URL as a query string for cache busting purposes
	 * @var   bool      $media      The media for which this stylesheet has been defined.
	 */
	public function wp_enqueue_style(
		$handle,
		$src = '',
		$deps = [],
		$ver = false,
		$media = 'all'
	) {
		if (!strpos($src, '//')) {
			$file = sprintf(
				'%sassets/%s',
				json_decode(DOT_PATH)->framework_path,
				$src
			);
			$src = sprintf('%sassets/%s', json_decode(DOT_PATH)->framework_url, $src);
			if (!file_exists($file)) {
				return;
			}
		}
		wp_enqueue_style($handle, $src, $deps, $ver, $media);
	}

	/**
	 * WordPress enqueue script
	 *
	 * @var   string    $handle     Name of the script. Should be unique
	 * @var   string    $src        Full URL of the script, or path of the script relative to the WordPress root directory
	 * @var   array     $deps       An array of registered script handles this script depends on
	 * @var   string    $ver        String specifying script version number, if it has one, which is added to the URL as a query string for cache busting purposes
	 * @var   bool      $in_footer      Whether to enqueue the script before </body> instead of in the <head>
	 */
	public function wp_enqueue_script(
		$handle,
		$src = '',
		$deps = [],
		$ver = false,
		$in_footer = false
	) {
		if (!strpos($src, '//')) {
			$file = sprintf(
				'%sassets/%s',
				json_decode(DOT_PATH)->framework_path,
				$src
			);
			$src = sprintf('%sassets/%s', json_decode(DOT_PATH)->framework_url, $src);
			if (!file_exists($file)) {
				return;
			}
		}
		wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
	}

	/**
	 * Enqueue assets
	 */
	public function enqueue_assets($assets)
	{
		foreach ($assets as $asset_id => $asset) {
			$asset = (object) $asset;
			if ($asset->type == 'css' && $asset->status) {
				$this->wp_enqueue_style($asset_id, $asset->src);
			} elseif ($asset->type == 'js' && $asset->status) {
				$this->wp_enqueue_script(
					$asset_id,
					$asset->src,
					[],
					'',
					isset($asset->in_footer) ? true : false
				);
			}
		}
	}
}
