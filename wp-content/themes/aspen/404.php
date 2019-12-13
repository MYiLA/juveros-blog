<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link    https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package aspen
 */

get_header(); ?>

	<!--Start of Main Content-->
	<main id="site-content">

		<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'error-404', 'not-found' ) ); ?>>

			<!--Blog Post Header-->
			<div class="error404-info clearfix">

				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/404-mug.jpg" alt="<?php esc_attr_e ('Not Found', 'aspen' ); ?>" />

				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'That page can&rsquo;t be found.', 'aspen' ); ?></h1>
				</header>
				<!-- .page-header -->
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try searching for something else?', 'aspen' ); ?></p>
				<div class="widget_search">
					<?php get_search_form(); ?>
				</div>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="take-me-home"><?php esc_html_e( 'Take me to the home page', 'aspen' ); ?></a>

			</div>
			<!--End of Blog Post Header-->

		</article><!-- #post-## -->


	</main>
	<!--End of Main Content-->

<?php get_footer(); ?>