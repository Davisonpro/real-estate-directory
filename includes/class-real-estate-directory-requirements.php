<?php
/**
 * Real Estate Directory Requirements class.
 *
 * @author    AyeCode Ltd
 * @package   GeoDir_Real_Estate_Requirements
 * @version   1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * GeoDir_Real_Estate_Requirements class.
 */
final class GeoDir_Real_Estate_Requirements {
	/**
	 * The single instance of the class.
	 *
	 * @since 2.0
	 */
	private static $instance = null;

	/**
	 * Save Search Notifications plugin main instance.
	 *
	 * @return GeoDir_Real_Estate_Requirements instance.
	 * @since 2.0
	 *
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof GeoDir_Real_Estate_Requirements ) ) {
			self::$instance = new GeoDir_Real_Estate_Requirements;
			self::$instance->includes();
			self::$instance->init_hooks();

			do_action( 'GeoDir_Real_Estate_Requirements_loaded' );
		}

		return self::$instance;
	}

	public function includes() {
		// libraries
		if ( is_admin() ) {
			require_once( plugin_dir_path( GEODIR_REAL_ESTATE_PLUGIN_FILE ) . 'includes/libs/tgm/class-tgm-plugin-activation.php' );
		}
	}


	/**
	 * Handle actions and filters.
	 *
	 * @since 2.0
	 */
	private function init_hooks() {
		if ( is_admin() ) {
			add_action( 'tgmpa_register', array( $this, 'register_required_plugins' ) );
		}
	}

	/**
	 * Register required plugins.
	 *
	 * @return void
	 * @since 2.0
	 *
	 */
	public function register_required_plugins() {
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(

			array(
				'name'     => 'GeoDirectory', // The plugin name.
				'slug'     => 'geodirectory', // The plugin slug (typically the folder name).
				'required' => true, // If false, the plugin is only 'recommended' instead of required.
			),
			array(
				'name'     => 'BlockStrap Blocks', // The plugin name.
				'slug'     => 'blockstrap-page-builder-blocks', // The plugin slug (typically the folder name).
				'required' => true, // If false, the plugin is only 'recommended' instead of required.
			),
			array(
				'name'     => 'UsersWP', // The plugin name.
				'slug'     => 'userswp', // The plugin slug (typically the folder name).
				'required' => true, // If false, the plugin is only 'recommended' instead of required.
			),


		);

		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'real-estate-directory',
			// Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',
			// Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins',
			// Menu slug.
			'parent_slug'  => 'plugins.php',
			// Parent menu slug.
			'capability'   => 'manage_options',
			// Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,
			// Show admin notices or not.
			'dismissable'  => true,
			// If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',
			// If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => true,
			// Automatically activate plugins after installation or not.
			'message'      => '',
			// Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}
}
