<?php

namespace RtclDiviAddons\Modules\SingleLocation;

use Rtcl\Helpers\Functions;
use RtclDiviAddons\Helpers\Functions as DiviFunctions;

class SingleLocation extends \ET_Builder_Module {

	public $slug = 'rtcl_single_location';
	public $vb_support = 'on';
	public $icon_path;

	protected $module_credits
		= [
			'author'     => 'RadiusTheme',
			'author_uri' => 'https://radiustheme.com',
		];

	public function init() {
		$this->name      = esc_html__( 'Listing Single Location', 'rtcl-divi-addons' );
		$this->icon_path = plugin_dir_path( __FILE__ ) . 'icon.svg';

		$this->settings_modal_toggles = [
			'general'  => [
				'toggles' => [
					'general'    => esc_html__( 'General', 'rtcl-divi-addons' ),
					'visibility' => esc_html__( 'Visibility', 'rtcl-divi-addons' ),
				],
			],
			'advanced' => [
				'toggles' => [
					'card'  => esc_html__( 'Box', 'rtcl-divi-addons' ),
					'title' => esc_html__( 'Title', 'rtcl-divi-addons' ),
					'count' => esc_html__( 'Count', 'rtcl-divi-addons' ),
				],
			],
		];
	}

	public function get_fields() {
		$location_dropdown = DiviFunctions::get_listing_taxonomy( 'parent', rtcl()->location );

		return [
			'rtcl_location_style'    => [
				'label'       => esc_html__( 'Style', 'rtcl-divi-addons' ),
				'type'        => 'select',
				'options'     => [
					'style-1' => __( 'Style 1', 'rtcl-divi-addons' ),
				],
				'default'     => 'style-1',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'rtcl_location_tax'      => [
				'label'       => esc_html__( 'Location', 'rtcl-divi-addons' ),
				'type'        => 'select',
				'options'     => $location_dropdown,
				'description' => esc_html__( 'Select a location to display.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'rtcl_enable_link'       => [
				'label'       => esc_html__( 'Enable Link', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'description' => __( 'Add / Remove listing location link.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			// computed.
			'__location'             => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'SingleLocation', 'get_content' ),
				'computed_depends_on' => array(
					'rtcl_location_tax'
				)
			),
			// visibility
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
			'rtcl_count_color'       => [
				'label'       => esc_html__( 'Count Color', 'rtcl-divi-addons' ),
				'description' => esc_html__( 'Here you can define a custom color for listing count.', 'rtcl-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'count',
			]
		];
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = [];
		$advanced_fields['text']        = [];
		$advanced_fields['text_shadow'] = [];

		$advanced_fields['fonts'] = [
			'title' => [
				'css'              => array(
					'main' => '.et-db .et-l %%order_class%% .rtcl-single-location .rtcl-location-title',
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
			'count' => [
				'css'              => array(
					'main' => '.et-db .et-l %%order_class%% .rtcl-single-location .count',
				),
				'important'        => 'all',
				'hide_text_color'  => true,
				'hide_text_shadow' => true,
				'hide_text_align'  => true,
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'count',
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
				'main'      => '%%order_class%% .rtcl-single-location',
				'important' => 'all',
			],
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'card',
		];

		$advanced_fields['background'] = array(
			'css' => array(
				'main' => '%%order_class%% .rtcl-single-location .rtcl-location-img'
			),
		);

		return $advanced_fields;
	}

	public static function get_content( $args = [] ) {

		return false;
	}

	public function render( $unprocessed_props, $content, $render_slug ) {
		$settings = $this->props;

		$this->render_css( $render_slug );

		$style = isset( $settings['rtcl_location_style'] ) ? sanitize_text_field( $settings['rtcl_location_style'] ) : 'style-1';

		$template_style = 'single-location/' . $style;

		$data = [
			'title'         => esc_html__( 'Please Select a Location and Background', 'rtcl-divi-addons' ),
			'count'         => 0,
			'template'      => $template_style,
			'style'         => $style,
			'settings'      => $settings,
			'template_path' => rtcl_divi_addons()->get_plugin_template_path(),
		];

		if ( ! empty( $settings['rtcl_location_tax'] ) ) {
			$term = get_term( $settings['rtcl_location_tax'], rtcl()->location );

			if ( $term && ! is_wp_error( $term ) ) {
				$data['title']     = $term->name;
				$data['count']     = $term->count;
				$data['permalink'] = get_term_link( $term );
			}
		}

		$data = apply_filters( 'rtcl_divi_filter_listing_location_data', $data );

		return Functions::get_template_html( $data['template'], $data, '', $data['template_path'] );
	}

	protected function render_css( $render_slug ) {
		$wrapper           = '.et-db .et-l %%order_class%% .rtcl-categories-wrapper';
		$title_color       = $this->props['rtcl_title_color'];
		$title_hover_color = $this->get_hover_value( 'rtcl_title_color' );
		$title_font_weight = explode( '|', $this->props['title_font'] )[1];
		$count_color       = $this->props['rtcl_count_color'];

		// Title
		if ( ! empty( $title_color ) ) {
			\ET_Builder_Element::set_style(
				$render_slug,
				[
					'selector'    => "$wrapper .rtcl-category-title a",
					'declaration' => sprintf( 'color: %1$s;', $title_color ),
				]
			);
		}
		if ( ! empty( $title_hover_color ) ) {
			\ET_Builder_Element::set_style(
				$render_slug,
				[
					'selector'    => "$wrapper .rtcl-category-title a:hover",
					'declaration' => sprintf( 'color: %1$s;', $title_hover_color ),
				]
			);
		}
		if ( ! empty( $title_font_weight ) ) {
			\ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.et-db .et-l %%order_class%% .rtcl-categories-wrapper .rtcl-category-title',
					'declaration' => sprintf( 'font-weight: %1$s;', $title_font_weight ),
				)
			);
		}
		// count
		if ( ! empty( $count_color ) ) {
			\ET_Builder_Element::set_style(
				$render_slug,
				[
					'selector'    => "$wrapper .cat-details-inner .count",
					'declaration' => sprintf( 'color: %1$s;', $count_color ),
				]
			);
		}
	}
}