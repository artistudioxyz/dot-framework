<?php

namespace Dot\Controller;

!defined('WPINC ') or die();

// Plugin class import.
use Dot\Controller;
use Dot\WordPress\Hook\Action;

/**
 * Backend
 *
 * @since 0.3.0
 *
 * @package    Dot
 * @subpackage Dot/Controller
 */
class Backend extends Controller
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

		// Enqueue scripts @backend.
		$action = new Action();
		$action->setComponent($this);
		$action->setHook('admin_enqueue_scripts');
		$action->setCallback('backend_enqueue');
		$action->setMandatory(true);
		$action->setDescription(__('Enqueue scripts in backend', 'dot'));
		$this->hooks[] = $action;
	}

	/**
	 * Enqueue scripts @backend
	 *
	 * @since 0.3.0
	 *
	 * @return  void
	 */
	public function backend_enqueue()
	{
		global $post;

		// Define Variables.
		define('DOT_SCREEN', json_encode($this->WP->getScreen()));
		$config = $this->Framework->getConfig()->options;
		$screen = $this->WP->getScreen();
		$screen->base = str_replace(' ', '-', $screen->base);
		$slug = sprintf('%s-setting', $this->Framework->getSlug());
		$screens = [sprintf('settings_page_%s', $slug)];
		$allowedPage = ['post.php', 'post-new.php'];

		// Load Vendors.
		if (
			in_array($screen->base, $screens) ||
			(isset($post->post_type) &&
				$post->post_type === 'movie' &&
				in_array($screen->pagenow, $allowedPage))
		) {
			// Load Core Vendors.
			wp_enqueue_script('jquery');

			$this->WP->enqueue_assets($config->dot_assets->backend);
			$this->WP->wp_enqueue_style(
				'animatecss',
				'vendor/animatecss/animate.min.css'
			);

			// Load Plugin Assets.
			$this->WP->wp_enqueue_style('dot', 'build/css/backend.min.css');
			$this->WP->wp_enqueue_script(
				'dot',
				'build/js/backend/backend.min.js',
				[],
				'',
				true
			);
		}
	}
}
