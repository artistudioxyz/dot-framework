## WordPress Class `src/WordPress` 

WordPress class provides workflow and abstraction layer between the framework and WordPress.
This can be useful if you want to extend WordPress functionality such as: 
- Adding custom property to hooks
- Encapsulate WordPress function
- Creating entity class for WordPress post type

Some sample of WordPress class are: 
- [Dot\WordPress\Hook\Action](https://github.com/artistudioxyz/dot-framework/blob/master/src/WordPress/Hook/Action.php)
- [Dot\WordPress\Hook\Filter](https://github.com/artistudioxyz/dot-framework/blob/master/src/WordPress/Hook/Filter.php)
- [Dot\WordPress\Hook\Shortcode](https://github.com/artistudioxyz/dot-framework/blob/master/src/WordPress/Hook/Shortcode.php)
- and many more, you can find it in [src/WordPress](https://github.com/artistudioxyz/dot-framework/tree/master/src/WordPress)

## Helper Class `src/WordPress/Helper/Helper.php`

WordPress helper class provides a set of reusable functions that can be used in multiple places across the framework.
The idea of creating this class is to create a layer of abstraction between the framework and WordPress.

For example when you want to load a script in WordPress you can use :
```php
$this->WP->wp_enqueue_style( 'dot', 'build/css/backend.min.css' );
```

Instead of using the WordPress function directly. 
Which will leads to error because the path is not correct : 
```php
wp_enqueue_style( 'dot', 'build/css/backend.min.css' ); // this will leads to error
```

This way you can use the WordPress function without worrying about the path because the path is already handled by the framework.
The detail of the function can be found in [Asset.php#L47-L75](https://github.com/artistudioxyz/dot-framework/blob/658d010cc42cedebe9d8339f79e99ec693fc11ff/src/WordPress/Helper/Asset.php#L47-L75)

### Traits

Currently, the WordPress class contains the following traits:
- `API` : provides a set of functions to manipulate API
- `Asset` : provides a set of functions to manipulate asset
- `Model` : provides a set of functions to manipulate model
- `Option` : provides a set of functions to manipulate option
- `Page` : provides a set of functions to manipulate page
- `Shortcode` : provides a set of functions to manipulate shortcode
- `Template` : provides a set of functions to manipulate template
- `User` : provides a set of functions to manipulate user
- `Validate` : provides a set of functions to validate data
