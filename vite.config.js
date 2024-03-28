import { defineConfig } from "vite";
import laravel from 'laravel-vite-plugin';
import viteSvgSpriteWrapper from 'vite-svg-sprite-wrapper';

export default defineConfig({
	base: '',
	build: {
		emptyOutDir: false, // Because of SVG
		// copyPublicDir: true,
		manifest: true,
		outDir: 'dist',
		assetsDir: 'src',
	},
	plugins: [
		laravel({
			publicDirectory: 'dist',
			input: [
				'src/stylesheets/styles.css',
				'src/scripts/app.js',
			],
			refresh: [
				'**.php', '**.twig'
			]
		}),
		viteSvgSpriteWrapper({
			icons: 'src/icons/*.svg',
			outputDir: 'dist'
		}),
	],
	resolve: {
		alias: [
			{
				find: /~(.+)/,
				replacement: process.cwd() + '/node_modules/$1'
			},
		]
	}
});
