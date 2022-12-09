<?php

namespace Dot;

!defined( 'WPINC ' ) or die;

/**
 * Helper library for Triangle plugins
 *
 * @package    Dot
 * @subpackage Dot\Includes
 */

class View {

    /**
     * Provide page information page_title, menu_title, etc
     * @var     object  $Page   Page object where the view is located
     */
    protected $Page;

    /**
     * @var     object  $Helper   Helper object for view
     */
    protected $Helper;

    /**
     * @access   protected
     * @var      array    $sections    	Lists of view path callback to load
     */
    protected $sections;

    /**
     * @access   protected
     * @var      string    $template    	View template callback to load
     */
    protected $template;

    /**
     * View data send from the controller
     * @var     array   $data    View data
     */
    protected $data;

    /**
     * Enable/Disable (Shortcode, etc)
     * @var     array   $options    View options
     */
    protected $options;

    /**
     * View constructor
     * @return void
     */
    public function __construct($plugin = []){
        if($plugin){
            $this->Plugin = $plugin;
            $this->Helper = (method_exists($plugin, 'getHelper')) ? $plugin->getHelper() : '';
            $this->WP = (method_exists($plugin, 'getWP')) ? $plugin->getWP() : '';
        }
        $this->data = [];
        $this->options = [];
    }

    /**
     * View constructor
     * @return void
     */
    public function addData($data){
        foreach($data as $key => $value) $this->data[$key] = $value;
    }

    /**
     * Helper to load content
     * @backend
     * @return  content
     */
    public function loadContent($content, $args = []){
        ob_start();
        extract($this->data);
        $path = json_decode(DOT_PATH);
        require $path->view_path . str_replace('.','/',$content) . '.php';
        $content = ob_get_clean();
        if(isset($this->options['shortcode']) && $this->options['shortcode']) $content = do_shortcode($content);
        return $content;
    }

    /**
     * Helper to handle data logic within section loop
     * - Slugify
     * - Determine active tab
     * - Determine which content to load
     * - Convert url for url type sections
     */
    public function sectionLoopLogic($path, $section){
        $data = array();
        $data['slug'] = str_replace(' ','',strtolower($section['name']));
        $data['active'] = isset($section['active']) ? true : false;
        $data['content'] = (isset($section['link']) && !$data['active']) ? '' : $this->loadContent($path); /** Handle url sections type */
        $data['content'] = (isset($section['link']) && strpos($section['link'], '//') ) ? $section['link'] : $data['content']; /** Handle http:// link */
        if( isset($section['link']) && !strpos($section['link'], '//') ) {
            $data['url'] = $this->WP->Page->add_query_arg(NULL, NULL) . '&section=' . $section['link'];
            $data['url'] = json_decode(DOT_PATH)['home_url'] . $data['url'];
            $data['url'] = '<a id="tab-' . $data['slug'] . '" href="' . $data['url'] . '">' . $section['name'] . '</a>';
        } elseif( isset($section['link']) && strpos($section['link'], '//') ){
            $data['url'] = '<a id="tab-' . $data['slug'] . '" href="' . $section['link'] . '" target="_blank">' . $section['name'] . '</a>';
        } else { $data['url'] = $section['name']; }
        return $data;
    }

    /**
     * Escape function generated within Service.php class
     * @return mixed    Return escape value
     */
    public function esc($type, $value, $args = []){
        return $this->WP->esc($type, $value, $args);
    }

    /**
     * Build view
     * @return  void
     */
    public function build(){
        echo $this->loadContent('Template/' . $this->template);
    }

    /**
     * @return object
     */
    public function getPage()
    {
        return $this->Page;
    }

    /**
     * @param object $Page
     */
    public function setPage($Page)
    {
        $this->Page = $Page;
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
     * @return array
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @param array $sections
     */
    public function setSections($sections)
    {
        $this->sections = $sections;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

}