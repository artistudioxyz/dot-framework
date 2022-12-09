<?php

namespace Dot\Controller;

!defined( 'WPINC ' ) or die;

/**
 * Initiate plugins
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
     * @return void
     * @param    object   $plugin     Plugin configuration
     * @pattern prototype
     */
    public function __construct($plugin){
        $this->Plugin = $plugin;
        $this->Helper = $plugin->getHelper();
        $this->WP = $plugin->getWP();
        $this->hooks = [];
    }

    /**
     * Overloading Method, for multiple arguments
     * @method  loadModel           _ Load model @var string name
     * @method  loadController      _ Load controller @var string name
     */
    public function __call($method, $arguments){
        if(in_array($method, ['loadModel', 'loadController'])){
            $list = ($method=='loadModel') ? $this->Plugin->getModels() : [];
            $list = ($method=='loadController') ? $this->Plugin->getControllers() : $list;
            if(count($arguments)==1) $this->{$arguments[0]} = $list[$arguments[0]];
            if(count($arguments)==2) $this->{$arguments[0]} = $list[$arguments[1]];
        }
    }

    /**
     * Validate $_POST Params
     * @var     array   $_POST      $_POST parameters
     * @var     array   $default    Default value config
     * @return  bool    Validation result
     */
    public function validateParams($params, $default, $validated = true){
        foreach($default as $index => $key){
            if(!isset($params[$key]) && !is_array($key)){ $validated = false; break; }
            if(is_array($key)) $validated = $this->validateParams($params[$index], $key, $validated);
        }
        return $validated;
    }

    /**
     * Sanitize $_POST Params
     * @var     array   Field sanitize params
     * @var     array   $post      $_POST parameters
     * @var     array   $get       $_GET parameters
     * @return  bool    Validation result
     */
    public function sanitizeParams($params, $default, $results = []){
        foreach($default as $key => $type){
            $results[$key] = (isset($params[$key])) ? $params[$key] : '';
            if(is_array($results[$key])) $results[$key] = $this->sanitizeParams($results[$key], $default[$key], []);
            else $results[$key] = $this->WP->Validate->sanitize($type, $results[$key]);
        }
        return $results;
    }

    /**
     * @return array
     */
    public function getHooks()
    {
        return $this->hooks;
    }

    /**
     * @param array $hooks
     */
    public function setHooks($hooks)
    {
        $this->hooks = $hooks;
    }

}