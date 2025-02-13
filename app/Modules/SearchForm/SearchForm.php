<?php

namespace RtclDiviAddons\Modules\SearchForm;

use Rtcl\Helpers\Functions;
use RtclDiviAddons\Modules\Base\DiviModule;

class SearchForm extends DiviModule {

	public $slug = 'rtcl_search_form';
	public $vb_support = 'on';
	public $icon_path;

	protected $module_credits
		= [
			'author'     => 'RadiusTheme',
			'author_uri' => 'https://radiustheme.com',
		];

	public function init() {
		$this->name      = esc_html__( 'Listing Search Form', 'rtcl-divi-addons' );
		$this->icon_path = plugin_dir_path( __FILE__ ) . 'icon.svg';

		$this->settings_modal_toggles = [
			'general'  => [
				'toggles' => [
					'general' => esc_html__( 'General', 'rtcl-divi-addons' ),
				],
			],
			'advanced' => [
				'toggles' => [
					'form'   => esc_html__( 'Form', 'rtcl-divi-addons' ),
					'fields' => esc_html__( 'Fields', 'rtcl-divi-addons' ),
					'button' => esc_html__( 'Search Button', 'rtcl-divi-addons' ),
				],
			],
		];
	}

	public function get_fields() {

		return [
			'search_style'       => [
				'label'       => esc_html__( 'Style', 'rtcl-divi-addons' ),
				'type'        => 'select',
				'options'     => [
					'dependency' => esc_html__( 'Dependency Selection', 'rtcl-divi-addons' ),
					'standard'   => esc_html__( 'Standard', 'rtcl-divi-addons' ),
					'popup'      => esc_html__( 'Popup', 'rtcl-divi-addons' ),
					'suggestion' => esc_html__( 'Auto Suggestion', 'rtcl-divi-addons' ),
				],
				'default'     => 'dependency',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'search_orientation' => [
				'label'       => esc_html__( 'Orientation', 'rtcl-divi-addons' ),
				'type'        => 'select',
				'options'     => [
					'inline'   => esc_html__( 'Inline', 'rtcl-divi-addons' ),
					'vertical' => esc_html__( 'Vertical', 'rtcl-divi-addons' ),
				],
				'default'     => 'inline',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'fields_label'       => [
				'label'       => esc_html__( 'Show Fields Label', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'keyword_field'      => [
				'label'       => esc_html__( 'Keywords Field', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'description' => __( 'Show / Hide keyword field.', 'rtcl-divi-addons' ),
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'types_field'        => [
				'label'       => esc_html__( 'Ad Types Field', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'category_field'     => [
				'label'       => esc_html__( 'Category Field', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'location_field'     => [
				'label'       => esc_html__( 'Location Field', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'radius_field'       => [
				'label'       => esc_html__( 'Radius Field', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'off',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			'price_field'        => [
				'label'       => esc_html__( 'Price Field', 'rtcl-divi-addons' ),
				'type'        => 'yes_no_button',
				'options'     => [
					'on'  => esc_html__( 'Yes', 'rtcl-divi-addons' ),
					'off' => esc_html__( 'No', 'rtcl-divi-addons' ),
				],
				'default'     => 'on',
				'tab_slug'    => 'general',
				'toggle_slug' => 'general',
			],
			// Style
			'form_background'    => [
				'label'       => esc_html__( 'Form Background Color', 'rtcl-divi-addons' ),
				'description' => esc_html__( 'Here you can define a custom color for form background.', 'rtcl-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'form',
			],
			'form_label_color'   => [
				'label'       => esc_html__( 'Label Color', 'rtcl-divi-addons' ),
				'description' => esc_html__( 'Here you can define a custom color for form label.', 'rtcl-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'fields',
			],
			'button_background'  => [
				'label'       => esc_html__( 'Background Color', 'rtcl-divi-addons' ),
				'description' => esc_html__( 'Here you can define a custom color for submit button.', 'rtcl-divi-addons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'button',
			],
		];
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = [];
		$advanced_fields['text']        = [];
		$advanced_fields['text_shadow'] = [];

		$advanced_fields['fonts'] = [
			'label'  => [
				'css'              => array(
					'main' => '.et-db .et-l %%order_class%% .rtcl-single-location .rtcl-location-name',
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
			'button' => [
				'css'              => array(
					'main' => '.et-db .et-l %%order_class%% .rtcl-single-location .rtcl-location-listing-count',
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
				'main'      => '%%order_class%% .rtcl-single-location .rtcl-location-content',
				'important' => 'all',
			],
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'form',
		];

		return $advanced_fields;
	}

	public function render( $unprocessed_props, $content, $render_slug ) {
		$settings = $this->props;

		$this->render_css( $render_slug );

		$style       = isset( $settings['search_style'] ) ? sanitize_text_field( $settings['search_style'] ) : 'dependency';
		$orientation = ! empty( $settings['search_orientation'] ) ? sanitize_text_field( $settings['search_orientation'] ) : 'inline';

		$template = 'search-form/listing-search';

		$data = [
			'template'      => $template,
			'style'         => $style,
			'orientation'   => $orientation,
			'settings'      => $settings,
			'template_path' => rtcl_divi_addons()->get_plugin_template_path(),
		];

		$data = apply_filters( 'rtcl_divi_listing_search_form_options', $data );

		return Functions::get_template_html( $data['template'], $data, '', $data['template_path'] );
	}

	protected function render_css( $render_slug ) {
		$wrapper         = '.et-db .et-l %%order_class%% .rtcl-search-form';
		$form_background = $this->props['form_background'];

		// Form
		if ( ! empty( $form_background ) ) {
			\ET_Builder_Element::set_style(
				$render_slug,
				[
					'selector'    => "$wrapper .rtcl-location-content",
					'declaration' => sprintf( 'background-color: %1$s;', $form_background ),
				]
			);
		}
	}
}