<?php
/**
 * GeoDirectory Real Estate
 *
 * @package           GeoDir_Real_Estate
 * @author            AyeCode Ltd
 * @copyright         2023 AyeCode Ltd
 * @license           GPLv3
 *
 * @wordpress-plugin
 * Plugin Name:       Real Estate Directory
 * Plugin URI:        https://wpgeodirectory.com/
 * Description:       Add real estate functionality to your site.
 * Version:           2.0
 * Requires at least: 6.0
 * Requires PHP:      7.0
 * Author:            AyeCode Ltd
 * Author URI:        https://ayecode.io
 * License:           GPLv3
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Requires Plugin:   geodirectory, blockstrap-page-builder-blocks, usserwp
 * Text Domain:       real-estate-directory
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'GEODIR_REAL_ESTATE_VERSION' ) ) {
	define( 'GEODIR_REAL_ESTATE_VERSION', '2.0' );
}

if ( ! defined( 'GEODIR_REAL_ESTATE_MIN_CORE' ) ) {
	define( 'GEODIR_REAL_ESTATE_MIN_CORE', '2.3' );
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 2.0
 */
function geodir_load_real_estate() {

	if ( ! defined( 'GEODIR_REAL_ESTATE_PLUGIN_FILE' ) ) {
		define( 'GEODIR_REAL_ESTATE_PLUGIN_FILE', __FILE__ );
	}

	// Min core version check
	if ( ! function_exists( 'geodir_min_version_check' ) || ! geodir_min_version_check( 'Save Search Notifications', GEODIR_REAL_ESTATE_MIN_CORE ) ) {
		return '';
	}

	/**
	 * The core plugin class that is used to define internationalization,
	 * dashboard-specific hooks, and public-facing site hooks.
	 */
	require_once( plugin_dir_path( GEODIR_REAL_ESTATE_PLUGIN_FILE ) . 'includes/class-real-estate-directory.php' );

	return GeoDir_Real_Estate::instance();
}
add_action( 'geodirectory_loaded', 'geodir_load_real_estate' );

/**
 * Checks and loads the real estate directory requirements.
 *
 * @return void
 */
function real_estate_directory_requirements(){

	if ( ! defined( 'GEODIR_REAL_ESTATE_PLUGIN_FILE' ) ) {
		define( 'GEODIR_REAL_ESTATE_PLUGIN_FILE', __FILE__ );
	}

	if ( is_admin() ) {
		/**
		 * Load the class for requirements
		 */
		require_once( plugin_dir_path( GEODIR_REAL_ESTATE_PLUGIN_FILE ) . 'includes/class-real-estate-directory-requirements.php' );
		GeoDir_Real_Estate_Requirements::instance();
	}
}
add_action('plugins_loaded','real_estate_directory_requirements');