/** Load Javascript Library */
const path = require('path')
let componentConfig = require( path.resolve(__dirname, 'assets/components/components.json') );
let blockConfig = require( path.resolve(__dirname, 'blocks/blocks.json') );

/** Export Module */
module.exports = function (grunt) {
	/** Configuration */
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		/** Compile TailwindCSS - Cross Platform */
		shell: {
			...(() => { /** Get Shortcode Build Commands */
				let shell = {}
				blockConfig.map((b) => {
					shell[`build_shortcode_${b.name}`] = {
						command: `npx vite build -c blocks/${b.name}/vite.config.js`
					}
				})
				return shell;
			})(),
			dot_refactor: {
				command: `aspri --wp-refactor --path ${path.resolve( __dirname )} --from Dot --to Dot --type theme && composer dump-autoload`,
			},
			npm_tailwind: {
				command: `npx tailwindcss build assets/css/tailwind/style.css -o assets/build/css/tailwind.min.css --silent`,
			},
			npm_wordpress: {
				command: `npm run build:wp`,
			},
			original_assets: { command: `node originalassets.js` },
			sass: {
				command: () => {
					let assets = { // No extension because added in loop command
						"assets/css/backend/style.scss": `assets/build/css/backend.min.css`,
						"assets/css/frontend/style.scss": `assets/build/css/frontend.min.css`,
					}
					let cmd = [];
					for (const [source, target] of Object.entries(assets)) {
						cmd.push(`npx sass ${source} ${target} --style compressed`)
					}
					return cmd.join(' && ')
				},
			},
		},

		/** CSS Minify */
		cssmin: {
			options: {
				mergeIntoShorthands: false,
				roundingPrecision: -1,
			},
			target: {
				files: {
					'assets/build/css/backend.min.css':
						'assets/build/css/backend.min.css',
					'assets/build/css/frontend.min.css':
						'assets/build/css/frontend.min.css',
				},
			},
		},

		/** Configure watch task */
		watch: {
			options: {
				livereload: false,
			},
			blocks: (() => { /** WordPress Blocks and Shortcodes (React JS) */
				let watcher = { files: [] };
				componentConfig.map((b) => {
					let FilesTasks = {
						files: [
							`blocks/${b.name}/**/*.js`,
							`blocks/${b.name}/**/*.jsx`,
						],
						tasks: [`build-shortcode-${b.name}`, 'build-css']
					};
					watcher[`component_${b.name}`] = FilesTasks;
				});
				return watcher;
			})(),
			components: (() => { /** Svelte Components */
				let watcher = { files: [] };
				componentConfig.map((c) => {
					let FilesTasks = {
						files: [
							`assets/components/${c.name}/**/*.js`,
							`assets/components/${c.name}/**/*.svelte`,
						],
						tasks: [`build-component-${c.name}`, 'build-css']
					};
					watcher[`component_${c.name}`] = FilesTasks;
				});
				return watcher;
			})(),
			js: {
				files: [
					'assets/js/**/*.js'
				],
				tasks: ['build-js'],
			},
			css: {
				files: [
					'assets/css/**/*.scss',
					'assets/css/**/*.css',
					'src/View/**/*.php',
					'*.php',
					'template-parts/**/*.php',
				],
				tasks: ['build-css'],
			},
		},
	})

	/** Load Plugin */
	grunt.loadNpmTasks('grunt-shell')
	grunt.loadNpmTasks('grunt-contrib-watch')
	grunt.loadNpmTasks('grunt-contrib-cssmin')

	/** Shortcodes */
	let ShortcodeBuild = [];
	blockConfig.map((b) => {
		ShortcodeBuild.push(`build-shortcode-${b.name}`)
		grunt.registerTask(`build-shortcode-${b.name}`, [ `shell:build_shortcode_${b.name}` ]);
	})

	/** Register Tasks */
	grunt.registerTask('build-css', [ 'shell:npm_tailwind', 'shell:sass', 'cssmin' ])
	grunt.registerTask('build-js', ['shell:npm_wordpress', ...ShortcodeBuild])
	grunt.registerTask('build', ['build-css', 'build-js'])
	grunt.registerTask('default', ['build', 'shell:original_assets'])
}
