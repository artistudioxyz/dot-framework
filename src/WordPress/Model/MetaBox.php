<?php

namespace Dot\WordPress\Model;

!defined( 'WPINC ' ) or die;

/**
 * Initiate framework
 *
 * @package    Dot
 * @subpackage Dot/Controller
 */

class MetaBox {

    /**
     * @access   protected
     * @var      string    $args    Unique id
     */
    protected $id;

    /**
     * @access   protected
     * @var      string    $title    Box title
     */
    protected $title;

    /**
     * @access   protected
     * @var      array    $callback  Content callback, must be of type callable
     */
    protected $callback;

    /**
     * @access   protected
     * @var      string    $screen  Post type
     */
    protected $screen;

    /**
     * @access   protected
     * @var      string    $context  The context within the screen where the boxes should display.
     */
    protected $context;

    /**
     * @access   protected
     * @var      string    $priority  The priority within the context where the boxes should show ('high', 'low')
     */
    protected $priority;

    /**
     * @access   protected
     * @var      string    $callback_args  Data that should be set as the $args property of the box array (which is the second parameter passed to your callback).
     */
    protected $callback_args;

    /**
     * Metabox constructor
     * @return void
     */
    public function __construct(){
        $this->screen = null;
        $this->context = 'advanced';
        $this->priority = 'default';
        $this->callback_args = null;
    }

    /**
     * Meta boxes are handy, flexible, modular edit screen elements that can be used to collect information related to the post being edited.
     * @backend
     * @return  void
     */
    public function build(){
        add_meta_box(
            $this->id,
            $this->title,
            $this->callback,
            $this->screen,
            $this->context,
            $this->priority,
            $this->callback_args
        );
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return array
     */
    public function getCallback(): array
    {
        return $this->callback;
    }

    /**
     * @param array $callback
     */
    public function setCallback(array $callback): void
    {
        $this->callback = $callback;
    }

    /**
     * @return string
     */
    public function getScreen(): string
    {
        return $this->screen;
    }

    /**
     * @param string $screen
     */
    public function setScreen(string $screen): void
    {
        $this->screen = $screen;
    }

    /**
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param string $context
     */
    public function setContext($context)
    {
        $this->context = $context;
    }

    /**
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param string $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return string
     */
    public function getCallbackArgs()
    {
        return $this->callback_args;
    }

    /**
     * @param string $callback_args
     */
    public function setCallbackArgs($callback_args)
    {
        $this->callback_args = $callback_args;
    }

}