<?php // phpcs:ignore
/**
 * Context
 *
 * @package WordPress
 * @subpackage CeliaAubry/Setup/Theme
 */

namespace CeliaAubry\Setup;

use Timber\{ Timber, Site };

Timber::init();
Timber::$dirname = array( 'views', 'templates', 'dist' );

/**
 * Context
 */
class Context extends Site {

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function run(): void {
		add_filter( 'timber/context', array( $this, 'add_socials_to_context' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/context', array( $this, 'add_to_theme' ) );
		add_filter( 'timber/context', array( $this, 'add_menus_to_context' ) );
		add_filter( 'timber/post/classmap', array( $this, 'add_post_classmap' ) );
	}


	/**
	 * Add to theme
	 *
	 * @param array $context The global context.
	 *
	 * @return array
	 */
	public function add_to_theme( array $context ): array {
		return $context;
	}


	/**
	 * Add socials to context
	 *
	 * @param array $context The global context.
	 *
	 * @return array
	 */
	public function add_socials_to_context( array $context ): array {
		// Share and Socials links.
		$socials = array(
			array(
				'title' => __( 'Facebook', 'celia-aubry' ),
				'slug'  => 'facebook',
				'name'  => __( 'Share on Facebook', 'celia-aubry' ),
				'link'  => 'https://www.facebook.com/sharer.php?u=',
				'url'   => get_option( 'facebook' ),
				'color' => '#3b5998',
			),
			array(
				'title' => __( 'Instagram', 'celia-aubry' ),
				'slug'  => 'instagram',
				'url'   => get_option( 'instagram' ),
			),
			array(
				'title' => __( 'YouTube', 'celia-aubry' ),
				'slug'  => 'youtube',
				'url'   => get_option( 'youtube' ),
				'color' => '#ff0000',
			),
			array(
				'title' => __( 'Twitter', 'celia-aubry' ),
				'slug'  => 'twitter',
				'name'  => __( 'Share on Twitter', 'celia-aubry' ),
				'link'  => 'https://twitter.com/intent/tweet?url=',
				'url'   => get_option( 'twitter' ),
				'color' => '#1da1f2',
			),
			array(
				'title' => __( 'LinkedIn', 'celia-aubry' ),
				'slug'  => 'linkedin',
				'name'  => __( 'Share on LinkedIn', 'celia-aubry' ),
				'link'  => 'https://www.linkedin.com/sharing/share-offsite/?url=',
				'url'   => get_option( 'linkedin' ),
				'color' => '#0077b5',
			),

		);

		foreach ( $socials as $social ) {
			if ( ! empty( $social['url'] ) ) {
				$context['socials'][ $social['slug'] ] = $social;
			}

			if ( ! empty( $social['link'] ) ) {
				$context['shares'][ $social['slug'] ] = $social;
			}
		}

		return $context;
	}


	/**
	 * Add to context
	 *
	 * @param array $context The global context.
	 *
	 * @return array
	 */
	public function add_to_context( array $context ): array {
		global $wp;

		$context['current_url'] = home_url( add_query_arg( array(), $wp->request ) );

		$context['privacy_policy_url'] = get_privacy_policy_url();
		$context['contact_url']        = get_permalink( get_option( 'page_for_contact' ) );

		$context['authordescription'] = get_option( 'authordescription' );
		$context['public_email']      = get_option( 'public_email' );

		return $context;
	}

	/**
	 * Add post classmap
	 *
	 * @param array $classmap Classmap.
	 *
	 * @return array
	 */
	public function add_post_classmap( $classmap ): array {
		$custom_classmap = array();

		return array_merge( $classmap, $custom_classmap );
	}


	/**
	 * Add menus to context
	 *
	 * @param array $context The global context.
	 *
	 * @see https://developer.wordpress.org/reference/functions/get_registered_nav_menus/
	 *
	 * @return array
	 */
	public function add_menus_to_context( array $context ): array {
		$menus = get_registered_nav_menus();

		foreach ( $menus as $menu => $value ) {
			$context['nav_menus'][ $menu ] = Timber::get_menu( $menu );
		}

		return $context;
	}
}
