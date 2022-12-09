<?php

namespace Dot\Wordpress\Helper;

!defined( 'WPINC ' ) or die;

/**
 * Add extra layer for wordpress functions
 *
 * @package    Dot
 * @subpackage Dot\Wordpress
 */

trait Model {

    /**
     * Retrieves post data given a post ID or post object.
     * @param     int|object      Post ID or post object. Defaults to global $post
     * @param     string          The required return type. One of OBJECT, ARRAY_A, or ARRAY_N
     * @param     filter          Type of filter to apply. Accepts 'raw', 'edit', 'db', or 'display'
     * @return  object          Post Type object
     */
    public function get_post($ID, $output = OBJECT, $filter = 'raw'){
        return get_post($ID, $output, $filter);
    }

    /**
     * Get Post Type
     * @param   array        Arguments to retrieve posts
     * @return  object       Post Type object
     */
    public function get_posts($args = []){
        return get_posts($args);
    }

    /**
     * Insert new post
     * @param   array   An array of elements that make up a post to update or insert.
     * @return int      The post ID on success
     */
    public function wp_insert_post($args){
        return wp_insert_post($args);
    }

    /**
     * Registers a post type.
     * @param   string   	Post type key
     * @param   array   	Array or string of arguments for registering a post type.
     * @return void
     */
    public function register_post_type($post_type, $args = []){
        register_post_type($post_type, $args);
    }

    /**
     * Retrieves a post meta field for the given post ID.
     * @param      int    $ID       Post id
     * @param      int    $meta_key       meta_key
     * @param      bool    $single   	If true, returns only the first value for the specified meta key
     * @return array       Will be an array if $single is false. Will be value of the meta field if $single is true
     */
    public function get_post_meta($ID, $meta_key, $single = false){
        return get_post_meta( $ID, $meta_key, $single );
    }

    /**
     * Adds a meta field to the given post
     * @param      int    $ID       Post id
     * @param      int    $meta_key       meta_key
     * @param      bool    $unique   Whether the same key should not be added
     * @return int      Meta ID on success, false on failure
     */
    public function add_post_meta($ID, $meta_key, $unique = false){
        return add_post_meta( $ID, $meta_key, $this->value, $unique );
    }

    /**
     * Adds a meta field to the given post
     * @param      int    $ID       Post id
     * @param      int    $meta_key       meta_key
     * @param      string    $prev_value   Previous value to check before updating
     * @return bool     The new meta field ID if a field with the given key didn't exist and was therefore added, true on successful update, false on failure
     */
    public function update_post_meta($ID, $meta_key, $value, $prev_value = false){
        return update_post_meta( $ID, $meta_key, $value, $prev_value );
    }

}