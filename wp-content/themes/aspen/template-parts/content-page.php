<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aspen
 */

?>
<?php if ( aspen_has_page_sidebar() ) : ?><div class="col-3-4"><?php endif; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div<?php aspen_page_header_tag( 'header' ); ?>>
		<div class="blog-header-inner">
			<div class="blog-header-content">

				<?php the_title( '<h1>', '</h1>' ); ?>

				<?php aspen_meta_categories(); ?>

				<?php aspen_breadcrumb(); ?>

			</div>
		</div>
	</div>


	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aspen' ),
			'after'  => '</div>'
		) );
		?>

		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
				/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'aspen' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->

	</div><!-- .entry-content -->

</article><!-- #post-## -->

<?php if ( ! aspen_is_woocommerce() ) : ?>
	<?php comments_template(); ?>
<?php endif; ?>


<?php if ( aspen_has_page_sidebar() ) : ?></div><?php endif; ?>
