<?php
/**
 * This script is not used within ShapingRain Framework itself.
 *
 * This script is meant to be used with your ShapingRain Framework-dependent theme or plugin,
 * so that your theme/plugin can verify whether the framework is installed.
 *
 * If ShapingRain is not installed, then the script will display a notice with a link to
 * ShapingRain. If ShapingRain is installed but not activated, it will display the appropriate notice as well.
 *
 * To use this script, just copy it into your theme/plugin directory then add this in the main file of your project:
 *
 * require_once( 'shapingrain-framework-checker.php' );
 *
 * Changelog:
 * v1.9
 *      * Simplified class
 * v1.7.4
 *		* Now integrates with TGM Plugin Activation - uses TGM instead of displaying
 *			our own admin notice
 * v1.7.7
 *		* Added filters to notices
 *
 * @package ShapingRain Framework
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly.
}

if ( ! class_exists( 'ShapingRainFrameworkChecker' ) ) {

	/**
	 * ShapingRain Framework Checker.
	 *
	 * @since 1.6
	 */
	class ShapingRainFrameworkChecker {


		const SEARCH_REGEX = '/shapingrain-framework.php/i';
		const FRAMEWORK_CLASS = 'ShapingRainFramework';
		const PLUGIN_SLUG = 'shapingrain-framework';


		/**
		 * Constructor, add hooks for checking for ShapingRain Framework.
		 *
		 * @since 1.6
		 */
		function __construct() {
			add_action( 'admin_notices', array( $this, 'display_install_or_active_notice' ), 2 );
			add_action( 'tgmpa_register', array( $this, 'tgm_plugin_activation_include' ) );
		}


		/**
		 * Checks the existence of ShapingRain Framework and prompts the display of a notice.
		 *
		 * @since 1.6
		 */
		public function display_install_or_active_notice() {

			// Check for TGM use, if used, let TGM do the notice.
			// We do this here since perform_check() is too early.
			if ( function_exists( 'tgmpa' ) ) {
				return;
			}

			// If the plugin does not exist, throw admin notice to install.
			if ( ! $this->plugin_exists() ) {
				echo "<div class='error'><p><strong>"
					. esc_html( apply_filters( 'shapingrain_checker_installation_notice', __( 'ShapingRain Framework needs to be installed.', 'aspen' ) ) )
					. sprintf( " <a href='%s'>%s</a>",
						esc_url( admin_url( 'plugin-install.php?tab=search&type=term&s=shapingrain+framework' ) ),
						esc_html( apply_filters( 'shapingrain_checker_search_plugin_notice', __( 'Click here to search for the plugin.', 'aspen' ) ) )
					)
					. '</strong></p></div>';

				// If the class doesn't exist, the plugin is inactive. Throw admin notice to activate plugin.
			} else if ( ! class_exists( apply_filters( 'sr_framework_checker_shapingrain_class', self::FRAMEWORK_CLASS ) ) ) {
				echo "<div class='error'><p><strong>"
					. esc_html( apply_filters( 'shapingrain_checker_activation_notice', __( 'ShapingRain Framework needs to be activated.', 'aspen' ) ) )
					. sprintf( " <a href='%s'>%s</a>",
						esc_url( admin_url( 'plugins.php' ) ),
						esc_html( apply_filters( 'shapingrain_checker_activate_plugin_notice', __( 'Click here to go to the plugins page and activate it.', 'aspen' ) ) )
					)
					. '</strong></p></div>';
			}
		}


		/**
		 * Checks the existence of ShapingRain Framework in the list of plugins.
		 * It uses the slug path of the plugin for checking.
		 *
		 * @since 1.6
		 *
		 * @return boolean True if ShapingRain Framework is installed (even if not activated).
		 */
		public function plugin_exists() {
			// Required function as it is only loaded in admin pages.
			require_once ABSPATH . 'wp-admin/includes/plugin.php';

			// Get all plugins, activated or not.
			$plugins = get_plugins();

			// Check plugin existence by checking if the name is registered as an array key. get_plugins collects all plugin path into arrays.
			foreach ( $plugins as $slug => $plugin ) {
				$search_regex = apply_filters( 'sr_framework_checker_regex', self::SEARCH_REGEX );
				if ( preg_match( $search_regex, $slug, $matches ) ) {
					return true;
				}
			}

			return false;
		}


		/**
		 * Includes ShapingRain Framework in TGM Plugin Activation if it's available.
		 *
		 * @since	1.7.4
		 *
		 * @return	void
		 *
		 * @see		http://tgmpluginactivation.com/
		 *
		 * @codeCoverageIgnore
		 */
		public function tgm_plugin_activation_include() {
			if ( function_exists( 'tgmpa' ) ) {

				$plugins = array(
					array(
						'name'     => 'ShapingRain Framework',
						'slug'     => self::PLUGIN_SLUG,
						'required' => true,
						'version'  => '1.2.2',
						'source'   => get_template_directory() . '/lib/plugins/shapingrain-framework.zip'
					),
					array(
						'name'     => 'Aspen Feature Pack by ShapingRain',
						'slug'     => 'aspen-feature-pack',
						'required' => true,
						'version'  => '1.1.3',
						'source'   => get_template_directory() . '/lib/plugins/aspen-feature-pack.zip'
					),
					array(
						'name'     => 'Envato Market Plug-In',
						'slug'     => 'envato-market',
						'required' => false,
						'version'  => '2.0.1',
						'source'   => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip'
					),
				);

				$config = array (
					'id'           => 'aspen',
					'menu'         => 'aspen-install-plugins',
					'parent_slug'  => 'themes.php',
					'capability'   => 'edit_theme_options',
					'message'      => '<div id="setting-error-tgmpa" class="error settings-error notice"><p><strong>' . esc_html__('These plug-ins are either required or recommended for Aspen for WordPress. Without these plug-ins some of the features will not be available. The Envato Market Plug-in is strongly recommended to keep your theme up to date.', 'aspen') . '</strong></p></div>',
					'has_notices'  => true,
					'dismissable'  => true,
					'dismiss_msg'  => '',
					'is_automatic' => true,
					'strings'      => array(
						'page_title' => __( 'Aspen for WordPress: Install Required Plugins', 'aspen' ),
						'menu_title' => __( 'Install Theme Plugins', 'aspen' ),
						'nag_type'   => 'error',
						// Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
					)
				);


				tgmpa( $plugins, $config );
			}
		}
	}

	new ShapingRainFrameworkChecker();


}
