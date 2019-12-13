<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aspen
 */

get_header(); ?>

<!--Start of Main Content-->
<main id="site-content">

	<!--Hero Banner-->
	<?php aspen_frontpage_banner(); ?>
	<!--End of Hero Banner-->

	<!--Blog Promo Area-->
	<?php aspen_promo_widgets(); ?>
	<!--End of Blog Promo Area-->

	<!--Start of Blog Posts-->
	<section id="blog-posts-overview">

		<div class="col-3-4">

			<?php if ( ( aspen_option ( 'blog_layout' ) == 'grid' || aspen_option( 'blog_layout' ) == 'masonry' ) && aspen_option ( 'blog_feature_first_post' ) && have_posts() ) : the_post(); ?>
				<div class="featured-post">
					<?php get_template_part( 'template-parts/blog-layouts/blog', aspen_get_blog_layout() ); ?>
				</div>
			<?php endif; ?>

			<!--Start of Default Row-->
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

		</div>

		<?php aspen_get_sidebar(); ?>

	</section>
	<!--End of Blog Posts-->

	<?php aspen_page_navigation(); ?>

</main>
<!--End of Main Content-->


<?php get_footer(); ?>
