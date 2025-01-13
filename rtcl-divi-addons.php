<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Classified Listing - Addons for Divi Builder
 * Plugin URI:        https://wordpress.org/plugins/classified-listing/
 * Description:       Classified Listing required addons for Divi Builder
 * Version:           1.0.0
 * Author:            RadiusTheme
 * Author URI:        https://radiustheme.com
 * Text Domain:       rtcl-divi-addons
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Define Constants
if ( ! defined( 'RTCL_DIVI_ADDONS_VERSION' ) ) {
	define( 'RTCL_DIVI_ADDONS_VERSION', '1.0.0' );
}
if ( ! defined( 'RTCL_DIVI_ADDONS_PLUGIN_FILE' ) ) {
	define( 'RTCL_DIVI_ADDONS_PLUGIN_FILE', __FILE__ );
}
if ( ! defined( 'RTCL_DIVI_ADDONS_PLUGIN_PATH' ) ) {
	define( 'RTCL_DIVI_ADDONS_PLUGIN_PATH', plugin_dir_path( RTCL_DIVI_ADDONS_PLUGIN_FILE ) );
}
// Include Files
require_once 'app/Init.php';