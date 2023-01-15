const path = require('path');
const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );
let blocksConfig = require( path.resolve(__dirname, 'blocks/blocks.json') );

/** Generate Blocks Config */
blocksConfig = blocksConfig.map((c) => {
    let config = {
		...defaultConfig,
        ...c,
    };
    config.output.path = path.resolve(__dirname, config.output.path);
    return config;
});
module.exports = [ ...blocksConfig ];
