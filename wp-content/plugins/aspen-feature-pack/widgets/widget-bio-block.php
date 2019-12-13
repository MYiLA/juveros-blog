<?php
/**
 * Plugin Name: Aspen Bio Block
 * Plugin URI: http://www.shapingrain.com
 * Description: Displays a testimonial.
 * Version: 1.0
 * License: GPLv2
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

if ( ! class_exists( 'Aspen_About_Me_Widget' ) ) {
	class Aspen_About_Me_Widget extends SR_Widget {

		function __construct() {

			// Configure widget array
			$args = array(
				// Widget Backend label
				'label'       => esc_html__( 'Aspen About Me', 'aspen-features' ),
				// Widget Backend Description
				'description' => esc_html__( 'Displays picture, name, position and social icons to introduce a person.', 'aspen-features' ),
				'options' => array ( 'classname' => 'aspen-bio-block' )
			);


			// Tab groups
			$args['groups'] = array(
				'general' => esc_html__( 'General', 'aspen-features' ),
				'social'  => esc_html__( 'Contact Options', 'aspen-features' ),
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
					'class'    => 'widefat',
					'std'      => esc_html__( 'About Me', 'aspen-features' ),
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Name', 'aspen-features' ),
					'desc'     => esc_html__( 'Enter this person\'s name.', 'aspen-features' ),
					'id'       => 'name',
					'group'    => 'general',
					'type'     => 'text',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Description', 'aspen-features' ),
					'desc'     => esc_html__( 'Enter a short description or introduction here, like a mini biography.', 'aspen-features' ),
					'id'       => 'description',
					'group'    => 'general',
					'type'     => 'textarea',
					'rows'     => '5',
					// class, rows, cols
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Job Title/Description/Company', 'aspen-features' ),
					'desc'     => esc_html__( 'Enter a job title, function and/or company name here.', 'aspen-features' ),
					'id'       => 'job_title',
					'group'    => 'general',
					'type'     => 'text',
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Link URL', 'aspen-features' ),
					'desc'     => esc_html__( 'Define a link to point this block to.', 'aspen-features' ),
					'id'       => 'link',
					'group'    => 'general',
					'type'     => 'text',
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Alignment', 'aspen-features' ),
					'desc'     => esc_html__( 'Select how text should be aligned.', 'aspen-features' ),
					'id'       => 'alignment',
					'type'     => 'select',
					'fields'   => array(
						array(
							'name'  => esc_html__( 'Left', 'aspen-features' ),
							'value' => 'left'
						),
						array(
							'name'  => esc_html__( 'Right', 'aspen-features' ),
							'value' => 'right'
						),
						array(
							'name'  => esc_html__( 'Center', 'aspen-features' ),
							'value' => 'center'
						)
					),
					'std'      => 'left',
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'  => esc_html__( 'Header Background Image', 'aspen-features' ),
					'desc'  => esc_html__( 'Upload an image to be displayed behind the avatar image.', 'aspen-features' ),
					'class' => 'img',
					'id'    => 'header_background',
					'group' => 'general',
					'type'  => 'image',
					'std'   => '',
					//'validate' => '',
					//'filter' => ''
				),
				array(
					'name'  => esc_html__( 'Avatar/Picture', 'aspen-features' ),
					'desc'  => esc_html__( 'Upload an image to be displayed.', 'aspen-features' ),
					'class' => 'img',
					'id'    => 'avatar',
					'group' => 'general',
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
							'name'  => esc_html__( 'Square', 'aspen-features' ),
							'value' => 'square'
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
				array(
					'name'  => esc_html__( 'Signature', 'aspen-features' ),
					'desc'  => esc_html__( 'Upload an image to be displayed as the signature.', 'aspen-features' ),
					'class' => 'img',
					'id'    => 'signature',
					'group' => 'general',
					'type'  => 'image',
					'std'   => '',
					//'validate' => '',
					//'filter' => ''
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
					'name'     => esc_html__( 'Email', 'aspen-features' ),
					'id'       => 'social_email',
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

			if ( aspen_array_option( 'title', $instance, false ) ) {
				$out .= $args['before_title'];
				$out .= esc_html( $instance['title'] );
				$out .= $args['after_title'];
			}

			$avatar      = aspen_array_option( 'avatar', $instance, false );
			$background  = aspen_array_option( 'header_background', $instance, false );

			$name        = aspen_array_option( 'name', $instance, false );
			$position    = aspen_array_option( 'job_title', $instance, false );
			$description = aspen_array_option( 'description', $instance, false );

			$signature = aspen_array_option( 'signature', $instance, false );

			$alignment = aspen_array_option( 'alignment', $instance, 'left' );

			$icon_size = '1x';

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

			$social_website = aspen_array_option( 'social_website', $instance, false );
			$social_email   = aspen_array_option( 'social_email', $instance, false );

			$avatar_style   = aspen_array_option( 'avatar_style', $instance, false );

			$link           = aspen_array_option( 'link', $instance, false );

			$out .= '<div class="aspen-bio-block image-' . $avatar_style . ' align-' . $alignment . '">';


			$background_image = '';
			if ( $background ) {
				$background = intval( $background );
				if ( $background != 0 ) {
					$background_image = wp_get_attachment_image_src( $background, 'full' );
					if ( $background_image ) {
						$background_image = ' style="background-image: url(' . esc_url( $background_image[0] ) . ');"';
					} else {
						$background_image = '';
					}
				}
			}

			$out .= '<div class="bio-header-background"' . $background_image . '></div>';

			$out .= '<div class="bio-header">';

			$link = trim( $link );

			if ( ! empty ( $link ) ) {
				$out .= '<a href="' . esc_url ( $link ) . '">';
			}

			if ( $avatar ) {
				$avatar = intval( $avatar );
				if ( $avatar != 0 ) {
					$avatar_image = wp_get_attachment_image_src( $avatar, 'ots-bio-avatar' );
					if ( $avatar_image ) {
						$out .= '<div class="bio-header-inner"><img src="' . esc_url( $avatar_image[0] ) . '" alt="' .
						        esc_attr(
							aspen_array_option( 'name', $instance, '' ) ) . '"></div>';
					}
				}
			}

			if ( $name || $position ) {
				$out .= '<div class="bio-header-info">';
			}

			if ( $name ) {
				$out .= '<h3>' . esc_html( $name ) . '</h3>';
			}

			if ( $position ) {
				$out .= '<p class="bio-job">' . esc_html( $position ) . '</p>';
			}

			if ( $name || $position ) {
				$out .= '</div>';
			}

			if ( ! empty ( trim ( $link ) ) ) {
				$out .= '</a>';
			}


			$out .= '</div>';


			if ( $description ) {
				$out .= '<p>' . aspen_esc_html( $description, false, true ) . '</p>';
			}

			if ( $signature ) {
				$signature = intval( $signature );
				if ( $signature != 0 ) {
					$signature_image = wp_get_attachment_image_src( $signature, 'full' );
					if ( $signature_image ) {
						$out .= '<img src="' . esc_url( $signature_image[0] ) . '" class="about-signature" alt="' .
						        esc_attr( aspen_array_option( 'name', $instance, '' ) ) . '">';
					}
				}
			}


			if (
					$social_website ||
					$social_email ||
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

				if ( $social_email ) {
					$out .= '<li>
					<a class="email" target="_blank" href="mailto:' . esc_html( $social_email ) . '">
					<i class="fa fa-envelope fa-' . $icon_size . 'x"></i>
					<span>' . esc_html__( 'Email', 'aspen-features' ) . '</span></a>
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
					<i class="fa fa-flickr fa-' . $icon_size . 'x"></i>
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
	if ( ! function_exists( 'register_aspen_about_me_widget' ) ) {
		function register_aspen_about_me_widget() {
			register_widget( 'Aspen_About_Me_Widget' );
		}

		add_action( 'widgets_init', 'register_aspen_about_me_widget', 1 );
	}
}