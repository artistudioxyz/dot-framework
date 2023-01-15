<?php

namespace Dot\WordPress\Helper;

!defined('WPINC ') or die();

/**
 * Add extra layer for WordPress functions
 *
 * @package    Dot
 * @subpackage Dot\WordPress
 */
trait Page
{
	/**
	 * WordPress - Determines whether the query is for an existing single page.
	 *
	 * @param   mixed $page   Page ID, title, slug, or array of such to check against.
	 * @return  bool    Whether the query is for an existing single page.
	 */
	public function is_page($page = '')
	{
		return is_page($page);
	}

	/**
	 * WordPress - Determines whether the query is for an existing archive page.
	 *
	 * @return  bool
	 */
	public function is_archive()
	{
		return is_archive();
	}

	/**
	 * WordPress - Retrieves a modified URL query string.
	 *
	 * @param  string $key    Either a query variable key, or an associative array of query variables.
	 * @param  string $value    Either a query variable value, or a URL to act upon.
	 * @param  string $url    A URL to act upon.
	 */
	public function add_query_arg($key, $value = null, $url = null)
	{
		return $url
			? add_query_arg($key, $value, $url)
			: add_query_arg($key, $value);
	}

	/**
	 * WordPress redirect
	 */
	public function wp_redirect($url)
	{
		wp_redirect($url);
		exit();
	}

	/**
	 * WordPress get_permalink
	 */
	public function get_permalink($post, $leavename = false)
	{
		return get_permalink($post, $leavename);
	}

	/**
	 * WordPress get screen
	 */
	public function getScreen()
	{
		global $post, $pagenow;
		try {
			$screen = function_exists('get_current_screen')
				? get_current_screen()
				: (object) [];
			$screen = $screen ? $screen : (object) [];
		} catch (Exception $e) {
			try {
				$screen = new \stdClass();
			} catch (Exception $e) {
				$screen = (object) [];
			}
		}
		$screen->post = $post;
		$screen->pagenow = $pagenow;
		return $screen;
	}

	/**
	 * Whether the site is being previewed in the Customizer.
	 */
	public function is_customize_preview()
	{
		return is_customize_preview();
	}
}
