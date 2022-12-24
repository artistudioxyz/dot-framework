<?php

namespace BingoPress\Helper;

!defined( 'WPINC ' ) or die;

/**
 * Helper library for BingoPress framework
 *
 * @package    BingoPress
 * @subpackage BingoPress\Includes
 */

trait Plan {

    /**
     * Get Premium Plan Info
     * @return bool
     */
    public function isPremiumPlan()
    {
        return true;
        /** Get Plan from config.json file */
        $plan = $this->Theme->getConfig()->premium;

        /** Freemius - Check Premium Plan */
        if(function_exists('bingopress_freemius')){
            if(bingopress_freemius()->is__premium_only()){
                if(bingopress_freemius()->is_plan('pro')) $plan = 'pro';
            }
        }

        return $plan;
    }

    /**
     * Get Upgrade URL
     * @return string
     */
    public function getUpgradeURL(){
        return (function_exists('bingopress_freemius')) ?
            bingopress_freemius()->get_upgrade_url() : false;
    }

}
