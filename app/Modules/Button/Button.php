<?php

namespace RtclDiviAddons\Modules\Button;

use Rtcl\Helpers\Functions;

class Button extends \ET_Builder_Module {
	public $slug = 'rtcl_divi_button';
	public $vb_support = 'on';

	public function init() {
		$this->name = esc_html__( 'CL Button', 'simp-simple-extension' );
	}

	public function get_fields() {
		return array(
			'content' => array(
				'label'           => esc_html__( 'Text', 'simp-simple-extension' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear below the heading text.', 'simp-simple-extension' ),
				'toggle_slug'     => 'main_content',
			),
		);
	}


	public function render( $unprocessed_props, $content, $render_slug ) {

		$data = [
			'props' => $this->props
		];

		return Functions::get_template_html( "button/style-1", $data, '', rtcl_divi_addons()->get_plugin_template_path() );
	}
}