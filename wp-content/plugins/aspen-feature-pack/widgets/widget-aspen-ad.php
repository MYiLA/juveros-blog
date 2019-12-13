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

if ( ! class_exists( 'Aspen_Ad_Widget' ) ) {
	class Aspen_Ad_Widget extends SR_Widget {

		function __construct() {

			// Configure widget array
			$args = array(
				// Widget Backend label
				'label'       => esc_html__( 'Aspen Ad', 'aspen-features' ),
				// Widget Backend Description
				'description' => esc_html__( 'Renders an ad.', 'aspen-features' ),
				'options'     => array( 'classname' => 'aspen-ad' )

			);

			// Configure the widget fields

			// fields array
			$args['fields'] = array(
				array(
					'name'   => esc_html__( 'HTML Code', 'aspen-features' ),
					'desc'   => esc_html__( 'Enter custom mark-up here. Either this code or an uploaded image is displayed, not both.', 'aspen-features' ),
					'id'     => 'text',
					'type'   => 'textarea_code',
					'rows'   => '15',
					'class'  => 'widefat',
					'std'    => '',
					'filter' => 'esc_html'
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
					'desc'     => esc_html__( 'Define a URL to point this link to.', 'aspen-features' ),
					'id'       => 'link',
					'type'     => 'text',
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
				array(
					'name'     => esc_html__( 'Add "nofollow" attribute to link.', 'aspen-features' ),
					'id'       => 'link_nofollow',
					'group'    => 'button',
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

			$code = aspen_array_option( 'text', $instance );
			$image = aspen_array_option( 'image', $instance );

			$link        = esc_url( trim( aspen_array_option( 'link', $instance, '' ) ) );
			$link_target = aspen_array_option( 'link_target', $instance, false );
			if ( $link_target == 1 ) {
				$link_target = ' target="_blank"';
			}

			if ( aspen_array_option( 'link_nofollow', $instance, false ) ) {
				$link_nofollow = ' rel="nofollow"';
			} else {
				$link_nofollow = '';
			}


			if ( !empty ( $code ) ) {
				$out .= '<aside class="ad-code">' . do_shortcode( html_entity_decode( $code ) ) . '</aside>';
			} else {
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

						$out .= '<aside class="ad-image">';

						if ( $link && $link != '' ) {
							// link URLs are escaped as such while retrieved from database
							$out .= '<a href="' . esc_attr( $link ) . '"' . $link_target . $link_nofollow . '>';
						}

						$out .= '<img src="' . esc_url( $image_src[0] ) . '"' . $title_alt . '>';

						if ( $link && $link != '' ) {
							$out .= '</a>';
						}

						$out .= '</aside>';
					}
				}
			}


			$out .= $args['after_widget'];

			echo aspen_filter_widget( $out, $args, $instance );

		}

	} // class

	// Register widget
	if ( ! function_exists( 'register_aspen_ad_widget' ) ) {
		function register_aspen_ad_widget() {
			register_widget( 'Aspen_Ad_Widget' );
		}

		add_action( 'widgets_init', 'register_aspen_ad_widget', 1 );
	}
}