<?php
/**
 * Plugin Name: Aspen Recent Comments
 * Plugin URI: http://www.shapingrain.com
 * Description: Displays a progress bar.
 * Version: 1.0
 * License: GPLv2
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

if ( ! class_exists( 'Aspen_Recent_Comments_Widget' ) ) {
	class Aspen_Recent_Comments_Widget extends SR_Widget {

		function __construct() {

			// Configure widget array
			$args = array(
				// Widget Backend label
				'label'       => esc_html__( 'Aspen Recent Comments', 'aspen-features' ),
				// Widget Backend Description
				'description' => esc_html__( 'Displays the most recent comments.', 'aspen-features' ),
				'options' => array ( 'classname' => 'aspen-recent-comments' )

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
					'std'      => esc_html__( 'Recent Comments', 'aspen-features' ),
					'validate' => 'alpha_dash',
					'filter'   => ''
				),
				array(
					'name'     => esc_html__( 'Amount of comments to show', 'aspen-features' ),
					'desc'     => esc_html__( 'Enter an amount of comments you would like to display.', 'aspen-features' ),
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

			$out .= $args['before_title'] . aspen_array_option( "title", $instance ) . $args['after_title'];

			if ( ! $amount = absint( aspen_array_option( 'amount', $instance ) ) ) {
				$amount = 5;
			}

			$recent_comments = get_comments( array(
				'number' => $amount,
				'status' => 'approve'
			) );

			$out .= "<ul>\n";

			if ( is_array( $recent_comments ) && count( $recent_comments ) > 0 ) {
				foreach ( $recent_comments as $comment ) {
					$post = get_post( $comment->comment_post_ID, 'OBJECT' );
					$out .= '<li><a href="' . esc_url( get_permalink( $post->ID ) ) . '" title="' . esc_attr( $post->post_title ) . '" rel="bookmark">';

					$out .= get_avatar( $comment->comment_author_email, 120 );

					$out .= '<p>' . esc_html( $post->post_title ) . '</p><div><span class="comment-author">' . esc_html( $comment->comment_author ) . '</span><span class="widget_date">' . get_the_time( get_option( 'date_format' ), $post->ID ) . '</span></div>';

					$out .= '</a></li>';

				}
			}

			$out .= "</ul>\n";

			$out .= $args['after_widget'];

			echo aspen_filter_widget( $out, $args, $instance );

		}

	} // class

	// Register widget
	if ( ! function_exists( 'register_aspen_recent_comments_widget' ) ) {
		function register_aspen_recent_comments_widget() {
			register_widget( 'Aspen_Recent_Comments_Widget' );
		}

		add_action( 'widgets_init', 'register_aspen_recent_comments_widget', 1 );
	}
}