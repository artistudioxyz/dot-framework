<?php

namespace Dot\Wordpress\Helper;

!defined( 'WPINC ' ) or die;

/**
 * Add extra layer for wordpress functions
 *
 * @package    Dot
 * @subpackage Dot\Wordpress
 */

trait Template {

    /**
     * Wordpress esc function
     * @return mixed    Return sanitized values
     */
    public function esc($type, $value, $args = []){
        if($type=='html') return esc_html($value);
        elseif($type=='url') return esc_url($value);
        elseif($type=='attr') return esc_attr($value);
    }

    /**
     * Template functions
     * - have_posts - Whether current WordPress query has results to loop over.
     * - the_post - Iterate the post index in the loop.
     * - the_content - Display the post content.
     */
    public function have_posts(){ return have_posts(); }
    public function the_post(){ the_post(); }
    public function the_content(){ the_content(); }

}