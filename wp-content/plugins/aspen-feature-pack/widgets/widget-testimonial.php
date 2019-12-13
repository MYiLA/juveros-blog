<?php
/**
 * Plugin Name: Aspen Testimonial
 * Plugin URI: http://www.shapingrain.com
 * Description: Displays a testimonial.
 * Version: 1.0
 * License: GPLv2
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

if ( ! class_exists( 'Aspen_Testimonial_Widget' ) ) {
	class Aspen_Testimonial_Widget extends SR_Widget {

		function __construct() {

			// Configure widget array
			$args = array(
				// Widget Backend label
				'label'       => esc_html__( 'Aspen Testimonial', 'aspen-features' ),
				// Widget Backend Description
				'description' => esc_html__( 'Displays a testimonial.', 'aspen-features' ),
				'options'     => array( 'classname' => 'aspen-testimonial' )
			);

			// Configure the widget fields

			// fields array
			$args['fields'] = array(

				// Title field
				array(
					'name'     => esc_html__( 'Title', 'aspen-features' ),
					'id'       => 'title',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => esc_html__( 'Testimonial', 'aspen-features' ),
					'validate' => 'alpha_dash',
					'filter'   => 'strip_tags|esc_attr'
				),
				array(
					'name'     => esc_html__( 'Quote', 'aspen-features' ),
					'desc'     => esc_html__( 'Enter the actual testimonial text here.', 'aspen-features' ),
					'id'       => 'quote',
					'type'     => 'textarea',
					'rows'     => '5',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => 'esc_textarea'
				),
				array(
					'name'     => esc_html__( 'Name', 'aspen-features' ),
					'desc'     => esc_html__( 'Enter the quoted person\'s name.', 'aspen-features' ),
					'id'       => 'name',
					'type'     => 'text',
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => 'strip_tags|esc_attr'
				),
				array(
					'name'     => esc_html__( 'Job Title/Description/Company', 'aspen-features' ),
					'desc'     => esc_html__( 'Enter a job title, function and/or company name here.', 'aspen-features' ),
					'id'       => 'job_title',
					'type'     => 'text',
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => 'strip_tags|esc_attr'
				),
				array(
					'name'  => esc_html__( 'Avatar/Picture', 'aspen-features' ),
					'desc'  => esc_html__( 'Upload an image to be displayed with this testimonial.', 'aspen-features' ),
					'class' => 'img',
					'id'    => 'avatar',
					'type'  => 'image',
					'std'   => '',
					//'validate' => '',
					//'filter' => ''
				),
				array(
					'name'     => esc_html__( 'Avatar Style', 'aspen-features' ),
					'desc'     => esc_html__( 'Select what style you would like to apply to this block\'s avatar.', 'aspen-features' ),
					'id'       => 'avatar_style',
					'group'    => 'general',
					'type'     => 'select',
					'fields'   => array(
						array(
							'name'  => esc_html__( 'Normal', 'aspen-features' ),
							'value' => 'normal'
						),
						array(
							'name'  => esc_html__( 'Rounded', 'aspen-features' ),
							'value' => 'rounded'
						),
						array(
							'name'  => esc_html__( 'Circle', 'aspen-features' ),
							'value' => 'circle'
						),
					),
					'std'      => 'normal',
					'validate' => 'alpha_dash',
					'filter'   => ''
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

			if ( aspen_array_option( 'title', $instance, false ) ) {
				$out .= $args['before_title'];
				$out .= esc_html( $instance['title'] );
				$out .= $args['after_title'];
			}

			$layout = 'speech-bubble';

			$avatar       = aspen_array_option( 'avatar', $instance, false );
			$avatar_image = false;

			$avatar_style = aspen_array_option( 'avatar_style', $instance, false );


			if ( $avatar ) {
				$avatar = intval( $avatar );
				if ( $avatar != 0 ) {
					$avatar_image = wp_get_attachment_image_src( $avatar, 'ots-testimonial-avatar' );
					if ( $avatar_image ) {
						$avatar_image = '<img src="' . esc_url( $avatar_image[0] ) . '" alt="' . esc_attr( aspen_array_option( 'name', $instance, '' ) ) . '">';
					}
				}
			}

			$add_classes = array(
				'aspen-testimonial',
				'layout-' . $layout,
				'image-' . $avatar_style
			);

			if ( $avatar_image ) {
				$add_classes[] = "has-avatar";
			} else {
				$add_classes[] = 'no-avatar';
			}

			$add_classes[] = 'text-align-center';

			$out .= '<blockquote class="' . implode( ' ', $add_classes ) . '">';

			$out .= '<q>' . aspen_esc_html( aspen_array_option( 'quote', $instance, '' ), false, true ) . '</q>';
			$out .= $avatar_image;

			$out .= '<footer class="testimonial-footer">';
			$out .= esc_html( aspen_array_option( 'name', $instance, '' ) );
			$out .= '<span>' . esc_html( aspen_array_option( 'job_title', $instance, '' ) ) . '</span>';
			$out .= '</footer>';

			$out .= '</blockquote>';

			$out .= $args['after_widget'];

			echo aspen_filter_widget( $out, $args, $instance );

		}

	} // class

	// Register widget
	if ( ! function_exists( 'register_aspen_testimonial_widget' ) ) {
		function register_aspen_testimonial_widget() {
			register_widget( 'Aspen_Testimonial_Widget' );
		}

		add_action( 'widgets_init', 'register_aspen_testimonial_widget', 1 );
	}
}