<?php // phpcs:ignore
/**
 * Class Case Study Tag
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
 * Case Study Tag
 */
class CaseStudyTag {

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
			'name'                       => _x( 'Tags', 'case study tag general name', 'celia-aubry' ),
			'singular_name'              => _x( 'Tag', 'case study tag singular name', 'celia-aubry' ),
			'search_items'               => __( 'Search Tags', 'celia-aubry' ),
			'all_items'                  => __( 'All Tags', 'celia-aubry' ),
			'popular_items'              => __( 'Popular Tags', 'celia-aubry' ),
			'edit_item'                  => __( 'Edit Tag', 'celia-aubry' ),
			'view_item'                  => __( 'View Tag', 'celia-aubry' ),
			'update_item'                => __( 'Update Tag', 'celia-aubry' ),
			'add_new_item'               => __( 'Add New Tag', 'celia-aubry' ),
			'new_item_name'              => __( 'New Tag Name', 'celia-aubry' ),
			'separate_items_with_commas' => __( 'Separate tags with commas', 'celia-aubry' ),
			'add_or_remove_items'        => __( 'Add or remove tags', 'celia-aubry' ),
			'choose_from_most_used'      => __( 'Choose from the most used tags', 'celia-aubry' ),
			'not_found'                  => __( 'No tags found.', 'celia-aubry' ),
			'no_terms'                   => __( 'No tags', 'celia-aubry' ),
			'items_list_navigation'      => __( 'Tags list navigation', 'celia-aubry' ),
			'items_list'                 => __( 'Tags list', 'celia-aubry' ),
			/* translators: Case Study tag heading when selecting from the most used terms. */
			'most_used'                  => _x( 'Most Used', 'case study tag', 'celia-aubry' ),
			'back_to_items'              => __( '&larr; Back to Tags', 'celia-aubry' ),
		);

		$args = array(
			'labels'             => $labels,
			'hierarchical'       => false,
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_in_quick_edit' => true,
			'show_admin_column'  => true,
			'show_in_rest'       => true,
		);

		register_taxonomy( 'case_study_tag', array( 'case_study' ), $args );
	}
}
