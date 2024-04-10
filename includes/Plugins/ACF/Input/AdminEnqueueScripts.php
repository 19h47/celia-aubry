<?php // phpcs:ignore
/**
 * Admin Enqueue Scripts
 *
 * @package WordPress
 * @subpackage CeliaAubry/Plugins/ACF/Admin
 */

namespace CeliaAubry\Plugins\ACF\Input;

/**
 * Admin Enqueue Scripts
 */
class AdminEnqueueScripts {
	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'acf/input/admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Admin head
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_style( get_theme_text_domain() . '-acf', get_template_directory_uri() . '/inc/Plugins/ACF/Admin/style.css', false, null );
	}
}
