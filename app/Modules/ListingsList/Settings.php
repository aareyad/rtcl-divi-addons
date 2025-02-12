<?php

namespace RtclDiviAddons\Modules\ListingsList;

use Rtcl\Helpers\Functions;
use RtclDiviAddons\Helpers\Functions as DiviFunctions;

class Settings extends \ET_Builder_Module {
	public $slug = 'rtcl_listings_list';
	public $vb_support = 'on';

	public function init() {
		$this->name = esc_html__( 'Listings List', 'rtcl-divi-addons' );

		$this->settings_modal_toggles = [
			'general'  => [
				'toggles' => [
					'layout'             => esc_html__( 'General', 'rtcl-divi-addons' ),
					'general'            => esc_html__( 'Query', 'rtcl-divi-addons' ),
					'content_visibility' => esc_html__( 'Visibility', 'rtcl-divi-addons' ),
				],
			],
			'advanced' => [
				'toggles' => [
					'title' => esc_html__( 'Title', 'rtcl-divi-addons' ),
					'price' => esc_html__( 'Price', 'rtcl-divi-addons' ),
					'meta'  => esc_html__( 'Meta', 'rtcl-divi-addons' ),
				],
			],
		];
	}

	public function get_fields() {
		$category_dropdown = DiviFunctions::get_listing_taxonomy( 'parent' );
		$location_dropdown = DiviFunctions::get_listing_taxonomy( 'parent', rtcl()->location );
		$listing_order_by  = DiviFunctions::get_order_options();

		return [
			'rtcl_list_style'          => [
				'label'       => esc_html__( 'Style', 'rtcl-divi-addons' ),
				'type'        => 'select',
				'options'     => [
					'style-1' => __( 'Style 1', 'rtcl-divi-addons' ),
					'style-2' => __( 'Style 2', 'rtcl-divi-addons' ),
				],
				'default'     => 'style-1',
				'tab_slug'    => 'general',
				'toggle_slug' => 'layout',
			],
			'rtcl_listing_types'       => [
				'label'       => esc_html__( 'Listing Types', 'rtcl-divi-addons' ),
				'type'        => 'select',
				'options'     => array_merge(
					[
						'all' => 'All',
					],
					Functions::get_listing_types()
				),
				'default'     => 'all',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'rtcl_listing_categories'  => [
				'label'       => esc_html__( 'Categories', 'rtcl-divi-addons' ),
				'type'        => 'select',
				'options'     => $category_dropdown,
				'default'     => 'all',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'rtcl_listing_location'    => [
				'label'       => esc_html__( 'Location', 'rtcl-divi-addons' ),
				'type'        => 'select',
				'options'     => $location_dropdown,
				'default'     => 'all',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'rtcl_listing_per_page'    => [
				'label'       => esc_html__( 'Listing Per Page', 'rtcl-divi-addons' ),
				'type'        => 'number',
				'default'     => '10',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
				'description' => esc_html__( 'Number of listing to display', 'rtcl-divi-addons' ),
			],
			'rtcl_listing_pagination'  => [
				'label'       => esc_html__( 'Listing Pagination', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'off',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'rtcl_orderby'             => [
				'label'       => esc_html__( 'Order By', 'rtcl-divi-addons' ),
				'type'        => 'select',
				'options'     => $listing_order_by,
				'default'     => 'date',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'rtcl_sortby'              => [
				'label'       => esc_html__( 'Sort By', 'rtcl-divi-addons' ),
				'type'        => 'select',
				'options'     => [
					'asc'  => __( 'Ascending', 'rtcl-divi-addons' ),
					'desc' => __( 'Descending', 'rtcl-divi-addons' ),
				],
				'default'     => 'desc',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'rtcl_image_size'          => [
				'label'            => esc_html__( 'Image Size', 'rtcl-divi-addons' ),
				'type'             => 'select',
				'options'          => DiviFunctions::get_image_sizes_select(),
				'default'          => 'rtcl-thumbnail',
				'computed_affects' => [
					'__html',
				],
				'tab_slug'         => 'general',
				'toggle_slug'      => 'layout',
			],
			'rtcl_no_listing_text'     => [
				'label'       => esc_html__( 'No Listing Text', 'rtcl-divi-addons' ),
				'type'        => 'text',
				'default'     => esc_html__( 'No Listing Found', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'layout',
			],
			// computed.
			'__listings'               => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'Settings', 'get_listings' ),
				'computed_depends_on' => array(
					'rtcl_listing_types',
					'rtcl_listing_categories',
					'rtcl_listing_location',
					'rtcl_orderby',
					'rtcl_sortby',
					'rtcl_listing_per_page',
					'rtcl_image_size',
					'rtcl_listing_pagination'
				)
			),
			// visibility
			'rtcl_show_image'          => [
				'label'       => esc_html__( 'Show Image', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'description' => __( 'Show / Hide listing image.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'content_visibility',
			],
			'rtcl_show_description'    => [
				'label'       => esc_html__( 'Show Description', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'off',
				'description' => __( 'Show / Hide listing description.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'content_visibility',
			],
			'rtcl_content_limit'       => [
				'label'       => esc_html__( 'Description Limit', 'rtcl-divi-addons' ),
				'type'        => 'number',
				'default'     => '20',
				'description' => __( 'Number of words to display.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'content_visibility',
				'show_if'     => [
					'rtcl_show_description' => 'on',
				],
			],
			'rtcl_show_labels'         => [
				'label'       => esc_html__( 'Show Badge', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'description' => __( 'Show / Hide listing badge.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'content_visibility',
			],
			'rtcl_show_date'           => [
				'label'       => esc_html__( 'Show Date', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'description' => __( 'Show / Hide listing date.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'content_visibility',
			],
			'rtcl_show_views'          => [
				'label'       => esc_html__( 'Show View Count', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'description' => __( 'Show / Hide listing views.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'content_visibility',
			],
			'rtcl_show_ad_types'       => [
				'label'       => esc_html__( 'Show Ad Type', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'description' => __( 'Show / Hide listing ad type.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'content_visibility',
			],
			'rtcl_show_location'       => [
				'label'       => esc_html__( 'Show Location', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'description' => __( 'Show / Hide listing location.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'content_visibility',
			],
			'rtcl_show_category'       => [
				'label'       => esc_html__( 'Show Category', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'description' => __( 'Show / Hide listing categories.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'content_visibility',
			],
			'rtcl_show_price'          => [
				'label'       => esc_html__( 'Show Price', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'description' => __( 'Show / Hide listing price.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'content_visibility',
			],
			'rtcl_show_custom_fields'  => [
				'label'       => esc_html__( 'Show Custom Fields', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'off',
				'description' => __( 'Show / Hide listing custom fields.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'content_visibility',
			],
			'rtcl_show_user'           => [
				'label'       => esc_html__( 'Show Author Name', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'description' => __( 'Show / Hide listing author name.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'content_visibility',
			],
			'rtcl_show_details_button' => [
				'label'       => esc_html__( 'Show Details Button', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'description' => __( 'Show / Hide listing details button.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'content_visibility',
			],
			'rtcl_show_favourites'     => [
				'label'       => esc_html__( 'Show Favourites', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'off',
				'description' => __( 'Show / Hide listing favourite button.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'content_visibility',
			],
			'rtcl_show_quick_view'     => [
				'label'       => esc_html__( 'Show Quick View', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'off',
				'description' => __( 'Show / Hide quick view button.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'content_visibility',
			],
			'rtcl_show_compare'        => [
				'label'       => esc_html__( 'Show Compare', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'off',
				'description' => __( 'Show / Hide compare button.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'content_visibility',
			],
			// Style
			'rtcl_title_color'         => [
				'label'       => esc_html__( 'Title Color', 'rtcl-divi-addons' ),
				'description' => esc_html__( 'Here you can define a custom color for listing title.', 'rtcl-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'title',
				'hover'       => 'tabs',
			],
			'rtcl_meta_color'          => [
				'label'       => esc_html__( 'Meta Color', 'rtcl-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'meta',
			],
			'rtcl_meta_icon_color'     => [
				'label'       => esc_html__( 'Meta Icon Color', 'rtcl-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'meta',
			],
			'rtcl_meta_category_color' => [
				'label'       => esc_html__( 'Category Color', 'rtcl-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'meta',
				'hover'       => 'tabs',
			],
			'rtcl_price_color'         => [
				'label'       => esc_html__( 'Price Color', 'rtcl-divi-addons' ),
				'description' => esc_html__( 'Here you can define a custom color for listing price.', 'rtcl-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'price',
			],
		];
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = [];
		$advanced_fields['text']        = [];
		$advanced_fields['text_shadow'] = [];

		$advanced_fields['fonts'] = [
			'title' => [
				'css'              => array(
					'main' => '.et-db .et-l %%order_class%% .rtcl-listings-wrapper .rtcl-listing-title',
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
			'meta'  => [
				'css'              => array(
					'main' => '.et-db .et-l %%order_class%% .rtcl-listings-wrapper .rtcl-listing-meta-data li',
				),
				'important'        => 'all',
				'hide_text_color'  => true,
				'hide_text_shadow' => true,
				'hide_text_align'  => true,
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'meta',
				'line_height'      => array(
					'range_settings' => array(
						'min'  => '1',
						'max'  => '3',
						'step' => '.1',
					),
					'default'        => '1.2em',
				),
				'font_size'        => array(
					'default' => '16px',
				),
				'font'             => [
					'default' => '|400|||||||',
				],
			],
			'price' => [
				'css'              => array(
					'main' => '.et-db .et-l %%order_class%% .rtcl-listings-wrapper .rtcl-listings .item-price .rtcl-price .rtcl-price-amount',
				),
				'important'        => 'all',
				'hide_text_color'  => true,
				'hide_text_shadow' => true,
				'hide_text_align'  => true,
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'price',
				'line_height'      => array(
					'range_settings' => array(
						'min'  => '1',
						'max'  => '3',
						'step' => '.1',
					),
					'default'        => '1.3em',
				),
				'font_size'        => array(
					'default' => '20px',
				),
				'font'             => [
					'default' => '|600|||||||',
				],
			]
		];

		return $advanced_fields;
	}

	public static function get_listings( $args = array(), $conditional_tags = array(), $current_page = array() ) {
		return false;
	}
}