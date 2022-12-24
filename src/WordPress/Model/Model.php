<?php

namespace Dot\WordPress\Model;

! defined( 'WPINC ' ) || die;

/**
 * Abstract class for WordPress model
 *
 * @package    Dot
 * @subpackage Dot\Includes\WordPress
 */

abstract class Model {

	/**
	 * @access   protected
	 * @var      string    $name    The name of post_type
	 */
	protected $name;

	/**
	 * @access   protected
	 * @var      array    $args    Post type args
	 */
	protected $args;

	/**
	 * Method to build model
	 *
	 * @return  void
	 */
	abstract function build();

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * @return array
	 */
	public function getArgs() {
		return $this->args;
	}

	/**
	 * @param array $args
	 */
	public function setArgs( $args ) {
		$this->args = $args;
	}

}
