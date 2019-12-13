<?php
/**
 * The template for displaying all pages.
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

	<!--Hero Banner-->
	<?php aspen_frontpage_banner(); ?>
	<!--End of Hero Banner-->

	<!--Blog Promo Area-->
	<?php aspen_promo_widgets(); ?>
	<!--End of Blog Promo Area-->

	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'template-parts/content', 'page' ); ?>
	<?php endwhile; // End of the loop. ?>

</main>
<!--End of Main Content-->

<?php get_footer(); ?>