<?php
/**
 * Plugin Name: Aspen Raw HTML
 * Plugin URI: http://www.shapingrain.com
 * Description: Renders any custom HTML and executes shortcodes.
 * Version: 1.0
 * License: GPLv2
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

if ( ! class_exists( 'Aspen_Raw_HTML_Widget' ) ) {
	class Aspen_Raw_HTML_Widget extends SR_Widget {

		function __construct() {

			// Configure widget array
			$args = array(
				// Widget Backend label
				'label'       => esc_html__( 'Aspen Raw HTML', 'aspen-features' ),
				// Widget Backend Description
				'description' => esc_html__( 'Renders any custom HTML with shortcodes.', 'aspen-features' ),
				'options' => array ( 'classname' => 'aspen-raw-html' )

			);

			// Configure the widget fields

			// fields array
			$args['fields'] = array(
				array(
					'name'   => esc_html__( 'Text', 'aspen-features' ),
					'desc'   => esc_html__( 'Enter text or custom mark-up here.', 'aspen-features' ),
					'id'     => 'text',
					'type'   => 'textarea_code',
					'rows'   => '15',
					'class'  => 'widefat',
					'std'    => '',
					'filter' => 'esc_html'
				),
			); // fields array

			$this->create_widget( $args );
		}

		// Output function
		function widget( $args, $instance ) {

			if ( ! function_exists( 'aspen_option' ) ) {
				return;
			}

			$out = $args['before_widget'];

			$out .= do_shortcode( html_entity_decode( aspen_array_option( 'text', $instance ) ) );

			$out .= $args['after_widget'];

			echo aspen_filter_widget( $out, $args, $instance );

		}

	} // class

	// Register widget
	if ( ! function_exists( 'register_aspen_raw_html_widget' ) ) {
		function register_aspen_raw_html_widget() {
			register_widget( 'Aspen_Raw_HTML_Widget' );
		}

		add_action( 'widgets_init', 'register_aspen_raw_html_widget', 1 );
	}
}