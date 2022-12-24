<?php

namespace Dot\WordPress\Page;

!defined( 'WPINC ' ) or die;

/**
 * Create custom page for wordpress
 *
 * @package    Dot
 * @subpackage Dot\Includes\WordPress
 */

abstract class Page {

    /**
     * @access   protected
     * @var      string    $page_title    The text to be displayed in the title tags of the page when the menu is selected.
     */
    protected $page_title;

    /**
     * @access   protected
     * @var      string    $menu_title    The text to be used for the menu.
     */
    protected $menu_title;

    /**
     * @access   protected
     * @var      string    $capability    The text to be used for the menu.
     */
    protected $capability;

    /**
     * @access   protected
     * @var      string    $menu_slug    The slug name to refer to this menu by.
     */
    protected $menu_slug;

    /**
     * @access   protected
     * @var      array    $function    The function to be called to output the content for this page.
     */
    protected $function;

    /**
     * @access   protected
     * @var      string    $position    	The position in the menu order this item should appear.
     */
    protected $position;

    /**
     * @access   protected
     * @var      object    $view    	View object to load
     */
    protected $view;

    /**
     * Page constructor
     * @return void
     */
    public function __construct()
    {
        $this->position = null;
        $this->function = [$this, 'loadView'];
    }

    /**
     * Method to build page
     * @return void
     */
    public abstract function build();

    /**
     * Load page view
     * @return void
     */
    public function loadView(){
        $this->view->setPage($this);
        $this->view->build();
    }

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->page_title;
    }

    /**
     * @param string $page_title
     */
    public function setPageTitle($page_title)
    {
        $this->page_title = $page_title;
    }

    /**
     * @return string
     */
    public function getMenuTitle()
    {
        return $this->menu_title;
    }

    /**
     * @param string $menu_title
     */
    public function setMenuTitle($menu_title)
    {
        $this->menu_title = $menu_title;
    }

    /**
     * @return string
     */
    public function getCapability()
    {
        return $this->capability;
    }

    /**
     * @param string $capability
     */
    public function setCapability($capability)
    {
        $this->capability = $capability;
    }

    /**
     * @return string
     */
    public function getMenuSlug()
    {
        return $this->menu_slug;
    }

    /**
     * @param string $menu_slug
     */
    public function setMenuSlug($menu_slug)
    {
        $this->menu_slug = $menu_slug;
    }

    /**
     * @return array
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * @param array $function
     */
    public function setFunction($function)
    {
        $this->function = $function;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return object
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param object $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

}