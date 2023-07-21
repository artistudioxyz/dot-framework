<?php

namespace Dot\Controller;

!defined('WPINC ') or die();

// Plugin class import.
use Dot\Controller;
use Dot\View;
use Dot\WordPress\Hook\Action;
use Dot\WordPress\Page\SubmenuPage;

/**
 * Backend Page
 *
 * @since 0.3.0
 *
 * @package    Dot
 * @subpackage Dot/Controller
 */
class BackendPage extends Controller
{
	/**
	 * Constructor
	 *
	 * @since 0.3.0
	 *
	 * @param object $framework Framework instance.
	 *
	 * @return void
	 */
	public function __construct($framework)
	{
		parent::__construct($framework);

		// Admin Menu Setting @backend.
		$action = new Action();
		$action->setComponent($this);
		$action->setHook('admin_menu');
		$action->setCallback('page_setting');
		$action->setMandatory(true);
		$action->setPremium(false);
		$action->setDescription(
			__('Add custom admin page under settings in backend', 'dot')
		);
		$this->hooks[] = $action;
	}

	/**
	 * Admin Menu Setting @backend.
	 *
	 * @since 0.3.0
	 *
	 * @return  void
	 */
	public function page_setting()
	{
		// Sections.
		$sections = [];
		$sections['Backend.about'] = ['name' => 'About', 'active' => true];

		// Set View.
		$view = new View($this->Framework);
		$view->setTemplate('backend.default');
		$view->setSections($sections);
		$view->addData([
			'background' => 'bg-alizarin',
		]);
		$view->setOptions(['shortcode' => false]);

		// Set Page.
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
