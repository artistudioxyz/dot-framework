<?php

namespace Dot;

!defined( 'WPINC ' ) or die;

/**
 * Helper library for Dot plugins
 *
 * @package    Dot
 * @subpackage Dot\Includes
 */

class Helper {

    /** Load Trait */
    use Helper\Html;
    use Helper\Directory;
    use Helper\Text;

    /**
     * Debug script
     * @return void
     */
    public function debug($data){
        echo '<pre>'; var_dump($data);
    }

    /**
     * Define const which will be used within the plugin
     * @param   object   $plugin     Wordpress plugin object
     * @return void
     */
    public function defineConst($plugin){
        define('DOT_NAME', $plugin->getName());
        define('DOT_VERSION', $plugin->getVersion());
        define('DOT_PRODUCTION', $plugin->isProduction());
        define('DOT_PATH', json_encode( $plugin->getPath() ));
    }

    /**
     * Convert html relative path into absolute path
     * @var     string  $path   Wordpress base path
     * @var     string  $html   Html string
     * @return  void
     */
    public function convertImagesRelativetoAbsolutePath($path, $html){
        $pattern = "/<img([^>]*) " .
            "src=\"([^http|ftp|https][^\"]*)\"/";
        $replace = "<img\${1} src=\"" . $path . "\${2}\"";
        return preg_replace($pattern, $replace, $html);
    }

    /**
     * Extract templates from config files
     * @var     array   $config         Lists of config templates
     * @var     array   $templates      Lists of templates, to return
     */
    public function getTemplatesFromConfig($config, $templates = []){
        foreach($config as $template){
            foreach($template->children as $children){
                $templates[$children->id] = $children;
            }
        }
        return $templates;
    }

}