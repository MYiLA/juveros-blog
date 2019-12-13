<?php

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly
}
class ShapingRainFrameworkOptionSelect extends ShapingRainFrameworkOption {

	public $defaultSecondarySettings = array(
		'options' => array(),
	);

	/**
	 * Check if this instance is the first load of the option class
	 *
	 * @since 1.9.3
	 * @var bool $firstLoad
	 */
	private static $firstLoad = true;

	/**
	 * Constructor
	 *
	 * @param array  $settings Option settings
	 * @param string $owner    Namespace
	 *
	 * @since    1.9.3
	 */
	function __construct( $settings, $owner ) {
		parent::__construct( $settings, $owner );
		sr_add_action_once( 'admin_enqueue_scripts', array( $this, 'load_select_scripts' ) );
		sr_add_action_once( 'customize_controls_enqueue_scripts', array( $this, 'load_select_scripts' ) );
	}


	/*
	 * Display for options and meta
	 */
	public function display() {
		$this->echoOptionHeader();
		$multiple = isset( $this->settings['multiple'] ) && true == $this->settings['multiple'] ? 'multiple' : '';

		$name = $this->getID();
		$val  = (array) $this->getValue();

		if ( ! empty( $multiple ) ) {
			$name = "{$name}[]";
		}

		?><select name="<?php echo $name; ?>" <?php echo $multiple; ?>><?php
		sr_parse_select_options( $this->settings['options'], $val );
		?></select><?php

		$this->echoOptionFooter();
	}


	/*
	 * Display for theme customizer
	 */
	public function registerCustomizerControl( $wp_customize, $section, $priority = 1 ) {

		$wp_customize->add_control( new ShapingRainFrameworkOptionSelectControl( $wp_customize, $this->getID(), array(
			'label' => $this->settings['name'],
			'section' => $section->settings['id'],
			'type' => 'select',
			'choices' => $this->settings['options'],
			'settings' => $this->getID(),
			'description' => $this->settings['desc'],
			'priority' => $priority,
		) ) );

	}


	/**
	 * Register and load the select2 script
	 *
	 * @since 1.9.3
	 * @return void
	 */
	public function load_select_scripts() {
		wp_enqueue_style( 'tf-select-option-style', ShapingRainFramework::getURL( '../css/class-option-select.css', __FILE__ ), null, TF_VERSION, 'all' );
	}

}


/*
 * We create a new control for the theme customizer (for the grouped options only)
 */
add_action( 'customize_register', 'registerShapingRainFrameworkOptionSelectControl', 1 );
function registerShapingRainFrameworkOptionSelectControl() {
	class ShapingRainFrameworkOptionSelectControl extends WP_Customize_Control {
		public $description;

		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select class="tf-select" <?php $this->link(); ?>>
					<?php sr_parse_select_options( $this->choices, (array) $this->value() ); ?>
					?></select>
				</select>
			</label>
			<?php
			if ( ! empty( $this->description ) ) {
				echo "<p class='description'>{$this->description}</p>";
			}
		}
	}
}


/**
 * Helper function for parsing select options
 *
 * This function is used to reduce duplicated code between the TF option
 * and the customizer control.
 *
 * @since 1.9
 *
 * @param array $options List of options
 * @param array $val     Current value
 *
 * @return void
 */
function sr_parse_select_options( $options, $val = array() ) {

	// No options? Duh...
	if ( empty( $options ) ) {
		return;
	}

	// Make sure the current value is an array (for multiple select).
	if ( ! is_array( $val ) ) {
		$val = (array) $val;
	}
	foreach ( $options as $value => $label ) {

		// This is if we have option groupings.
		if ( is_array( $label ) ) {

			?>
			<optgroup label="<?php echo $value ?>"><?php
			foreach ( $label as $subValue => $subLabel ) {

				printf( '<option value="%s" %s %s>%s</option>',
					$subValue,
					in_array( $subValue, $val ) ? 'selected="selected"' : '',
					disabled( stripos( $subValue, '!' ), 0, false ),
					$subLabel
				);
			}
			?></optgroup><?php
			// This is for normal list of options.
		} else {
			printf( '<option value="%s" %s %s>%s</option>',
				$value,
				in_array( $value, $val ) ? 'selected="selected"' : '',
				disabled( stripos( $value, '!' ), 0, false ),
				$label
			);
		}
	}

}
