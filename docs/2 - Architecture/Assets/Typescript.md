## Why use Typescript instead of Javascript?

There are several reasons why this framework uses TypeScript instead of JavaScript:
1. Static Typing: TypeScript introduces static typing, allowing developers to define types for variables, function parameters, and return values. This helps catch type-related errors during development and improves code quality and reliability.
2. Enhanced IDE Support: With static typing, IDEs can provide better auto-completion, type checking, and code navigation features. This leads to improved developer productivity and fewer mistakes.
3. Better Code Organization: TypeScript supports classes, interfaces, and modules, making it easier to organize and structure code in a more object-oriented manner.
4. and more, you can learn more by visiting Typescript [Official Website](https://www.typescriptlang.org/).

## Script Configuration [scripts.json](https://github.com/artistudioxyz/dot-framework/blob/master/assets/components/components.json)

Under `assets/ts` you'll find a directory containing [scripts.json](https://github.com/artistudioxyz/dot-framework/blob/master/assets/components/components.json).
This file is used to store information about the script library configuration that are available in the framework.

Here are sample of configuration to be put into [scripts.json](https://github.com/artistudioxyz/dot-framework/blob/master/assets/components/components.json) :
```json
[
  {
    "name": "frontend",
    "entry": "./assets/ts/frontend/frontend.ts",
    "output": {
      "filename": "frontend.min.js",
      "path": "assets/build/js/frontend"
    }
  }
]
```

This will be then loaded by [Gruntfile.js](https://github.com/artistudioxyz/dot-framework/blob/master/Gruntfile.js) and then compiled into a javascript file.

## How to create script library?

To create a script library, you can follow these steps:
- cd into `assets/ts` directory.
- Create a new directory for your script library `mkdir {MyScriptLibrary}`
- Create a new file for your script library `touch {MyScriptLibrary}.ts`
- Change Directory to project root `cd ../../`
- Compile the component by running `grunt`
