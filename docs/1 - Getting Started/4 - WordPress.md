This framework can be used for either WordPress plugin or theme development.

## How this framework can help you?

This framework is designed as a boilerplate code to your plugin or theme development.
All the code is open source you can modify it as you like under MIT license.

Besides integration with cutting edges technology like Svelte, Tailwind, SASS, etc.
This framework is designed to be modular, extendable, and as simple as possible,
so you don't have to worry about changing your coding style or following a strict coding standard.

This framework also comes with pre-made setting page that can be used to create a setting page for your plugin or theme.

## Main Plugin File [dot.php](https://github.com/artistudioxyz/dot-framework/blob/master/dot.php)

You can find the main plugin file in [dot.php](https://github.com/artistudioxyz/dot-framework/blob/master/dot.php) this file is the main entry point of your plugin.
This file is used to register the plugin, load the plugin, and register the plugin assets.
The filename will be changed to `{MyPluginorThemeName}.php` when you refactor this framework.

You can change the plugin name, version, and description in this file.

## Main Theme Files

To create a theme in WordPress you need to create:
- `style.css` : This file is used to store theme information such as theme name, version, author, etc.
- `functions.php` : This file is used to register the theme, load the theme, and register the theme assets.
- and more ... you can learn more about WordPress theme in [WordPress Theme Handbook](https://developer.wordpress.org/themes/getting-started/)

But mainly you only need to create `style.css` and `functions.php` to create a theme.
After you refactor this framework you can find the main theme file in `functions.php` this file is the main entry point of your theme.

## Support Hooks

This framework also integrate WordPress hooks, here are support hooks that can be used inside the plugins :

- [Action](https://developer.wordpress.org/reference/functions/add_action)
- [Filter](https://developer.wordpress.org/reference/functions/add_filter)
- [Shortcode](https://developer.wordpress.org/plugins/shortcodes/basic-shortcodes)
- and many more ...