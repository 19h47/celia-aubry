<?php // phpcs:ignore
/**
 * Front Page Fields
 *
 * @package WordPress
 * @subpackage CeliaAubry
 */

namespace CeliaAubry\Plugins\ACF\IncludeFields;

/**
 * Front Page Fields
 */
class FrontPageFields {

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
		$key            = 'front_page';
		$hide_on_screen = array( 'the_content' );

		$location = array(
			array(
				array(
					'param'    => 'page_type',
					'operator' => '==',
					'value'    => 'front_page',
				),
			),
		);

		$fields = array(
			array(
				'key'        => 'field_' . $key . '_hero',
				'label'      => __( 'Hero', 'celia-aubry' ),
				'name'       => 'hero',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'         => 'field_' . $key . '_hero_title',
						'label'       => __( 'Title', 'celia-aubry' ),
						'name'        => 'title',
						'type'        => 'textarea',
						'rows'        => 3,
						'placeholder' => __( 'Title', 'celia-aubry' ),
						'new_lines'   => 'br',
					),
					array(
						'key'         => 'field_' . $key . '_hero_content',
						'label'       => __( 'Content', 'celia-aubry' ),
						'name'        => 'content',
						'type'        => 'textarea',
						'rows'        => 1,
						'placeholder' => __( 'Content', 'celia-aubry' ),
						'new_lines'   => 'br',
					),
					array(
						'key'         => 'field_' . $key . '_hero_date',
						'label'       => __( 'Date', 'celia-aubry' ),
						'name'        => 'date',
						'type'        => 'text',
						'placeholder' => __( 'Date', 'celia-aubry' ),
					),
				),
			),
		);

		acf_add_local_field_group(
			array(
				'key'            => 'group_' . $key,
				'title'          => __( 'Front Page Fields', 'celia-aubry' ),
				'fields'         => $fields,
				'location'       => $location,
				'menu_order'     => 0,
				'hide_on_screen' => $hide_on_screen,
			)
		);
	}
}
