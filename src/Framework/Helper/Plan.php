<?php

namespace Dot\Helper;

!defined('WPINC ') or die();

/**
 * Helper library for Dot framework
 *
 * @package    Dot
 * @subpackage Dot\Includes
 */

trait Plan
{
	/**
	 * Get Premium Plan Info
	 * @return bool
	 */
	public function isPremiumPlan()
	{
		return true;
		/** Get Plan from config.json file */
		$plan = $this->Framework->getConfig()->premium;

		/** Freemius - Check Premium Plan */
		if (function_exists('dot_freemius')) {
			if (dot_freemius()->is__premium_only()) {
				if (dot_freemius()->is_plan('pro')) {
					$plan = 'pro';
				}
			}
		}

		return $plan;
	}

	/**
	 * Get Upgrade URL
	 * @return string
	 */
	public function getUpgradeURL()
	{
		return function_exists('dot_freemius')
			? dot_freemius()->get_upgrade_url()
			: false;
	}
}
