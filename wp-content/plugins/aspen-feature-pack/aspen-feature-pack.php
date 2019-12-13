<?php
/**
 * Plugin Name: Aspen Feature Pack by ShapingRain
 * Plugin URI: http://shapingrain.com
 * Description: The Aspen Feature Pack plug-in is required to enable some of the Aspen theme's add-on features, e.g. social sharing links, custom widgets etc.
 * Author: ShapingRain
 * Version: 1.1.3
 * Author URI: http://shapingrain.com
 */


/**
 * Constants
 */

define ('ASPEN_FEATURES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'ASPEN_FEATURES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );


/**
 * Text domain
 */

function aspen_features_load_plugin_textdomain() {
	load_plugin_textdomain( 'aspen-features', false, basename( dirname( __FILE__ ) ) . '/languages/' );
}

add_action( 'plugins_loaded', 'aspen_features_load_plugin_textdomain' );


/**
 * Load code for individual features
 */

if ( ! function_exists( 'aspen_array_option' ) ) {
	function aspen_array_option( $key = '', $instance, $default = false ) {
		if ( isset( $instance[ $key ] ) ) {
			$content = $instance[ $key ];

			return $content;
		} else {
			return $default;
		}
	}
}

if ( ! function_exists( 'aspen_filter_widget' ) ) {
	function aspen_filter_widget( $output = '', $args = null, $instance = null ) {
		return apply_filters( 'aspen_filter_widget', $output, $args, $instance );
	}
}

require ASPEN_FEATURES_PLUGIN_DIR . 'social.php';
require ASPEN_FEATURES_PLUGIN_DIR . 'widgets.php';


/**
 * General function calls that are 'plugin territory'
 */

add_filter( 'widget_text', 'do_shortcode' ); /* Ensure shortcodes are executed within the text widget */

