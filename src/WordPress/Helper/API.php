<?php

namespace Dot\WordPress\Helper;

!defined( 'WPINC ' ) or die;

/**
 * Add extra layer for WordPress functions
 *
 * @package    Dot
 * @subpackage Dot\WordPress
 */

trait API {

    /**
     * WordPress - Send a JSON response back to an Ajax request.
     * @var     mixed       $response   Variable (usually an array or object) to encode as JSON, then print and die.
     * @var     int       $status_code   The HTTP status code to output.
     * @return  void
     */
    public function wp_send_json($response, $status_code = null){ wp_send_json($response, $status_code); }

    /**
     * WordPress - Load wp_editor
     * @var     string      $content    Html content string to be edited
     * @var     string      $id         WP_Editor id
     * @return  string                  Generated html consist of wp_editor
     */
    public function ajax_wp_editor($content, $id){
        ob_start();
        wp_editor( $content, $id, [] );
        $content = ob_get_clean();
        $content .= \_WP_Editors::enqueue_scripts();
        $content .= print_footer_scripts();
        $content .= \_WP_Editors::editor_js();
        return $content;
    }

}