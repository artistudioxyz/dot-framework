<?php

namespace BingoPress\WordPress;

!defined( 'WPINC ' ) or die;

/**
 * Add extra layer for WordPress functions
 *
 * @package    BingoPress
 * @subpackage BingoPress\WordPress
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