# 🟣 DOT Framework

Just another WordPress Plugin and Theme boilerplate with TailwindCSS, SASS, Blocks, ESLint, Prettier, and more.

## 📝 Installation
- Create a new project `composer create-project artistudioxyz/dot-framework {projectname}`
  - or Include it as a dependency `composer require artistudioxyz/dot-framework`
- Install dependencies `npm install`
- Build assets `npx grunt`

### Note - Namespace
One of the problem when working with Plugins in WordPress is that, you can't have the same namespace across multiple plugin. e.g `Dot\WordPress`.
Luckily there is a solution for that, you need to refactor the framework to use your project namespace,
but this process can be a tedious, because you'll need to refactor the namespace, setting, and configuration across multiple files.

Introducing [Aspri (Asisten Pribadi)](https://github.com/artistudioxyz/aspri), it is a simple library written in Go to help you refactor this framework and make it your own.
- To refactor this framework you can run : `aspri --wp-refactor --path {pathtoproject} --from Dot --to {Projectnamespace} --type {plugin|theme}`
  - or via grunt : `grunt shell:dot_refactor` (you need to set the `{Projectnamespace}` in `Gruntfile.js`)

### Note - Versions

- Please don't forget to change the version in `config.json` and `package.json` to your own version.

## 📟 Commands

- Generate original assets from `.min` in [`assets/build`,`assets/vendor`] : `grunt shell:original_assets`
- Install husky : `npx husky install`

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
- [artistudioxyz/bingopress](https://github.com/artistudioxyz/bingopress)
- [artistudioxyz/floating-awesome-button](https://github.com/artistudioxyz/floating-awesome-button)
- [agung2001/calo](https://github.com/agung2001/wp-calo)
- [agung2001/layar-tancap](https://github.com/agung2001/wp-layar-tancap)

## ⭐️ Support & Contribution
- Help support me by giving a 🌟 or [donate][website]

[website]: https://agung2001.github.io
