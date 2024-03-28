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
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_scripts' ), 20 );
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function enqueue_styles_scripts(): void {

		// enqueue the Vite module
		Vite::enqueue_module();

		// register theme-style-css
		$filename = Vite::asset( 'src/stylesheets/styles.css' );

		// enqueue theme-style-css into our head
		wp_enqueue_style( 'wordpress-theme-vite-style', $filename, array(), null, 'screen' );

		// register theme-script-js
		$filename = Vite::asset( 'src/scripts/app.js' );

		// enqueue theme-script-js into our head (change false to true for footer)
		wp_enqueue_script( 'wordpress-theme-vite-script', $filename, array(), null, false );

		// update html script type to module wp hack
		Vite::script_type_module( 'wordpress-theme-vite-script' );
	}
}
