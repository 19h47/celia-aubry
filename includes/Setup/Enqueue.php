<?php // phpcs:ignore
/**
 * Enqueue
 *
 * @package WordPress
 * @subpackage CeliaAubry
 */

namespace CeliaAubry\Setup;

use CeliaAubry\Vite;

/**
 * Enqueue
 */
class Enqueue {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		add_action( 'wp_head', array( $this, 'preload_wp_styles' ) );
		add_filter( 'wp_preload_resources', array( $this, 'preload_resources' ) );
		add_filter( 'wp_speculation_rules_configuration', array( $this, 'speculation_rules_configuration' ) );
	}


	/**
	 * Preload the fonts painted above the fold (Inria Sans for the body and the
	 * current menu item, Maghfirea for the titles) so they are not discovered
	 * only once the CSS is parsed.
	 *
	 * @param array $resources Resources to preload.
	 * @return array
	 */
	public function preload_resources( array $resources ): array {
		$fonts = array( 'inria-sans/inria-sans-regular', 'inria-sans/inria-sans-bold', 'maghfirea/maghfirea-regular' );

		foreach ( $fonts as $font ) {
			$resources[] = array(
				'href'        => Vite::asset( 'src/fonts/' . $font . '.woff2' ),
				'as'          => 'font',
				'type'        => 'font/woff2',
				'crossorigin' => 'anonymous',
			);
		}

		return $resources;
	}


	/**
	 * Prefetch a linked page after a short hover (`moderate`) rather than on
	 * click. Prefetch only: prerendering would run the page's scripts before
	 * it is shown. `null` (logged-in visitors, plain permalinks) keeps
	 * speculative loading off.
	 *
	 * @param array|null $config Speculation rules configuration.
	 * @return array|null
	 */
	public function speculation_rules_configuration( ?array $config ): ?array {
		if ( null === $config ) {
			return null;
		}

		return array(
			'mode'      => 'prefetch',
			'eagerness' => 'moderate',
		);
	}


	/**
	 * Enqueue styles.
	 *
	 * Fonts are self-hosted: see src/stylesheets/styles.css.
	 *
	 * @access public
	 * @return void
	 * @since  1.0.0
	 */
	public function enqueue_styles(): void {
		$filename = Vite::asset( 'src/stylesheets/styles.css' );

		wp_enqueue_style( get_theme_text_domain() . '-main', $filename, array(), null );
	}


	/**
	 * Dequeue styles
	 *
	 * Remove styles that are not needed.
	 *
	 * @access public
	 * @return void
	 */
	public function dequeue_styles(): void {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'wc-block-style' );
		wp_dequeue_style( 'global-styles' );
		wp_dequeue_style( 'classic-theme-styles' );
	}

	/**
	 * Enqueue scripts
	 *
	 * @access public
	 * @return void
	 * @since  1.0.0
	 */
	public function enqueue_scripts(): void {

		wp_deregister_script( 'jquery' );
		wp_deregister_script( 'wp-embed' );

		$deps = array();

		// Enqueue the Vite module.
		Vite::enqueue_script_module();

		wp_register_script_module(
			get_theme_text_domain() . '-main',
			Vite::asset( 'src/scripts/app.js' ),
			$deps,
			null
		);

		$data = array(
			'template_directory_uri' => get_template_directory_uri(),
			'base_url'               => site_url(),
			'home_url'               => home_url( '/' ),
			'ajax_url'               => admin_url( 'admin-ajax.php' ),
			'api_url'                => home_url( 'wp-json' ),
			'current_url'            => get_permalink(),
			'nonce'                  => wp_create_nonce( 'security' ),
			'text_domain'            => get_theme_text_domain(),
			'messages'               => array(
				'value_missing' => array(
					'default' => _x( 'Please fill out this field.', 'messages', 'celia-aubry' ),
				),
				'type_mismatch' => array(
					'email'   => _x( 'Please enter an email address.', 'messages', 'celia-aubry' ),
					'url'     => _x( 'Please enter a URL.', 'messages', 'celia-aubry' ),
					'default' => _x( 'Please match the expected format.', 'messages', 'celia-aubry' ),
				),
			),
		);

		wp_register_script( get_theme_text_domain() . '-feature', false );
		wp_add_inline_script( get_theme_text_domain() . '-feature', '!function(e,n,o){("ontouchstart"in e||e.DocumentTouch&&n instanceof DocumentTouch||o.MaxTouchPoints>0||o.msMaxTouchPoints>0)&&(n.documentElement.className=n.documentElement.className.replace(/\bno-touch\b/,"touch")),n.documentElement.className=n.documentElement.className.replace(/\bno-js\b/,"js")}(window,document,navigator);' );
		wp_add_inline_script( get_theme_text_domain() . '-feature', '/Safari/.test(navigator.userAgent)&&/Apple Computer/.test(navigator.vendor)&&(document.documentElement.className+=" is-safari");' );

		// @TODO doesn't work with wp_enqueue_script_module
		wp_add_inline_script(
			get_theme_text_domain() . '-feature',
			'var ' . get_theme_text_domain() . ' = ' . wp_json_encode(
				$data
			),
			'before',
		);

		wp_enqueue_script( get_theme_text_domain() . '-feature' );
		wp_enqueue_script_module( get_theme_text_domain() . '-main' );
	}


	/**
	 * Preload styles
	 *
	 * Preload styles for faster loading.
	 *
	 * @access public
	 * @return void
	 */
	public function preload_wp_styles(): void {
		global $wp_styles;

		foreach ( $wp_styles->queue as $handle ) {
			$style = $wp_styles->registered[ $handle ];

			if ( substr( $style->handle, 0, strlen( get_theme_text_domain() ) ) !== get_theme_text_domain() ) {
				continue;
			}

			$href = $style->src . ( $style->ver ? "?ver={$style->ver}" : '' );
			echo '<link rel="preload" as="style" href="' . esc_attr( $href ) . '">';

		}
	}
}
