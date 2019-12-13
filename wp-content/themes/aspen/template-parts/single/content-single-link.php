<?php
/**
 * Template part for displaying single posts (link post format).
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aspen
 */

?>

<!--Start of Blog Post-->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<!--Blog Post Header-->
	<div class="blog-header">

		<div class="blog-header-inner">
			<div class="blog-header-content">

				<div class="blog-post-date">
					<?php if ( aspen_show_date( true ) ) : ?>
						<span class="blog-post-date">
						<time class="entry-date" datetime="<?php echo get_post_time( 'c', true ); ?>"><?php the_date(); ?></time>
					</span>
					<?php endif; ?>
				</div>

				<?php the_title( '<h1>', '</h1>' ); ?>

				<?php if ( aspen_show_categories() || aspen_show_date() || aspen_show_author() ) : ?>
					<!--Blog Post Meta Info-->
					<div class="blog-post-meta">
						<?php if ( aspen_show_author( true ) ) : ?>
							<span class="blog-post-author"><?php esc_html_e( 'Written by ', 'aspen' ); ?><?php the_author_posts_link(); ?></span><?php endif; ?>
						<?php if ( aspen_show_categories( true ) ) : ?><?php if ( aspen_categorized_blog() ) : ?>
							<span class="blog-post-category"><?php esc_html_e( 'in ', 'aspen' ); ?><?php the_category( ', ' ); ?></span><?php endif; ?>
						<?php endif; ?>
					</div>
					<!--End of Blog Post Meta Info-->
				<?php endif; ?>

				<div class="blog-post-link">
					<a href="<?php echo esc_url( aspen_post_meta( 'post_format_link_url' ) ); ?>" target="_blank">
						<?php the_post_thumbnail( 'aspen-post-thumbnail-large' ); ?>
						<div class="link">
						    <div class="link-inner">
                                <?php if ( ! empty ( aspen_post_meta( 'post_format_link_text' ) ) ) : ?>
                                    <p><?php echo esc_html( aspen_post_meta( 'post_format_link_text' ) ); ?></p>
                                <?php else : ?>
                                    <p><?php the_title() ?></p>
                                <?php endif; ?>
                                <span class="link-url"><?php echo aspen_post_meta( 'post_format_link_url' ); ?></span>
							</div>
						</div>
					</a>
				</div>

				<!--Start of Breadcrumb-->
				<?php aspen_breadcrumb(); ?>
				<!--End of Breadcrumb-->

			</div>
		</div>

	</div>
	<!--End of Blog Post Header-->

	<div class="blog-content">

		<div class="col-3-4">

			<div class="blog-post-content row">
				<?php do_action( 'aspen_share', true ); ?>

				<!--Start of Blog Post Content-->

				<?php if ( has_excerpt() ) : ?>
					<!--Start of Introduction-->
					<div class="blog-introduction">
						<?php echo apply_filters( 'the_excerpt', get_the_excerpt() ); ?>
					</div>
					<!--End of Introduction-->
				<?php endif; ?>

				<?php the_content(); ?>

				<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aspen' ),
					'after'  => '</div>'
				) );
				?>

				<!--End of Blog Post Content-->

				<!--Start of Blog Post Footer Elements-->

				<!--Start of Post Social Elements & Post Tags-->
				<aside id="blog-post-bottom-meta">
					<?php do_action( 'aspen_share' ); ?>

					<?php if ( aspen_show_tags( true ) ) : ?>
						<!--Start of Post Tags-->
						<?php aspen_tags(); ?>
						<!--End of Post Tags-->
					<?php endif; ?>
				</aside>
				<!--End of Blog Social Elements & Blog Post Tags-->

			</div>

			<?php if ( aspen_show_author_box( true ) ) : ?>
				<!--Start of Author Info-->
				<?php aspen_author_info(); ?>
				<!--End of Author Info-->
			<?php endif; ?>

			<?php aspen_post_navigation(); ?>


			<div class="row">
				<?php if ( aspen_show_related( true ) ) : ?>
					<!--Start of similar Blog Posts-->
					<?php aspen_related_posts(); ?>
					<!--End of similar Blog Posts-->
				<?php endif; ?>

				<?php if ( ! is_active_sidebar( 'aspen-sidebar' ) && ! aspen_option( 'hide_sidebar' ) ) : ?><div class="aspen-full-width"><?php endif; ?>
					<!--Start of Comments-->
					<?php comments_template(); ?>
					<!--End of Comments-->
					<?php if ( ! is_active_sidebar( 'aspen-sidebar' ) && ! aspen_option( 'hide_sidebar' ) ) : ?></div><?php endif; ?>
			</div>
			<!--End of Blog Post Footer Elements-->

		</div>


		<?php aspen_get_sidebar(); ?>

	</div>

</article>

<!--End of Blog Post-->
