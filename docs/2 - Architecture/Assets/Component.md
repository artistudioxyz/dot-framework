## What is a Component?

A component in this framework is a svelte component that is compiled into a javascript file and then loaded into the plugin or theme.
You can learn more about svelte frontend framework [here](https://svelte.dev/).

## Component Configuration [components.json](https://github.com/artistudioxyz/dot-framework/blob/master/assets/components/components.json)

Under `assets/components` you'll find a directory containing [components.json](https://github.com/artistudioxyz/dot-framework/blob/master/assets/components/components.json). 
This file is used to store information about the component configuration that are available in the framework.

Here are sample of configuration to be put into [components.json](https://github.com/artistudioxyz/dot-framework/blob/master/assets/components/components.json) :
```json
[
  {
    "name": "component"
  }
]
```

This will be then loaded by [Gruntfile.js](https://github.com/artistudioxyz/dot-framework/blob/master/Gruntfile.js) and then compiled into a javascript file.

## How to create component?

To create a component, you can follow these steps:
- cd into `assets/components` directory.
- Run `npx degit sveltejs/template {MyProject}`
- Change Directory to project root `cd ../../`
- Compile the component by running `grunt`
