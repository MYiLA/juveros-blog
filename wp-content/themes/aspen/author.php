<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aspen
 */

get_header(); ?>

<!--Start of Main Content-->
<main id="site-content">

	<!--Blog Category Header-->
	<div class="blog-header-inner">
		<div class="blog-header-content">

			<?php aspen_author_info( "author" ) ;?>

		</div>
	</div>
	<!--End of Blog Category Header-->

	<!--Start of Blog Posts-->
	<section id="blog-posts-overview">

		<div class="col-3-4">

			<!--Start of Default Row-->
			<?php
			$layout = aspen_get_blog_layout();
			if ( $layout == "masonry" || $layout == "grid" ) {
				echo '<div class="row-grid clearfix">';
			}
			?>

			<div class="<?php echo aspen_post_grid_classes( aspen_get_blog_layout(), array( 'clearfix' ) ); ?>" <?php echo aspen_post_grid_section_attrs( aspen_get_blog_layout() ); ?>>

				<?php if ( have_posts() ) : ?>

					<?php $item_count = 1; ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/blog-layouts/blog', aspen_get_blog_layout() ); ?>
					<?php endwhile; ?>

				<?php else : ?>

					<?php get_template_part( 'template-parts/content', 'none' ); ?>

				<?php endif; ?>

			</div>
			<!--End of Default Row-->

			<?php
			if ( $layout == "masonry" || $layout == "grid" ) {
				echo '</div>';
			}
			?>

		</div>

		<?php aspen_get_sidebar(); ?>


	</section>
	<!--End of Blog Posts-->

	<?php aspen_page_navigation(); ?>

</main>
<!--End of Main Content-->


<?php get_footer(); ?>
