<?php // phpcs:ignore
/**
 * Settings
 *
 * @package WordPress
 * @subpackage CeliaAubry
 */

namespace CeliaAubry\Setup;

/**
 * Supports
 */
class Settings {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'admin_init', array( $this, 'settings_api_init' ) );
		add_action( 'init', array( $this, 'register_settings' ) );
	}


	/**
	 * Register settings
	 *
	 * @return void
	 */
	public function settings_api_init(): void {
		add_settings_section(
			'contacts',
			'',
			array( $this, 'contacts_callback_function' ),
			'reading'
		);

		add_settings_field(
			'public_email',
			__( 'Public Email Address', 'celia-aubry' ),
			array( $this, 'email_callback_function' ),
			'reading',
			'contacts',
			array(
				'name'        => 'public_email',
				'label'       => __( 'Email', 'celia-aubry' ),
				'description' => __( 'This email address is used for public purposes.', 'celia-aubry' ),
				'placeholder' => 'artvandelay@vandelayindustries.com',
			)
		);

		add_settings_field(
			'authordescription',
			__( 'Author Description', 'celia-aubry' ),
			array( $this, 'textarea_callback_function' ),
			'reading',
			'default',
			array(
				'id'          => 'authordescription',
				'name'        => 'authordescription',
				'rows'        => 2,
				'value'       => get_option( 'authordescription' ),
				'placeholder' => __( 'Author Description', 'celia-uabry' ),
			)
		);

		add_settings_field(
			'page_for_contact',
			__( 'Contact Page', 'celia-aubry' ),
			array( $this, 'dropdown_pages_callback_function' ),
			'reading',
			'default',
			array(
				'name' => 'page_for_contact',
			)
		);
	}


	/**
	 * Socials callback function
	 *
	 * @return void
	 */
	public function socials_callback_function(): void {
		echo '';
	}


	/**
	 * Contacts callback function
	 *
	 * @return void
	 */
	public function contacts_callback_function(): void {
		echo '';
	}


	/**
	 * Dropdown pages callback function
	 *
	 * @param array $args Arguments.
	 *
	 * @see https://developer.wordpress.org/reference/functions/wp_dropdown_pages/
	 *
	 * @return void
	 */
	public function dropdown_pages_callback_function( array $args ): void {
		wp_dropdown_pages(
			array(
				'selected' => get_option( $args['name'] ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				'name'     => $args['name'], // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			)
		);

		if ( isset( $args['description'] ) && ! empty( $args['description'] ) ) {
			echo wp_kses_post( '<p class="description">' . $args['description'] . '</p>' );
		}
	}


	/**
	 * Text callback function
	 *
	 * @param array $args Args.
	 *
	 * @return void
	 */
	public function text_callback_function( array $args ): void {
		wp_form_controls_input(
			array(
				'type'        => isset( $args['type'] ) && ! empty( $args['type'] ) ? $args['type'] : 'text',
				'name'        => $args['name'],
				'value'       => get_option( $args['name'] ),
				'placeholder' => $args['placeholder'],
				'description' => isset( $args['description'] ) && ! empty( $args['description'] ) ? $args['description'] : $args['placeholder'],
			),
		);
	}


	/**
	 * Email callback function
	 *
	 * @param array $args Args.
	 *
	 * @return void
	 */
	public function email_callback_function( $args ): void {
		wp_form_controls_input(
			array(
				'type'        => 'email',
				'name'        => $args['name'],
				'value'       => get_option( $args['name'] ),
				'placeholder' => $args['placeholder'],
				'description' => $args['description'],
				'attributes'  => array(
					'pattern'      => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
					'autocomplete' => 'email',
					'aria-label'   => $args['label'],
				),
			)
		);
	}


	/**
	 * URL callback function
	 *
	 * @param array $args Args.
	 *
	 * @return void
	 */
	public function url_callback_function( $args ): void {
		wp_form_controls_input(
			array(
				'type'        => 'url',
				'name'        => $args['name'],
				'value'       => get_option( $args['name'] ),
				'placeholder' => $args['placeholder'],
				'description' => $args['description'],
			)
		);
	}


	/**
	 * Textarea callback function
	 *
	 * @param array $args Arguments.
	 *
	 * @see https://core.trac.wordpress.org/browser/tags/5.6/src/wp-includes/post-template.php#L1163
	 * @return void
	 */
	public function textarea_callback_function( array $args ): void {
		wp_form_controls_textarea( $args );
	}


	/**
	 * Register settings
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_setting/
	 *
	 * @return void
	 */
	public function register_settings(): void {
		register_setting(
			'reading',
			'page_for_contact',
			array(
				'type'              => 'integer',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => null,
			)
		);

		register_setting( 'reading', 'public_email' );
		register_setting( 'reading', 'authordescription' );
	}
}
