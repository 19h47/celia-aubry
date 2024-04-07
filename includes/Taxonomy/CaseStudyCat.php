<?php // phpcs:ignore
/**
 * Class Case Study Cat
 *
 * PHP version 8.0.0
 *
 * @author  Jérémy Levron <jeremylevron@19h47.fr> (https://19h47.fr)
 *
 * @package WordPress
 * @subpackage CeliaAubry
 */

namespace CeliaAubry\Taxonomy;

/**
 * Case Study Cat
 */
class CaseStudyCat {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Register custom taxonomy
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_taxonomy/
	 *
	 * @return void
	 */
	public function register(): void {

		$labels = array(
			'name'                       => _x( 'Categories', 'case study cat general name', 'celia-aubry' ),
			'singular_name'              => _x( 'Category', 'case study cat singular name', 'celia-aubry' ),
			'search_items'               => __( 'Search Categories', 'celia-aubry' ),
			'all_items'                  => __( 'All Categories', 'celia-aubry' ),
			'popular_items'              => __( 'Popular Categories', 'celia-aubry' ),
			'edit_item'                  => __( 'Edit Category', 'celia-aubry' ),
			'view_item'                  => __( 'View Category', 'celia-aubry' ),
			'update_item'                => __( 'Update Category', 'celia-aubry' ),
			'add_new_item'               => __( 'Add New Category', 'celia-aubry' ),
			'new_item_name'              => __( 'New Category Name', 'celia-aubry' ),
			'separate_items_with_commas' => __( 'Separate categories with commas', 'celia-aubry' ),
			'add_or_remove_items'        => __( 'Add or remove categories', 'celia-aubry' ),
			'choose_from_most_used'      => __( 'Choose from the most used categories', 'celia-aubry' ),
			'not_found'                  => __( 'No categories found.', 'celia-aubry' ),
			'no_terms'                   => __( 'No categories', 'celia-aubry' ),
			'items_list_navigation'      => __( 'Categories list navigation', 'celia-aubry' ),
			'items_list'                 => __( 'Categories list', 'celia-aubry' ),
			/* translators: Case Study cat heading when selecting from the most used terms. */
			'most_used'                  => _x( 'Most Used', 'case study cat', 'celia-aubry' ),
			'back_to_items'              => __( '&larr; Back to Categories', 'celia-aubry' ),
		);

		$rewrite = array(
			'slug'       => get_option( 'case_study_cat_base' ),
			'with_front' => true,
		);

		$args = array(
			'labels'             => $labels,
			'rewrite'            => $rewrite,
			'hierarchical'       => true,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_in_quick_edit' => true,
			'show_admin_column'  => true,
			'show_in_rest'       => true,
		);

		register_taxonomy( 'case_study_cat', array( 'case_study' ), $args );
	}
}
