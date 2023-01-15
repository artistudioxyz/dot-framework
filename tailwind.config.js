const colors = require('tailwindcss/colors')

module.exports = {
  mode: 'jit',
  purge: [
	  '*.php',
	  'template-parts/**/*.php',
	  './src/View/**/*.php'
  ],
  theme: {
    extend: {
      colors: {
        primary: colors.purple,
        danger: colors.pink,
      },
    },
  },
}
