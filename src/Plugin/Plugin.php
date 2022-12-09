<?php

namespace Dot;

!defined( 'WPINC ' ) or die;

/**
 * Initiate plugins
 *
 * @package    Dot
 * @subpackage Dot\Includes
 */

class Plugin {

    /**
     * Plugin name
     * @var     string
     */
    protected $name;

    /**
     * Plugin version
     * @var     string
     */
    protected $version;

    /**
     * Plugin stage (true = production, false = development)
     * @var     boolean
     */
    protected $production;

    /**
     * Enable/Disable plugins hook (Action, Filter, Shortcode)
     * @var     array   ['action', 'filter', 'shortcode']
     */
    protected $enableHooks;

    /**
     * Plugin path
     * @var     array
     */
    protected $path;

    /**
     * Lists of plugin apis
     * @var     array
     */
    protected $apis;

    /**
     * Lists of plugin controllers
     * @var     array
     */
    protected $controllers;

    /**
     * Lists of plugin features
     * @var     array
     */
    protected $features;

    /**
     * Lists of plugin models
     * @var     array
     */
    protected $models;

    /**
     * Plugin configuration
     * @var     object
     */
    protected $config;

    /**
     * @access   protected
     * @var      object    $helper  Helper object for controller
     */
    protected $Helper;

    /**
     * @access   protected
     * @var      object    $helper  Helper object for controller
     */
    protected $WP;

    /**
     * Define the core functionality of the plugin.
     *
     * @param   array   $path     Wordpress plugin path
     * @return void
     */
    public function __construct(){
        /** Initiate Plugin */
        $this->config = $this->getPluginConfig();
        $this->name = $this->config->name;
        $this->version = $this->config->version;
        $this->production = $this->config->production;
        $this->enableHooks = $this->config->enableHooks;
        $this->controllers = [];
        $this->features = [];
        $this->models = [];
        $this->Helper = new Helper();
        $this->WP = new \Dot\Wordpress\Helper();
        /** Init Config */
        $this->config->path = explode('/', dirname(__DIR__, 2));
        $this->config->path = implode('/', $this->config->path) . '/' . end($this->config->path) . '.php';
    }

    /**
     * Get Plugin Config
     */
    public function getPluginConfig(){
        $config = dirname(__DIR__, 2);
        $config = file_get_contents($config . '/config.json');
        $config = json_decode($config);
        return $config;
    }

    /**
     * Run the plugin
     * - Load plugin model
     * - Load plugin API
     * - Load plugin controller
     * @return  void
     */
    public function run(){
        $this->config->options = $this->WP->get_option('dot_config');
        $this->config->options = ($this->config->options) ? $this->config->options : new \stdClass();
        $this->path = $this->WP->getPath($this->config->path);
        $this->Helper->defineConst($this);
        $this->loadModels();
        $this->loadFeatures();
        $this->loadHooks('Controller');
        $this->loadHooks('Api');
    }

    /**
     * Activate the plugin
     * @return  void
     */
    public function activate(){
        /** Set Default Option */
        $config = (array) $this->config->default + (array) $this->WP->get_option('dot_config');
        $this->WP->update_option('dot_config', (object) $config);
    }

    /**
     * Load registered models
     * @return  void
     */
    public function loadModels(){
        $models = $this->Helper->getDirFiles($this->path['plugin_path'] . 'src/Model');
        $allow = ['.', '..','.DS_Store','index.php'];
        foreach($models as $model){
            if(in_array(basename($model), $allow)) continue;
            $name = basename( $model, '.php' );
            $model = '\\Dot\\Model\\'.$name;
            $model = new $model($this);
            /** Build */
            $args = $model->getArgs();
            $args['build'] = (isset($args['build'])) ? $args['build'] : true;
            if($args['build']) $model->build();
            /** Run Hooks */
            $this->models[$name] = $model;
            foreach($model->getHooks() as $hook){
                $class = str_replace( 'Dot\\Wordpress\\Hook\\' , '', get_class($hook) );
                if(in_array(strtolower($class), $this->enableHooks)) $hook->run();
            }
        }
    }

    /**
     * Load registered hooks in a controller
     * @return  void
     * @pattern bridge
     */
    private function loadFeatures(){
        $features = $this->Helper->getDirFiles($this->path['plugin_path'] . 'src/Feature');
        $allow = ['.', '..','.DS_Store','index.php'];
        foreach($features as $feature){
            if(in_array(basename($feature), $allow)) continue;
            $name = basename( $feature, '.php' );
            $feature = '\\Dot\\Feature\\'.$name;
            $feature = new $feature($this);
            $this->features[$feature->getKey()] = $feature;
        }
        ksort($this->features);
    }

    /**
     * Load registered hooks in a controller
     * @return  void
     * @var     string  $dir   plugin hooks directory (API, Controller)
     * @pattern bridge
     */
    private function loadHooks($dir){
        $controllers = $this->Helper->getDirFiles($this->path['plugin_path'] . 'src/' . $dir);
        $allow = ['.', '..','.DS_Store','index.php'];
        foreach($controllers as $controller){
            if(in_array(basename($controller), $allow)) continue;
            $name = basename( $controller, '.php' );
            $controller = '\\Dot\\'.ucwords($dir).'\\'.$name;
            $controller = new $controller($this);
            if($dir=='Controller') $this->controllers[$name] = $controller;
            if($dir=='Api') $this->apis[$name] = $controller;
            foreach($controller->getHooks() as $hook){
                $class = str_replace( 'Dot\\Wordpress\\Hook\\' , '', get_class($hook) );
                if(in_array(strtolower($class), $this->enableHooks)) {
                    $namespace = (new \ReflectionClass( $hook->getComponent() ))->getNamespaceName();
                    $namespaceKey = str_replace('\\','_', strtolower($namespace));
                    $hookName = preg_replace("/[^A-Za-z0-9_]/", '', strtolower($hook->getHook()) );
                    $callbackName = preg_replace("/[^A-Za-z0-9_]/", '', strtolower($hook->getCallback()) );
                    $key = sprintf('dot_hooks_%s_%s_%s_%s', $namespaceKey, strtolower($name), $hookName, $callbackName);
                    $status = (isset($this->config->options->$key)) ? $this->config->options->$key : $hook->isStatus(); // Option Exists
                    $status = ($status) ? true : false; // Grab option status
                    if($status==false && !$hook->isMandatory()) continue;
                    $hook->run();
                }
            }
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    /**
     * @return bool
     */
    public function isProduction(): bool
    {
        return $this->production;
    }

    /**
     * @param bool $production
     */
    public function setProduction(bool $production): void
    {
        $this->production = $production;
    }

    /**
     * @return array
     */
    public function getEnableHooks(): array
    {
        return $this->enableHooks;
    }

    /**
     * @param array $enableHooks
     */
    public function setEnableHooks(array $enableHooks): void
    {
        $this->enableHooks = $enableHooks;
    }

    /**
     * @return array
     */
    public function getPath(): array
    {
        return $this->path;
    }

    /**
     * @param array $path
     */
    public function setPath(array $path): void
    {
        $this->path = $path;
    }

    /**
     * @return array
     */
    public function getApis()
    {
        return $this->apis;
    }

    /**
     * @param array $apis
     */
    public function setApis($apis)
    {
        $this->apis = $apis;
    }

    /**
     * @return array
     */
    public function getControllers(): array
    {
        return $this->controllers;
    }

    /**
     * @param array $controllers
     */
    public function setControllers(array $controllers): void
    {
        $this->controllers = $controllers;
    }

    /**
     * @return array
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @param array $features
     */
    public function setFeatures($features)
    {
        $this->features = $features;
    }

    /**
     * @return array
     */
    public function getModels(): array
    {
        return $this->models;
    }

    /**
     * @param array $models
     */
    public function setModels(array $models): void
    {
        $this->models = $models;
    }

    /**
     * @return object
     */
    public function getConfig(): object
    {
        return $this->config;
    }

    /**
     * @param object $config
     */
    public function setConfig(object $config): void
    {
        $this->config = $config;
    }

    /**
     * @return object
     */
    public function getHelper()
    {
        return $this->Helper;
    }

    /**
     * @param object $Helper
     */
    public function setHelper($Helper)
    {
        $this->Helper = $Helper;
    }

    /**
     * @return object
     */
    public function getWP(): Wordpress\Helper
    {
        return $this->WP;
    }

    /**
     * @param object $WP
     */
    public function setWP(Wordpress\Helper $WP): void
    {
        $this->WP = $WP;
    }

}