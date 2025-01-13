<?php

namespace RtclDiviAddons\Helpers;

class Installer {
	/**
	 * @return void
	 */
	public static function activate(): void {

		if ( ! is_blog_installed() ) {
			return;
		}

		do_action( 'rtcl_flush_rewrite_rules' );
	}

	/**
	 * @return void
	 */
	public static function deactivate(): void {
		do_action( 'rtcl_flush_rewrite_rules' );
	}
}