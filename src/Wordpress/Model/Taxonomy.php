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

class Taxonomy extends Model {

    /**
     * @access   protected
     * @var      array    $type    Post type for taxonomies
     */
    protected $type;

    /**
     * Metadata constructor
     */
    public function __construct(){
        $this->ServiceModel = new ServiceModel();
    }

    /**
     * Method to model
     * @return void
     */
    public function build(){
        $this->ServiceModel->register_taxonomy($this->name, $this->type->getName() , $this->args);
    }

    /**
     * @return array
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param array $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

}