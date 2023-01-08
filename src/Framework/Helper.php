<?php

namespace Dot;

!defined('WPINC ') or die();

/**
 * Helper library for Dot framework
 *
 * @package    Dot
 * @subpackage Dot\Includes
 */

class Helper
{
	/** Load Trait */
	use Helper\File;
	use Helper\Directory;
	use Helper\Text;
	use Helper\Option;
	use Helper\Plan;

	/**
	 * Define const which will be used within the framework
	 * @param   object   $theme     WordPress theme object
	 * @return void
	 */
	public function defineConst($theme)
	{
		define('DOT_NAME', $theme->getName());
		define('DOT_VERSION', $theme->getVersion());
		define('DOT_PRODUCTION', $theme->isProduction());
		define('DOT_PATH', json_encode($theme->getPath()));
	}

	/**
	 * Convert html relative path into absolute path
	 * @var     string  $path   WordPress base path
	 * @var     string  $html   Html string
	 * @return  void
	 */
	public function convertImagesRelativetoAbsolutePath($path, $html)
	{
		$pattern = '/<img([^>]*) ' . "src=\"([^http|ftp|https][^\"]*)\"/";
		$replace = "<img\${1} src=\"" . $path . "\${2}\"";
		return preg_replace($pattern, $replace, $html);
	}

	/**
	 * Extract templates from config files
	 * @var     array   $config         Lists of config templates
	 * @var     array   $templates      Lists of templates, to return
	 */
	public function getTemplatesFromConfig($config, $templates = [])
	{
		foreach ($config as $template) {
			foreach ($template->children as $children) {
				$templates[$children->id] = $children;
			}
		}
		return $templates;
	}
}
