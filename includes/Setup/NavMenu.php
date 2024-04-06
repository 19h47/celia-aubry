<?php // phpcs:ignore
/**
 * Nav Menu
 *
 * @package WordPress
 * @subpackage CeliaAubry
 */

namespace CeliaAubry\Setup;

/**
 * Nav menu
 */
class NavMenu {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'after_setup_theme', array( $this, 'register_menus' ) );
	}

	/**
	 * Register nav menus
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_nav_menus/
	 *
	 * @return void
	 */
	public function register_menus(): void {
		register_nav_menus(
			array(
				'main'   => __( 'Main Menu', 'celia-aubry' ),
				'footer' => __( 'Footer Menu', 'celia-aubry' ),
				'legals' => __( 'Legals Menu', 'celia-aubry' ),
			)
		);
	}
}
