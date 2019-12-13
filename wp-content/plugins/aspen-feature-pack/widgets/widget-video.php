<?php
/**
 * Plugin Name: Aspen Video
 * Plugin URI: http://www.shapingrain.com
 * Description: Displays a map.
 * Version: 1.0
 * License: GPLv2
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

if ( ! class_exists( 'Aspen_Video_Widget' ) ) {
	class Aspen_Video_Widget extends SR_Widget {

		function __construct() {

			// Configure widget array
			$args = array(
				// Widget Backend label
				'label'       => esc_html__( 'Aspen Embedded Video', 'aspen-features' ),
				// Widget Backend Description
				'description' => esc_html__( 'Displays an embedded video.', 'aspen-features' ),
				'options' => array ( 'classname' => 'aspen-embedded-video' )
			);

			// Configure the widget fields

			// fields array
			$args['fields'] = array(

				// Title field
				array(
					'name'     => esc_html__( 'Title', 'aspen-features' ),
					'desc'     => esc_html__( 'Enter the widget title.', 'aspen-features' ),
					'id'       => 'title',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Video URL or Custom Embed Code', 'aspen-features' ),
					'desc'     => esc_html__( 'Enter a plain video URL, or an embed code. If using custom embed codes, make sure you modify it to be responsive.', 'aspen-features' ),
					'id'       => 'code',
					'type'     => 'textarea',
					'rows'     => '5',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => 'esc_textarea'
				),
				array(
					'name'     => esc_html__( 'Embed Mode', 'aspen-features' ),
					'desc'     => esc_html__( 'Select which embed mode you would like to use.', 'aspen-features' ),
					'id'       => 'type',
					'type'     => 'select',
					'fields'   => array(
						array(
							'name'  => esc_html__( 'oEmbed from plain URL', 'aspen-features' ),
							'value' => 'embed'
						),
						array(
							'name'  => esc_html__( 'Custom integration code', 'aspen-features' ),
							'value' => 'custom'
						),
						array(
							'name'  => esc_html__( 'Custom integration code, with responsive wrapper', 'aspen-features' ),
							'value' => 'custom_wrapper'
						)

					),
					'std'      => 'embed',
					'validate' => 'alpha_dash',
					'filter'   => ''
				)
			); // fields array

			$this->create_widget( $args );
		}


		// Output function
		function widget( $args, $instance ) {

			if ( ! function_exists( 'aspen_option' ) ) {
				return;
			}

			$out = $args['before_widget'];

			if ( aspen_array_option( 'title', $instance, false ) ) {
				$out .= $args['before_title'];
				$out .= esc_html ( $instance['title'] );
				$out .= $args['after_title'];
			}


			$type = aspen_array_option( 'type', $instance, false );

			if ( $type == "custom" ) {
				$out .= aspen_esc_html( html_entity_decode( aspen_array_option( 'code', $instance, '' ) ) );
			} elseif ( $type == "custom_wrapper" ) {
				$out .= '<figure class="embed-container">' . aspen_esc_html( html_entity_decode( aspen_array_option( 'code', $instance, '' ) ) ) . '</figure>';
			} else {
				$embed = new WP_Embed();
				$out .= $embed->run_shortcode( '[embed]' . aspen_array_option( 'code', $instance, '' ) . '[/embed]' );
			}

			$out .= $args['after_widget'];

			echo aspen_filter_widget( $out, $args, $instance );

		}

	} // class

	// Register widget
	if ( ! function_exists( 'register_aspen_video_widget' ) ) {
		function register_aspen_video_widget() {
			register_widget( 'Aspen_Video_Widget' );
		}

		add_action( 'widgets_init', 'register_aspen_video_widget', 1 );
	}
}