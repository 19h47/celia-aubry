<?php // phpcs:ignore
/**
 * Class Case Study
 *
 * @package WordPress
 * @subpackage CeliaAubry
 */

namespace CeliaAubry\Post;

use Timber\{ Timber };

/**
 * Case Study class
 */
class CaseStudy {

	/**
	 * Runs initialization tasks.
	 *
	 * @access public
	 */
	public function run() {
		add_action( 'init', array( $this, 'register' ), 10, 0 );

		add_filter( 'post_updated_messages', array( $this, 'updated_messages' ), 10, 1 );
		add_filter( 'bulk_post_updated_messages', array( $this, 'bulk_updated_messages' ), 10, 2 );
	}

	/**
	 * Updated messages
	 *
	 * @param array $messages Post updated messages. For defaults see $messages declarations above.
	 * @return array $message
	 * @link https://developer.wordpress.org/reference/hooks/post_updated_messages/
	 * @access public
	 */
	public function updated_messages( array $messages ): array {
		global $post;

		$post_ID     = isset( $post_ID ) ? (int) $post_ID : 0;
		$preview_url = get_preview_post_link( $post );

		/* translators: Publish box date format, see https://secure.php.net/date */
		$scheduled_date = date_i18n( __( 'M j, Y @ H:i', 'celia-aubry' ), strtotime( $post->post_date ) );

		$view_link_html = sprintf(
			' <a href="%1$s">%2$s</a>',
			esc_url( get_permalink( $post_ID ) ),
			__( 'View Case Study', 'celia-aubry' )
		);

		$scheduled_link_html = sprintf(
			' <a target="_blank" href="%1$s">%2$s</a>',
			esc_url( get_permalink( $post_ID ) ),
			__( 'Preview Case Study', 'celia-aubry' )
		);

		$preview_link_html = sprintf(
			' <a target="_blank" href="%1$s">%2$s</a>',
			esc_url( $preview_url ),
			__( 'Preview Case Study', 'celia-aubry' )
		);

		$messages['case_study'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Case Study updated.', 'celia-aubry' ) . $view_link_html,
			2  => __( 'Custom field updated.', 'celia-aubry' ),
			3  => __( 'Custom field deleted.', 'celia-aubry' ),
			4  => __( 'Case Study updated.', 'celia-aubry' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Case Study restored to revision from %s.', 'celia-aubry' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore
			6  => __( 'Case Study published.', 'celia-aubry' ) . $view_link_html,
			7  => __( 'Case Study saved.', 'celia-aubry' ),
			8  => __( 'Case Study submitted.', 'celia-aubry' ) . $preview_link_html,
			9  => sprintf( __( 'Case Study scheduled for: %s.', 'celia-aubry' ), '<strong>' . $scheduled_date . '</strong>' ) . $scheduled_link_html, // phpcs:ignore
			10 => __( 'Case Study draft updated.', 'celia-aubry' ) . $preview_link_html,
		);

		return $messages;
	}


	/**
	 * Bulk updated messages
	 *
	 * @param array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
	 * @param array $bulk_counts Array of item counts for each message, used to build internationalized strings.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/bulk_post_updated_messages/
	 *
	 * @return array $bulk_counts
	 */
	public function bulk_updated_messages( array $bulk_messages, array $bulk_counts ): array {
		$bulk_counts_updated   = $bulk_counts['updated'];
		$bulk_counts_locked    = $bulk_counts['locked'];
		$bulk_counts_deleted   = $bulk_counts['deleted'];
		$bulk_counts_trashed   = $bulk_counts['trashed'];
		$bulk_counts_untrashed = $bulk_counts['untrashed'];

		$bulk_messages['case_study'] = array(
			/* translators: %s: Number of case studies. */
			'updated'   => _n( '%s case study updated.', '%s case studies updated.', $bulk_counts_updated, 'celia-aubry' ),
			'locked'    => ( 1 === $bulk_counts_locked ) ? __( '1 case study not updated, somebody is editing it.', 'celia-aubry' ) :
				/* translators: %s: Number of case studies. */
				_n( '%s case study not updated, somebody is editing it.', '%s case studies not updated, somebody is editing them.', $bulk_counts_locked, 'celia-aubry' ),
			/* translators: %s: Number of case studies. */
			'deleted'   => _n( '%s case study permanently deleted.', '%s case study permanently deleted.', $bulk_counts_deleted, 'celia-aubry' ),
			/* translators: %s: Number of case studies.. */
			'trashed'   => _n( '%s case study moved to the Trash.', '%s case study moved to the Trash.', $bulk_counts_trashed, 'celia-aubry' ),
			/* translators: %s: Number of case studies. */
			'untrashed' => _n( '%s case study restored from the Trash.', '%s case study restored from the Trash.', $bulk_counts_untrashed, 'celia-aubry' ),
		);

		return $bulk_messages;
	}


	/**
	 * Register Custom Post Type
	 *
	 * @return void
	 * @access public
	 */
	public function register(): void {
		$labels = array(
			'name'                     => _x( 'Case Studies', 'case study type generale name', 'celia-aubry' ),
			'singular_name'            => _x( 'Case Study', 'case study type singular name', 'celia-aubry' ),
			'add_new'                  => _x( 'Add New', 'case study type', 'celia-aubry' ),
			'add_new_item'             => __( 'Add New Case Study', 'celia-aubry' ),
			'edit_item'                => __( 'Edit Case Study', 'celia-aubry' ),
			'new_item'                 => __( 'New Case Study', 'celia-aubry' ),
			'view_items'               => __( 'View Case Studies', 'celia-aubry' ),
			'view_item'                => __( 'View Case Study', 'celia-aubry' ),
			'search_items'             => __( 'Search Case Studies', 'celia-aubry' ),
			'not_found'                => __( 'No case studies found.', 'celia-aubry' ),
			'not_found_in_trash'       => __( 'No case studies found in Trash.', 'celia-aubry' ),
			'parent_item_colon'        => __( 'Parent Case Study:', 'celia-aubry' ),
			'all_items'                => __( 'All Case Studies', 'celia-aubry' ),
			'archives'                 => __( 'Case Study Archives', 'celia-aubry' ),
			'attributes'               => __( 'Case Study Attributes', 'celia-aubry' ),
			'insert_into_item'         => __( 'Insert into case study', 'celia-aubry' ),
			'uploaded_to_this_item'    => __( 'Uploaded to this case study', 'celia-aubry' ),
			'featured_image'           => _x( 'Featured Image', 'case study', 'celia-aubry' ),
			'set_featured_image'       => _x( 'Set featured image', 'case study', 'celia-aubry' ),
			'remove_featured_image'    => _x( 'Remove featured image', 'case study', 'celia-aubry' ),
			'use_featured_image'       => _x( 'Use as featured image', 'case study', 'celia-aubry' ),
			'items_list_navigation'    => __( 'Case studies list navigation', 'celia-aubry' ),
			'items_list'               => __( 'Case studies list', 'celia-aubry' ),
			'item_published'           => __( 'Case study published.', 'celia-aubry' ),
			'item_published_privately' => __( 'Case study published privately.', 'celia-aubry' ),
			'item_reverted_to_draft'   => __( 'Case study reverted to draft.', 'celia-aubry' ),
			'item_scheduled'           => __( 'Case study scheduled.', 'celia-aubry' ),
			'item_updated'             => __( 'Case study updated.', 'celia-aubry' ),
		);

		$rewrite = array(
			'slug'       => get_option( 'case_study_base' ),
			'with_front' => true,
		);

		$args = array(
			'label'               => __( 'Case Study', 'celia-aubry' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'excerpt', 'thumbnail' ),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-portfolio',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'show_in_rest'        => true,
			'taxonomies'          => array( 'case_study_cat', 'case_study_tag' ),
		);

		register_post_type( 'case_study', $args );
	}
}
