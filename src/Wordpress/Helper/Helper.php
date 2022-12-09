<?php

namespace Dot\Wordpress;

!defined( 'WPINC ' ) or die;

/**
 * Add extra layer for wordpress functions
 *
 * @package    Dot
 * @subpackage Dot\Wordpress
 */

class Helper {

    /** Load WP Trait */
    use Helper\API;
    use Helper\Asset;
    use Helper\Model;
    use Helper\Option;
    use Helper\Page;
    use Helper\Shortcode;
    use Helper\Template;
    use Helper\Validate;
    use Helper\User;

}