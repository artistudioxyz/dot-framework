<?php

namespace Dot\Controller;

! defined( 'WPINC ' ) or die;

/**
 * Initiate framework
 *
 * @package    Dot
 * @subpackage Dot/Controller
 */

class Controller {

	/**
	 * @access   protected
	 * @var      array    $hook    Lists of hooks to register within controller
	 */
	protected $hooks;

	/**
	 * Admin constructor
	 *
	 * @return void
	 * @param    object $theme     Framework configuration
	 * @pattern prototype
	 */
	public function __construct( \Dot\Theme $theme ) {
		$this->Theme = $theme;
		$this->Helper = $theme->getHelper();
		$this->WP     = $theme->getWP();
		$this->hooks  = array();
	}

	/**
	 * Overloading Method, for multiple arguments
	 *
	 * @method  loadModel           _ Load model @var string name
	 * @method  loadController      _ Load controller @var string name
	 */
	public function __call( $method, $arguments ) {
		if ( in_array( $method, array( 'loadModel', 'loadController' ) ) ) {
			$list = ( $method == 'loadModel' ) ? $this->Theme->getModels() : array();
			$list = ( $method == 'loadController' ) ? $this->Theme->getControllers() : $list;
			if ( count( $arguments ) == 1 ) {
				$this->{$arguments[0]} = $list[ $arguments[0] ];
			}
			if ( count( $arguments ) == 2 ) {
				$this->{$arguments[0]} = $list[ $arguments[1] ];
			}
		}
	}

	/**
	 * @return array
	 */
	public function getHooks() {
		return $this->hooks;
	}

	/**
	 * @param array $hooks
	 */
	public function setHooks( $hooks ) {
		$this->hooks = $hooks;
	}

}
