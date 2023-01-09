<?php

namespace Dot\WordPress\Helper;

!defined('WPINC ') or die();

/**
 * Add extra layer for WordPress functions
 *
 * @package    Dot
 * @subpackage Dot\WordPress
 */

trait Model
{
	/**
	 * Retrieves post data given a post ID or post object.
	 * @param     int|object      Post ID or post object. Defaults to global $post
	 * @param     string          The required return type. One of OBJECT, ARRAY_A, or ARRAY_N
	 * @param     filter          Type of filter to apply. Accepts 'raw', 'edit', 'db', or 'display'
	 * @return  object          Post Type object
	 */
	public function get_post($ID, $output = OBJECT, $filter = 'raw')
	{
		return get_post($ID, $output, $filter);
	}

	/**
	 * Get Post Type
	 * @param   array        Arguments to retrieve posts
	 * @return  object       Post Type object
	 */
	public function get_posts($args = [])
	{
		return get_posts($args);
	}

	/**
	 * Insert new post
	 * @param   array   An array of elements that make up a post to update or insert.
	 * @return int      The post ID on success
	 */
	public function wp_insert_post($args)
	{
		return wp_insert_post($args);
	}

	/**
	 * Determines if a meta field with the given key exists for the given object ID.
	 */
	public function metadata_exists(
		string $meta_type,
		int $object_id,
		string $meta_key
	) {
		return metadata_exists($meta_type, $object_id, $meta_key);
	}

	/**
	 * Retrieves a post meta field for the given post ID.
	 * @param      int    $ID       Post id
	 * @param      int    $meta_key       meta_key
	 * @param      bool    $single   	If true, returns only the first value for the specified meta key
	 * @return array       Will be an array if $single is false. Will be value of the meta field if $single is true
	 */
	public function get_post_meta($ID, $meta_key, $single = false)
	{
		return get_post_meta($ID, $meta_key, $single);
	}

	/**
	 * Adds a meta field to the given post
	 * @param      int    $ID       Post id
	 * @param      int    $meta_key       meta_key
	 * @param      bool    $unique   Whether the same key should not be added
	 * @return int      Meta ID on success, false on failure
	 */
	public function add_post_meta($ID, $meta_key, $unique = false)
	{
		return add_post_meta($ID, $meta_key, $this->value, $unique);
	}

	/**
	 * Adds a meta field to the given post
	 * @param      int    $ID       Post id
	 * @param      int    $meta_key       meta_key
	 * @param      string    $prev_value   Previous value to check before updating
	 * @return bool     The new meta field ID if a field with the given key didn't exist and was therefore added, true on successful update, false on failure
	 */
	public function update_post_meta($ID, $meta_key, $value, $prev_value = false)
	{
		return update_post_meta($ID, $meta_key, $value, $prev_value);
	}

	/**
	 * Deletes a post meta field for the given post ID.
	 *
	 * You can match based on the key, or key and value. Removing based on key and
	 * value, will keep from removing duplicate metadata with the same key. It also
	 * allows removing all metadata matching the key, if needed.
	 *
	 * @since 1.5.0
	 *
	 * @param int    $post_id    Post ID.
	 * @param string $meta_key   Metadata name.
	 * @param mixed  $meta_value Optional. Metadata value. If provided,
	 *                           rows will only be removed that match the value.
	 *                           Must be serializable if non-scalar. Default empty.
	 * @return bool True on success, false on failure.
	 */
	public function delete_post_meta($post_id, $meta_key, $meta_value = '')
	{
		delete_post_meta($post_id, $meta_key, $meta_value = '');
	}
}
