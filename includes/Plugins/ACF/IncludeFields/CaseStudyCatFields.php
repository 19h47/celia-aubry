<?php // phpcs:ignore
/**
 * Case Study Cat Fields
 *
 * @package WordPress
 * @subpackage CeliaAubry
 */

namespace CeliaAubry\Plugins\ACF\IncludeFields;

/**
 * Case Study Cat Fields
 */
class CaseStudyCatFields {
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
		$key            = 'case_study_cat';
		$hide_on_screen = array();

		$location = array(
			array(
				array(
					'param'    => 'taxonomy',
					'operator' => '==',
					'value'    => 'case_study_cat',
				),
			),
		);

		$fields = array(
			array(
				'key'         => 'field_' . $key . '_excerpt',
				'label'       => __( 'Excerpt', 'celia-aubry' ),
				'name'        => 'excerpt',
				'type'        => 'textarea',
				'rows'        => 4,
				'placeholder' => __( 'Excerpt', 'celia-aubry' ),
				'new_lines'   => 'br',
			),
			array(
				'key'           => 'field_' . $key . '_icon',
				'label'         => __( 'Icon', 'celia-aubry' ),
				'name'          => 'icon',
				'type'          => 'image',
				'return_format' => 'id',
				'library'       => 'all',
			),
		);

		acf_add_local_field_group(
			array(
				'key'            => 'group_' . $key,
				'title'          => __( 'Case Study Cat Fields', 'celia-aubry' ),
				'fields'         => $fields,
				'location'       => $location,
				'hide_on_screen' => $hide_on_screen,
			)
		);
	}
}
