<?php

namespace Dot\Model;

!defined( 'WPINC ' ) or die;

/**
 * Initiate framework
 *
 * @package    Dot
 * @subpackage Dot/Model
 */

use Dot\WordPress\Model\Type;

class Model extends Type {

    /**
     * Construct type
     * @return void
     * @var    object $theme Framework configuration
     * @pattern prototype
     */
    public function __construct($theme)
    {
        $this->name = substr(strrchr(get_called_class(), "\\"), 1);
        $this->name = strtolower($this->name);
        $this->Theme = $theme;
        $this->Helper = $theme->getHelper();
        $this->WP = $theme->getWP();
        $this->taxonomies = [];
        $this->hooks = [];
        $this->metas = [];
        $this->args = [];
        $this->args['public'] = true;
        $this->args['labels'] = ['name' => ucwords($this->name)];
    }

    /**
     * Overloading Method, for multiple arguments
     * @method  loadModel           _ Load model @var string name
     * @method  loadController      _ Load controller @var string name
     */
    public function __call($method, $arguments){
        if(in_array($method, ['loadModel', 'loadController'])){
            $list = ($method=='loadModel') ? $this->Theme->getModels() : [];
            $list = ($method=='loadController') ? $this->Theme->getControllers() : $list;
            if(count($arguments)==1) $this->{$arguments[0]} = $list[$arguments[0]];
            if(count($arguments)==2) $this->{$arguments[0]} = $list[$arguments[1]];
        }
    }

}