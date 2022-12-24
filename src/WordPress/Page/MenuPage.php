<?php

namespace Dot\WordPress\Page;

!defined( 'WPINC ' ) or die;

/**
 * Create custom page for wordpress
 *
 * @package    Dot
 * @subpackage Dot\Includes\WordPress
 */

class MenuPage extends Page {

    /**
     * @access   protected
     * @var      string    $icon_url    	The URL to the icon to be used for this menu.
     */
    protected $icon_url;

    /**
     * @return string
     */
    public function getIconUrl()
    {
        return $this->icon_url;
    }

    /**
     * @param string $icon_url
     */
    public function setIconUrl($icon_url)
    {
        $this->icon_url = $icon_url;
    }

    /**
     * Method to build page
     * @return void
     */
    public function build(){
        add_menu_page(
            $this->page_title,
            $this->menu_title,
            $this->capability,
            $this->menu_slug,
            $this->function,
            $this->icon_url,
            $this->position
        );
    }

}