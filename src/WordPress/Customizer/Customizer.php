<?php

namespace Dot\WordPress\Customizer;

!defined( 'WPINC ' ) or die;

/**
 * Register all actions
 *
 * @package    Dot
 * @subpackage Dot\Includes\WordPress
 */

abstract class Customizer {

    /**
     * @access   protected
     * @var      string    $ID    Customizer ID
     */
    protected $ID;

    /**
     * @access   protected
     * @var      array    $args    Customizer Arguments
     */
    protected $args;

    /**
     * Customizer constructor.
     */
    public function __construct(){
        $this->ID = '';
        $this->args = [];
    }

    /**
     * Method to build customizer
     * @parm    object  $wp_customize   WP Customize
     * @return  void
     */
    abstract function build($wp_customize);

    /**
     * @return string
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param string $ID
     */
    public function setID($ID)
    {
        $this->ID = $ID;
    }

    /**
     * @return array
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * @param array $args
     */
    public function setArgs($args)
    {
        $this->args = $args;
    }

}