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
	<div class="aspen-full-width">
		<div<?php aspen_page_header_tag( 'category' ); ?>>
			<div class="blog-header-inner">
				<div class="blog-header-content">
					<h1><?php the_archive_title(); ?></h1>
					<?php the_archive_description(); ?>
					<?php aspen_breadcrumb(); ?>
				</div>
			</div>
		</div>
	</div>
	<!--End of Blog Category Header-->

	<!--Start of Blog Posts-->
	<section id="blog-posts-overview">

		<div class="col-3-4">

			<?php if ( ( aspen_option( 'blog_layout' ) == 'grid' || aspen_option( 'blog_layout' ) == 'masonry' ) && aspen_option( 'blog_feature_first_post' ) && have_posts() ) : the_post(); ?>
				<div class="featured-post">
					<?php get_template_part( 'template-parts/blog-layouts/blog', aspen_get_blog_layout() ); ?>
				</div>
			<?php endif; ?>


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
