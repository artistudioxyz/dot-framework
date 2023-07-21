# How to Install Dot Framework?

You can install the framework by following these steps :
- Create a new project `composer create-project artistudioxyz/dot-framework {MyPluginorThemeName}`
- Change directory `cd {MyPluginorThemeName}`
- Install [Aspri (Asisten Pribadi)](https://github.com/artistudioxyz/aspri) to your system
- Refactor this framework by running : `aspri --wp-refactor --from Dot --to {MyPluginorThemeName} --type {plugin or theme}`
- Install dependencies `npm install`
- Build assets `npx grunt`
- Composer update `composer update`
- Create WordPress file, to learn more please see : [WordPress Plugin Handbook](https://developer.wordpress.org/plugins/) or [WordPress Theme Handbook](https://developer.wordpress.org/themes/getting-started/)
    - For plugin, please create `mypluginname.php`, for reference please see [calo.php](https://github.com/agung2001/wp-calo/blob/develop/calo.php)
    - For theme, please create (`functions.php`, `style.css`), for reference please see [functions.php](https://github.com/artistudioxyz/bingopress/blob/main/functions.php), [style.css](https://github.com/artistudioxyz/bingopress/blob/main/style.css)
- Activate the plugin/theme in WordPress

## [Aspri (Asisten Pribadi)](https://github.com/artistudioxyz/aspri)

One of the problem when working with Plugins in WordPress is that, you can't have the same namespace across multiple plugin. e.g `Dot\WordPress`.
Luckily there is a solution for that, introducing [Aspri (Asisten Pribadi)](https://github.com/artistudioxyz/aspri),
a simple library written in Go to help you refactor this framework and make it your own.

- To refactor this framework you can run : `aspri --wp-refactor --path {pathtoproject} --from Dot --to {Projectnamespace} --type {plugin|theme}`
    - or via grunt : `grunt shell:dot_refactor` (you need to set the `{Projectnamespace}` in `Gruntfile.js`)