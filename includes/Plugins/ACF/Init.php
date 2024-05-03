<?php // phpcs:ignore
/**
 * Init
 *
 * @package WordPress
 * @subpackage CeliaAubry/Plugins/ACF
 */

namespace CeliaAubry\Plugins\ACF;

/**
 * Init
 */
class Init {
	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'acf/init', array( $this, 'add_options_pages' ) );
	}

	/**
	 * Add Options Pages
	 *
	 * @return void
	 */
	public function add_options_pages(): void {
		acf_add_options_page(
			array(
				'page_title' => __( 'Theme Options', 'celia-aubry' ),
				'menu_slug'  => 'options-theme',
				'redirect'   => false,
			)
		);
	}
}
