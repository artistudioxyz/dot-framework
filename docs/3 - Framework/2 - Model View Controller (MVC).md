## What is Model View Controller (MVC)?

Model View Controller (MVC) is a software design pattern that separates the programming logic into three parts, namely the Model, View, and Controller.

1. Model: The Model represents the data and the business logic of the application. It is responsible for managing the data, processing it, and enforcing the rules and constraints of the application. The Model does not directly interact with the user interface but instead provides an interface for the other components to access and manipulate the data.
2. View: The View is responsible for presenting the data to the user and handling user interactions. It represents the user interface and displays the data from the Model to the user. The View is typically passive and does not contain any business logic; it only focuses on how the data is presented and how the user can interact with it.
3. Controller: The Controller acts as an intermediary between the Model and the View. It receives user input from the View, processes it, and updates the Model accordingly. It also fetches data from the Model and updates the View to display the updated data. The Controller is responsible for managing the flow of data and user interactions within the application.

## Model View Controller (MVC) in WordPress

WordPress does not specifically implement MVC, because it is not a framework, but a CMS. However, it is possible to implement it in WordPress.
One thing to note is that WordPress is a bit strict with their development workflow, so it is not possible to implement MVC in a conventional way.

We don't want to create our own system that is not compatible with WordPress.
What we want is to create a system that is compatible so that it can be used in the long run.

That is why this framework implements MVC in this way:
- `src/Controller`: This folder or classes inside it will be used to store, register and manage hooks.
- `src/Model`: This folder or classes inside it will be used to store, register and manage custom post type, taxonomy, and custom table.
- `src/View`: This folder or files inside it will be used to store implementation of custom pages, components, templates, and widgets.

## Controller

Here are examples of how to implement a controller in this framework.
```php
<?php

namespace Dot\Controller;

!defined('WPINC ') or die();

// Plugin class import.
use Dot\Controller;

/**
 * Controller
 *
 * @package    Dot
 * @subpackage Dot/Controller
 */
class Dot extends Controller {
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

## Model

Here are examples of how to implement a model in this framework.
```php
<?php

namespace Dot\Model;

! defined( 'WPINC ' ) || die;

// Plugin class import.
use Dot\WordPress\Model\Type;

/**
 * Model
 *
 * @package    Dot
 * @subpackage Dot/Model
 */
class Dot extends Type {
	/**
	 * Constructor
	 *
	 * @param object $framework Framework instance.
	 *
	 * @return void
	 */
	public function __construct( $framework ) {
        parent::__construct( $framework );

		/**
         * Register Post Type
         * - TODO: You can define the arguments of the post type here.
         * - TODO: If you set `build` argument to false, the post type won't be registered. The default is set to true.
         */
        $this->args['build'] = false;

        /** TODO: This is where you register the hooks */
	}
}
```

### Custom Post Type

In dot framework, you can create a custom post type by using `Dot\WordPress\Model\Type` class.
By inheriting this class, the custom post type will be automatically registered.
But if you don't wish to create a custom post type, you can set `build` argument to false.

### Taxonomy

In dot framework, you can create a taxonomy by using `Dot\WordPress\Model\Taxonomy` class.
You can put taxonomy code below inside `__construct` method of your model class to register it.
```php
$taxonomy = new Taxonomy();
$taxonomy->setName('dot_category');
$taxonomy->setArgs(array(
	'hierarchical' => false,
	'labels' => array(
		'name' => 'Categories',
		'singular_name' => 'Category'
	),
	'show_ui' => true,
	'show_admin_column' => true,
	'show_in_rest' => true,
	'rewrite' => array('slug' => 'dot_category'),
	'default_term' => array(
		'name' => 'Uncategorized',
		'slug' => 'uncategorized',
		'description' => '',
	),
));
$this->setTaxonomies( array( $taxonomy ) );
```

## View

The View is not a class, but a folder or files inside it.
It's just an implementation of custom pages, components, templates, or widgets.
You can create view by using `Dot\View` class.

You can render view statically by using `View::render()` method.
```php
View::render('View.Path', array()); // TODO: Optional you can pass data to the view by using the second parameter.
```

You can also access view by using View class.
This is useful if you want to render view dynamically, load multiple view, or load complex view with template.
Here are examples of how to implement a view in this framework.
```php
// Sections
$sections = [];
$sections['View.Path'] = ['name' => 'View']; // TODO: This is where you load the view, you can load multiple view at once.

// Create a new View instance.
$view = new View($this->Framework);
$view->setTemplate('backend.default'); // TODO: This is where you set the template.
$view->setSections($sections);
$view->setData(array()); // TODO: Optional This is where you set the data.
$view->setOptions(['shortcode' => true]);
$view->build(); // TODO: Optional if you want to build the view within current hook call, or wait and send it somewhere.
```
