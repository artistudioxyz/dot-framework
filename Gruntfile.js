/** Load Javascript Library */
const path = require('path')
let componentConfig = require( path.resolve(__dirname, 'assets/components/components.json') );
let scriptConfig = require( path.resolve(__dirname, 'assets/ts/scripts.json') );
let blockConfig = require( path.resolve(__dirname, 'blocks/blocks.json') );

/** Export Module */
module.exports = function (grunt) {
	/** Configuration */
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		/** Compile TailwindCSS - Cross Platform */
		shell: {
			...(() => { /** Get Svelte Build Components */
			let shell = {};
				componentConfig.map((c) => {
					shell[`rollup_component_${c.name}`] = {
						command: `npx rollup -c assets/components/${c.name}/rollup.config.js`
					};
				});
				return shell;
			})(),
			...(() => { /** Get Typescript Library */
			let shell = {};
				scriptConfig.map((s) => {
					shell[`npm_webpack_${s.name}`] = {
						command: `npx webpack --config-name ${s.name}`
					}
				});
				return shell;
			})(),
			...(() => { /** Get Blocks Build Commands */
			let shell = {}
				blockConfig.map((b) => {
					shell[`build_block_${b.name}`] = {
						command: `npx vite build -c blocks/${b.name}/vite.config.js`
					}
				})
				return shell;
			})(),
			npm_tailwind: {
				command: `npx tailwindcss build assets/css/tailwind/style.css -o assets/build/css/tailwind.min.css --silent`,
			},
			npm_typescript: { command: 'npx tsc' },
			npm_webpack: { command: 'npx webpack' },
			npm_wordpress: { command: `npm run build:wp` },
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

		/** Uglify - JS Compressor and minifier */
		uglify: {
			options: { sourceMap: false },
			build: {
				files: (() => {
					let assets = {};
					scriptConfig.map(s => {
						let path = `${s.output.path}/${s.output.filename}`;
						assets[path] = [path];
					});
					return assets;
				})()
			},
		},

		/** Configure watch task */
		watch: {
			options: {
				livereload: false,
			},
			...(() => { /** Svelte Components */
			let watcher = {};
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
			...(() => { /** Typescript Library */
			let watcher = {};
				scriptConfig.map(s => {
					let FilesTasks = {
						files: [ `assets/ts/${s.name}/**/*.ts` ],
						tasks: [`build-script-${s.name}`]
					};
					watcher[`script-${s.name}`] = FilesTasks;
				});
				return watcher;
			})(),
			...(() => { /** WordPress Blocks and Shortcodes (React JS) */
			let watcher = {};
				blockConfig.map((b) => {
					let FilesTasks = {
						files: [
							`blocks/${b.name}/**/*.js`,
							`blocks/${b.name}/**/*.jsx`,
						],
						tasks: [`build-block-${b.name}`, 'build-css']
					};
					watcher.files[`component_${b.name}`] = FilesTasks;
				});
				return watcher;
			})(),
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
	grunt.loadNpmTasks('grunt-contrib-uglify-es');
	grunt.loadNpmTasks('grunt-contrib-watch')
	grunt.loadNpmTasks('grunt-contrib-cssmin')

	/** Component */
	let ComponentsBuild = [];
	componentConfig.map((c) => {
		ComponentsBuild.push(`build-component-${c}`);
		grunt.registerTask(`build-component-${c}`, [ `shell:rollup_component_${c}` ]);
	});

	/** Typescripts using webpack */
	let ScriptBuild = [];
	scriptConfig.map(s => {
		ScriptBuild.push(`build-script-${s.name}`);
		grunt.registerTask(`build-script-${s.name}`, [ `shell:npm_webpack_${s.name}`, 'uglify' ]);
	});

	/** Blocks */
	let BlocksBuild = [];
	blockConfig.map((b) => {
		BlocksBuild.push(`build-block-${b.name}`)
		grunt.registerTask(`build-block-${b.name}`, [ `shell:build_block_${b.name}` ]);
	})

	/** Register Tasks */
	grunt.registerTask('build-css', [ 'shell:npm_tailwind', 'shell:sass', 'cssmin' ])
	grunt.registerTask('build-js', ['shell:npm_webpack', 'shell:npm_wordpress', ...ComponentsBuild, ...ScriptBuild, ...BlocksBuild])
	grunt.registerTask('build', ['build-css', 'build-js'])
	grunt.registerTask('default', ['build', 'shell:original_assets'])
}
