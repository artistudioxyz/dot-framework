# 🍱 DOT Framework

Just another WordPress Plugin and Theme boilerplate with TailwindCSS, SASS, Blocks, ESLint, Prettier, and more.

<p>
	<img src="https://img.shields.io/github/last-commit/artistudioxyz/dot-framework" alt="Last Commit">
	<img src="https://img.shields.io/github/languages/code-size/artistudioxyz/dot-framework" alt="Code Size">
	<img src="https://img.shields.io/github/v/tag/artistudioxyz/dot-framework" alt="Latest Tag">
	<img src="https://github.com/artistudioxyz/dot-framework/actions/workflows/workflow.yml/badge.svg" alt="Build Status">
	<img src="https://img.shields.io/github/stars/artistudioxyz/dot-framework?style=social" alt="Stars">
</p>

## 📝 Installation
- Create a new project `composer create-project artistudioxyz/dot-framework {MyPluginorThemeName}`
- Change directory `cd {MyPluginorThemeName}`
- Install [Aspri (Asisten Pribadi)](https://github.com/artistudioxyz/aspri) to your system
- Refactor this framework by running : `aspri --wp-refactor --path "path/to/project" --from Dot --to {MyPluginorThemeName} --type {plugin or theme}`
- Install dependencies `npm install`
- Build assets `npx grunt`
- Composer update `composer update`
- Create WordPress file
  - For plugin, please create `MyPluginorThemeName.php`, for reference please see [Calo.php](https://github.com/agung2001/wp-calo/blob/develop/calo.php)
  - For theme, please create (`functions.php`, `style.css`), for reference please see [functions.php](https://github.com/artistudioxyz/bingopress/blob/main/functions.php), [style.css](https://github.com/artistudioxyz/bingopress/blob/main/style.css)
  - to learn more please see [WordPress Theme Handbook](https://developer.wordpress.org/themes/getting-started/)
- Activate the plugin in WordPress

## 🛠️ About [Aspri (Asisten Pribadi)](https://github.com/artistudioxyz/aspri)

One of the problem when working with Plugins in WordPress is that, you can't have the same namespace across multiple plugin. e.g `Dot\WordPress`.
Luckily there is a solution for that, introducing [Aspri (Asisten Pribadi)](https://github.com/artistudioxyz/aspri),
a simple library written in Go to help you refactor this framework and make it your own.

- To refactor this framework you can run : `aspri --wp-refactor --path {pathtoproject} --from Dot --to {Projectnamespace} --type {plugin|theme}`
	- or via grunt : `grunt shell:dot_refactor` (you need to set the `{Projectnamespace}` in `Gruntfile.js`)

## ⚙️ Configuration

- (Optional) If you use in your project, you can install it by running command : `npx husky install`
- (Optional) Change the version in `config.json` and `package.json` to your own version ex. `1.0.0`.
- (Optional) Disable GitHub release-it in `.release-it.json`
- (Optional) to generate original assets from `.min` in [`assets/build`,`assets/vendor`] : `grunt shell:original_assets`

## 🎉 Credits

This framework is heavily using these free & open-source libraries
all the credits go to these peoples and communities
who had helped provide and develop these libraries

- [Commit Lint](https://commitlint.js.org/)
- [Composer](https://getcomposer.org/)
- [Conventionnal Commit](https://www.conventionalcommits.org/en/v1.0.0/)
- [ESLint](https://eslint.org/)
- [GruntJS](https://gruntjs.com/)
- [Husky](https://typicode.github.io/husky/#/)
- [NPM](https://www.npmjs.com/)
- [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer)
- [Prettier](https://prettier.io/)
- [Release-it](https://www.npmjs.com/package/release-it)
- [Rollup](https://rollupjs.org/guide/en/)
- [SASS](https://sass-lang.com/)
- [Svelte](https://svelte.dev/)
- [TailwindCSS](https://tailwindcss.com/)
- [Vite](https://vitejs.dev/)
- [WPCS](https://github.com/WordPress/WordPress-Coding-Standards)

## 🤖 Used by

Plugin :
- [artistudioxyz/floating-awesome-button](https://github.com/artistudioxyz/floating-awesome-button)
- [agung2001/calo](https://github.com/agung2001/wp-calo)
- [agung2001/layar-tancap](https://github.com/agung2001/wp-layar-tancap)

Theme :
- [artistudioxyz/bingopress](https://github.com/artistudioxyz/bingopress)

## ⭐️ Support & Contribution
- Help support me by giving a 🌟 or [donate][website]

[website]: https://agung2001.github.io
