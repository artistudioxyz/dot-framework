<?php

namespace Dot\Wordpress\Model;

!defined( 'WPINC ' ) or die;

/**
 * Abstract class for wordpress model
 *
 * @package    Dot
 * @subpackage Dot\Includes\Wordpress
 */

use Dot\Wordpress\Service\Model as ServiceModel;

class Type extends Model {

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
    public function __construct(){
        $this->ServiceModel = new ServiceModel();
    }

    /**
     * Retrieves post data given a post ID or post object.
     * @param     int|object      Post ID or post object. Defaults to global $post
     * @param     string          The required return type. One of OBJECT, ARRAY_A, or ARRAY_N
     * @param     filter          Type of filter to apply. Accepts 'raw', 'edit', 'db', or 'display'
     * @return  object          Post Type object
     */
    public function get_post($output = OBJECT, $filter = 'raw'){
        return $this->ServiceModel->get_post($this->ID, $output, $filter);
    }

    /**
     * Get Post Type
     * @return object   Post Type object
     */
    public function get_posts(){
        if($this->name) $this->args['post_type'] = $this->name;
        return $this->ServiceModel->get_posts($this->args);
    }

    /**
     * Insert new post
     * @return int      The post ID on success
     */
    public function insert_post(){
        if($this->name) $this->args['post_type'] = $this->name;
        return $this->ServiceModel->wp_insert_post($this->args);
    }

    /**
     * Method to model
     * @return void
     */
    public function build(){
        $this->args['taxonomies'] = array_keys($this->taxonomies);
        $this->ServiceModel->register_post_type($this->name, $this->args);
        foreach($this->taxonomies as $taxonomy){
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