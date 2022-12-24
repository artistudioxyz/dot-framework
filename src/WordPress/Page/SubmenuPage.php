<?php

namespace Dot\WordPress\Page;

!defined( 'WPINC ' ) or die;

/**
 * Create custom page for wordpress
 *
 * @package    Dot
 * @subpackage Dot\Includes\WordPress
 */

class SubmenuPage extends Page {

    /**
     * @access   protected
     * @var      string    $parent_slug    	The slug name for the parent menu (or the file name of a standard WordPress admin page).
     */
    protected $parent_slug;

    /**
     * @return string
     */
    public function getParentSlug()
    {
        return $this->parent_slug;
    }

    /**
     * @param string $parent_slug
     */
    public function setParentSlug($parent_slug)
    {
        $this->parent_slug = $parent_slug;
    }

    /**
     * Method to build page
     * @return void
     */
    public function build(){
        add_submenu_page(
            $this->parent_slug,
            $this->page_title,
            $this->menu_title,
            $this->capability,
            $this->menu_slug,
            $this->function,
            $this->position
        );
    }

}