<?php

namespace BingoPress;

!defined( 'WPINC ' ) or die;

/**
 * Helper library for BingoPress theme
 *
 * @package    BingoPress
 * @subpackage BingoPress\Includes
 */

use BingoPress\View;

class Form {

    /**
     * Option Container
     * @param string $type  Container path type
     * @param array $label  Container label config
     * @param object $content  HTML Content Object
     */
    public function container($type, $content, $args = array()){
        View::RenderStatic(
            sprintf( 'Template/form/container/%s', $type ),
            compact('content', 'args')
        );
    }

    /** Render DOM HTML Element */
    public function heading($text, $args = array()){
        View::RenderStatic(
            'Template/form/html/heading',
            compact('text', 'args')
        );
    }

    /** Render DOM HTML Element */
    public function select($name, $options = array(), $args = array()){
        View::RenderStatic(
            'Template/form/html/select',
            compact('name', 'options', 'args')
        );
    }

    /** Render DOM HTML Element */
    public function number($name, $args = array()){
        View::RenderStatic(
            'Template/form/html/number',
            compact('name', 'args')
        );
    }

    /** Render DOM HTML Element */
    public function switch($name, $args = array()){
        View::RenderStatic(
            'Template/form/html/switch',
            compact('name', 'args')
        );
    }

    /** Render DOM HTML Element */
    public function text($name, $args = array()){
        View::RenderStatic(
            'Template/form/html/text',
            compact('name', 'args')
        );
    }

}