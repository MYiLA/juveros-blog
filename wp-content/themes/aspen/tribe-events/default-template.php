<?php
/**
 * Default Events Template 
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aspen
 */

get_header(); ?>

<!--Start of Main Content-->
<main id="site-content">

	<?php
	/**
	 * Template part for displaying page content in page.php.
	 *
	 * @link    https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package aspen
	 */

	?>

	<div class="col-3-4">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="entry-content">

					<?php tribe_events_before_html(); ?>
					<?php tribe_get_view(); ?>
					<?php tribe_events_after_html(); ?>

			</div><!-- .entry-content -->

		</article><!-- #post-## -->

		</div>

	<div id="sidebar" class="widget-area col-4" role="complementary">
		<?php if ( is_active_sidebar( 'aspen-sidebar' ) && ! aspen_option( 'hide_sidebar' ) ) : ?>
			<?php dynamic_sidebar( 'aspen-sidebar' ); ?>
		<?php endif; ?>
	</div>

</main>
<!--End of Main Content-->

<?php get_footer(); ?>