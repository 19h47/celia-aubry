<?php // phpcs:ignore
/**
 * Case Study Fields
 *
 * @package WordPress
 * @subpackage CeliaAubry
 */

namespace CeliaAubry\Plugins\ACF\IncludeFields;

/**
 * Blocks Fields
 */
class CaseStudyFields {
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
		$key            = 'case_study';
		$hide_on_screen = array();

		$location = array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'case_study',
				),
			),
		);

		$fields = array(
			array(
				'key'         => 'field_' . $key . '_description',
				'label'       => __( 'Description', 'celia-aubry' ),
				'name'        => 'description',
				'type'        => 'text',
				'placeholder' => __( 'Description', 'celia-aubry' ),
			),
			array(
				'key'         => 'field_' . $key . '_date',
				'label'       => __( 'Date', 'celia-aubry' ),
				'name'        => 'date',
				'type'        => 'text',
				'placeholder' => __( 'Date', 'celia-aubry' ),
			),
			array(
				'key'           => 'field_' . $key . '_link',
				'label'         => __( 'Link', 'celia-aubry' ),
				'name'          => 'link',
				'type'          => 'link',
				'instructions'  => __( 'Indicate the link of the case study. (Optional)', 'celia-aubry' ),
				'return_format' => 'array',
			),
		);

		acf_add_local_field_group(
			array(
				'key'            => 'group_' . $key,
				'title'          => __( 'Case Study Fields', 'celia-aubry' ),
				'fields'         => $fields,
				'location'       => $location,
				'position'       => 'acf_after_title',
				'hide_on_screen' => $hide_on_screen,
			)
		);
	}
}
