<?php

namespace Dot\WordPress\Customizer;

!defined( 'WPINC ' ) or die;

/**
 * Register all actions
 *
 * @package    Dot
 * @subpackage Dot\Includes\WordPress
 */

class Control extends Customizer {

    /**
     * @access   protected
     * @var      object    $handler    WP Customizer handler
     */
    protected $handler;

    /**
     * Color Handler
     * @param   object      $wp_customize       WP Customize
     * @param   string      $ID                 Customize ID
     * @param   array      $args               Customize arguments
     */
    public function createColor($wp_customize, $ID, $args){
        return new \WP_Customize_Color_Control( $wp_customize, $ID, $args );
    }

    /**
     * Build
     * @return  void
     */
    public function build($wp_customize){
        if($this->handler) {
            $wp_customize->add_control( $this->handler );
        }
        else $wp_customize->add_control($this->ID, $this->args);
    }

    /**
     * @return object
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param object $handler
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;
    }

}