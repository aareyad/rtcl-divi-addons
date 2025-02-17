<?php

namespace RtclDiviAddons\Modules\ListingCategories;

use Rtcl\Helpers\Functions;
use RtclDiviAddons\Helpers\Functions as DiviFunctions;

class Settings extends \ET_Builder_Module {
	public $slug = 'rtcl_listing_categories';
	public $vb_support = 'on';
	public $icon_path;

	protected $module_credits
		= [
			'author'     => 'RadiusTheme',
			'author_uri' => 'https://radiustheme.com',
		];

	public function init() {
		$this->name      = esc_html__( 'Listing Categories', 'rtcl-divi-addons' );
		$this->icon_path = plugin_dir_path( __FILE__ ) . 'icon.svg';

		$this->settings_modal_toggles = [
			'general'  => [
				'toggles' => [
					'general'    => esc_html__( 'General', 'rtcl-divi-addons' ),
					'query'      => esc_html__( 'Query', 'rtcl-divi-addons' ),
					'visibility' => esc_html__( 'Visibility', 'rtcl-divi-addons' ),
				],
			],
			'advanced' => [
				'toggles' => [
					'card'        => esc_html__( 'Card', 'rtcl-divi-addons' ),
					'title'       => esc_html__( 'Title', 'rtcl-divi-addons' ),
					'description' => esc_html__( 'Content', 'rtcl-divi-addons' ),
					'count'       => esc_html__( 'Count', 'rtcl-divi-addons' ),
				],
			],
		];
	}

	public function get_fields() {
		$category_dropdown = DiviFunctions::get_listing_taxonomy( 'parent' );

		return [
			'rtcl_cats_style'        => [
				'label'       => esc_html__( 'Style', 'rtcl-divi-addons' ),
				'type'        => 'select',
				'options'     => [
					'style-1' => __( 'Style 1', 'rtcl-divi-addons' ),
				],
				'default'     => 'style-1',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'rtcl_grid_column'       => [
				'label'          => esc_html__( 'Grid Column', 'rtcl-divi-addons' ),
				'type'           => 'select',
				'options'        => [
					'4' => __( 'Column 4', 'rtcl-divi-addons' ),
					'3' => __( 'Column 3', 'rtcl-divi-addons' ),
					'2' => __( 'Column 2', 'rtcl-divi-addons' ),
					'1' => __( 'Column 1', 'rtcl-divi-addons' ),
				],
				'default'        => '3',
				'description'    => esc_html__( 'Select column number to display categories.', 'rtcl-divi-addons' ),
				'mobile_options' => true,
				'tab_slug'       => 'general',
				'toggle_slug'    => 'general',
			],
			'rtcl_cats'              => [
				'label'       => esc_html__( 'Categories', 'rtcl-divi-addons' ),
				'type'        => 'multiple_checkboxes',
				'options'     => $category_dropdown,
				'description' => esc_html__( 'Leave checkboxes unchecked to select all', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'query',
			],
			'rtcl_category_limit'    => [
				'label'       => esc_html__( 'Limit', 'rtcl-divi-addons' ),
				'type'        => 'number',
				'default'     => '10',
				'tab_slug'    => 'general',
				'toggle_slug' => 'query',
				'description' => esc_html__( 'Number of category to display', 'rtcl-divi-addons' ),
			],
			'rtcl_orderby'           => [
				'label'       => esc_html__( 'Order By', 'rtcl-divi-addons' ),
				'type'        => 'select',
				'options'     => [
					'none'    => esc_html__( 'None', 'rtcl-divi-addons' ),
					'term_id' => esc_html__( 'ID', 'rtcl-divi-addons' ),
					'date'    => esc_html__( 'Date', 'rtcl-divi-addons' ),
					'name'    => esc_html__( 'Title', 'rtcl-divi-addons' ),
					'count'   => esc_html__( 'Count', 'rtcl-divi-addons' ),
					'custom'  => esc_html__( 'Custom Order', 'rtcl-divi-addons' ),
				],
				'default'     => 'name',
				'tab_slug'    => 'general',
				'toggle_slug' => 'query',
			],
			'rtcl_order'             => [
				'label'       => esc_html__( 'Sort By', 'rtcl-divi-addons' ),
				'type'        => 'select',
				'options'     => [
					'asc'  => __( 'Ascending', 'rtcl-divi-addons' ),
					'desc' => __( 'Descending', 'rtcl-divi-addons' ),
				],
				'default'     => 'asc',
				'tab_slug'    => 'general',
				'toggle_slug' => 'query',
			],
			'rtcl_hide_empty'        => [
				'label'       => esc_html__( 'Hide Empty', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'off',
				'description' => __( 'Show / Hide categories that has no listings.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'query',
			],
			// computed.
			'__categories'           => array(
				'type'                => 'computed',
				'computed_callback'   => array( Settings::class, 'get_content' ),
				'computed_depends_on' => array(
					'rtcl_cats',
					'rtcl_category_limit',
					'rtcl_orderby',
					'rtcl_order',
					'rtcl_hide_empty'
				)
			),
			// visibility
			'rtcl_show_image'        => [
				'label'       => esc_html__( 'Show Image / Icon', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'description' => __( 'Show / Hide listing image or icon.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'visibility',
			],
			'rtcl_icon_type'         => [
				'label'       => esc_html__( 'Icon Type', 'rtcl-divi-addons' ),
				'type'        => 'select',
				'options'     => [
					'image' => __( 'Image', 'rtcl-divi-addons' ),
					'icon'  => __( 'Icon', 'rtcl-divi-addons' ),
				],
				'show_if'     => [
					'rtcl_show_image' => 'on',
				],
				'default'     => 'image',
				'tab_slug'    => 'general',
				'toggle_slug' => 'visibility',
			],
			'rtcl_show_count'        => [
				'label'       => esc_html__( 'Show Count', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'description' => __( 'Show / Hide listing counts.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'visibility',
			],
			'rtcl_description'       => [
				'label'       => esc_html__( 'Show Description', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'off',
				'description' => __( 'Show / Hide category description.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'visibility',
			],
			'rtcl_content_limit'     => [
				'label'       => esc_html__( 'Description Limit', 'rtcl-divi-addons' ),
				'type'        => 'number',
				'default'     => '20',
				'description' => __( 'Number of words to display.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'visibility',
				'show_if'     => [
					'rtcl_description' => 'on',
				],
			],
			// Style
			'rtcl_content_alignment' => [
				'label'       => esc_html__( 'Content Alignment', 'rtcl-divi-addons' ),
				'type'        => 'text_align',
				'options'     => et_builder_get_text_orientation_options( [ 'justified' ] ),
				'default'     => 'center',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'card',
			],
			'rtcl_title_color'       => [
				'label'       => esc_html__( 'Name Color', 'rtcl-divi-addons' ),
				'description' => esc_html__( 'Here you can define a custom color for category name.', 'rtcl-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'title',
				'hover'       => 'tabs',
			],
			'rtcl_desc_color'        => [
				'label'       => esc_html__( 'Description Color', 'rtcl-divi-addons' ),
				'description' => esc_html__( 'Here you can define a custom color for category description.', 'rtcl-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'description'
			],
			'rtcl_count_color'       => [
				'label'       => esc_html__( 'Count Color', 'rtcl-divi-addons' ),
				'description' => esc_html__( 'Here you can define a custom color for listing count.', 'rtcl-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'count',
			],
			'rtcl_count_text_size'   => [
				'label'          => esc_html__( 'Count Font Size', 'rtcl-divi-addons' ),
				'description'    => esc_html__( 'Here you can define font size for listing count.', 'rtcl-divi-addons' ),
				'type'           => 'range',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'count',
				'default'        => '16px',
				'allowed_units'  => [ 'px' ],
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 40,
				),
			],
		];
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = [];
		$advanced_fields['text']        = [];
		$advanced_fields['text_shadow'] = [];

		$advanced_fields['fonts'] = [
			'title'       => [
				'css'              => array(
					'main' => '.et-db .et-l %%order_class%% .rtcl-categories-wrapper .rtcl-category-title',
				),
				'important'        => 'all',
				'hide_text_color'  => true,
				'hide_text_shadow' => true,
				'hide_text_align'  => true,
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'title',
				'line_height'      => array(
					'range_settings' => array(
						'min'  => '1',
						'max'  => '3',
						'step' => '.1',
					),
					'default'        => '1.2em',
				),
				'font_size'        => array(
					'default' => '18px',
				),
				'font'             => [
					'default' => '|700|||||||',
				],
			],
			'description' => [
				'css'              => array(
					'main' => '.et-db .et-l %%order_class%% .rtcl-categories-wrapper .cat-details-inner p',
				),
				'important'        => 'all',
				'hide_text_color'  => true,
				'hide_text_shadow' => true,
				'hide_text_align'  => true,
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'description',
				'line_height'      => array(
					'range_settings' => array(
						'min'  => '1',
						'max'  => '3',
						'step' => '.1',
					),
					'default'        => '1.6em',
				),
				'font_size'        => array(
					'default' => '16px',
				),
				'font'             => [
					'default' => '|400|||||||',
				],
			]
		];

		$advanced_fields['margin_padding'] = [
			'css'         => [
				'main'      => '%%order_class%% .rtcl-cat-item .cat-details',
				'important' => 'all',
			],
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'card',
		];

		return $advanced_fields;
	}

	public static function get_content( $args = [] ) {
		$category_includes = ! empty( $args['rtcl_cats'] ) ? $args['rtcl_cats'] : '';
		$category_includes = explode( '|', $category_includes );

		$category_terms = DiviFunctions::divi_get_user_selected_terms( $category_includes, rtcl()->category );

		$sort_terms = [];

		if ( ! empty( $category_terms ) ) {
			foreach ( $category_terms as $term_id ) {
				$sort_terms[]['value'] = $term_id;
			}
		}

		return $sort_terms;
	}
}