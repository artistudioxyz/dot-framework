<?php

namespace Dot;

!defined('WPINC ') || die();

/**
 * Initiate theme
 *
 * @package    Dot
 * @subpackage Dot\Includes
 */

class Theme
{
	/**
	 * @var     Theme  $instance   Hold instance
	 */
	private static $instance = null;

	/**
	 * Theme name
	 *
	 * @var     string
	 */
	protected $name;

	/**
	 * Theme slug
	 *
	 * @var     string
	 */
	protected $slug;

	/**
	 * Theme version
	 *
	 * @var     string
	 */
	protected $version;

	/**
	 * Theme stage (true = production, false = development)
	 *
	 * @var     boolean
	 */
	protected $production;

	/**
	 * Enable/Disable theme hook (Action, Filter, Shortcode)
	 *
	 * @var     array   ['action', 'filter', 'shortcode']
	 */
	protected $enableHooks;

	/**
	 * Theme path
	 *
	 * @var     array
	 */
	protected $path;

	/**
	 * Lists of theme apis
	 *
	 * @var     array
	 */
	protected $apis;

	/**
	 * Lists of theme controllers
	 *
	 * @var     array
	 */
	protected $controllers;

	/**
	 * Lists of theme features
	 *
	 * @var     array
	 */
	protected $features;

	/**
	 * Lists of theme models
	 *
	 * @var     array
	 */
	protected $models;

	/**
	 * Theme configuration
	 *
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
	 * @var      object    $form  Form object for controller
	 */
	protected $Form;

	/**
	 * @access   protected
	 * @var      object    $helper  Helper object for controller
	 */
	protected $WP;

	/**
	 * Define the core functionality of the theme.
	 *
	 * @param   array $path     WordPress theme path
	 * @return void
	 */
	public function __construct()
	{
		/** Initiate Theme */
		$this->config = $this->getThemeConfig();
		$this->name = $this->config->name;
		$this->slug = strtolower($this->config->name);
		$this->slug = str_replace(' ', '-', $this->slug);
		$this->version = $this->config->version;
		$this->production = $this->config->production;
		$this->enableHooks = $this->config->enableHooks;
		$this->controllers = [];
		$this->features = [];
		$this->models = [];
		$this->Helper = new Helper();
		$this->Form = new Form();
		$this->WP = new \Dot\WordPress\Helper();
		/** Init Config */
		$this->config->path = explode('/', dirname(__DIR__, 1));
		$this->config->path =
			implode('/', $this->config->path) .
			'/' .
			end($this->config->path) .
			'.php';
		$this->config->options = $this->WP->get_option('dot_config');
		$this->config->options = $this->config->options
			? $this->config->options
			: new \stdClass();
		$this->path = $this->generatePath($this->config->path);
	}

	/**
	 * Get Theme Config
	 */
	public function getThemeConfig()
	{
		$config = dirname(__DIR__, 1);
		$config = file_get_contents($config . '/config.json');
		$config = json_decode($config);
		return $config;
	}

	/**
	 * Run the theme
	 * - Load theme model
	 * - Load theme API
	 * - Load theme controller
	 *
	 * @return  void
	 */
	public function run()
	{
		$this->Helper->defineConst($this);
		$this->loadFeatures();
		$this->loadHooks('Controller');
		$this->loadHooks('Api');
		//        $this->loadModulesHooks();
		$this->setDefaultOption();
	}

	/**
	 * Lifecycle Activate the theme
	 *
	 * @return  void
	 */
	public function activate()
	{
		$this->setDefaultOption();
	}

	/**
	 * Load registered hooks in a controller
	 *
	 * @return  void
	 * @pattern bridge
	 */
	private function loadFeatures()
	{
		$features = $this->Helper->getDirFiles(
			$this->path['framework_path'] . 'src/Feature'
		);
		$allow = ['.', '..', '.DS_Store', 'index.php'];
		foreach ($features as $feature) {
			if (in_array(basename($feature), $allow)) {
				continue;
			}
			$name = basename($feature, '.php');
			$feature = '\\Dot\\Feature\\' . $name;
			$feature = new $feature($this);
			$this->features[$feature->getKey()] = $feature;
			if (method_exists($feature, 'loadHooks')) {
				foreach ($feature->getHooks() as $hook) {
					$hook->run();
				}
			}
		}
		ksort($this->features);
	}

	/**
	 * Load Modules Hook
	 */
	public function loadModulesHooks()
	{
		$modules = [];
		$allow = ['.', '..', '.DS_Store', 'index.php'];
		foreach (
			$this->Helper->getDirFiles(
				$this->path['framework_path'] . 'src/Helper/DotModule'
			)
			as $module
		) {
			if (in_array(basename($module), $allow)) {
				continue;
			}
			$name = basename($module, '.php');
			$class = '\\Dot\\Module\\' . $name;
			if (method_exists($class, 'loadHooks')) {
				$modules[$name] = new $class();
				foreach ($modules[$name]->getHooks() as $hook) {
					$hook->run();
				}
			}
		}
	}

	/**
	 * Get Dot Modules
	 */
	public function getModules()
	{
		$modules = [];
		$allow = ['.', '..', '.DS_Store', 'index.php'];
		foreach (
			$this->Helper->getDirFiles(
				$this->path['framework_path'] . 'src/Helper/DotModule'
			)
			as $module
		) {
			if (in_array(basename($module), $allow)) {
				continue;
			}
			$name = basename($module, '.php');
			$class = '\\Dot\\Module\\' . $name;
			$modules[$name] = new $class();
		}
		return $modules;
	}

	/**
	 * Load registered hooks in a controller
	 *
	 * @return  void
	 * @var     string  $dir   theme hooks directory (API, Controller)
	 * @pattern bridge
	 */
	private function loadHooks($dir)
	{
		$controllers = $this->Helper->getDirFiles(
			$this->path['framework_path'] . 'src/' . $dir
		);
		$allow = ['.', '..', '.DS_Store', 'index.php'];
		foreach ($controllers as $controller) {
			if (in_array(basename($controller), $allow)) {
				continue;
			}
			$name = basename($controller, '.php');
			$controller = '\\Dot\\' . ucwords($dir) . '\\' . $name;
			$controller = new $controller($this);
			if ($dir === 'Controller') {
				$this->controllers[$name] = $controller;
			}
			if ($dir === 'Api') {
				$this->apis[$name] = $controller;
			}
			foreach ($controller->getHooks() as $hook) {
				$class = str_replace('Dot\\WordPress\\Hook\\', '', get_class($hook));
				if (in_array(strtolower($class), $this->enableHooks)) {
					$namespace = (new \ReflectionClass(
						$hook->getComponent()
					))->getNamespaceName();
					$namespaceKey = str_replace('\\', '_', strtolower($namespace));
					$hookName = preg_replace(
						'/[^A-Za-z0-9_]/',
						'',
						strtolower($hook->getHook())
					);
					$callbackName = preg_replace(
						'/[^A-Za-z0-9_]/',
						'',
						strtolower($hook->getCallback())
					);
					$key = sprintf(
						'hooks_%s_%s_%s_%s',
						$namespaceKey,
						strtolower($name),
						$hookName,
						$callbackName
					);
					$status = isset($this->config->options->dot_hooks->$key)
						? $this->config->options->dot_hooks->$key
						: $hook->isStatus(); // Option Exists
					$status = $status === 'true' || $status == '1' ? true : false; // Grab option status
					if ($status == false && !$hook->isMandatory()) {
						continue; // Check theme isMandatory
					}
					if (!$this->Helper->isPremiumPlan() && $hook->isPremium()) {
						continue; // Check theme isPremiumPlan
					}
					$hook->run();
				}
			}
		}
	}

	/**
	 * Get instance
	 *
	 * @return $this
	 */
	public static function getInstance()
	{
		if (self::$instance == null) {
			self::$instance = new Theme();
		}
		return self::$instance;
	}

	/**
	 * Set default config
	 *
	 * @return void
	 */
	public function setDefaultOption()
	{
		$config = (array) $this->config->options;
		if (empty($config) || !$config) {
			$config = $this->Helper->ArrayMergeRecursive(
				(array) $this->config->default,
				(array) $this->config->options
			);
			$this->WP->update_option('dot_config', (object) $config);
			$this->config->options = (object) $config;
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
	public function getSlug()
	{
		return $this->slug;
	}

	/**
	 * @param string $slug
	 */
	public function setSlug($slug): void
	{
		$this->slug = $slug;
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
	public function getConfig()
	{
		return $this->config;
	}

	/**
	 * @param object $config
	 */
	public function setConfig($config): void
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
	public function getForm(): Form
	{
		return $this->Form;
	}

	/**
	 * @param object $Form
	 */
	public function setForm(Form $Form): void
	{
		$this->Form = $Form;
	}

	/**
	 * @return object
	 */
	public function getWP(): WordPress\Helper\Helper
	{
		return $this->WP;
	}

	/**
	 * @param object $WP
	 */
	public function setWP(WordPress\Helper\Helper $WP): void
	{
		$this->WP = $WP;
	}

	/**
	 * WordPress path function
	 */
	public function generatePath($path)
	{
		if (!function_exists('get_home_path')) {
			require ABSPATH . '/wp-admin/includes/file.php';
		}
		$path = [
			'path' => $path,
			'home_path' => get_home_path(),
			'home_url' => get_home_url(),
			'admin_url' => admin_url(),
			'framework_path' => trailingslashit(get_template_directory($path)),
			'framework_url' => trailingslashit(get_template_directory_uri($path)),
			'upload_dir' => wp_upload_dir(),
			'ajax_url' => get_home_url() . '/wp-admin/admin-ajax.php',
		];
		$path['view_path'] = $path['framework_path'] . 'src/View/';
		return $path;
	}
}
