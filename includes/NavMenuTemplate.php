<?php // phpcs:ignore
/**
 * Nav Menu Template
 *
 * @package WordPress
 * @subpackage CeliaAubry/NavMenuTemplate
 */

namespace CeliaAubry;

/**
 * Nav Menu Template
 *
 * Hooks of wp-includes/nav-menu-template.php.
 */
class NavMenuTemplate {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_filter( 'wp_nav_menu_objects', array( $this, 'nav_menu_objects' ) );
	}


	/**
	 * Mark a post type archive item as the parent of a single post of that
	 * post type: WordPress marks it current on the archive only.
	 *
	 * @param object[] $items The menu items, sorted by each menu item's menu order.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/wp_nav_menu_objects/
	 *
	 * @return object[]
	 */
	public function nav_menu_objects( array $items ): array {
		foreach ( $items as $item ) {
			if ( 'post_type_archive' === $item->type && is_singular( $item->object ) ) {
				$item->current_item_parent = true;
			}
		}

		return $items;
	}
}
