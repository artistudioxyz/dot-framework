<?php

namespace Dot\WordPress\Helper;

!defined( 'WPINC ' ) or die;

/**
 * Add extra layer for WordPress functions
 *
 * @package    Dot
 * @subpackage Dot\WordPress
 */

trait Option {

    /**
     * Retrieve theme modification value for the current theme.
     * @param   string      $name       	Theme modification name.
     * @param   mixed       $default       	Theme modification default value.
     */
    public function get_theme_mod($name, $default = false){ return get_theme_mod($name, $default); }

    /**
     * Update theme modification value for the current theme.
     * @param   string      $name       	Theme modification name.
     * @param   mixed       $value       		Theme modification value.
     */
    public function set_theme_mod($name, $value){ return set_theme_mod($name, $value); }

    /**
     * Retrieves an option value based on an option name.
     * @return  mixed       Value set for the option
     * @param     string      $option         Name of option to retrieve. Expected to not be SQL-escaped.
     * @param     array       $default    	Default value to return if the option does not exist.
     */
    public function get_option($option, $default = false){ return get_option($option, $default); }

    /**
     * Retrieves an option value based on an option name.
     * @return  bool        False if value was not updated and true if value was updated.
     * @param     string      $option         Option name. Expected to not be SQL-escaped.
     * @param     array       $value      	Option value. Must be serializable if non-scalar. Expected to not be SQL-escaped.
     * @param     array       $autoload    	Whether to load the option when WordPress starts up.
     */
    public function update_option($option, $value, $autoload = null){ return update_option($option, $value, $autoload); }

    /**
     * Retrieves an option value based on an option name.
     * @return  bool        False if value was not updated and true if value was updated.
     * @param     string      $option         Option name. Expected to not be SQL-escaped.
     * @param     array       $value        Option value. Must be serializable if non-scalar. Expected to not be SQL-escaped.
     * @param     array       $autoload     Whether to load the option when WordPress starts up.
     */
    public function delete_option($option){ return delete_option($option); }

}