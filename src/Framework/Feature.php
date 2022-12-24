<?php

namespace BingoPress\Feature;

! defined( 'WPINC ' ) or die;

/**
 * Initiate framework
 *
 * @package    BingoPress
 * @subpackage BingoPress\Includes
 */

class Feature {

	/**
	 * Feature key
	 *
	 * @var     string
	 */
	protected $key;

	/**
	 * Feature name
	 *
	 * @var     string
	 */
	protected $name;

	/**
	 * Feature description
	 *
	 * @var     string
	 */
	protected $description;

	/**
	 * Feature options
	 *
	 * @var     object
	 */
	protected $options;

	/**
	 * Feature params
	 *
	 * @var     object
	 */
	protected $params;

	/**
	 * Feature construect
	 *
	 * @return void
	 * @var    object   $theme     Feature configuration
	 * @pattern prototype
	 */
	public function __construct( \BingoPress\Theme $theme ) {
		$this->options            = (object) array();
		$this->params             = (object) array();
		$this->hide_on_production = false;
		$this->Theme             = $theme;
	}

	/**
	 * @return string
	 */
	public function getKey() {
		return $this->key;
	}

	/**
	 * @param string $key
	 */
	public function setKey( $key ) {
		$this->key = $key;
	}

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
	public function getOptions() {
		return $this->options;
	}

	/**
	 * @param object $options
	 */
	public function setOptions( $options ): void {
		$this->options = $options;
	}

	/**
	 * @return object
	 */
	public function getParams() {
		return $this->params;
	}

	/**
	 * @param object $params
	 */
	public function setParams( $params ): void {
		$this->params = $params;
	}

}
