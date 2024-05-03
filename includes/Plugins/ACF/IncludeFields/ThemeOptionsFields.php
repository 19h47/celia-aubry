<?php // phpcs:ignore
/**
 * Theme Options Fields
 *
 * @package WordPress
 * @subpackage CeliaAubry
 */

namespace CeliaAubry\Plugins\ACF\IncludeFields;

/**
 * Theme Options Fields
 */
class ThemeOptionsFields {

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
		$key = 'options_theme';

		$location = array(
			array(
				array(
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'options-theme',
				),
			),
		);

		$fields = array(
			array(
				'key'        => 'field_' . $key . '_404',
				'label'      => __( '404', 'celia-aubry' ),
				'name'       => '404',
				'type'       => 'group',
				'wrapper'    => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_' . $key . '_404_title',
						'label'         => __( 'Title', 'celia-aubry' ),
						'name'          => 'title',
						'type'          => 'text',
						'instructions'  => __( '404 title.', 'celia-aubry' ),
						'placeholder'   => __( 'Title', 'celia-aubry' ),
						'default_value' => __( 'Oops! That page can&rsquo;t be found.', 'celia-aubry' ),
					),
					array(
						'key'           => 'field_' . $key . '_404_content',
						'label'         => __( 'Content', 'celia-aubry' ),
						'name'          => 'content',
						'type'          => 'textarea',
						'instructions'  => __( '404 content.', 'celia-aubry' ),
						'rows'          => 2,
						'placeholder'   => __( 'Content', 'celia-aubry' ),
						'new_lines'     => '',
						'default_value' => __( 'It looks like nothing was found at this location.', 'celia-aubry' ),
					),
				),
			),
		);

		acf_add_local_field_group(
			array(
				'key'        => 'group_' . $key,
				'title'      => __( 'Theme Options Fields', 'celia-aubry' ),
				'fields'     => $fields,
				'location'   => $location,
				'menu_order' => 0,
			)
		);
	}
}
