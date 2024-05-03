<?php // phpcs:ignore
/**
 * Contact Page Fields
 *
 * @package WordPress
 * @subpackage CeliaAubry
 */

namespace CeliaAubry\Plugins\ACF\IncludeFields;

/**
 * Contact Page Fields
 */
class ContactPageFields {
	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'acf/include_fields', array( $this, 'fields' ) );
	}

	/**
	 * Registers the field group.
	 *
	 * @return void
	 */
	public function fields() {
		$key            = 'contact_page';
		$hide_on_screen = array( 'the_content' );

		$location = array(
			array(
				array(
					'param'    => 'post_template',
					'operator' => '==',
					'value'    => 'templates/contact-page.php',
				),
			),
		);

		$fields = array(
			array(
				'key'        => 'field_' . $key . '_hero',
				'label'      => __( 'Hero', 'celia-aubry' ),
				'name'       => 'hero',
				'aria-label' => '',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'         => 'field_' . $key . '_hero_title',
						'label'       => __( 'Title', 'celia-aubry' ),
						'name'        => 'title',
						'type'        => 'text',
						'placeholder' => __( 'Title', 'celia-aubry' ),
					),
					array(
						'key'         => 'field_' . $key . '_hero_content',
						'label'       => __( 'Content', 'celia-aubry' ),
						'name'        => 'content',
						'type'        => 'textarea',
						'rows'        => 3,
						'placeholder' => __( 'Content', 'celia-aubry' ),
						'new_lines'   => 'br',
					),
					array(
						'key'         => 'field_' . $key . '_hero_contact',
						'label'       => __( 'Contact', 'celia-aubry' ),
						'name'        => 'contact',
						'type'        => 'textarea',
						'rows'        => 2,
						'placeholder' => __( 'Contact', 'celia-aubry' ),
						'new_lines'   => 'br',
					),
					array(
						'key'         => 'field_' . $key . '_hero_email',
						'label'       => __( 'Email', 'celia-aubry' ),
						'name'        => 'email',
						'type'        => 'link',
						'placeholder' => __( 'artvandelay@vandelayindustries.com', 'celia-aubry' ),
					),
				),
			),
		);

		acf_add_local_field_group(
			array(
				'key'            => 'group_' . $key,
				'title'          => __( 'Contact Page Fields', 'celia-aubry' ),
				'fields'         => $fields,
				'location'       => $location,
				'menu_order'     => 0,
				'hide_on_screen' => $hide_on_screen,
			)
		);
	}
}
