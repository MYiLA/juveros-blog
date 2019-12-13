<?php
/**
 * Plugin Name: Aspen Recent Posts
 * Plugin URI: http://www.shapingrain.com
 * Description: Displays a progress bar.
 * Version: 1.0
 * License: GPLv2
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

if ( ! class_exists( 'Aspen_Recent_Posts_Widget' ) ) {

	class Aspen_Recent_Posts_Widget extends SR_Widget {

		function __construct() {

			// Configure widget array
			$args = array(
				// Widget Backend label
				'label'       => esc_html__( 'Aspen Recent Posts', 'aspen-features' ),
				// Widget Backend Description
				'description' => esc_html__( 'Displays the most recent posts.', 'aspen-features' ),
				'options' => array ( 'classname' => 'aspen-recent-posts' )

			);

			// Configure the widget fields

			// fields array
			$args['fields'] = array(
				array(
					'name'     => esc_html__( 'Title', 'aspen-features' ),
					'desc'     => esc_html__( 'Enter the widget title.', 'aspen-features' ),
					'id'       => 'title',
					'type'     => 'text',
					'class'    => 'widefat',
					'std'      => esc_html__( 'Recent Posts', 'aspen-features' ),
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Amount of posts to show', 'aspen-features' ),
					'desc'     => esc_html__( 'Enter an amount of posts you would like to display.', 'aspen-features' ),
					'id'       => 'amount',
					'type'     => 'text',
					'class'    => '',
					'std'      => '5',
					'validate' => 'numeric',
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

			$title = aspen_array_option( 'title', $instance );
			if ( ! empty( $title ) ) {
				$out .= $args['before_title'] . esc_html ( $title ) . $args['after_title'];
			}

			if ( ! $amount = absint( aspen_array_option( 'amount', $instance ) ) ) {
				$amount = 5;
			}

			$qargs = array(
				'posts_per_page'      => $amount,
				'nopaging'            => false,
				'suppress_filters'    => true,
				'ignore_sticky_posts' => true
			);

			$aspen_recent_posts_q = null;
			$aspen_recent_posts_q = new WP_Query( $qargs );

			$out .= "<ul>\n";

			while ( $aspen_recent_posts_q->have_posts() ) {
				$aspen_recent_posts_q->the_post();

				$format = get_post_format();
				if ( false === $format ) {
					$format = 'default';
				}

				if ( has_post_thumbnail() ) {
					$nothumbnail = ' has-thumb';
				} else {
					$nothumbnail = ' no-thumb';
				}

				$out .= '<li class="format-' . $format . $nothumbnail . '">';


				$out .= '<p>';

				$out .= '<a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '" rel="bookmark">';

				if ( has_post_thumbnail() ) {
					$out .= get_the_post_thumbnail( get_the_ID(), 'aspen-post-thumbnail-tiny' );
				}

				$out .= esc_html( get_the_title() );

				$out .= '</a>';

				$out .= aspen_primary_category( true );
				$out .= '<span class="widget_date">' . get_the_time( get_option( 'date_format' ) ) . '</span>';

				$out .= '</p>';

				$out .= '</li>';

			}

			wp_reset_query();

			$out .= "</ul>\n";

			$out .= $args['after_widget'];

			echo aspen_filter_widget( $out, $args, $instance );

		}

	} // class

	// Register widget
	if ( ! function_exists( 'register_aspen_recent_posts_widget' ) ) {
		function register_aspen_recent_posts_widget() {
			register_widget( 'Aspen_Recent_Posts_Widget' );
		}

		add_action( 'widgets_init', 'register_aspen_recent_posts_widget', 1 );
	}
}