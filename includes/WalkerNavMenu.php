<?php // phpcs:ignore
/**
 * Walker Nav Menu
 *
 * @package WordPress
 * @subpackage CeliaAubry/WalkerNavMenu
 */

namespace CeliaAubry;

use WP_Post;

/**
 * Walker Nav Menu
 */
class WalkerNavMenu {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_filter( 'nav_menu_css_class', array( $this, 'nav_menu_css_class' ), 10, 2 );
	}


	/**
	 * Add theme supports
	 *
	 * @param string[] $classes   Array of the CSS classes that are applied to the menu item's `<li>` element.
	 * @param WP_Post  $menu_item The current menu item object.
	 *
	 * @return array
	 */
	public function nav_menu_css_class( array $classes = array(), WP_Post $menu_item = null ): array {
		if ( $menu_item->type === 'post_type_archive' ) {
			$classes[] = ( $menu_item->url === get_post_type_archive_link( get_post_type() ) ) ? 'font-bold after:scale-x-100' : '';
		}

		return $classes;
	}
}
