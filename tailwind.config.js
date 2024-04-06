const { fontFamily } = require('tailwindcss/defaultTheme');

const borderRadius = {};
const colors = {
	neutral: {
		50: '#F1F1F1',
		400: '#ACABAB',
		900: '#222222'
	},
	brand: {
		beige: '#FBF9F7',
		jaune: '#FAE360',
		rose: '#F4C4CE',
		'vert-dark': '#002823'
	}
};
const fontSize = {};
const maxWidth = {};
const spacing = {};
const transitionDuration = {};

const zIndex = {
	1: '1',
	2: '2',
	3: '3',
	4: '4',
	5: '5',
};


module.exports = {
	content: ['./views/**/*.twig', './src/**/*.{html,js}', './includes/**/*.{php,json}'],
	theme: {
		container: {
			center: true,
			padding: '1rem',
		},
		extend: {
			gridTemplateColumns: {
				'24': 'repeat(24, minmax(0, 1fr))',
			},
			gridColumn: {
				'span-11': 'span 11 / span 11',
				'span-14': 'span 14 / span 14',
				'span-17': 'span 17 / span 17',
			},
			borderRadius,
			colors,
			fontSize,
			maxWidth,
			spacing,
			transitionDuration,
			zIndex,
		},
		fontFamily: {
			serif: ['"Maghfirea"', ...fontFamily.serif],
			sans: ['"Inria Sans"', ...fontFamily.sans],
		},
	}
};
