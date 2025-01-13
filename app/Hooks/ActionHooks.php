<?php

namespace RtclDiviAddons\Hooks;

class ActionHooks {

	/**
	 * @return void
	 */
	public static function init(): void {
		add_action( 'divi_extensions_init', [ __CLASS__, 'divi_init' ] );
	}

	public static function divi_init() {
		add_action( 'et_builder_ready', [ __CLASS__, 'load_modules' ], 9 );
	}

	public static function load_modules() {
		if ( ! class_exists( \ET_Builder_Element::class ) ) {
			return;
		}

		if ( file_exists( RTCL_DIVI_ADDONS_PLUGIN_PATH . 'includes/loader.php' ) ) {
			require_once RTCL_DIVI_ADDONS_PLUGIN_PATH . 'includes/loader.php';
		}
	}

}