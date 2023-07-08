const path = require('path');
const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );
let blocksConfig = require( path.resolve(__dirname, 'blocks/blocks.json') );
let scriptsConfig = require( path.resolve(__dirname, 'assets/ts/scripts.json') );

/** Generate TypeScript Config */
scriptsConfig = scriptsConfig.map((c) => {
	let config = {
		...c,
		mode: 'development',
		devtool: 'source-map',
		module: {
			rules: [
				{
					test: /\.ts?$/,
					use: 'ts-loader',
					exclude: /node_modules/,
				},
			]
		},
		resolve: {
			extensions: ['.ts']
		}
	};
	config.output.path = path.resolve(__dirname, config.output.path);
	return config;
});

/** Generate Blocks Config */
blocksConfig = blocksConfig.map((c) => {
	let config = {
		...defaultConfig,
		...c,
	};
	config.output.path = path.resolve(__dirname, config.output.path);
	return config;
});

// Export Module
module.exports = [ ...scriptsConfig, ...blocksConfig ];
