# 🟣 DOT Framework

a Simple WordPress Utility Library for building better Plugins and Themes.

## 📝 Installation
- To install this framework you can easily run : `composer require artistudioxyz/dot-framework`

### Note
One of the problem when working with Plugins in WordPress is that, you can't have the same namespace across multiple plugin. e.g `Dot\WordPress`.
Luckily there is a solution for that, you need to refactor the framework to use your project namespace,
but this process can be a tedious, because you'll need to refactor the namespace, setting, and configuration across multiple files.

Introducing [Aspri (Asisten Pribadi)](https://github.com/artistudioxyz/aspri), it is a simple library written in Go to help you refactor this framework and make it your own.
- To refactor this framework you can run : `aspri --wp-refactor --path {pathtoproject}/vendor/artistudioxyz/dot-framework --from Dot --to {Projectname} --type {plugin|theme}`

## 🤖 Used by
- [artistudioxyz/bingopress](https://github.com/artistudioxyz/bingopress)
- [artistudioxyz/floating-awesome-button](https://github.com/artistudioxyz/floating-awesome-button)
