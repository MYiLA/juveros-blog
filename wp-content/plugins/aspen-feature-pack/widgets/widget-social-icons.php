<?php
/**
 * Plugin Name: Aspen Social Icons
 * Plugin URI: http://www.shapingrain.com
 * Description: Displays a progress bar.
 * Version: 1.0
 * License: GPLv2
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

if ( ! class_exists( 'Aspen_Social_Icons_Widget' ) ) {
	class Aspen_Social_Icons_Widget extends SR_Widget {

		function __construct() {

			// Configure widget array
			$args = array(
				// Widget Backend label
				'label'       => esc_html__( 'Aspen Social Icons', 'aspen-features' ),
				// Widget Backend Description
				'description' => esc_html__( 'Displays social profile links with icons.', 'aspen-features' ),
				'options'     => array( 'classname' => 'aspen-social-icons' )
			);


			// Tab groups
			$args['groups'] = array(
				'general' => esc_html__( 'General', 'aspen-features' ),
				'social'  => esc_html__( 'Links', 'aspen-features' ),
			);


			// Configure the widget fields
			// fields array
			$args['fields'] = array(
				array(
					'name'     => esc_html__( 'Title', 'aspen-features' ),
					'desc'     => esc_html__( 'Enter the widget title.', 'aspen-features' ),
					'id'       => 'title',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => esc_html__( 'Follow us', 'aspen-features' ),
					'group'    => 'general',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Website', 'aspen-features' ),
					'id'       => 'social_website',
					'group'    => 'social',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Facebook URL', 'aspen-features' ),
					'id'       => 'social_facebook',
					'group'    => 'social',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Twitter URL', 'aspen-features' ),
					'id'       => 'social_twitter',
					'group'    => 'social',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Google+ URL', 'aspen-features' ),
					'id'       => 'social_gplus',
					'group'    => 'social',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'LinkedIn URL', 'aspen-features' ),
					'id'       => 'social_linkedin',
					'group'    => 'social',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Instagram URL', 'aspen-features' ),
					'id'       => 'social_instagram',
					'group'    => 'social',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Pinterest URL', 'aspen-features' ),
					'id'       => 'social_pinterest',
					'group'    => 'social',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Flickr URL', 'aspen-features' ),
					'id'       => 'social_flickr',
					'group'    => 'social',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Tumblr URL', 'aspen-features' ),
					'id'       => 'social_tumblr',
					'group'    => 'social',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Foursquare URL', 'aspen-features' ),
					'id'       => 'social_foursquare',
					'group'    => 'social',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'YouTube URL', 'aspen-features' ),
					'id'       => 'social_youtube',
					'group'    => 'social',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Vimeo URL', 'aspen-features' ),
					'id'       => 'social_vimeo',
					'group'    => 'social',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
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

			$icon_size = '1';

			$out .= '<div class="social-widget icon-size-' . $icon_size . '">';

			$title = aspen_array_option( 'title', $instance );
			if ( ! empty( $title ) ) {
				$out .= '<h3 class="widget-title">' . esc_html( $title ) . '</h3>';
			}

			$social_facebook   = aspen_array_option( 'social_facebook', $instance, false );
			$social_twitter    = aspen_array_option( 'social_twitter', $instance, false );
			$social_gplus      = aspen_array_option( 'social_gplus', $instance, false );
			$social_linkedin   = aspen_array_option( 'social_linkedin', $instance, false );
			$social_instagram  = aspen_array_option( 'social_instagram', $instance, false );
			$social_pinterest  = aspen_array_option( 'social_pinterest', $instance, false );
			$social_flickr     = aspen_array_option( 'social_flickr', $instance, false );
			$social_tumblr     = aspen_array_option( 'social_tumblr', $instance, false );
			$social_foursquare = aspen_array_option( 'social_foursquare', $instance, false );
			$social_youtube    = aspen_array_option( 'social_youtube', $instance, false );
			$social_vimeo      = aspen_array_option( 'social_vimeo', $instance, false );
			$social_website    = aspen_array_option( 'social_website', $instance, false );


			if (
				$social_website ||
				$social_facebook ||
				$social_twitter ||
				$social_gplus ||
				$social_linkedin ||
				$social_instagram ||
				$social_pinterest ||
				$social_flickr ||
				$social_tumblr ||
				$social_foursquare ||
				$social_youtube ||
				$social_vimeo
			) {
				$out .= '<ul class="social-icons">';

				if ( $social_website ) {
					$out .= '<li>
					<a class="website" target="_blank" href="' . esc_url( $social_website ) . '">
					<i class="fa fa-home fa-' . $icon_size . 'x"></i>
					<span>' . esc_html__( 'Website', 'aspen-features' ) . '</span></a>
				</li>';
				}

				if ( $social_facebook ) {
					$out .= '<li>
					<a class="facebook" target="_blank" href="' . esc_url( $social_facebook ) . '">
					<i class="fa fa-facebook fa-' . $icon_size . 'x"></i>
					<span>' . esc_html__( 'Facebook', 'aspen-features' ) . '</span></a>
				</li>';
				}

				if ( $social_twitter ) {
					$out .= '<li>
					<a class="twitter" target="_blank" href="' . esc_url( $social_twitter ) . '">
					<i class="fa fa-twitter fa-' . $icon_size . 'x"></i>
					<span>' . esc_html__( 'Twitter', 'aspen-features' ) . '</span></a>
				</li>';
				}

				if ( $social_gplus ) {
					$out .= '<li>
					<a class="googleplus" target="_blank" href="' . esc_url( $social_gplus ) . '">
					<i class="fa fa-google-plus fa-' . $icon_size . 'x"></i>
					<span>' . esc_html__( 'Google+', 'aspen-features' ) . '</span></a>
				</li>';
				}

				if ( $social_linkedin ) {
					$out .= '<li>
					<a class="linkedin" target="_blank" href="' . esc_url( $social_linkedin ) . '">
					<i class="fa fa-linkedin fa-' . $icon_size . 'x"></i>
					<span>' . esc_html__( 'LinkedIn', 'aspen-features' ) . '</span></a>
				</li>';
				}

				if ( $social_instagram ) {
					$out .= '<li>
					<a class="instagram" target="_blank" href="' . esc_url( $social_instagram ) . '">
					<i class="fa fa-instagram fa-' . $icon_size . 'x"></i>
					<span>' . esc_html__( 'Instagram', 'aspen-features' ) . '</span></a>
				</li>';
				}

				if ( $social_pinterest ) {
					$out .= '<li>
					<a class="pinterest" target="_blank" href="' . esc_url( $social_pinterest ) . '">
					<i class="fa fa-pinterest fa-' . $icon_size . 'x"></i>
					<span>' . esc_html__( 'Pinterest', 'aspen-features' ) . '</span></a>
				</li>';
				}

				if ( $social_flickr ) {
					$out .= '<li>
					<a class="flickr" target="_blank" href="' . esc_url( $social_flickr ) . '">
					<i class="fa fa-flickr fa-' . $icon_size . 'x"></i>
					<span>' . esc_html__( 'Flickr', 'aspen-features' ) . '</span></a>
				</li>';
				}

				if ( $social_tumblr ) {
					$out .= '<li>
					<a class="tumblr" target="_blank" href="' . esc_url( $social_tumblr ) . '">
					<i class="fa fa-tumblr fa-' . $icon_size . 'x"></i>
					<span>' . esc_html__( 'Tumblr', 'aspen-features' ) . '</span></a>
				</li>';
				}

				if ( $social_foursquare ) {
					$out .= '<li>
					<a class="foursquare" target="_blank" href="' . esc_url( $social_foursquare ) . '">
					<i class="fa fa-foursquare fa-' . $icon_size . 'x"></i>
					<span>' . esc_html__( 'Foursquare', 'aspen-features' ) . '</span></a>
				</li>';
				}

				if ( $social_youtube ) {
					$out .= '<li>
					<a class="youtube" target="_blank" href="' . esc_url( $social_youtube ) . '">
					<i class="fa fa-youtube fa-' . $icon_size . 'x"></i>
					<span>' . esc_html__( 'YouTube', 'aspen-features' ) . '</span></a>
				</li>';
				}

				if ( $social_vimeo ) {
					$out .= '<li>
					<a class="vimeo" target="_blank" href="' . esc_url( $social_vimeo ) . '">
					<i class="fa fa-vimeo-square fa-' . $icon_size . 'x"></i>
					<span>' . esc_html__( 'Vimeo', 'aspen-features' ) . '</span></a>
				</li>';
				}

				$out .= '</ul>';
			}


			$out .= '</div>';

			$out .= $args['after_widget'];

			echo aspen_filter_widget( $out, $args, $instance );

		}

	} // class

	// Register widget
	if ( ! function_exists( 'register_aspen_social_icons_widget' ) ) {
		function register_aspen_social_icons_widget() {
			register_widget( 'Aspen_Social_Icons_Widget' );
		}

		add_action( 'widgets_init', 'register_aspen_social_icons_widget', 1 );
	}
}