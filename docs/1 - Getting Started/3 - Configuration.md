## Plugin Configuration [config.json](https://github.com/artistudioxyz/dot-framework/blob/master/config.json)

This file will contain all configuration of the plugin in `.json` format

- `premium` : if the plugin is premium, set to `true` and vice versa.
- `enableHooks` : hook used to enable / disable hooks within the plugin.
- `default` : default configuration of the plugin.

## Composer Configuration [composer.json](https://github.com/artistudioxyz/dot-framework/blob/master/composer.json)

This file will contain composer configuration in `.json` format

- `autoload` : mapping directories run automatically when composer run.
  - [psr-4](https://brain.artistudio.xyz/knowledge/technical/research/terms-concepts/standards/php/psr-4.md) : mapping directory for psr-4
- `authors` : author of the plugin.
- `require` : the vendors that plugin uses.

## NPM Configuration [package.json](https://github.com/artistudioxyz/dot-framework/blob/master/package.json)

This file will contain npm configuration in `.json` format

- `scripts` : mapping directories run automatically when npm run.
- `devDependencies` : the vendors that plugin uses.
- `dependencies` : the vendors that plugin uses.
- `lint-staged` : mapping directories run automatically when npm run lint-staged.

## Grunt JS Configuration [Gruntfile.js](https://github.com/artistudioxyz/dot-framework/blob/master/Gruntfile.js)

This file will contain grunt configuration in `.js` format
There already exists a default configuration for grunt in the plugin, you can add or remove it as needed.

## Versioning

The plugin versioning is based on [Semantic Versioning](https://semver.org/)
The versioning is based on MAJOR.MINOR.PATCH

This framework uses release-it to manage the versioning.
If you want to set up your own version of your plugin or theme, you can change:
- the version in the [config.json](https://github.com/artistudioxyz/dot-framework/blob/master/config.json) file
- the version in the [package.json](https://github.com/artistudioxyz/dot-framework/blob/master/package.json) file
