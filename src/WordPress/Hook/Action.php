<?php

namespace BingoPress\WordPress\Hook;

!defined( 'WPINC ' ) or die;

/**
 * Register all actions
 *
 * @package    BingoPress
 * @subpackage BingoPress\Includes\WordPress
 */

class Action extends Hook {

    /**
     * Run hook
     * @return  void
     */
    public function run(){
        add_action(
            $this->hook,
            array( $this->component, $this->callback ),
            $this->priority,
            $this->accepted_args
        );
    }

}