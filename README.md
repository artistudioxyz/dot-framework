# 🟣 DOT Framework

Just another WordPress Plugin and Theme boilerplate with TailwindCSS, SASS, Blocks, ESLint, Prettier, and more.

## 📝 Installation
- Create a new project `composer create-project artistudioxyz/dot-framework {projectname}`
  - or Include it as a dependency `composer require artistudioxyz/dot-framework`

### Note
One of the problem when working with Plugins in WordPress is that, you can't have the same namespace across multiple plugin. e.g `Dot\WordPress`.
Luckily there is a solution for that, you need to refactor the framework to use your project namespace,
but this process can be a tedious, because you'll need to refactor the namespace, setting, and configuration across multiple files.

Introducing [Aspri (Asisten Pribadi)](https://github.com/artistudioxyz/aspri), it is a simple library written in Go to help you refactor this framework and make it your own.
- To refactor this framework you can run : `aspri --wp-refactor --path {pathtoproject}/vendor/artistudioxyz/dot-framework --from Dot --to {Projectname} --type {plugin|theme}`

## 🎉 Credits

This framework is heavily using these free & open-source libraries
all the credits go to these peoples and communities
who had helped provide and develop these libraries

- 📟 Compiler: [GruntJS](https://gruntjs.com/)
- 📟 Framework : [TailwindCSS](https://tailwindcss.com/)
- 📟 Languages : [SASS](https://sass-lang.com/)
- 📟 Lint & Hooks : [ESLint](https://eslint.org/), [Husky](https://typicode.github.io/husky), [Prettier](https://prettier.io/)
- 📟 QA & Test : [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer), [WPCS](https://github.com/WordPress/WordPress-Coding-Standards)
- 📟 Release & Specification : [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/), [Release-it](https://www.npmjs.com/package/release-it)
- 📟 Vendors : [Composer](https://getcomposer.org/), [NPM](https://www.npmjs.com/)

## 🤖 Used by
- [artistudioxyz/bingopress](https://github.com/artistudioxyz/bingopress)
- [artistudioxyz/floating-awesome-button](https://github.com/artistudioxyz/floating-awesome-button)

## ⭐️ Support & Contribution
- Help support me by giving a 🌟 or [donate][website]

[website]: https://agungsundoro.ddns.net
