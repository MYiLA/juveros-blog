<?php
/**
 * Plugin Name: Aspen Instagram Feed
 * Plugin URI: http://www.shapingrain.com
 * Description: Displays an Instagram feed, integration for the popular Instagram Feed widget by Smash Balloon.
 * Version: 1.0
 * License: GPLv2
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

if ( ! class_exists( 'Aspen_Instagram_Widget' ) ) {
	class Aspen_Instagram_Widget extends SR_Widget {

		function __construct() {

			// Configure widget array
			$args = array(
				// Widget Backend label
				'label'       => esc_html__( 'Aspen Instagram Feed', 'aspen-features' ),
				// Widget Backend Description
				'description' => esc_html__( 'Displays an Instagram Feed.', 'aspen-features' ),
				'options'     => array( 'classname' => 'aspen-instagram' )
			);



			// Configure the widget fields


			if ( ! function_exists( 'sb_instagram_activate' ) ) {
				$args['fields'] = array ( array(
					'name'     => esc_html__( 'Info', 'aspen-features' ),
					'desc'     => esc_html__( 'This widget requires Instagram Feed plug-in by Smash Balloon. You can find it in the WordPress plug-in repository.', 'aspen-features' ),
					'id'       => 'info',
					'type'     => 'paragraph',
					'class'    => 'widefat',
					'std'      => '',
					'validate' => 'numeric',
					'filter'   => ''
				) );
			} else {
				// fields array
				$args['fields'] = array(
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
						'name'     => esc_html__( 'Profile Link URL', 'aspen-features' ),
						'desc'     => esc_html__( 'Enter an optional URL to link the title to.', 'aspen-features' ),
						'id'       => 'link',
						'type'     => 'text',
						// class, rows, cols
						'class'    => 'widefat',
						'std'      => '',
						'validate' => 'alpha_dash',
						'filter'   => ''
					),
					array(
						'name'     => esc_html__( 'Columns', 'aspen-features' ),
						'desc'     => esc_html__( 'How many items should be displayed per row?', 'aspen-features' ),
						'id'       => 'columns',
						'type'     => 'select',
						'fields'   => array(
							array(
								'name'  => '1',
								'value' => '1'
							),
							array(
								'name'  => '2',
								'value' => '2'
							),
							array(
								'name'  => '3',
								'value' => '3'
							),
							array(
								'name'  => '4',
								'value' => '4'
							),
							array(
								'name'  => '5',
								'value' => '5'
							),
							array(
								'name'  => '6',
								'value' => '6'
							),
							array(
								'name'  => '7',
								'value' => '7'
							),
							array(
								'name'  => '8',
								'value' => '8'
							),
							array(
								'name'  => '9',
								'value' => '9'
							),
							array(
								'name'  => '10',
								'value' => '10'
							),
							array(
								'name'  => '11',
								'value' => '11'
							),
							array(
								'name'  => '12',
								'value' => '12'
							),
						),
						'std'      => 8,
						'validate' => 'numeric',
						'filter'   => ''
					),
					array(
						'name'     => esc_html__( 'Amount of Items', 'aspen-features' ),
						'desc'     => esc_html__( 'Enter maximum number of items that should be displayed initially.', 'aspen-features' ),
						'id'       => 'amount',
						'type'     => 'text',
						// class, rows, cols
						'class'    => 'widefat',
						'std'      => '8',
						'validate' => 'numeric',
						'filter'   => ''
					),

				); // fields array
			}





			$this->create_widget( $args );
		}

		// Output function
		function widget( $args, $instance ) {

			if ( ! function_exists( 'aspen_option' ) ) {
				return;
			}

			$out = $args['before_widget'];

			if ( ! function_exists( 'sb_instagram_activate' ) && current_user_can( 'administrator' ) ) {

				$out .= '<div class="missing-plugin">' . esc_html__( 'The Instagram Feed widget requires the Instagram Feed plug-in by Smash Balloon. You can find it in the WordPress plug-in repository. This message is only visible for administrators.', 'aspen-features' ) . '</div>';

			} else {

				$link    = esc_url( trim( aspen_array_option( 'link', $instance, '' ) ) );
				$amount  = intval( aspen_array_option( 'amount', $instance, '' ) );
				$columns = intval( aspen_array_option( 'columns', $instance, '' ) );

				if ( ! empty ( $link ) ) {
					$out .= '<a href="' . esc_attr( $link ) . '">';
				}

				if ( aspen_array_option( 'title', $instance, false ) ) {
					$out .= $args['before_title'];
					$out .= esc_html( $instance['title'] );
					$out .= $args['after_title'];
				}

				if ( ! empty ( $link ) ) {
					$out .= '</a>';
				}

				$out .= do_shortcode( '[instagram-feed num="' . $amount . '" cols="' . $columns . '"]' );

			}

			$out .= $args['after_widget'];

			echo aspen_filter_widget( $out, $args, $instance );


		}

	} // class

	// Register widget
	if ( ! function_exists( 'register_aspen_instagram_widget' ) ) {
		function register_aspen_instagram_widget() {
			register_widget( 'Aspen_Instagram_Widget' );
		}

		add_action( 'widgets_init', 'register_aspen_instagram_widget', 1 );
	}
}