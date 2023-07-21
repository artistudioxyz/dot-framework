Dot Framework provides `src/API` directory which you can create to store your API class.
This directory is not required to be created, but it is recommended to organize your code better.
This directory is already covered by autoloader, so you don't need to worry about including the files.

## HTTP API

In WordPress there are 2 ways to implement HTTP API:
- [WordPress Ajax API](https://codex.wordpress.org/AJAX_in_Plugins)
- [WordPress REST API](https://developer.wordpress.org/rest-api/)

## WordPress Ajax API

One of the easiest ways to implement HTTP API in WordPress is by using WordPress Ajax API.
You can simply register new action hook to handle the request and response.
Here are sample code of how to register Ajax API in WordPress:
```php
add_action( 'wp_ajax_dot', array($this, 'ajax_callback_function') ); // For logged in user.
add_action( 'wp_ajax_nopriv_dot', array($this, 'ajax_callback_function') ); // For non logged in user.
```

It also works the same way in Dot Framework, but you need to create a new API class then register the hooks inside the `__construct()` method.
Here are sample code of how to create a new API class:
```php
<?php

namespace Dot\API;

!defined('WPINC ') or die();

// Plugin class import.
use Dot\API;

/**
 * API
 *
 * @package    Dot
 * @subpackage Dot/API
 */
class Dot extends API {
	/**
	 * Constructor
	 *
	 * @param object $framework Framework instance.
	 *
	 * @return void
	 */
	public function __construct($framework) {
		parent::__construct($framework);
		/** TODO: This is where you register the hooks */
	}
}
```

Also, you can either use native WordPress hooks like example above or Dot Framework hooks such as:
```php
$action = new Action();
$action->setComponent($this);
$action->setHook('wp_ajax_follow_button_content');
$action->setCallback('ajax_follow_button_content');
$this->hooks[] = $action;
```

## WordPress REST API

WordPress REST API provides a more modern way to implement HTTP API in WordPress.
Which provides HTTP verbs such as `GET`, `POST`, `PUT`, `PATCH`, `DELETE` and many more.
You can simply register new route to handle the request and response.

Here are sample code of how to register REST API in WordPress:
```php
function register_dot_rest_route() {
    register_rest_route( 'dot/v1', '/follow/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => array($this, 'follow_button_content'),
    ) );
}
add_action( 'rest_api_init', 'register_dot_rest_route');
```

It also works the same way in Dot Framework, but you need to create a new API class then register the hooks inside the `__construct()` method.
You can see the sample code in WordPress Ajax API section above.

Also, you can either use native WordPress hooks like example above or Dot Framework hooks such as:
```php
$action = new Action();
$action->setComponent( $this );
$action->setHook( 'rest_api_init' );
$action->setCallback( 'register_rest_route' );
$this->hooks[] = $action;
```
