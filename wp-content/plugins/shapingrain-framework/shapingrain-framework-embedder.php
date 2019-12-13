<?php
/**
 * This script is not used within ShapingRain Framework itself.
 *
 * This script is meant to be used when embedding ShapingRain Framework into your
 * theme or plugin.
 *
 * To embed ShapingRain Framework into your project, copy the whole ShapingRain Framework folder
 * into your project, then in your functions.php or main plugin script, do a
 * require_once( 'ShapingRain-Framework/shapingrain-framework-embedder.php' );
 *
 * When done, your project will use the embedded copy of ShapingRain Framework. When the plugin
 * version is activated, that one will be used instead.
 *
 * For more details on embedding, read our docs:
 * http://www.shapingrainframework.net/embedding-shapingrain-framework-in-your-project/
 *
 * @package ShapingRain Framework
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly.
}

if ( ! class_exists( 'ShapingRainFrameworkEmbedder' ) ) {


	/**
	 * ShapingRain Framework Embedder
	 *
	 * @since 1.6
	 */
	class ShapingRainFrameworkEmbedder {


		/**
		 * Constructor, add hooks for embedding for ShapingRain Framework
		 *
		 * @since 1.6
		 */
		function __construct() {
			// Don't do anything when we're activating a plugin to prevent errors
			// on redeclaring ShapingRain classes.
			if ( is_admin() ) {
				if ( ! empty( $_GET['action'] ) && ! empty( $_GET['plugin'] ) ) { // Input var: okay.
				    if ( 'activate' === $_GET['action'] ) { // Input var: okay.
				        return;
				    }
				}
			}
			add_action( 'after_setup_theme', array( $this, 'perform_check' ), 1 );
		}


		/**
		 * Uses ShapingRain Framework
		 *
		 * @since 1.6
		 */
		public function perform_check() {
			if ( class_exists( 'ShapingRainFramework' ) ) {
				return;
			}
			require_once( 'shapingrain-framework.php' );
		}
	}

	new ShapingRainFrameworkEmbedder();
}
