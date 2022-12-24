<?php

namespace Dot\WordPress\Helper;

!defined( 'WPINC ' ) or die;

/**
 * Add extra layer for WordPress functions
 *
 * @package    Dot
 * @subpackage Dot\WordPress
 */

trait Shortcode {

    /**
     * Search content for shortcodes and filter shortcodes through their hooks.
     * @var     string      $content        Content to search for shortcodes.
     * @var     bool        $ignore_html    When true, shortcodes inside HTML elements will be skipped.
     */
    public function do_shortcode($content, $ignore_html = false){
        return do_shortcode($content, $ignore_html);
    }

    /**
     * WordPress shortcode_atts
     * @var     array   $pairs              Entire list of supported attributes and their defaults.
     * @var     array   $atts               User defined attributes in shortcode tag.
     * @var     string   $shortcode         The name of the shortcode, provided for context to enable filtering
     * @return array    Combined and filtered attribute list.
     */
    public function shortcode_atts($pairs, $atts, $shortcode = ''){
        return shortcode_atts($pairs, $atts, $shortcode);
    }

}