<?php

namespace Dot\WordPress\Hook;

!defined( 'WPINC ' ) or die;

/**
 * Abstract class for hook
 *
 * @package    Dot
 * @subpackage Dot\Includes\WordPress
 */

class Filter extends Hook {

    /**
     * Run hook
     * @return  void
     */
    public function run(){
        add_filter(
            $this->hook,
            array( $this->component, $this->callback ),
            $this->priority,
            $this->accepted_args
        );
    }

}