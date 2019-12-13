<?php
/**
 * Custom option
 *
 * @package ShapingRain Framework
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly.
}

/**
 * Custom option class
 *
 * @since 1.0
 */
class ShapingRainFrameworkOptionCustom extends ShapingRainFrameworkOption {

	/**
	 * Default settings specific to this option
	 * @var array
	 */
	public $defaultSecondarySettings = array(
		'custom' => '', // Custom HTML
	);

	/**
	 * Display for options and meta
	 */
	public function display() {
		if ( ! empty( $this->settings['name'] ) ) {

			$this->echoOptionHeader();
			echo $this->settings['custom'];
			$this->echoOptionFooter( false );

		} else {

			$this->echoOptionHeaderBare();
			echo $this->settings['custom'];
			$this->echoOptionFooterBare( false );

		}
	}

	/**
	 * Display for theme customizer
	 *
	 * @param WP_Customize             $wp_customize The customizer object.
	 * @param ShapingRainFrameworkCustomizer $section      The customizer section.
	 * @param int                      $priority     The display priority of the control.
	 */
	public function registerCustomizerControl( $wp_customize, $section, $priority = 1 ) {
		$wp_customize->add_control( new ShapingRainFrameworkOptionCustomControl( $wp_customize, $this->getID(), array(
			'label' => $this->settings['name'],
			'section' => $section->settings['id'],
			'type' => 'select',
			'settings' => $this->getID(),
			'priority' => $priority,
			'custom' => $this->settings['custom'],
		) ) );
	}
}


// We create a new control for the theme customizer.
add_action( 'customize_register', 'register_shapingrain_framework_option_custom_control', 1 );

/**
 * Register the customizer control
 */
function register_shapingrain_framework_option_custom_control() {

	/**
	 * Custom option class
	 *
	 * @since 1.0
	 */
	class ShapingRainFrameworkOptionCustomControl extends WP_Customize_Control {

		/**
		 * The custom content control
		 *
		 * @var bool
		 */
		public $custom;

		/**
		 * Renders the control
		 */
		public function render_content() {
			echo $this->custom;
		}
	}
}
