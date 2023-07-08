<?php

namespace Dot\Controller;

!defined('WPINC ') or die();

/**
 * Initiate framework
 *
 * @package    Dot
 * @subpackage Dot/Controller
 */

use Dot\Controller;
use Dot\View;
use Dot\WordPress\Hook\Action;
use Dot\WordPress\Page\SubmenuPage;

class BackendPage extends Controller
{
	/**
	 * Admin constructor
	 *
	 * @return void
	 * @var    object   $plugin     Plugin configuration
	 * @pattern prototype
	 */
	public function __construct($plugin)
	{
		parent::__construct($plugin);

		/** @backend - Add custom admin page under settings */
		$action = new Action();
		$action->setComponent($this);
		$action->setHook('admin_menu');
		$action->setCallback('page_setting');
		$action->setMandatory(true);
		$this->hooks[] = $action;
	}

	/**
	 * Admin Menu Setting
	 *
	 * @backend @submenu setting
	 * @return  void
	 */
	public function page_setting()
	{
		/** Section */
		$sections = [];
		$sections['Backend.about'] = ['name' => 'About', 'active' => true];

		/** Set View */
		$view = new View($this->Framework);
		$view->setTemplate('backend.default');
		$view->setSections($sections);
		$view->addData([
			'background' => 'bg-alizarin',
		]);
		$view->setOptions(['shortcode' => false]);

		/**
		 * Set Page.
		 */
		/** Set Page */
		$page = new SubmenuPage();
		$page->setParentSlug('options-general.php');
		$page->setPageTitle(DOT_NAME);
		$page->setMenuTitle(DOT_NAME);
		$page->setCapability('manage_options');
		$page->setMenuSlug(strtolower(DOT_NAME) . '-setting');
		$page->setFunction([$page, 'loadView']);
		$page->setView($view);
		$page->build();
	}
}
