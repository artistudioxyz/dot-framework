<?php

namespace Dot\WordPress\Hook;

! defined( 'WPINC ' ) || die;

/**
 * WordPress parent hook for (Action, Filter, and Shortcode)
 *
 * @package    Dot
 * @subpackage Dot\Includes\WordPress
 */

abstract class Hook {

	/**
	 * @access   protected
	 * @var      array    $hook    The name of the WordPress hook that is being registered.
	 */
	protected $hook;

	/**
	 * @access   protected
	 * @var      array    $component    A reference to the instance of the object on which the hook is defined.
	 */
	protected $component;

	/**
	 * @access   protected
	 * @var      array    $callback    The name of the function definition on the $component.
	 */
	protected $callback;

	/**
	 * @access   protected
	 * @var      array    $priority    The priority at which the function should be fired.
	 */
	protected $priority;

	/**
	 * @access   protected
	 * @var      array    $accepted_args    The number of arguments that should be passed to the $callback.
	 */
	protected $accepted_args;

	/**
	 * @access   protected
	 * @var      bool    $status    Hook status active or not
	 */
	protected $status;

	/**
	 * @access   protected
	 * @var      bool    $mandatory    Hook mandatory requirement
	 */
	protected $mandatory;

	/**
	 * @access   protected
	 * @var      string    $description    Hook description
	 */
	protected $description;

	/**
	 * @access   protected
	 * @var      object    $feature    Hook Feature
	 */
	protected $feature;

	/**
	 * @access   protected
	 * @var      bool    $premium    Premium Feature
	 */
	protected $premium;

	/**
	 * Hook constructor
	 *
	 * @return void
	 */
	public function __construct() {
		$this->status        = true;
		$this->premium       = false;
		$this->mandatory     = false;
		$this->priority      = 10;
		$this->accepted_args = 0;
		$this->description   = '';
	}

	/**
	 * Method to run hook
	 *
	 * @return  void
	 */
	abstract function run();

	/**
	 * @return string
	 */
	public function getHook() {
		return $this->hook;
	}

	/**
	 * @param string $hook
	 */
	public function setHook( $hook ) {
		$this->hook = $hook;
	}

	/**
	 * @return object
	 */
	public function getComponent() {
		return $this->component;
	}

	/**
	 * @param object $component
	 */
	public function setComponent( $component ) {
		$this->component = $component;
	}

	/**
	 * @return string
	 */
	public function getCallback() {
		return $this->callback;
	}

	/**
	 * @param string $callback
	 */
	public function setCallback( $callback ) {
		$this->callback = $callback;
	}

	/**
	 * @return int
	 */
	public function getPriority() {
		return $this->priority;
	}

	/**
	 * @param int $priority
	 */
	public function setPriority( $priority ) {
		$this->priority = $priority;
	}

	/**
	 * @return int
	 */
	public function getAcceptedArgs() {
		return $this->accepted_args;
	}

	/**
	 * @param int $accepted_args
	 */
	public function setAcceptedArgs( $accepted_args ) {
		$this->accepted_args = $accepted_args;
	}

	/**
	 * @return bool
	 */
	public function isMandatory() {
		return $this->mandatory;
	}

	/**
	 * @param bool $mandatory
	 */
	public function setMandatory( $mandatory ) {
		$this->mandatory = $mandatory;
	}

	/**
	 * @return bool
	 */
	public function isStatus() {
		return $this->status;
	}

	/**
	 * @param bool $status
	 */
	public function setStatus( $status ) {
		$this->status = $status;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param string $description
	 */
	public function setDescription( $description ) {
		$this->description = $description;
	}

	/**
	 * @return object
	 */
	public function getFeature() {
		return $this->feature;
	}

	/**
	 * @param object $feature
	 */
	public function setFeature( $feature ) {
		$this->feature = $feature;
	}

	/**
	 * @return bool
	 */
	public function isPremium(): bool {
		return $this->premium;
	}

	/**
	 * @param bool $premium
	 */
	public function setPremium( bool $premium ): void {
		$this->premium = $premium;
	}
}
