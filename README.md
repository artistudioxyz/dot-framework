# 🟣 DOT Framework

Just another WordPress Plugin and Theme boilerplate with TailwindCSS, SASS, Blocks, ESLint, Prettier, and more.

## 📝 Installation
- Create a new project `composer create-project artistudioxyz/dot-framework {projectname}`
  - or Include it as a dependency `composer require artistudioxyz/dot-framework`
- Install dependencies `npm install`
- Build assets `npx grunt`

### Note
One of the problem when working with Plugins in WordPress is that, you can't have the same namespace across multiple plugin. e.g `Dot\WordPress`.
Luckily there is a solution for that, you need to refactor the framework to use your project namespace,
but this process can be a tedious, because you'll need to refactor the namespace, setting, and configuration across multiple files.

Introducing [Aspri (Asisten Pribadi)](https://github.com/artistudioxyz/aspri), it is a simple library written in Go to help you refactor this framework and make it your own.
- To refactor this framework you can run : `aspri --wp-refactor --path {pathtoproject} --from Dot --to {Projectnamespace} --type {plugin|theme}`
  - or via grunt : `grunt shell:dot_refactor` (you need to set the `{Projectnamespace}` in `Gruntfile.js`)

## 📟 Commands

- Generate original assets from `.min` in [`assets/build`,`assets/vendor`] : `grunt shell:original_assets`
- Install husky : `npx husky install`

## 🎉 Credits

This framework is heavily using these free & open-source libraries
all the credits go to these peoples and communities
who had helped provide and develop these libraries

```packages.json
"@babel/eslint-parser": "^7.19.1"
"@commitlint/cli": "^17.3.0"
"@commitlint/config-conventional": "^17.3.0"
"@prettier/plugin-php": "^0.19.2"
"@release-it/bumper": "^4.0.0"
"@release-it/conventional-changelog": "^5.1.1"
"@types/react": "^18.0.26"
"@types/react-dom": "^18.0.9"
"@vitejs/plugin-react": "^3.0.0"
"@wordpress/block-library": "^8.0.0"
"@wordpress/blocks": "^12.0.0"
"@wordpress/components": "^23.0.0"
"@wordpress/scripts": "^25.0.0"
"autoprefixer": "^10.2.6"
"dotenv-cli": "^6.0.0"
"eslint": "^8.30.0"
"eslint-plugin-svelte3": "^4.0.0"
"grunt": "^1.4.1"
"grunt-contrib-cssmin": "^4.0.0"
"grunt-contrib-watch": "^1.1.0"
"grunt-shell": "^3.0.1"
"husky": "^8.0.2"
"node-sass": "^7.0.3"
"prettier": "^2.8.1"
"prettier-plugin-svelte": "^2.9.0"
"release-it": "^15.5.1"
"rollup": "^2.3.4"
"rollup-plugin-css-only": "^3.1.0"
"rollup-plugin-livereload": "^2.0.0"
"rollup-plugin-svelte": "^7.0.0"
"rollup-plugin-terser": "^7.0.0"
"sass": "1.57.0"
"shelljs": "^0.8.5"
"tailwindcss": "^2.1.2"
"svelte": "^3.55.0"
"vite": "^4.0.0"
```

## 🤖 Used by
- [artistudioxyz/bingopress](https://github.com/artistudioxyz/bingopress)
- [artistudioxyz/floating-awesome-button](https://github.com/artistudioxyz/floating-awesome-button)
- [agung2001/layar-tancap](https://github.com/agung2001/wp-layar-tancap)

## ⭐️ Support & Contribution
- Help support me by giving a 🌟 or [donate][website]

[website]: https://agung2001.github.io
