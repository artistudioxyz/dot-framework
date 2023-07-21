The framework categorize CSS styles into 3 different categories : 
- Backend : CSS styles that are only used in the backend
- Frontend : CSS styles that are only used in the frontend
- Tailwind : Tailwind CSS configuration

To enable additional features such nested CSS, variables, etc. The framework uses [SASS](https://sass-lang.com/).

## Folder structure

Backend / Frontend `assets/css/{backend|frontend}` : 
- `_asset.scss` : You can store variables, component styles, etc. in this file. 
- `_external.scss` : You can store external CSS styles in this file.
- `_mixin.scss` : You can store mixins in this file.
- `_template.scss` : This file used to store `src/View/Template` styles.
- `style.scss` : Main CSS file

Tailwind `assets/css/tailwind` :
- `style.css` : Default Tailwind CSS configuration

## Main CSS file

Tailwind CSS sometimes modify default CSS styles such as HTML, Body, etc. 
To avoid style conflicts, the framework uses nested container to store all the CSS styles.
```
.dot-container {
	// Tailwind CSS
	@import '../../build/css/tailwind.min';

	// General Asset
	@import '_mixin';
	@import '_asset';

	// Template Modification
	@import '_template';
}

/** External Styling */
@import '_external';
```

This type of CSS structure is used in both backend and frontend.
You can extend the CSS structure by adding additional files in the `assets/css/{backend|frontend}` directory then import the file in the main CSS file.
