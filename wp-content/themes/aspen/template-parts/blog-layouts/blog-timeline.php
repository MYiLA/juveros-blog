<?php
/**
 *
 * Blog template: Timeline
 *
 * @package aspen
 */
?>

<div class="aspen-timeline">
	<!--Start of Blog Post-->
	<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-summary'); ?>>

		<div class="blog-post-timeline-date">
			<?php if ( aspen_show_date() ) : ?><span class="blog-post-date"><time class="entry-date" datetime="<?php echo get_post_time('c', true);?>"><?php the_time( get_option( 'date_format' ) ); ?> <span class="timeline-time"><?php the_time( 'g:i a' ); ?></span></time></span><?php endif; ?>
		</div>

		<div class="blog-post-timeline-icon"></div>

		<div class="blog-post-summary-content">

			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a>
			</h2>

			<?php if ( aspen_show_date() || aspen_show_author() || aspen_show_categories() || aspen_show_comments_count() ) : ?>
				<div class="blog-post-meta">
					<?php if ( aspen_show_author() ) : ?>
						<span class="blog-post-author"><?php the_author_posts_link(); ?></span>
					<?php endif; ?>
					<?php if ( aspen_show_categories() ) : ?><?php if ( aspen_categorized_blog() ) : ?>
                    <span class="blog-post-category"><?php the_category( ', ' ); ?></span><?php endif; ?>
                    <?php endif; ?>
					<?php if ( aspen_show_comments_count() ) : ?>
						<span class="blog-post-comment"><?php comments_number(); ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>



			<?php if ( get_post_format() == "link" ) : ?>

				<div class="blog-post-link">
					<a href="<?php echo esc_url( aspen_post_meta( 'post_format_link_url' ) ); ?>" target="_blank">
						<?php the_post_thumbnail( 'aspen-post-thumbnail-large' ); ?>
						<div class="link"></div>
					</a>
				</div>

			<?php elseif ( get_post_format() == "quote" ) : ?>

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

			<?php elseif ( get_post_format() == "video" ) : ?>

				<div class="blog-post-video">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">

						<?php if ( ! empty ( aspen_post_meta( 'post_format_video_code' ) ) ) : ?>
							<?php
							echo '<figure class="embed-container">' . apply_filters( 'the_content', aspen_post_meta( 'post_format_video_code' ) ) . "</figure>";
							?>
						<?php endif; ?>

					</a>
				</div>

			<?php elseif ( get_post_format() == "gallery" ) : ?>

				<?php
				$images = inbound_get_gallery( get_the_content() );

				if ( ! $images ) :
					if ( has_post_thumbnail() ) :
						the_post_thumbnail( 'aspen-post-thumbnail-large' );
					endif;
				else:
					aspen_gallery_slider( $images );
				endif;
				?>

			<?php else : ?>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="blog-post-image">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'aspen-post-thumbnail-large' ); ?></a>
					</div>
				<?php endif; ?>

			<?php endif; ?>

			<?php if ( get_post_format() == "quote" ) : ?>

				<div class="blog-post-bottom">
					<?php do_action( 'aspen_share' ); ?>
				</div>

			<?php else: ?>

				<?php the_excerpt(); ?>

				<div class="blog-post-bottom">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="more-link"><span><?php esc_html_e( 'Continue Reading', 'aspen' ); ?></span></a>

					<?php do_action( 'aspen_share' ); ?>
				</div>

			<?php endif; ?>


		</div>

	</article>
</div>