<?php // phpcs:ignore
/**
 * Blocks Fields
 *
 * @package WordPress
 * @subpackage CeliaAubry
 */

namespace CeliaAubry\Plugins\ACF\IncludeFields;

/**
 * Blocks Fields
 */
class BlocksFields {
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
		$key            = 'blocks';
		$hide_on_screen = array();

		$location = array(
			array(
				array(
					'param'    => 'taxonomy',
					'operator' => '==',
					'value'    => 'case_study_cat',
				),
			),
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'case_study',
				),
			),
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'templates/about-page.php',
				),
			),
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
				'key'          => 'field_' . $key . '_blocks',
				'label'        => __( 'Blocks', 'celia-aubry' ),
				'name'         => 'blocks',
				'type'         => 'flexible_content',
				'layouts'      => array(
					'layout_' . $key . '_gallery'       => array(
						'key'        => 'layout_' . $key . '_gallery',
						'name'       => 'gallery',
						'label'      => __( 'Gallery', 'celia-aubry' ),
						'display'    => 'block',
						'sub_fields' => array(
							array(
								'key'          => 'field_' . $key . '_gallery_title',
								'label'        => __( 'Title', 'celia-aubry' ),
								'instructions' => __( 'Indicate the title of the block. (Optional)', 'celia-aubry' ),
								'name'         => 'title',
								'type'         => 'text',
								'placeholder'  => __( 'Title', 'celia-aubry' ),
							),
							array(
								'key'          => 'field_' . $key . '_gallery_content',
								'label'        => __( 'Content', 'celia-aubry' ),
								'instructions' => __( 'Indicate the content of the block. (Optional)', 'celia-aubry' ),
								'name'         => 'content',
								'type'         => 'wysiwyg',
								'tabs'         => 'all',
								'toolbar'      => 'full',
								'media_upload' => 0,
							),
							array(
								'key'           => 'field_' . $key . '_gallery_images',
								'label'         => __( 'Images', 'celia-aubry' ),
								'name'          => 'images',
								'type'          => 'gallery',
								'return_format' => 'id',
							),
							array(
								'key'           => 'field_' . $key . '_gallery_background_color',
								'label'         => __( 'Background Color', 'celia-aubry' ),
								'name'          => 'background_color',
								'type'          => 'select',
								'choices'       => array(
									'dark'  => __( 'Dark', 'celia-aubry' ),
									'beige' => __( 'Beige', 'celia-aubry' ),
									'light' => __( 'Light', 'celia-aubry' ),
								),
								'default_value' => 'light',
								'return_format' => 'value',
							),
						),
					),
					'layout_' . $key . '_title_content_link' => array(
						'key'        => 'layout_' . $key . '_title_content_link',
						'name'       => 'title_content_link',
						'label'      => __( 'Title, Content & link', 'celia-aubry' ),
						'display'    => 'block',
						'sub_fields' => array(
							array(
								'key'          => 'field_' . $key . '_title_content_link_title',
								'label'        => __( 'Title', 'celia-aubry' ),
								'name'         => 'title',
								'type'         => 'text',
								'placeholder'  => __( 'Title', 'celia-aubry' ),
								'instructions' => __( 'Indicate the title of the block. (Optional)', 'celia-aubry' ),
							),
							array(
								'key'          => 'field_' . $key . '_title_content_link_content',
								'label'        => __( 'Content', 'celia-aubry' ),
								'name'         => 'content',
								'type'         => 'wysiwyg',
								'tabs'         => 'all',
								'toolbar'      => 'full',
								'media_upload' => 0,
								'instructions' => __( 'Indicate the content of the block. (Optional)', 'celia-aubry' ),
							),
							array(
								'key'           => 'field_' . $key . '_title_content_link_link',
								'label'         => __( 'Link', 'celia-aubry' ),
								'name'          => 'link',
								'type'          => 'link',
								'return_format' => 'array',
								'instructions'  => __( 'Indicate the link of the block. (Optional)', 'celia-aubry' ),
							),
							array(
								'key'           => 'field_' . $key . '_title_content_link_background_color',
								'label'         => __( 'Background Color', 'celia-aubry' ),
								'name'          => 'background_color',
								'type'          => 'select',
								'choices'       => array(
									'dark'  => __( 'Dark', 'celia-aubry' ),
									'beige' => __( 'Beige', 'celia-aubry' ),
									'light' => __( 'Light', 'celia-aubry' ),
								),
								'default_value' => 'light',
								'return_format' => 'value',
							),
						),
					),
					'layout_' . $key . '_image_content' => array(
						'key'        => 'layout_' . $key . '_image_content',
						'name'       => 'image_content',
						'label'      => __( 'Image & Content', 'celia-aubry' ),
						'display'    => 'block',
						'sub_fields' => array(
							array(
								'key'           => 'field_' . $key . '_image_content_image',
								'label'         => __( 'Image', 'celia-aubry' ),
								'name'          => 'image',
								'type'          => 'image',
								'return_format' => 'id',
								'library'       => 'all',
								'instructions'  => __( 'Indicate the image of the block. (Optional)', 'celia-aubry' ),
								'preview_size'  => 'full',
								'wrapper'       => array( 'width' => 1 / 3 * 100 ),
							),
							array(
								'key'          => 'field_' . $key . '_image_content_content',
								'label'        => __( 'Content', 'celia-aubry' ),
								'name'         => 'content',
								'type'         => 'wysiwyg',
								'tabs'         => 'all',
								'toolbar'      => 'full',
								'wrapper'      => array( 'width' => 2 / 3 * 100 ),
								'instructions' => __( 'Indicate the content of the block. (Optional)', 'celia-aubry' ),
							),
						),
					),
					'layout_' . $key . '_title_content_images' => array(
						'key'        => 'layout_' . $key . '_title_content_images',
						'name'       => 'title_content_images',
						'label'      => __( 'Title, Content & Images', 'celia-aubry' ),
						'display'    => 'block',
						'sub_fields' => array(
							array(
								'key'         => 'field_' . $key . '_title_content_images_title',
								'label'       => __( 'Title', 'celia-aubry' ),
								'name'        => 'title',
								'type'        => 'text',
								'placeholder' => __( 'Title', 'celia-aubry' ),
							),
							array(
								'key'          => 'field_' . $key . '_title_content_images_content',
								'label'        => __( 'Content', 'celia-aubry' ),
								'name'         => 'content',
								'type'         => 'wysiwyg',
								'tabs'         => 'all',
								'toolbar'      => 'full',
								'instructions' => __( 'Indicate the image of the block. (Optional)', 'celia-aubry' ),
							),
							array(
								'key'           => 'field_' . $key . '_title_content_images_images',
								'label'         => __( 'Images', 'celia-aubry' ),
								'name'          => 'images',
								'type'          => 'gallery',
								'return_format' => 'id',
								'library'       => 'all',
							),
						),
					),
					'layout_' . $key . '_image'         => array(
						'key'        => 'layout_' . $key . '_image',
						'name'       => 'image',
						'label'      => __( 'Image', 'celia-aubry' ),
						'display'    => 'block',
						'sub_fields' => array(
							array(
								'key'           => 'field_' . $key . '_image_image',
								'label'         => __( 'Image', 'celia-aubry' ),
								'name'          => 'image',
								'type'          => 'image',
								'return_format' => 'id',
								'library'       => 'all',
								'preview_size'  => 'full',
							),
							array(
								'key'           => 'field_' . $key . '_image_aspect_ratio',
								'label'         => __( 'Aspect Ratio', 'celia-aubry' ),
								'name'          => 'aspect_ratio',
								'type'          => 'select',
								'instructions'  => __( 'Aspect ratio of the image. (Default auto)', 'celia-aubry' ),
								'choices'       => array(
									'auto'   => __( 'Auto', 'celia-aubry' ),
									'square' => __( '1 / 1', 'celia-aubry' ),
									'2/1'    => __( '2 / 1', 'celia-aubry' ),
									'video'  => __( '16 / 9', 'celia-aubry' ),
								),
								'default_value' => 'auto',
								'return_format' => 'value',
								'wrapper'       => array(
									'width' => 4 / 12 * 100,
								),
							),
							array(
								'key'     => 'field_' . $key . '_image_margins',
								'label'   => __( 'Margins', 'celia-aubry' ),
								'name'    => 'margins',
								'type'    => 'true_false',
								'wrapper' => array(
									'width' => 4 / 12 * 100,
								),
								'message' => __( 'Does the block have margins?', 'celia-aubry' ),
							),
							array(
								'key'     => 'field_' . $key . '_image_full_width',
								'label'   => __( 'Full Width', 'celia-aubry' ),
								'name'    => 'full_width',
								'type'    => 'true_false',
								'wrapper' => array(
									'width' => 4 / 12 * 100,
								),
								'message' => __( 'Is the image full width?', 'celia-aubry' ),
							),
						),
					),
					'layout_' . $key . '_case_studies_grid' => array(
						'key'        => 'layout_' . $key . '_case_studies_grid',
						'name'       => 'case_studies_grid',
						'label'      => __( 'Case Studies Grid', 'celia-aubry' ),
						'display'    => 'block',
						'sub_fields' => array(
							array(
								'key'         => 'field_' . $key . '_case_studies_grid_title',
								'label'       => __( 'Title', 'celia-aubry' ),
								'name'        => 'title',
								'type'        => 'text',
								'placeholder' => __( 'Title', 'celia-aubry' ),
							),
							array(
								'key'           => 'field_' . $key . '_case_studies_grid_categories',
								'label'         => __( 'Categories', 'celia-aubry' ),
								'name'          => 'categories',
								'type'          => 'taxonomy',
								'taxonomy'      => 'case_study_cat',
								'add_term'      => 0,
								'save_terms'    => 0,
								'load_terms'    => 0,
								'return_format' => 'id',
								'field_type'    => 'multi_select',
								'allow_null'    => 1,
							),
						),
					),
					'layout_' . $key . '_case_studies_list' => array(
						'key'        => 'layout_' . $key . '_case_studies_list',
						'name'       => 'case_studies_list',
						'label'      => __( 'Case Studies List', 'celia-aubry' ),
						'display'    => 'block',
						'sub_fields' => array(
							array(
								'key'         => 'field_' . $key . '_case_studies_list_title',
								'label'       => __( 'Title', 'celia-aubry' ),
								'name'        => 'title',
								'type'        => 'text',
								'placeholder' => __( 'Title', 'celia-aubry' ),
							),
							array(
								'key'           => 'field_' . $key . '_case_studies_list_case_studies',
								'label'         => __( 'Case Studies', 'celia-aubry' ),
								'name'          => 'case_studies',
								'type'          => 'relationship',
								'post_type'     => array( 'case_study' ),
								'filters'       => array( 'search' ),
								'return_format' => 'id',
							),
						),
					),
					'layout_' . $key . '_timeline'      => array(
						'key'        => 'layout_' . $key . '_timeline',
						'name'       => 'timeline',
						'label'      => __( 'Timeline', 'celia-aubry' ),
						'display'    => 'block',
						'sub_fields' => array(
							array(
								'key'         => 'field_' . $key . '_timeline_title',
								'label'       => __( 'Title', 'celia-aubry' ),
								'name'        => 'title',
								'type'        => 'text',
								'placeholder' => __( 'Title', 'celia-aubry' ),
							),
							array(
								'key'          => 'field_' . $key . '_timeline_items',
								'label'        => __( 'Items', 'celia-aubry' ),
								'name'         => 'items',
								'type'         => 'repeater',
								'layout'       => 'block',
								'button_label' => __( 'Add Item', 'celia-aubry' ),
								'sub_fields'   => array(
									array(
										'key'             => 'field_' . $key . '_timeline_items_title',
										'label'           => __( 'Title', 'celia-aubry' ),
										'name'            => 'title',
										'type'            => 'text',
										'wrapper'         => array( 'width' => 7 / 24 * 100 ),
										'placeholder'     => __( 'Title', 'celia-aubry' ),
										'parent_repeater' => 'field_' . $key . '_timeline_items',
									),
									array(
										'key'             => 'field_' . $key . '_timeline_items_content',
										'label'           => __( 'Content', 'celia-aubry' ),
										'name'            => 'content',
										'wrapper'         => array( 'width' => 17 / 24 * 100 ),
										'type'            => 'wysiwyg',
										'tabs'            => 'all',
										'toolbar'         => 'full',
										'media_upload'    => 0,
										'parent_repeater' => 'field_' . $key . '_timeline_items',
									),
								),
							),
						),
					),
					'layout_' . $key . '_testimonials'  => array(
						'key'        => 'layout_' . $key . '_testimonials',
						'name'       => 'testimonials',
						'label'      => __( 'Testimonials', 'celia-aubry' ),
						'display'    => 'block',
						'sub_fields' => array(
							array(
								'key'         => 'field_' . $key . '_testimonials_title',
								'label'       => __( 'Title', 'celia-aubry' ),
								'name'        => 'title',
								'type'        => 'text',
								'placeholder' => __( 'Title', 'celia-aubry' ),
							),
							array(
								'key'          => 'field_' . $key . '_testimonials_items',
								'label'        => __( 'Items', 'celia-aubry' ),
								'name'         => 'items',
								'type'         => 'repeater',
								'layout'       => 'block',
								'button_label' => __( 'Add Item', 'celia-aubry' ),
								'sub_fields'   => array(
									array(
										'key'             => 'field_' . $key . '_testimonials_items_title',
										'label'           => __( 'Title', 'celia-aubry' ),
										'name'            => 'title',
										'type'            => 'text',
										'placeholder'     => __( 'Title', 'celia-aubry' ),
										'parent_repeater' => 'field_' . $key . '_testimonials_items',
									),
									array(
										'key'             => 'field_' . $key . '_testimonials_items_position',
										'label'           => __( 'Position', 'celia-aubry' ),
										'name'            => 'position',
										'type'            => 'text',
										'placeholder'     => __( 'Position', 'celia-aubry' ),
										'parent_repeater' => 'field_' . $key . '_testimonials_items',
									),
									array(
										'key'             => 'field_' . $key . '_testimonials_items_content',
										'label'           => __( 'Content', 'celia-aubry' ),
										'name'            => 'content',
										'type'            => 'textarea',
										'rows'            => 4,
										'placeholder'     => __( 'Content', 'celia-aubry' ),
										'new_lines'       => 'br',
										'parent_repeater' => 'field_' . $key . '_testimonials_items',
									),
								),
							),
							array(
								'key'           => 'field_' . $key . '_testimonials_link',
								'label'         => __( 'Link', 'celia-aubry' ),
								'name'          => 'link',
								'type'          => 'link',
								'return_format' => 'array',
							),
						),
					),
					'layout_' . $key . '_read_more'     => array(
						'key'        => 'layout_' . $key . '_read_more',
						'name'       => 'read_more',
						'label'      => __( 'Read More', 'celia-aubry' ),
						'display'    => 'block',
						'sub_fields' => array(
							array(
								'key'         => 'field_' . $key . '_read_more_title',
								'label'       => __( 'Title', 'celia-aubry' ),
								'name'        => 'title',
								'type'        => 'text',
								'placeholder' => __( 'Title', 'celia-aubry' ),
							),
							array(
								'key'          => 'field_' . $key . '_read_more_content',
								'label'        => __( 'Content', 'celia-aubry' ),
								'name'         => 'content',
								'type'         => 'wysiwyg',
								'tabs'         => 'all',
								'toolbar'      => 'full',
								'media_upload' => 0,
							),
							array(
								'key'           => 'field_' . $key . '_read_more_image',
								'label'         => __( 'Image', 'celia-aubry' ),
								'name'          => 'image',
								'type'          => 'image',
								'return_format' => 'id',
								'library'       => 'all',
								'preview_size'  => 'full',
							),
						),
					),
					'layout_' . $key . '_case_study_categories' => array(
						'key'        => 'layout_' . $key . '_case_study_categories',
						'name'       => 'case_study_categories',
						'label'      => __( 'Case Study Categories', 'celia-aubry' ),
						'display'    => 'block',
						'sub_fields' => array(
							array(
								'key'         => 'field_' . $key . '_case_study_categories_title',
								'label'       => __( 'Title', 'celia-aubry' ),
								'name'        => 'title',
								'type'        => 'text',
								'placeholder' => __( 'Title', 'celia-aubry' ),
							),
							array(
								'key'          => 'field_' . $key . '_case_study_categories_categories',
								'label'        => __( 'Categories', 'celia-aubry' ),
								'name'         => 'categories',
								'type'         => 'repeater',
								'layout'       => 'block',
								'button_label' => __( 'Add Category', 'celia-aubry' ),
								'sub_fields'   => array(
									array(
										'key'             => 'field_' . $key . '_case_study_categories_categories_category',
										'label'           => __( 'Category', 'celia-aubry' ),
										'name'            => 'category',
										'type'            => 'taxonomy',
										'taxonomy'        => 'case_study_cat',
										'add_term'        => 0,
										'save_terms'      => 0,
										'load_terms'      => 0,
										'return_format'   => 'id',
										'field_type'      => 'select',
										'allow_null'      => 0,
										'parent_repeater' => 'field_' . $key . '_case_study_categories_categories',
										'wrapper'         => array( 'width' => 7 / 12 * 100 ),
									),
									array(
										'key'             => 'field_' . $key . '_case_study_categories_categories_case_study',
										'label'           => __( 'Case Study', 'celia-aubry' ),
										'name'            => 'case_study',
										'type'            => 'post_object',
										'post_type'       => array( 'case_study' ),
										'return_format'   => 'id',
										'multiple'        => 0,
										'allow_null'      => 0,
										'parent_repeater' => 'field_' . $key . '_case_study_categories_categories',
										'wrapper'         => array( 'width' => 5 / 12 * 100 ),
									),
								),
							),
						),
					),
					'layout_' . $key . '_key_figures'   => array(
						'key'        => 'layout_' . $key . '_key_figures',
						'name'       => 'key_figures',
						'label'      => __( 'Key Figures', 'celia-aubry' ),
						'display'    => 'block',
						'sub_fields' => array(
							array(
								'key'         => 'field_' . $key . '_key_figures_title',
								'label'       => __( 'Title', 'celia-aubry' ),
								'name'        => 'title',
								'type'        => 'text',
								'placeholder' => __( 'Title', 'celia-aubry' ),
							),
							array(
								'key'          => 'field_' . $key . '_key_figures_key_figures',
								'label'        => __( 'Key Figures', 'celia-aubry' ),
								'name'         => 'key_figures',
								'type'         => 'repeater',
								'layout'       => 'block',
								'min'          => 0,
								'max'          => 3,
								'button_label' => __( 'Add Key Figure', 'celia-aubry' ),
								'instructions' => __( 'Indicate the key figures of the block. (Up to 3 maximum)', 'celia-aubry' ),
								'sub_fields'   => array(
									array(
										'key'             => 'field_' . $key . '_key_figures_key_figures_key_figure',
										'label'           => __( 'Key Figure', 'celia-aubry' ),
										'name'            => 'key_figure',
										'type'            => 'text',
										'placeholder'     => __( 'Key Figure', 'celia-aubry' ),
										'parent_repeater' => 'field_' . $key . '_key_figures_key_figures',
									),
									array(
										'key'             => 'field_' . $key . '_key_figures_key_figures_content',
										'label'           => __( 'Content', 'celia-aubry' ),
										'name'            => 'content',
										'type'            => 'textarea',
										'rows'            => 2,
										'placeholder'     => __( 'Content', 'celia-aubry' ),
										'new_lines'       => 'br',
										'parent_repeater' => 'field_' . $key . '_key_figures_key_figures',
									),
								),
							),
						),
					),
				),
				'button_label' => __( 'Add Block', 'celia-aubry' ),
			),
		);

		acf_add_local_field_group(
			array(
				'key'            => 'group_' . $key,
				'title'          => __( 'Blocks Fields', 'celia-aubry' ),
				'fields'         => $fields,
				'location'       => $location,
				'menu_order'     => 1,
				'hide_on_screen' => $hide_on_screen,
			)
		);
	}
}
