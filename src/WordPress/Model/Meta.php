<?php

namespace Dot\WordPress\Model;

!defined( 'WPINC ' ) or die;

/**
 * Abstract class for WordPress model
 *
 * @package    Dot
 * @subpackage Dot\Includes\WordPress
 */

class Meta {

    /**
     * @access   protected
     * @var      object    $type     Post Type Object
     */
    protected $type;

    /**
     * @access   protected
     * @var      string    $key     Metadata key
     */
    protected $key;

    /**
     * @access   protected
     * @var      string    $value   Metadata value
     */
    protected $value;

    /**
     * @access   protected
     * @var      string    $args   Generalize metadata arguments
     */
    protected $args;

    /**
     * @access  protected
     */
    protected $ServiceModel;

    /**
     * Metadata constructor
     */
    public function __construct(){
        $this->WP = new \Dot\WordPress\Helper();
        $this->args = [];
    }

    /**
     * Retrieves a post meta field for the given post ID.
     * @param      bool    $single   	If true, returns only the first value for the specified meta key
     * @return array       Will be an array if $single is false. Will be value of the meta field if $single is true
     */
    public function get_post_meta($single = false){
        return $this->WP->get_post_meta( $this->type->getID(), $this->key, $single );
    }

    /**
     * Adds a meta field to the given post
     * @param      bool    $unique   Whether the same key should not be added
     * @return int      Meta ID on success, false on failure
     */
    public function add_post_meta($unique = false){
        return $this->WP->get_post_meta( $this->type->getID(), $this->key, $this->value, $unique );
    }

    /**
     * Adds a meta field to the given post
     * @param      string    $prev_value   Previous value to check before updating
     * @return bool     The new meta field ID if a field with the given key didn't exist and was therefore added, true on successful update, false on failure
     */
    public function update_post_meta($prev_value = false){
        return $this->WP->get_post_meta( $this->type->getID(), $this->key, $this->value, $prev_value );
    }

    /**
     * @return object
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param object $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * @param string $args
     */
    public function setArgs($args)
    {
        $this->args = $args;
    }

}