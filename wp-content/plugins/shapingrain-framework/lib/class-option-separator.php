<?php

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly
}
class ShapingRainFrameworkOptionSeparator extends ShapingRainFrameworkOption {

	/*
	 * Display for options and meta
	 */
	public function display() {
		$this->echoOptionHeader();
		?>
		<hr />
		<?php
		$this->echoOptionFooter( false );
	}
}
