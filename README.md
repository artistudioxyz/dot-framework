# 🍱 DOT Framework

Dot Framework is a powerful PHP framework designed to expedite WordPress plugin and theme development. By integrating cutting-edge technologies such as TailwindCSS, SASS, Blocks, ESLint, Prettier, and more.

it empowers developers to create feature-rich and visually appealing solutions effortlessly. With a focus on efficiency and code quality, Dot Framework streamlines the development process, enabling developers to build robust and customizable plugins and themes in record time.

Embrace this versatile framework to enhance productivity, ensure code consistency, and deliver exceptional user experiences within the vibrant WordPress ecosystem. Simplify development and elevate your projects with Dot Framework's comprehensive toolset.

<p>
	<img src="https://img.shields.io/github/last-commit/artistudioxyz/dot-framework" alt="Last Commit">
	<img src="https://img.shields.io/github/languages/code-size/artistudioxyz/dot-framework" alt="Code Size">
	<img src="https://img.shields.io/github/v/tag/artistudioxyz/dot-framework" alt="Latest Tag">
	<img src="https://github.com/artistudioxyz/dot-framework/actions/workflows/workflow.yml/badge.svg" alt="Build Status">
	<img src="https://img.shields.io/github/stars/artistudioxyz/dot-framework?style=social" alt="Stars">
</p>

## 🚀 Installation

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

## 📝 Documentations

- 1 - Getting Started
	- [0 - Introduction.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/1-getting-started/0-introduction.md)
	- [1 - Directory Structure.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/1-getting-started/1-directory-structure.md)
	- [2 - Installation.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/1-getting-started/2-installation.md)
	- [3 - Configuration.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/1-getting-started/3-configuration.md)
	- [4 - WordPress.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/1-getting-started/4-wordpress.md)
	- [5 - Concepts.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/1-getting-started/5-concepts.md)
- 2 - Architecture
	- Assets
		- [CSS.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/2-architecture/assets/css.md)
		- [Component.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/2-architecture/assets/component.md)
		- [Typescript.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/2-architecture/assets/typescript.md)
	- Technologies
		- [Composer.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/2-architecture/technologies/composer.md)
		- [Grunt JS.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/2-architecture/technologies/grunt-js.md)
		- [Husky.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/2-architecture/technologies/husky.md)
		- [Release-it.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/2-architecture/technologies/release-it.md)
		- [SASS.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/2-architecture/technologies/sass.md)
		- [Tailwind CSS.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/2-architecture/technologies/tailwind-css.md)
- 3 - Framework
	- [1 - Main File (dot.php).md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/3-framework/1-main-file-dot.php-.md)
	- [2 - Model View Controller (MVC).md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/3-framework/2-model-view-controller-mvc-.md)
	- [3 - Hook.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/3-framework/3-hook.md)
	- [4 - Helper.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/3-framework/4-helper.md)
	- [5 - WordPress.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/3-framework/5-wordpress.md)
	- [6 - API.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/3-framework/6-api.md)
- [README.md](https://brain.artistudio.xyz/knowledge/WordPress-dot-framework/readme.md)

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

- Plugin
  - [artistudioxyz/floating-awesome-button](https://github.com/artistudioxyz/floating-awesome-button)
  - [agung2001/calo](https://github.com/agung2001/wp-calo)
  - [agung2001/layar-tancap](https://github.com/agung2001/wp-layar-tancap)
- Theme
  - [artistudioxyz/bingopress](https://github.com/artistudioxyz/bingopress)

## ⭐️ Support & Contribution

- Help support me by giving a 🌟 or [donate][website]
- Or you can read [CONTRIBUTING.md](CONTRIBUTING.md)

[website]: https://agung2001.github.io
