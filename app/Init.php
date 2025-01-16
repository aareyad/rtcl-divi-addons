<?php

use RtclDiviAddons\Helpers\Installer;
use RtclDiviAddons\Hooks\ActionHooks;
use RtclDiviAddons\Hooks\DiviHooks;
use RtclDiviAddons\Hooks\FilterHooks;
use RtclDiviAddons\Models\Dependencies;

require_once RTCL_DIVI_ADDONS_PLUGIN_PATH . 'vendor/autoload.php';

final class RtclDiviInit {
	private static string $suffix;
	private static string $version;
	private $dependency;
	private static $singleton = false;

	/**
	 * Create an inaccessible constructor.
	 */
	private function __construct() {
		self::$suffix     = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
		self::$version    = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? time() : RTCL_DIVI_ADDONS_VERSION;
		$this->dependency = Dependencies::getInstance();

		$this->load_scripts();
		$this->init();
	}

	/**
	 * Fetch an instance of the class.
	 */
	final public static function getInstance() {
		if ( self::$singleton === false ) {
			self::$singleton = new self();
		}

		return self::$singleton;
	}

	/**
	 * Initialize necessary things
	 */
	protected function init() {
		$this->define_constants();
		$this->load_language();
		$this->hooks();
	}

	/**
	 * @return void
	 */
	private function load_scripts() {
		if ( $this->dependency->check() ) {
			add_action( 'wp_enqueue_scripts', [ __CLASS__, 'front_end_script' ], 30 );
			//add_action( 'admin_enqueue_scripts', [ __CLASS__, 'load_admin_script' ] );
		}
	}

	/**
	 * @return void
	 */
	private function define_constants() {
		if ( ! defined( 'RTCL_DIVI_ADDONS_URL' ) ) {
			define( 'RTCL_DIVI_ADDONS_URL', plugins_url( '', RTCL_DIVI_ADDONS_PLUGIN_FILE ) );
		}
		if ( ! defined( 'RTCL_DIVI_ADDONS_SLUG' ) ) {
			define( 'RTCL_DIVI_ADDONS_SLUG', basename( dirname( RTCL_DIVI_ADDONS_PLUGIN_FILE ) ) );
		}
		if ( ! defined( 'RTCL_DIVI_ADDONS_PLUGIN_DIRNAME' ) ) {
			define( 'RTCL_DIVI_ADDONS_PLUGIN_DIRNAME', dirname( plugin_basename( RTCL_DIVI_ADDONS_PLUGIN_FILE ) ) );
		}
		if ( ! defined( 'RTCL_DIVI_ADDONS_PLUGIN_BASENAME' ) ) {
			define( 'RTCL_DIVI_ADDONS_PLUGIN_BASENAME', plugin_basename( RTCL_DIVI_ADDONS_PLUGIN_FILE ) );
		}
	}

	/**
	 * @return void
	 */
	public function load_language() {
		load_plugin_textdomain( 'rtcl-divi-addons', false, trailingslashit( RTCL_DIVI_ADDONS_PLUGIN_DIRNAME ) . 'languages' );
	}

	/**
	 * @return void
	 */
	private function hooks() {
		if ( $this->dependency->check() ) {
			FilterHooks::init();
			ActionHooks::init();
			DiviHooks::init();
		}
	}

	public static function front_end_script() {
		wp_register_style( 'rtcl-divi-addons', RTCL_DIVI_ADDONS_URL . "/assets/css/frontend.css", [ 'rtcl-public' ], self::$version );
		wp_register_script( 'rtcl-divi-addons', RTCL_DIVI_ADDONS_URL . "/assets/js/frontend.js", [ 'jquery' ], self::$version, true );
		wp_enqueue_script( 'rtcl-divi-modules', RTCL_DIVI_ADDONS_URL . "/assets/js/divi-modules.js",
			[ 'jquery', 'react-dom', 'react', 'et_pb_media_library', 'wp-element', 'wp-i18n' ],
			self::$version, true );

		$localize = [
			'rtcl_nonce' => wp_create_nonce( 'rtcl-nonce' ),
		];

		wp_localize_script( 'rtcl-divi-modules', 'rtcl_divi', $localize );
	}

	public static function load_admin_script() {

	}

	/**
	 * @return string
	 */
	public function get_plugin_template_path() {
		return $this->plugin_path() . '/templates/';
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( RTCL_DIVI_ADDONS_PLUGIN_FILE ) );
	}
}

function rtcl_divi_addons() {
	return RtclDiviInit::getInstance();
}

add_action( 'divi_extensions_init', function () {
	rtcl_divi_addons();
} );

register_activation_hook( RTCL_DIVI_ADDONS_PLUGIN_FILE, [ Installer::class, 'activate' ] );
register_deactivation_hook( RTCL_DIVI_ADDONS_PLUGIN_FILE, [ Installer::class, 'deactivate' ] );