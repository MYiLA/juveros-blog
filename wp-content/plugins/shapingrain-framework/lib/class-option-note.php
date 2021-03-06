<?php

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly
}
class ShapingRainFrameworkOptionNote extends ShapingRainFrameworkOption {

	public $defaultSecondarySettings = array(
		'color' => 'green', // The color of the note's border
		'notification' => false,
		'paragraph' => true,
	);

	/*
	 * Display for options and meta
	 */
	public function display() {
		$this->echoOptionHeader();

		$color = $this->settings['color'] == 'green' ? '' : 'error';

		if ( $this->settings['notification'] ) {
			?><div class='updated below-h2 <?php echo $color ?>'><?php
		}

		if ( $this->settings['paragraph'] ) {
			echo "<p class='description'>";
		}

		echo $this->settings['desc'];

		if ( $this->settings['paragraph'] ) {
			echo '</p>';
		}

		if ( $this->settings['notification'] ) {
			?></div><?php
		}

		$this->echoOptionFooter( false );
	}

	/*
	 * Display for theme customizer
	 */
	public function registerCustomizerControl( $wp_customize, $section, $priority = 1 ) {
		$wp_customize->add_control( new ShapingRainFrameworkOptionNoteControl( $wp_customize, $this->getID(), array(
			'label' => $this->settings['name'],
			'section' => $section->getID(),
			'settings' => $this->getID(),
			'description' => $this->settings['desc'],
			'priority' => $priority,
		) ) );
	}
}

/*
 * WP_Customize_Control with description
 */
add_action( 'customize_register', 'registerShapingRainFrameworkOptionNoteControl', 1 );
function registerShapingRainFrameworkOptionNoteControl() {
	class ShapingRainFrameworkOptionNoteControl extends WP_Customize_Control {
		public $description;

		public function render_content() {
			if ( ! empty( $this->description ) ) {
				echo "<p class='description'>" . $this->description . '</p>';
			}
		}
	}
}
