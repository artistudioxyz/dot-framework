# Main File (dot.php)

The framework works by integrating entry point file `dot.php` into your plugin or theme.
The filename will be changed to `{MyPluginorThemeName}.php` when you refactor this framework.

The implementation will be different for each plugin or theme, but the concept is the same.
What this entry point file does is to load the framework and run it.

Here are the things that this file does

### 1. Prevent direct access to the file

This code is used for security. Its function is to protect plugins from being accessed directly from outside.

```php
! defined( 'WPINC ' ) || die;
```

### 2. Load composer vendor autoload

This code is used to call the autoloader from composer. So then we don't have to manually load the classes.

```php
require_once __DIR__ . '/vendor/autoload.php';
```

### 3. Run the framework

```php
$dot = new Dot\Plugin();
$dot->run();
```

## Framework Instance

The framework instance could be either [src/Plugin.php](https://github.com/artistudioxyz/dot-framework/blob/master/src/Plugin.php) or [src/Theme.php](https://github.com/artistudioxyz/dot-framework/blob/master/src/Theme.php) depending on the type you choose.
After refactor there will be either `Plugin.php` or `Theme.php` in your plugin or theme.
The implementation of these files will be different for each plugin or theme, but the concept is the same.

Some of the things that this file does are:
- Configure the framework instance
- Setup helpers and services
- Define constants and variables
- Load framework classes
  - Load models `src/Models`
  - Load features `src/Features`
  - Load controllers `src/Controllers`
  - Load apis `src/Apis`
