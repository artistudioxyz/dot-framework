<?php

namespace Dot\Wordpress\Helper;

!defined( 'WPINC ' ) or die;

/**
 * Add extra layer for wordpress functions
 *
 * @package    Dot
 * @subpackage Dot\Wordpress
 */

trait Validate {

    /**
     * Wordpress sanitize script
     * @return mixed    Return sanitized values
     */
    public function sanitize($type, $value, $args = []){
        if($type=='key') return sanitize_key($value);
        elseif($type=='filename') return sanitize_file_name($value);
        elseif($type=='text' || $type=='int') return sanitize_text_field($value);
        elseif($type=='email') return sanitize_email($value);
        elseif($type=='html') {
            $value = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $value);
            return preg_replace('#<style(.*?)>(.*?)</style>#is', '', $value);
        }
    }

}