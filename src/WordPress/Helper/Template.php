<?php

namespace Dot\WordPress\Helper;

!defined( 'WPINC ' ) or die;

/**
 * Add extra layer for WordPress functions
 *
 * @package    Dot
 * @subpackage Dot\WordPress
 */

trait Template {

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