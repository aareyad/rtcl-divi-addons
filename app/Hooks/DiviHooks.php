<?php

namespace RtclDiviAddons\Hooks;

use RtclDiviAddons\Modules\ListingsGrid\ListingsGrid;
use RtclDiviAddons\Modules\ListingsList\ListingsList;

class DiviHooks {

	/**
	 * @return void
	 */
	public static function init(): void {
		add_action( 'et_builder_ready', [ __CLASS__, 'load_modules' ], 9 );
	}

	public static function load_modules() {
		if ( ! class_exists( \ET_Builder_Element::class ) ) {
			return;
		}

		new ListingsGrid();
		new ListingsList();
	}

}