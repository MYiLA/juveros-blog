<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package aspen
 */

get_header(); ?>

<!--Start of Main Content-->
<main id="site-content">

	<!--Blog Category Header-->
	<div class="aspen-full-width">
		<div<?php aspen_page_header_tag(); ?>>
			<div class="blog-header-inner">
				<div class="blog-header-content">
					<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'aspen' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</div>
			</div>
		</div>
	</div>
	<!--End of Blog Category Header-->

	<!--Start of Blog Posts-->
	<section id="blog-posts-overview">

		<!--Start of Default Row-->
		<?php
		$layout = aspen_get_blog_layout();
		if ( $layout == "masonry" || $layout == "grid" ) {
			echo '<div class="row-grid clearfix">';
		}
		?>

		<div class="<?php echo aspen_post_grid_classes( aspen_get_blog_layout(), array( 'row', 'clearfix' ) ); ?>" <?php echo aspen_post_grid_section_attrs( aspen_get_blog_layout() ); ?>>

			<?php if ( have_posts() ) : ?>

				<?php $item_count = 1; ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/blog-layouts/blog', 'standard' ); ?>
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
	</section>
	<!--End of Blog Posts-->

	<?php aspen_page_navigation(); ?>


</main>
<!--End of Main Content-->


<?php get_footer(); ?>

