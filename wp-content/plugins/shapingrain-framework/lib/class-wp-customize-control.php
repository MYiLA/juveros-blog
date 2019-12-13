<?php

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly
}
/*
 * WP_Customize_Control with description
 */
add_action( 'customize_register', 'registerShapingRainFrameworkCustomizeControl', 1 );
function registerShapingRainFrameworkCustomizeControl() {
	class ShapingRainFrameworkCustomizeControl extends WP_Customize_Control {
		public $description;

		public function render_content() {
			parent::render_content();
			// echo "<p class='description'>{$this->description}</p>";
		}
	}
}
