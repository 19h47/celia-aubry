import { defineConfig } from "vite";
import laravel from 'laravel-vite-plugin';
import viteSvgSpriteWrapper from 'vite-svg-sprite-wrapper';
import tailwindcss from '@tailwindcss/vite';

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
		tailwindcss(),
		laravel({
			publicDirectory: 'dist',
			input: [
				'src/stylesheets/styles.css',
				'src/scripts/app.js',
			],
			refresh: [
				'**.php', '**.twig'
			],
			assets: [
				'src/img/**',
			],
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
