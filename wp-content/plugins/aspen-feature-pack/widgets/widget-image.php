<?php
/**
 * Plugin Name: Aspen Image
 * Plugin URI: http://www.shapingrain.com
 * Description: Displays an image.
 * Version: 1.0
 * License: GPLv2
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

if ( ! class_exists( 'Aspen_Image_Widget' ) ) {
	class Aspen_Image_Widget extends SR_Widget {

		function __construct() {

			// Configure widget array
			$args = array(
				// Widget Backend label
				'label'       => esc_html__( 'Aspen Image', 'aspen-features' ),
				// Widget Backend Description
				'description' => esc_html__( 'Displays a simple image.', 'aspen-features' ),
				'options' => array ( 'classname' => 'aspen-image' )
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
					'name'  => esc_html__( 'Image', 'aspen-features' ),
					'desc'  => esc_html__( 'Upload or select an image.', 'aspen-features' ),
					'class' => 'img',
					'id'    => 'image',
					'type'  => 'image',
					'std'   => '',
					//'validate' => '',
					//'filter' => ''
				),
				array(
					'name'     => esc_html__( 'Link URL', 'aspen-features' ),
					'desc'     => esc_html__( 'Enter an optional URL to link the image to.', 'aspen-features' ),
					'id'       => 'link',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Open Link in New Window', 'aspen-features' ),
					'id'       => 'link_target',
					'type'     => 'checkbox',
					'class'    => 'widefat',
					'std'      => 0,
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

			$image     = aspen_array_option( 'image', $instance );

			$link        = esc_url( trim( aspen_array_option( 'link', $instance, '' ) ) );
			$link_target = aspen_array_option( 'link_target', $instance, false );
			if ( $link_target == 1 ) {
				$link_target = ' target="_blank"';
			}


			// image output
			if ( $image ) {
				$image_src = wp_get_attachment_image_src( intval( $image ), "full" );

				if ( $image_src ) {
					$title = aspen_array_option( 'title', $instance, false );
					if ( $title ) {
						$title_alt = ' alt="' . esc_attr( $title ) . '"';
					} else {
						$attachment  = get_post( intval( $image ) );
						$image_title = $attachment->post_title;

						$title_alt = ' alt="' . esc_attr( $image_title ) . '"';
					}

					$out .= '<div class="single-image">';

					if ( $link && $link != '' ) {
						// link URLs are escaped as such while retrieved from database
						$out .= '<a href="' . esc_attr( $link ) . '"' . $link_target . '>';
					}
					$out .= '<img src="' . esc_url( $image_src[0] ) . '"' . $title_alt . '>';
					if ( $link && $link != '' ) {
						$out .= '</a>';
					}
					$out .= '</div>';
				}
			}

			$out .= $args['after_widget'];

			echo aspen_filter_widget( $out, $args, $instance );


		}

	} // class

	// Register widget
	if ( ! function_exists( 'register_aspen_image_widget' ) ) {
		function register_aspen_image_widget() {
			register_widget( 'Aspen_Image_Widget' );
		}

		add_action( 'widgets_init', 'register_aspen_image_widget', 1 );
	}
}