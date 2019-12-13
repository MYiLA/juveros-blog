<?php
/**
 * Widgets
 *
 * @package aspen-features
 */

if ( ! defined( 'ASPEN_WIDGETS_DIR' ) ) {
	define( 'ASPEN_WIDGETS_DIR', ASPEN_FEATURES_PLUGIN_DIR . 'widgets' . DIRECTORY_SEPARATOR );
}

require plugin_dir_path( __FILE__ ) . 'lib/widget-class/widget-class.php'; /* Custom Widget UI class */


/**
 * Scripts
 */

function aspen_features_admin_scripts( $hook ) {
	if ( 'post.php' == $hook || 'post-new.php' == $hook || 'widgets.php' == $hook || 'customize.php' == $hook ) {
		wp_enqueue_script( 'aspen-features-admin-js', ASPEN_FEATURES_PLUGIN_URL . 'assets/js/widgets.js', array( 'jquery' ) );
	}
}

add_action( 'admin_enqueue_scripts', 'aspen_features_admin_scripts', 999 );


/**
 * Load and initialize built-in widgets
 */

if ( ! function_exists( 'aspen_init_widgets' ) ) {
	function aspen_init_widgets() {
		if ( $handle = opendir( ASPEN_WIDGETS_DIR ) ) {
			while ( false !== ( $entry = readdir( $handle ) ) ) {
				if ( substr_count( $entry, 'widget-' ) > 0 ) {
					require_once( ASPEN_WIDGETS_DIR . $entry );
				}
			}
			closedir( $handle );
		}
		do_action( 'aspen_after_init_widgets' );
	}
}
aspen_init_widgets();
