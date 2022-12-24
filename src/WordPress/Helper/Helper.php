<?php

namespace Dot\WordPress;

!defined( 'WPINC ' ) or die;

/**
 * Add extra layer for WordPress functions
 *
 * @package    Dot
 * @subpackage Dot\WordPress
 */

class Helper {

    /** Load WP Trait */
    use Helper\API;
    use Helper\Asset;
    use Helper\Option;
    use Helper\Page;
    use Helper\Shortcode;
    use Helper\Template;
    use Helper\Validate;
    use Helper\User;

}