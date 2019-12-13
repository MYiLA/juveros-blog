<?php
/**
 * Heading option
 *
 * @package ShapingRain Framework
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly.
}

/**
 * Heading Option
 *
 * A heading for separating your options in an admin page or meta box
 *
 * <strong>Creating a heading option with a description:</strong>
 * <pre>$adminPage->createOption( array(
 *     'name' => __( 'General Settings', 'default' ),
 *     'type' => 'heading',
 *     'desc' => __( 'Settings for the general usage of the plugin', 'default' ),
 * ) );</pre>
 *
 * @since 1.0
 * @type heading
 * @availability Admin Pages|Meta Boxes|Customizer
 * @no id,default,livepreview,css,hidden
 */
class ShapingRainFrameworkOptionHeading extends ShapingRainFrameworkOption {

	/**
	 * Display for options and meta
	 */
	public function display() {
		$headingID = str_replace( ' ', '-', strtolower( $this->settings['name'] ) );
		$class = $this->getClass();
		$tag = $this->getTag();

		if ( empty ( $tag ) )
			$tag = "h3";

		?>
		<tr valign="top" class="<?php if ( ! empty ( $class ) ) { echo $class . ' '; } ?>even first tf-heading">
			<th scope="row" class="first last" colspan="2">
				<<?php echo $tag; ?> id="<?php echo esc_attr( $headingID ) ?>"><?php echo $this->settings['name'] ?></<?php echo $tag; ?>>
				<?php
				if ( ! empty( $this->settings['desc'] ) ) {
					?><p class='description'><?php echo $this->settings['desc'] ?></p><?php
				}
				?>
			</th>
		</tr>
		<?php
	}

	/**
	 * Display for theme customizer
	 *
	 * @param WP_Customize             $wp_customize The customizer object.
	 * @param ShapingRainFrameworkCustomizer $section      The customizer section.
	 * @param int                      $priority     The display priority of the control.
	 */
	public function registerCustomizerControl( $wp_customize, $section, $priority = 1 ) {
		$wp_customize->add_control( new ShapingRainFrameworkOptionHeadingControl( $wp_customize, $this->getID(), array(
			'label' => $this->settings['name'],
			'section' => $section->settings['id'],
			'type' => 'select',
			'settings' => $this->getID(),
			'description' => $this->settings['desc'],
			'priority' => $priority,
		) ) );
	}
}


// We create a new control for the theme customizer.
add_action( 'customize_register', 'register_shapingrain_framework_option_heading_control', 1 );

/**
 * Register the customizer control
 */
function register_shapingrain_framework_option_heading_control() {

	/**
	 * Heading option class
	 *
	 * @since 1.0
	 */
	class ShapingRainFrameworkOptionHeadingControl extends WP_Customize_Control {

		/**
		 * The description of this control
		 *
		 * @var bool
		 */
		public $description;

		/**
		 * Renders the control
		 */
		public function render_content() {

			?>
			<h3 class="customize-control-title tf-heading">
				<?php echo esc_html( $this->label ) ?>
				<?php
				if ( ! empty( $this->description ) ) {
					echo "<p class='description'>" . wp_kses_post( $this->description ) . '</p>';
				}
				?>
			</h3>
			<?php
		}
	}
}
