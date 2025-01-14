<?php

namespace RtclDiviAddons\Modules\ListingsGrid;

use Rtcl\Helpers\Functions;
use Rtcl\Helpers\Pagination;

class ListingsGrid extends \ET_Builder_Module {
	public $slug = 'rtcl_listings_grid';
	public $vb_support = 'on';

	public function init() {
		$this->name = esc_html__( 'Listings Grid', 'rtcl-divi-addons' );

		$this->settings_modal_toggles = [
			'general'  => [
				'toggles' => [
					'layout'             => esc_html__( 'Layout', 'rtcl-divi-addons' ),
					'general'            => esc_html__( 'General', 'rtcl-divi-addons' ),
					'content_visibility' => esc_html__( 'Content Visibility', 'rtcl-divi-addons' ),
				],
			],
			'advanced' => [
				'toggles' => [
					'title' => array(
						'title'             => esc_html__( 'Title', 'rtcl-divi-addons' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'rtcl-divi-addons' ),
							),
							'hover'  => array(
								'name' => esc_html__( 'Hover', 'rtcl-divi-addons' ),
							),
						),
					),
					'meta'  => array(
						'title'             => esc_html__( 'Meta', 'rtcl-divi-addons' ),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'rtcl-divi-addons' ),
							),
							'hover'  => array(
								'name' => esc_html__( 'Hover', 'rtcl-divi-addons' ),
							),
						),
					),
				],
			],
		];
	}

	public function get_fields() {
		$category_dropdown = $this->taxonomy_list( 'parent' );
		$location_dropdown = $this->taxonomy_list( 'parent', rtcl()->location );
		$listing_order_by  = [
			'title' => esc_html__( 'Title', 'rtcl-divi-addons' ),
			'date'  => esc_html__( 'Date', 'rtcl-divi-addons' ),
			'ID'    => esc_html__( 'ID', 'rtcl-divi-addons' ),
			'price' => esc_html__( 'Price', 'rtcl-divi-addons' ),
			'views' => esc_html__( 'Views', 'rtcl-divi-addons' ),
			'none'  => esc_html__( 'None', 'rtcl-divi-addons' ),
		];

		$listing_order_by = apply_filters( 'rtcl_divi_listing_order_by', $listing_order_by );

		return [
			'rtcl_grid_style'                => [
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
			'rtcl_grid_column'               => [
				'label'          => esc_html__( 'Grid Column', 'rtcl-divi-addons' ),
				'type'           => 'select',
				'options'        => [
					'4' => __( 'Column 4', 'rtcl-divi-addons' ),
					'3' => __( 'Column 3', 'rtcl-divi-addons' ),
					'2' => __( 'Column 2', 'rtcl-divi-addons' ),
					'1' => __( 'Column 1', 'rtcl-divi-addons' ),
				],
				'default'        => '3',
				'description'    => esc_html__( 'Select column number to display listings.', 'rtcl-divi-addons' ),
				'mobile_options' => true,
				'tab_slug'       => 'general',
				'toggle_slug'    => 'layout',
			],
			'rtcl_listing_types'             => [
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
			'rtcl_listing_categories'        => [
				'label'       => esc_html__( 'Categories', 'rtcl-divi-addons' ),
				'type'        => 'select',
				'options'     => $category_dropdown,
				'default'     => 'all',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'rtcl_listing_location'          => [
				'label'       => esc_html__( 'Location', 'rtcl-divi-addons' ),
				'type'        => 'select',
				'options'     => $location_dropdown,
				'default'     => 'all',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'rtcl_listing_per_page'          => [
				'label'       => esc_html__( 'Listing Per Page', 'rtcl-divi-addons' ),
				'type'        => 'number',
				'default'     => '10',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
				'description' => esc_html__( 'Number of listing to display', 'rtcl-divi-addons' ),
			],
			'rtcl_listing_pagination'        => [
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
			'rtcl_orderby'                   => [
				'label'       => esc_html__( 'Order By', 'rtcl-divi-addons' ),
				'type'        => 'select',
				'options'     => $listing_order_by,
				'default'     => 'date',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'rtcl_sortby'                    => [
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
			'rtcl_image_size'                => [
				'label'            => esc_html__( 'Image Size', 'rtcl-divi-addons' ),
				'type'             => 'select',
				'options'          => $this->get_image_sizes_select(),
				'default'          => 'rtcl-thumbnail',
				'computed_affects' => [
					'__html',
				],
				'tab_slug'         => 'general',
				'toggle_slug'      => 'general',
			],
			'rtcl_no_listing_text'           => [
				'label'       => esc_html__( 'No Listing Text', 'rtcl-divi-addons' ),
				'type'        => 'text',
				'default'     => esc_html__( 'No Listing Found', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'rtcl_show_image'                => [
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
			'rtcl_show_description'          => [
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
			'rtcl_content_limit'             => [
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
			'rtcl_show_labels'               => [
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
			'rtcl_show_details_button'       => [
				'label'       => esc_html__( 'Show Details Button', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'description' => __( 'Show / Hide listing button.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'content_visibility',
			],
			'rtcl_show_date'                 => [
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
			'rtcl_show_ad_types'             => [
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
			'rtcl_show_location'             => [
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
			'rtcl_show_category'             => [
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
			'rtcl_show_price'                => [
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
			'rtcl_show_user'                 => [
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
			// Style
			'rtcl_title_color'               => [
				'label'       => esc_html__( 'Title Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom color for listing title.', 'rtcl-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'title',
				'sub_toggle'  => 'normal',
			],
			'rtcl_title_hover_color'         => [
				'label'       => esc_html__( 'Title Hover Color', 'addons-for-divi' ),
				'description' => esc_html__( 'Here you can define a custom color for listing title.', 'rtcl-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'title',
				'sub_toggle'  => 'hover',
			],
			'rtcl_meta_color'                => [
				'label'       => esc_html__( 'Meta Color', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'meta',
				'sub_toggle'  => 'normal',
			],
			'rtcl_meta_icon_color'           => [
				'label'       => esc_html__( 'Meta Icon Color', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'meta',
				'sub_toggle'  => 'normal',
			],
			'rtcl_meta_category_color'       => [
				'label'       => esc_html__( 'Category Color', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'meta',
				'sub_toggle'  => 'normal',
			],
			'rtcl_meta_hover_color'          => [
				'label'       => esc_html__( 'Meta Hover Color', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'meta',
				'sub_toggle'  => 'hover',
			],
			'rtcl_meta_hover_icon_color'     => [
				'label'       => esc_html__( 'Meta Icon Hover Color', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'meta',
				'sub_toggle'  => 'hover',
			],
			'rtcl_meta_category_color_hover' => [
				'label'       => esc_html__( 'Category Hover Color', 'addons-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'meta',
				'sub_toggle'  => 'hover',
			],
		];
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = [];
		$advanced_fields['text']        = [];
		$advanced_fields['text_shadow'] = [];
		//$advanced_fields['fonts']       = [];

		$advanced_fields['fonts'] = [
			'title' => [
				'css'              => array(
					'main' => '%%order_class%% .rtcl-listing-title',
				),
				'important'        => 'all',
				'hide_text_color'  => true,
				'hide_text_shadow' => true,
				'hide_text_align'  => true,
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'title',
				'sub_toggle'       => 'normal',
				'line_height'      => array(
					'range_settings' => array(
						'min'  => '1',
						'max'  => '3',
						'step' => '.1',
					),
					'default'        => '1.2em',
				),
				'font_size'        => array(
					'default' => '24px',
				),
				'font'             => [
					'default' => '|700|||||||',
				],
			],
			'meta'  => [
				'css'              => array(
					'main' => '%%order_class%% .rtcl-listing-meta-data',
				),
				'important'        => 'all',
				'hide_text_color'  => true,
				'hide_text_shadow' => true,
				'hide_text_align'  => true,
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'meta',
				'sub_toggle'       => 'normal',
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
			]
		];

		return $advanced_fields;
	}

	protected function taxonomy_list( $parent = 'all', $taxonomy = '' ) {
		$args = [
			'taxonomy'   => rtcl()->category,
			'fields'     => 'id=>name',
			'hide_empty' => true,
		];

		if ( ! empty( $taxonomy ) ) {
			$args['taxonomy'] = sanitize_text_field( $taxonomy );
		}

		if ( 'parent' === $parent ) {
			$args['parent'] = 0;
		}

		$terms = get_terms( $args );

		$category_dropdown = [
			'all' => 'All',
		];

		foreach ( $terms as $id => $name ) {
			$category_dropdown[ $id ] = $name;
		}

		return $category_dropdown;
	}

	protected function get_image_sizes_select() {

		global $_wp_additional_image_sizes;

		$intermediate_image_sizes = get_intermediate_image_sizes();

		$image_sizes = array();
		foreach ( $intermediate_image_sizes as $size ) {
			if ( isset( $_wp_additional_image_sizes[ $size ] ) ) {
				$image_sizes[ $size ] = array(
					'width'  => $_wp_additional_image_sizes[ $size ]['width'],
					'height' => $_wp_additional_image_sizes[ $size ]['height']
				);
			} else {
				$image_sizes[ $size ] = array(
					'width'  => intval( get_option( "{$size}_size_w" ) ),
					'height' => intval( get_option( "{$size}_size_h" ) )
				);
			}
		}

		$sizes_arr = [];
		foreach ( $image_sizes as $key => $value ) {
			$sizes_arr[ $key ] = ucwords( strtolower( preg_replace( '/[-_]/', ' ', $key ) ) ) . " - {$value['width']} x {$value['height']}";
		}

		$sizes_arr['full'] = __( 'Full Size', 'rtcl-divi-addons' );

		return $sizes_arr;
	}

	public function widget_results() {
		$args = $this->widget_query_args();

		add_filter( 'excerpt_length', [ $this, 'excerpt_limit' ] );
		add_filter( 'excerpt_more', '__return_empty_string' );
		// The Query.
		$loop_obj = new \WP_Query( $args );

		return $loop_obj;
	}

	public function widget_query_args() {
		$settings = $this->props;

		$categories_list   = isset( $settings['rtcl_listing_categories'] ) && ! empty( $settings['rtcl_listing_categories'] )
			? $settings['rtcl_listing_categories'] : [];
		$location_list     = isset( $settings['rtcl_listing_location'] ) && ! empty( $settings['rtcl_listing_location'] ) ? $settings['rtcl_listing_location']
			: [];
		$orderby           = isset( $settings['rtcl_orderby'] ) && ! empty( $settings['rtcl_orderby'] ) ? $settings['rtcl_orderby'] : 'date';
		$order             = isset( $settings['rtcl_sortby'] ) && ! empty( $settings['rtcl_sortby'] ) ? $settings['rtcl_sortby'] : 'desc';
		$listings_per_page = isset( $settings['rtcl_listing_per_page'] ) && ! empty( $settings['rtcl_listing_per_page'] ) ? $settings['rtcl_listing_per_page']
			: '10';
		$listing_type      = isset( $settings['rtcl_listing_types'] ) && ! empty( $settings['rtcl_listing_types'] ) ? $settings['rtcl_listing_types'] : 'all';

		$meta_queries      = [];
		$the_args          = [
			'post_type'      => rtcl()->post_type,
			'posts_per_page' => $listings_per_page,
			'post_status'    => 'publish',
			'tax_query'      => [ // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
			                      'relation' => 'AND',
			],
		];
		$the_args['paged'] = Pagination::get_page_number();

		if ( ! empty( $order ) && ! empty( $orderby ) ) {

			switch ( $orderby ) {
				case 'price':
					$the_args['meta_key'] = $orderby; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
					$the_args['orderby']  = 'meta_value_num';
					$the_args['order']    = $order;
					break;
				case 'views':
					$the_args['meta_key'] = '_views'; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
					$the_args['orderby']  = 'meta_value_num';
					$the_args['order']    = $order;
					break;
				case 'rand':
					$the_args['orderby'] = $orderby;
					break;
				default:
					$the_args['orderby'] = $orderby;
					$the_args['order']   = $order;
			}
		}

		if ( ! empty( $categories_list ) ) {
			$the_args['tax_query'][] = [
				'taxonomy' => rtcl()->category,
				'terms'    => $categories_list,
				'field'    => 'term_id',
				'operator' => 'IN',
			];
		}

		if ( ! empty( $location_list ) ) {
			$the_args['tax_query'][] = [
				'taxonomy' => rtcl()->location,
				'terms'    => $location_list,
				'field'    => 'term_id',
				'operator' => 'IN',
			];
		}

		if ( $listing_type && in_array( $listing_type, array_keys( Functions::get_listing_types() ) ) && ! Functions::is_ad_type_disabled() ) {
			$meta_queries[] = [
				'key'     => 'ad_type',
				'value'   => $listing_type,
				'compare' => '=',
			];
		}

		$count_meta_queries = count( $meta_queries );
		if ( $count_meta_queries ) {
			// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			$the_args['meta_query'] = ( $count_meta_queries > 1 ) ? array_merge( [ 'relation' => 'AND' ], $meta_queries ) : $meta_queries;
		}

		return $the_args;
	}

	public function render( $unprocessed_props, $content, $render_slug ) {
		$settings  = $this->props;
		$the_loops = $this->widget_results();

		$style = isset( $settings['rtcl_grid_style'] ) ? sanitize_text_field( $settings['rtcl_grid_style'] ) : 'style-1';

		$template_style = 'listing-ads/grid/' . $style;

		$data = [
			'template'      => $template_style,
			'instance'      => $settings,
			'the_loops'     => $the_loops,
			'template_path' => rtcl_divi_addons()->get_plugin_template_path(),
		];

		$data = apply_filters( 'rtcl_divi_filter_listing_data', $data );

		if ( $the_loops->found_posts ) {
			return Functions::get_template_html( $data['template'], $data, '', $data['template_path'] );
		} else if ( ! empty( $settings['rtcl_no_listing_text'] ) ) {
			return '<h3>' . esc_html( $settings['rtcl_no_listing_text'] ) . '</h3>';
		}

		wp_reset_postdata();
	}
}