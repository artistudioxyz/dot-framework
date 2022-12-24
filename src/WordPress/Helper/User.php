<?php

namespace Dot\WordPress\Helper;

!defined( 'WPINC ' ) or die;

/**
 * Add extra layer for WordPress functions
 *
 * @package    Dot
 * @subpackage Dot\WordPress
 */

trait User {

    /**
     * Retrieve list of users matching criteria.
     * @backend
     * @return  object  Lists of user object
     */
    public function get_users($args){
        return get_users($args);
    }

    /**
     * Retrieve user info by a given field
     * @backend
     * @return  object  User object
     */
    public function get_user_by($field, $value){
        return get_user_by($field, $value);
    }

    /**
     * Retrieve the current user object.
     * @backend
     * @return  object  User object
     */
    public function get_current_user(){
        return wp_get_current_user();
    }

}