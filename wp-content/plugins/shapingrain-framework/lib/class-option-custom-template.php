<?php
/**
 * Custom option
 *
 * @package ShapingRain Framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Custom option class
 *
 * @since 1.0
 */
class ShapingRainFrameworkOptionCustomTemplate extends ShapingRainFrameworkOption {

	/**
	 * Default settings specific to this option
	 *
	 * @var array
	 */
	public $defaultSecondarySettings = array(
		'template' => '', // Custom Template
	);

	/**
	 * Display for options and meta
	 */
	public function display() {
		$this->echoOptionHeaderBare();
		include( get_template_directory() . '/lib/admin-pages/' . $this->settings['template'] . '.php' );;
		$this->echoOptionFooterBare( false );
	}

}

