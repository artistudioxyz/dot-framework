<?php

namespace Dot\WordPress\Model;

use Dot\WordPress\Hook\Action;

!defined('WPINC ') or die();

/**
 * Abstract class for WordPress model
 *
 * @package    Dot
 * @subpackage Dot\Includes\WordPress
 */

class Type extends Model
{
	/**
	 * @access   protected
	 * @var      int    $ID    Post ID
	 */
	protected $ID;

	/**
	 * @access   protected
	 * @var      array    $metas    Lists of post type metas
	 */
	protected $metas;

	/**
	 * @access   protected
	 * @var      array    $taxonomies    Taxonomies array trees
	 */
	protected $taxonomies;

	/**
	 * @access   protected
	 * @var      array    $hooks    Lists of hooks to register within model
	 */
	protected $hooks;

	/**
	 * Metadata constructor
	 */
	public function __construct($framework)
	{
		$this->WP = new \Dot\WordPress\Helper();
		$this->Framework = $framework;
	}

	/**
	 * Retrieves post data given a post ID or post object.
	 * @param     int|object      Post ID or post object. Defaults to global $post
	 * @param     string          The required return type. One of OBJECT, ARRAY_A, or ARRAY_N
	 * @param     filter          Type of filter to apply. Accepts 'raw', 'edit', 'db', or 'display'
	 * @return  object          Post Type object
	 */
	public function get_post($output = OBJECT, $filter = 'raw')
	{
		return $this->WP->get_post($this->ID, $output, $filter);
	}

	/**
	 * Get Post Type
	 * @return object   Post Type object
	 */
	public function get_posts()
	{
		if ($this->name) {
			$this->args['post_type'] = $this->name;
		}
		return $this->WP->get_posts($this->args);
	}

	/**
	 * Insert new post
	 * @return int      The post ID on success
	 */
	public function insert_post()
	{
		if ($this->name) {
			$this->args['post_type'] = $this->name;
		}
		return $this->WP->wp_insert_post($this->args);
	}

	/**
	 * Method to model
	 * @return void
	 */
	public function build()
	{
		/** Load Models */
		$action = new Action($this->Framework);
		$action->setComponent($this);
		$action->setHook('init');
		$action->setCallback('build_callback');
		$action->setMandatory(true);
		$action->setAcceptedArgs(0);
		$this->hooks[] = $action;
	}

	/**
	 * Build Callback
	 */
	public function build_callback()
	{
		$this->args['taxonomies'] = array_keys($this->taxonomies);
		register_post_type($this->name, $this->args);
		foreach ($this->taxonomies as $taxonomy) {
			$taxonomy->setType($this);
			$taxonomy->build();
		}
	}

	/**
	 * @return int
	 */
	public function getID(): int
	{
		return $this->ID;
	}

	/**
	 * @param int $ID
	 */
	public function setID(int $ID): void
	{
		$this->ID = $ID;
	}

	/**
	 * @return array
	 */
	public function getMetas(): array
	{
		return $this->metas;
	}

	/**
	 * @param array $metas
	 */
	public function setMetas(array $metas): void
	{
		$this->metas = $metas;
	}

	/**
	 * @return array
	 */
	public function getTaxonomies(): array
	{
		return $this->taxonomies;
	}

	/**
	 * @param array $taxonomies
	 */
	public function setTaxonomies(array $taxonomies): void
	{
		$this->taxonomies = $taxonomies;
	}

	/**
	 * @return array
	 */
	public function getHooks(): array
	{
		return $this->hooks;
	}

	/**
	 * @param array $hooks
	 */
	public function setHooks(array $hooks): void
	{
		$this->hooks = $hooks;
	}
}
