<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package aspen
 */

get_header(); ?>

<!--Start of Main Content-->
<main id="site-content">

	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'template-parts/single/content-single', get_post_format() ); ?>
	<?php endwhile; // End of the loop. ?>

</main>
<!--End of Main Content-->

<?php get_footer(); ?>

