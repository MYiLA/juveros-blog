<?php
/**
 *
 * Blog template: Minimal
 *
 * @package aspen
 */
?>
<!--Start of Blog Post-->
<article  id="post-<?php the_ID(); ?>" <?php post_class('blog-post-summary'); ?>>
	<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a></h2>
		<?php if ( aspen_show_categories() || aspen_show_date() || aspen_show_author() || aspen_show_comments_count() ) : ?>
    	<div class="blog-post-meta">
    		<?php if ( aspen_show_author() ) : ?><span class="blog-post-author"><?php the_author_link(); ?></span><?php endif; ?>
    		<?php if ( aspen_show_date() ) : ?><span class="blog-post-date"><time class="entry-date" datetime="<?php echo get_post_time('c', true);?>"><?php the_time( get_option( 'date_format' ) ); ?></time></span><?php endif; ?>
    	    <?php if ( aspen_show_categories() ) : ?><?php if ( aspen_categorized_blog() ) : ?><span class="blog-post-category"><?php the_category( ', ' ); ?></span><?php endif; ?><?php endif; ?>
		    <?php if ( aspen_show_comments_count() ) : ?>
				<span class="blog-post-comment"><?php comments_number(); ?></span>
		    <?php endif; ?>
		</div>
    	<?php endif; ?>
	
	<?php aspen_excerpt_intro(); ?>

	<?php if ( get_post_format() == "quote" ) : ?>
		<div class="blog-post-quote">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<div class="quote">
					<?php if ( ! empty ( aspen_post_meta( 'post_format_quote_text' ) ) ) : ?>
						<blockquote>
							<p><?php echo esc_html( aspen_post_meta( 'post_format_quote_text' ) ); ?></p>
							<?php if ( ! empty ( aspen_post_meta( 'post_format_quote_name' ) ) ) : ?>
								<footer>
									<cite><?php echo esc_html( aspen_post_meta( 'post_format_quote_name' ) ); ?></cite>
								</footer>
							<?php endif; ?>
						</blockquote>
					<?php else : ?>
						<?php echo get_the_excerpt(); ?>
					<?php endif; ?>
				</div>
			</a>
		</div>
	<?php else: ?>
		<?php the_excerpt(); ?>
	<?php endif; ?>


	<div class="blog-post-bottom">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="more-link"><span>Continue Reading</span></a>

		<?php do_action('aspen_share' ); ?>
	</div>
</article>
<!--End of Blog Post-->
