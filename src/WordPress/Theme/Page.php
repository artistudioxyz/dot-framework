<?php

namespace BingoPress\WordPress\Theme;

use BingoPress\WordPress\Page as AbstractPage;

!defined( 'WPINC ' ) or die;

/**
 * Create custom page for WordPress
 *
 * @package    BingoPress
 * @subpackage BingoPress\Includes\WordPress
 */

class Page extends AbstractPage {

    /**
     * Method to build page
     * @return void
     */
    public function build(){
        add_theme_page(
            $this->page_title,
            $this->menu_title,
            $this->capability,
            $this->menu_slug,
            $this->function,
            $this->position
        );
    }

}