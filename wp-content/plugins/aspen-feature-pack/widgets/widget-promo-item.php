<?php
/**
 * Plugin Name: Aspen Promo Item
 * Plugin URI: http://www.shapingrain.com
 * Description: Displays an image as a promo item.
 * Version: 1.0
 * License: GPLv2
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

if ( ! class_exists( 'Aspem_Promo_Item_Widget' ) ) {
	class Aspem_Promo_Item_Widget extends SR_Widget {

		function __construct() {

			// Configure widget array
			$args = array(
				// Widget Backend label
				'label'       => esc_html__( 'Aspen Promo Item', 'aspen-features' ),
				// Widget Backend Description
				'description' => esc_html__( 'Displays an image as a promo item.', 'aspen-features' ),
				'options'     => array( 'classname' => 'aspen-promo-item' )

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
					'name'     => esc_html__( 'Primary Label', 'aspen-features' ),
					'desc'     => esc_html__( 'This is a larger, highlighted label.', 'aspen-features' ),
					'id'       => 'primary_label',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Secondary Label', 'aspen-features' ),
					'desc'     => esc_html__( 'This is a smaller, secondary label used for additional description or a call to action.',	'aspen-features' ),
					'id'       => 'secondary_label',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Image', 'aspen-features' ),
					'desc'     => esc_html__( 'Upload or select an image.', 'aspen-features' ),
					'class'    => 'img',
					'id'       => 'image',
					'type'     => 'image',
					'std'      => '',
					'validate' => 'numeric',
					'filter'   => ''
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

			if ( ! function_exists( 'aspen_esc_html' ) ) {
				return;
			}

			$out = $args['before_widget'];


			if ( aspen_array_option( 'title', $instance, false ) ) {
				$out .= $args['before_title'];
				$out .= esc_html( $instance['title'] );
				$out .= $args['after_title'];
			}

			$out .= '<div class="promo-item-wrapper">';

			$image          = aspen_array_option( 'image', $instance );
			$thumbnail_size = 'full';

			$link        = '';
			$link_target = '';


			$link        = esc_url( trim( aspen_array_option( 'link', $instance, '' ) ) );
			$link_target = aspen_array_option( 'link_target', $instance, false );
			if ( $link_target == 1 ) {
				$link_target = ' target="_blank"';
			}

			if ( $image ) {
				$image_src = wp_get_attachment_image_src( intval( $image ), "full" );
				if ( $thumbnail_size == "full" ) {
					$thumbnail_image_src = $image_src;
				} else {
					$thumbnail_image_src = wp_get_attachment_image_src( intval( $image ), $thumbnail_size );
				}

				if ( $image_src ) {
					$title = aspen_array_option( 'title', $instance, false );

					$primary_label = aspen_esc_html( aspen_array_option( 'primary_label', $instance, false ), false,
						true );

					$secondary_label = aspen_esc_html( aspen_array_option( 'secondary_label', $instance, false ),
						false,
						true );


					$out .= '<div class="promo-item-image" style="background-image: url(' . esc_url( $thumbnail_image_src[0] ) . ');">';

                    $out .= '</div>';

					if ( $link && $link != '' ) {
						// link URLs are escaped as such while retrieved from database
						$out .= '<a href="' . esc_attr( $link ) . '"' . $link_target . '>';
					}

					$out .= '<div class="promo-item-inner">';

					if ( ! empty( $primary_label ) || ! empty( $secondary_label ) ) {
						$out .= '<div class="promo-text">';
						if ( ! empty( $primary_label ) ) {
							$out .= '<h3>' . $primary_label . '</h3>';
						}
						if ( ! empty( $secondary_label ) ) {
							$out .= '<p>' . esc_html( $secondary_label ) . '</p>';
						}
						$out .= '</div>';
					}

					$out .= '</div>';

					if ( ! empty( $link ) ) {
						$out .= '</a>';
					}

				}
			}

			$out .= '</div>'; // div.promo-item-wrapper


			$out .= $args['after_widget'];

			echo aspen_filter_widget( $out, $args, $instance );


		}

	} // class

	// Register widget
	if ( ! function_exists( 'register_aspen_promo_item_widget' ) ) {
		function register_aspen_promo_item_widget() {
			register_widget( 'Aspem_Promo_Item_Widget' );
		}

		add_action( 'widgets_init', 'register_aspen_promo_item_widget', 1 );
	}
}