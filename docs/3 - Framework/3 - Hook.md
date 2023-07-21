## What is Hooks?

In WordPress, hooks are a way to modify or extend the functionality of a theme or plugin without directly editing the original code. They provide a way to add custom code at specific points in the WordPress core, themes, and plugins, allowing developers to change or enhance the behavior of the software without modifying its source code.

Hooks play a crucial role in the WordPress ecosystem, as they facilitate extensibility and allow developers to build powerful and flexible themes and plugins that can be easily customized by others. They are an essential part of the WordPress architecture and are widely used throughout the platform.

To learn more about hooks you can visit the [WordPress Hooks](https://developer.wordpress.org/plugins/hooks/) documentation.

## Native WordPress Hooks

In WordPress, you can define hooks using the `add_action()` and `add_filter()` functions. 
These functions take two parameters: the name of the hook and the function to be executed when the hook is triggered.

In Dot Framework, it works the same way, but you need to register the hooks inside the `__construct()` method within a Controller.
You can check [[2 - Model View Controller (MVC)]] to learn more about Controller.
Here are sample code of how to register hooks in Dot Framework:

### Action
```php
add_action( 'hook_name', array($this, 'hook_callback_function') ); 
``` 

### Filter
```php
add_action( 'hook_name', array($this, 'hook_callback_function') ); 
```

## Dot Framework Hook Class

In Dot Framework, Hook Class is just addition to native WordPress hooks, you can either use it or not.
Please don't forget to import the Hook Class before using it. 
This is optional if you don't use it, you don't have to import it.
```php
use Dot\WordPress\Hook\Action; // Import Action Hook Class.
use Dot\WordPress\Hook\Filter; // Import Filter Hook Class.
use Dot\WordPress\Hook\Shortcode; // Import Shortcode Hook Class.
```

### Custom Attributes

by using Hook Class, you can define additional attributes for hook class such as description, premium status, etc.
Here are sample code of how to register hooks in Dot Framework using Hook Class:

### Action
```php
$action = new Action();
$action->setComponent( $this );
$action->setHook( 'admin_enqueue_scripts' );
$action->setCallback( 'backend_enqueue' );
$action->setPriority( 10 );
$action->setAcceptedArgs( 0 );
$action->setMandatory( true );
$action->setPremium(false);
$action->setDescription( __( 'Enqueue scripts in backend', 'dot' ) );
$this->hooks[] = $action;
```

### Filter
```php
$filter = new Filter();
$filter->setComponent( $this );
$filter->setHook( 'the_content' );
$filter->setCallback( 'filter_the_content' );
$filter->setAcceptedArgs(1);
$filter->setMandatory( false );
$action->setDescription( __( 'Filter blog content', 'dot' ) );
$this->hooks[] = $filter;
```

### Shortcode
```php
$shortcode = new Shortcode();
$shortcode->setComponent($this);
$shortcode->setHook('dot');
$shortcode->setCallback('shortcode_template');
$shortcode->setAcceptedArgs(1);
$shortcode->setPremium(false);
$shortcode->setDescription('Create dot shortcode');
$this->hooks[] = $shortcode;
```

### Prototype Pattern
You can also use prototype pattern to define hook class, so you don't need to define all attributes for each hook class. 
Here are sample code of how to use prototype pattern to define hook class:
```php
// Initial Hooks.
$action = new Action();
$action->setComponent( $this );
$action->setHook( 'admin_enqueue_scripts' );
$action->setCallback( 'backend_enqueue' );
$action->setPriority( 10 );
$action->setAcceptedArgs( 0 );
$action->setMandatory( true );
$action->setPremium(false);
$action->setDescription( __( 'Enqueue scripts in backend', 'dot' ) );
$this->hooks[] = $action;

// Prototype Hooks.
$action = clone $action;
$action->setHook('admin_menu');
$action->setCallback('page_setting');
$action->setDescription( __( 'Add custom admin page under settings in backend', 'dot' ) );
$this->hooks[] = $action;
```
