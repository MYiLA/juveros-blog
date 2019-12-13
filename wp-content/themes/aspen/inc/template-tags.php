<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package aspen
 */

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */

if ( ! function_exists( 'aspen_posted_on' ) ) {
	function aspen_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( 'Posted on %s', 'post date', 'aspen' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'aspen' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
}


/**
 * Prints HTML with meta information for the categories, tags and comments.
 */

if ( ! function_exists( 'aspen_entry_footer' ) ) {
	function aspen_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'aspen' ) );
			if ( $categories_list && aspen_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'aspen' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'aspen' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'aspen' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'aspen' ), esc_html__( '1 Comment', 'aspen' ), esc_html__( '% Comments', 'aspen' ) );
			echo '</span>';
		}

		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'aspen' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}


/**
 * Returns true if a blog has more than 1 category.
 */

function aspen_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'aspen_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'aspen_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so aspen_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so aspen_categorized_blog should return false.
		return false;
	}
}


/**
 * Renders category information
 */

if ( ! function_exists( 'aspen_meta_categories' ) ) {
	function aspen_meta_categories() {

		if ( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() || is_wc_endpoint_url() ) ) :
		else: ?>
			<!--Blog Post Meta Info-->
			<div class="blog-post-meta">
				<?php if ( aspen_categorized_blog() ) : ?>
					<span class="blog-post-category"><?php the_category( ', ' ); ?></span>
				<?php endif; ?>
			</div>
			<!--End of Blog Post Meta Info-->
		<?php
		endif;
	}
}


/**
 * Flush out the transients used in aspen_categorized_blog.
 */

function aspen_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	delete_transient( 'aspen_categories' );
}

add_action( 'edit_category', 'aspen_category_transient_flusher' );
add_action( 'save_post', 'aspen_category_transient_flusher' );


/*
 * Renders header template
 */

if ( ! function_exists( 'aspen_header' ) ) {
	function aspen_header() {
		get_template_part( 'template-parts/header/navigation-style', aspen_option( 'header_navigation_style' ) );
	}
}


/**
 * Renders social icons
 */

if ( ! function_exists( 'aspen_social_icons' ) ) {
	function aspen_social_icons( $position = "header", $echo = true ) {

		$services = aspen_option( 'social_icons' );

		$header_hide = aspen_option( 'header_hide_social' );
		$footer_hide = aspen_option( 'footer_hide_social' );
		$out         = '';

		if ( empty ( $services ) ) {
			return;
		}

		if ( count( $services ) > 0 ) {

			if ( ( $position == "header" || $position == "mobile" ) && $header_hide ) {
				return;
			}
			if ( $position == "footer" && $footer_hide ) {
				return;
			}
			if ( $position == "header" ) {
				$out .= '<ul class="social-media">';
			} elseif ( $position == "mobile" ) {
				$out .= '<ol class="social-media">';
			} elseif ( $position == "footer" ) {
				$out .= '<ul class="social-icons social-circle icon-size-1">';
			}

			foreach ( $services as $service ) {
				$url = aspen_option( 'social_icons_' . $service );

				if ( ! empty ( $url ) ) {
					$out .= '<li><a href="' . esc_url( $url ) . '"><i class="fa fa-' . esc_attr( $service ) . ' fa-1x"></i></a></li>';
				}

			}

			if ( $position == "header" || $position == "footer" ) {
				$out .= '</ul>';
			} else {
				$out .= "</ol>";
			}

		}

		if ( $echo ) {
			echo apply_filters( 'aspen_social_icons_output', $out );
		} else {
			return $out;
		}
	}
}


/**
 * Renders search bar
 */

if ( ! function_exists( 'aspen_search' ) ) {
	function aspen_search() {
		$hide = aspen_option( 'header_hide_search' );
		if ( ! ( $hide ) ) {
			?>
			<!--Search-->
			<div id="header-search">
				<a href="#search-header" class="search-trigger"><i class="fa fa-search"></i></a>
			</div>
			<!--End of Search-->
			<?php
		}
	}
}

if ( ! function_exists( 'aspen_search_header' ) ) {
	function aspen_search_header() {
		$hide = aspen_option( 'header_hide_search' );
		if ( ! ( $hide ) ) {
			?>
			<!--Start of Search Header-->
			<div id="search-header">
				<button class="close"><i class="fa fa-times"></i></button>
				<form method="get" class="search-form overlay overlay-scale" action="<?php echo esc_url( home_url() ); ?>">
					<input type="search" id="search-overlay-input" class="search-field" placeholder="<?php esc_attr_e( 'Search', 'aspen' ); ?> &hellip;" value="" name="s" autofocus>
					<input type="submit" class="search-submit" value="">
					<span class="search-icon"></span>
				</form>
			</div>
			<!--End of Search Header-->
			<?php
		}
	}
}

if ( ! function_exists( 'aspen_search_mobile' ) ) {
	function aspen_search_mobile() {
		return '<form method="get" class="search-form" action="' . esc_url( home_url() ) . '">
					<input type="search" id="search-mobile" class="search-field" placeholder="' . esc_attr__( 'Search', 'aspen' ) . ' &hellip;" value="" name="s">
					<input type="submit" class="search-submit" value="">
				</form>';
	}
}


/**
 * Renders sidebar custom HTML
 */

if ( ! function_exists( 'aspen_sidebar_text' ) ) {
	function aspen_sidebar_text() {
		$text = aspen_option( 'header_sidebar_text' );
		if ( ! empty ( $text ) ) {
			echo apply_filters( 'the_content', $text );
		}
	}
}


/**
 * Renders logos in various contexts
 */

if ( ! function_exists( 'aspen_header_logo' ) ) {
	function aspen_header_logo() {
		$image_id_primary   = apply_filters( 'aspen_logo_image_id', aspen_option( 'logo_image' ) );
		$image_id_secondary = apply_filters( 'aspen_logo_image_secondary_id', aspen_option( 'logo_image_secondary' ) );
		$image_id_mobile    = apply_filters( 'aspen_logo_image_mobile_id', aspen_option( 'logo_image_mobile' ) );

		$blog_url = home_url();

		if ( intval( $image_id_primary ) + intval( $image_id_secondary ) + intval( $image_id_mobile ) > 0 ) {

			echo '<a href="' . esc_url( $blog_url ) . '">';

			if ( $image_id_primary ) {
				if ( wp_attachment_is_image( $image_id_primary ) ) {
					$alt_primary              = get_post_meta( $image_id_primary, '_wp_attachment_image_alt', true );
					$image_attachment_primary = wp_get_attachment_image_src( $image_id_primary, 'full' );
					if ( $image_attachment_primary ) {
						echo '<img src="' . esc_url( $image_attachment_primary[0] ) . '" alt="' . esc_attr( $alt_primary ) . '" id="logo-primary" />';
					}
				}
			}

			if ( $image_id_secondary ) {
				if ( wp_attachment_is_image( $image_id_secondary ) ) {
					$alt_secondary              = get_post_meta( $image_id_secondary, '_wp_attachment_image_alt', true );
					$image_attachment_secondary = wp_get_attachment_image_src( $image_id_secondary, 'full' );
					if ( $image_attachment_secondary ) {
						echo '<img src="' . esc_url( $image_attachment_secondary[0] ) . '" alt="' . esc_attr( $alt_secondary ) . '" id="logo-secondary" />';
					}
				}
			}

			if ( $image_id_mobile ) {
				if ( wp_attachment_is_image( $image_id_mobile ) ) {
					$alt_mobile              = get_post_meta( $image_id_mobile, '_wp_attachment_image_alt', true );
					$image_attachment_mobile = wp_get_attachment_image_src( $image_id_mobile, 'full' );
					if ( $image_id_mobile ) {
						echo '<img src="' . esc_url( $image_attachment_mobile[0] ) . '" alt="' . esc_attr( $alt_mobile ) . '" id="logo-mobile" />';
					}
				}
			}

			echo '</a>';

		}

	}
}


/**
 * Renders header title
 */

if ( ! function_exists( 'aspen_header_title' ) ) {
	function aspen_header_title() {
		$hide = aspen_option( 'header_hide_title' );
		if ( ! ( $hide ) ) {
			$blog_title = get_bloginfo( 'name' );
			$blog_url   = home_url();
			echo '<a href="' . esc_url( $blog_url ) . '"><h1>' . $blog_title . '</h1></a>';
		}
	}
}


/**
 * Renders header tagline
 */

if ( ! function_exists( 'aspen_header_tagline' ) ) {
	function aspen_header_tagline() {
		$hide = aspen_option( 'header_hide_tagline' );
		if ( ! ( $hide ) ) {
			$tagline = get_bloginfo( 'description' );
			if ( ! empty ( $tagline ) ) {
				echo '<span>' . esc_html( $tagline ) . '</span>';
			}
		}
	}
}


/**
 * Renders breadcrumb navigation
 */

if ( ! function_exists( 'aspen_breadcrumb' ) ) {
	function aspen_breadcrumb() {
		if ( ! aspen_option( 'blog_show_breadcrumb' ) ) {
			return;
		}

		global $post;

		$items = array();

		$items[] = array(
			'link'  => home_url( '/' ),
			'title' => get_bloginfo( 'name' )
		);

		if ( is_home() ) {
			return;
		}

		if ( ! is_home() ) {

			if ( is_category() || is_single() ) {
				$cats = get_the_category( $post->ID );

				foreach ( $cats as $cat ) {
					$items[] = array(
						'link'  => get_category_link( $cat->cat_ID ),
						'title' => $cat->cat_name
					);
				}

				if ( is_single() ) {
					$items[] = array(
						'title' => get_the_title()
					);
				}
			} elseif ( is_page() ) {

				if ( $post->post_parent ) {
					$anc = get_post_ancestors( $post->ID );
					if ( $anc && is_array( $anc ) ) {
						$anc = array_reverse( $anc );
						foreach ( $anc as $ancestor ) {
							$anc_link = get_permalink( $ancestor );
							$items[]  = array(
								'title' => get_the_title( $ancestor ),
								'link'  => $anc_link
							);
						}
						$items[] = array(
							'title' => get_the_title()
						);
					}
				} else {
					$items[] = array(
						'title' => get_the_title()
					);
				}
			}
		} elseif ( is_tag() ) {
			$items[] = array(
				'title' => single_tag_title()
			);

		} elseif ( is_day() ) {
			$items[] = array(
				'title' => sprintf( esc_html__( "Archive: %s", "aspen" ), get_the_time( 'F jS, Y' ) )
			);
		} elseif ( is_month() ) {
			$items[] = array(
				'title' => sprintf( esc_html__( "Archive: %s", "aspen" ), get_the_time( 'F, Y' ) )
			);
		} elseif ( is_year() ) {
			$items[] = array(
				'title' => sprintf( esc_html__( "Archive: %s", "aspen" ), get_the_time( 'Y' ) )
			);
		} elseif ( is_author() ) {
			$author  = get_userdata( get_query_var( 'author' ) );
			$items[] = array(
				'title' => sprintf( esc_html__( "Author's Archive for %s", "aspen" ), $author->display_name() )
			);
		} elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) {
			$items[] = array(
				'title' => sprintf( esc_html__( "Blog Archive: %s", "aspen" ), aspen_get_the_title() )
			);
		} elseif ( is_search() ) {
			$items[] = array(
				'title' => sprintf( esc_html__( "Search Results: %s", "aspen" ), aspen_get_the_title() )
			);
		} else {
			$items[] = array(
				'title' => aspen_get_the_title()
			);
		}

		echo '<div id="breadcrumb">' . "\n";
		echo '<ul xmlns:v="http://rdf.data-vocabulary.org/#">' . "\n";
		foreach ( $items as $item ) {
			echo '<li>';
			echo '<span  typeof="v:Breadcrumb">';
			if ( isset( $item['link'] ) ) {
				echo '<a rel="v:url" property="v:title" href="' . esc_url( $item['link'] ) . '">';
			}
			echo esc_html( strip_tags( $item['title'] ) );
			if ( isset( $item['link'] ) ) {
				echo '</a>';
			}
			echo '</span>';
			echo '</li>';
		}
		echo '</ul>' . "\n";
		echo '</div>' . "\n";
	}
}


/*
 * Custom title function, derived from WordPress core
 */

if ( ! function_exists( 'aspen_get_the_title' ) ) {
	function aspen_get_the_title( $sep = '', $seplocation = '' ) {
		global $wpdb, $wp_locale;

		$m        = get_query_var( 'm' );
		$year     = get_query_var( 'year' );
		$monthnum = get_query_var( 'monthnum' );
		$day      = get_query_var( 'day' );
		$search   = get_query_var( 's' );
		$title    = '';

		$t_sep = '%WP_TITILE_SEP%'; // Temporary separator, for accurate flipping, if necessary

		// If there is a post
		if ( is_single() || ( is_home() && ! is_front_page() ) || ( is_page() && ! is_front_page() ) ) {
			$title = single_post_title( '', false );
		}

		// If there's a category or tag
		if ( is_category() || is_tag() ) {
			$title = single_term_title( '', false );
		}

		// If there's a taxonomy
		if ( is_tax() ) {
			$term  = get_queried_object();
			$tax   = get_taxonomy( $term->taxonomy );
			$title = single_term_title( $tax->labels->name . $t_sep, false );
		}

		// If there's an author
		if ( is_author() ) {
			$author = get_queried_object();
			$title  = $author->display_name;
		}

		// If there's a post type archive
		if ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		}

		// If there's a month
		if ( is_archive() && ! empty( $m ) ) {
			$my_year  = substr( $m, 0, 4 );
			$my_month = $wp_locale->get_month( substr( $m, 4, 2 ) );
			$my_day   = intval( substr( $m, 6, 2 ) );
			$title    = $my_year . ( $my_month ? $t_sep . $my_month : '' ) . ( $my_day ? $t_sep . $my_day : '' );
		}

		// If there's a year
		if ( is_archive() && ! empty( $year ) ) {
			$title = $year;
			if ( ! empty( $monthnum ) ) {
				$title .= $t_sep . $wp_locale->get_month( $monthnum );
			}
			if ( ! empty( $day ) ) {
				$title .= $t_sep . zeroise( $day, 2 );
			}
		}

		// If it's a search
		if ( is_search() ) {
			/* translators: 1: separator, 2: search phrase */
			$title = sprintf( esc_html__( 'Search Results %1$s %2$s', 'aspen' ), $t_sep, strip_tags( $search ) );
		}

		// If it's a 404 page
		if ( is_404() ) {
			$title = esc_html__( 'Page not found', 'aspen' );
		}

		$prefix = '';
		if ( ! empty( $title ) ) {
			$prefix = " $sep ";
		}

		// Determines position of the separator and direction of the breadcrumb
		if ( 'right' == $seplocation ) { // sep on right, so reverse the order
			$title_array = explode( $t_sep, $title );
			$title_array = array_reverse( $title_array );
			$title       = implode( " $sep ", $title_array ) . $prefix;
		} else {
			$title_array = explode( $t_sep, $title );
			$title       = $prefix . implode( " $sep ", $title_array );
		}


		// Send it out
		return trim( $title );
	}
}


/*
 * Comments
 */

if ( ! function_exists( 'aspen_comment_form' ) ) :
	function aspen_comment_form() {
		$commenter     = wp_get_current_commenter();
		$req           = get_option( 'require_name_email' );
		$aria_req      = ( $req ? " aria-required='true'" : '' );
		$user          = wp_get_current_user();
		$user_identity = $user->display_name;

		$args = array(
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => esc_html__( 'Leave a Reply', 'aspen' ),
			'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'aspen' ),
			'cancel_reply_link'    => esc_html__( 'Cancel Reply', 'aspen' ),
			'label_submit'         => esc_html__( 'Post Comment', 'aspen' ),
			'comment_field'        => '<p class="comment-form-comment col-1">' .
			                          '<textarea id="comment" name="comment" cols="45" placeholder="' . _x( 'Comment', 'noun', 'aspen' ) . '" rows="8" aria-required="true">' .
			                          '</textarea></p>',
			'must_log_in'          => '<p class="must-log-in">' .
			                          sprintf(
				                          aspen_esc_html( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'aspen' ) ),
				                          esc_url( wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) )
			                          ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' .
			                          sprintf(
				                          aspen_esc_html( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'aspen' ) ),
				                          esc_url( admin_url( 'profile.php' ) ),
				                          $user_identity,
				                          esc_url( wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) )
			                          ) . '</p>',
			'comment_notes_before' => '',
			'comment_notes_after'  => '',

			'submit_field' => '<p class="comment-notes">' .
			                  esc_html__( 'Your email address will not be published.', 'aspen' ) .
			                  '</p><p class="form-submit">%1$s %2$s</p>',
			'fields'       => apply_filters( 'comment_form_default_fields', array(

					'author' =>
						'<p class="comment-form-author col-3">' .
						'<input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Name', 'aspen' ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
						'" size="30"' . $aria_req . ' /></p>',
					'email'  =>
						'<p class="comment-form-email col-3">' .
						'<input id="email" name="email" type="text" placeholder="' . esc_attr__( 'Email', 'aspen' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) .
						'" size="30"' . $aria_req . ' /></p>',
					'url'    =>
						'<p class="comment-form-url col-3">' .
						'<input id="url" name="url" type="text" placeholder="' . esc_attr__( 'Website', 'aspen' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
						'" size="30" /></p>'
				)
			),
		);
		comment_form( $args );
	}
endif;


/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */

if ( ! function_exists( 'aspen_comment' ) ) :
	function aspen_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				?>
				<li class="post pingback">
				<p><?php esc_html_e( 'Pingback:', 'aspen' ); ?><?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'aspen' ), '<span class="edit-link">', '<span>' ); ?></p>
				<?php
				break;
			default :
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<div id="comment-<?php comment_ID(); ?>">
						<?php echo get_avatar( $comment, 65 ); ?>
						<p class="comment-meta">
							<span class="fn n comment_name"><?php echo get_comment_author_link(); ?></span>

							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'aspen' ), get_comment_date(), get_comment_time() ); ?>
							</time>

							<?php
							comment_reply_link( array_merge( $args, array(
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
							) ) );
							?>
						</p>
						<p><?php comment_text(); ?></p>
					</div>
				</li>

				<?php
				break;
		endswitch;
	}
endif; // ends check for aspen_comment()


/**
 * Renders frontpage banner (slider and image)
 */

if ( ! function_exists( 'aspen_frontpage_banner' ) ) {
	function aspen_frontpage_banner() {
		if ( ! is_front_page() ) {
			return;
		}

		$banner_content = aspen_option( 'frontpage_banner_content' );
		switch ( $banner_content ) {
			case 'none':
				// do nothing
				break;
			case 'image':
				aspen_image_banner();
				break;
			case 'slider':
				aspen_feature_slider();
				break;
			case 'html':
				$html = aspen_option( 'frontpage_banner_html' );
				echo '<div class="aspen-full-width">';
				echo '<div class="aspen-banner-html">';
				echo do_shortcode( $html );
				echo '</div>';
				echo '</div>';
				break;
		}

	}
}


if ( ! function_exists( 'aspen_image_banner' ) ) {
	function aspen_image_banner() {
		$id = aspen_option( 'frontpage_banner_background' );
		?>
		<?php if ( aspen_option( 'frontpage_banner_background_style' ) == 'full-width' ) : ?><div class="aspen-full-width"><?php endif; ?>
		<div<?php aspen_page_header_tag( 'front', $id ); ?>>
			<div class="blog-header-inner">
				<div class="blog-header-content">
					<?php if ( aspen_option( 'frontpage_banner_headline' ) ) : ?>
						<h1><?php echo esc_html( aspen_option( 'frontpage_banner_headline' ) ) ?></h1>
					<?php endif; ?>

					<?php if ( aspen_option( 'frontpage_banner_sub_headline' ) ) : ?>
						<p><?php echo esc_html( aspen_option( 'frontpage_banner_sub_headline' ) ) ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php if ( aspen_option( 'frontpage_banner_background_style' ) == 'full-width' ) : ?></div><?php endif; ?>
	<?php }
}

if ( ! function_exists( 'aspen_feature_slider_classes' ) ) {
	function aspen_feature_slider_classes( $classes = array() ) {

		// display arrows
		if ( aspen_option( 'frontpage_slider_arrows' ) ) {
			$classes[] = 'slider-arrows';
		} else {
			$classes[] = 'slider-no-arrows';
		}

		// display bullets
		if ( aspen_option( 'frontpage_slider_bullets' ) ) {
			$classes[] = 'slider-bullets';
		} else {
			$classes[] = 'slider-no-bullets';
		}


		echo implode( ' ', $classes );
	}
}

if ( ! function_exists( 'aspen_feature_slider_data' ) ) {
	function aspen_feature_slider_data( $data = array() ) {
		$output = '';

		// style
		if ( aspen_option( 'frontpage_slider_style' ) ) {
			$data['slider-style'] = aspen_option( 'frontpage_slider_style' );
		}

		// display arrows
		if ( aspen_option( 'frontpage_slider_arrows' ) ) {
			$data['slider-arrows'] = '1';
		} else {
			$data['slider-arrows'] = '0';
		}

		// display bullets
		if ( aspen_option( 'frontpage_slider_bullets' ) ) {
			$data['slider-bullets'] = '1';
		} else {
			$data['slider-bullets'] = '0';
		}

		// slider transition
		if ( aspen_option( 'frontpage_slider_transition' ) ) {
			$data['slider-transition'] = aspen_option( 'frontpage_slider_transition' );
		}

		// slider autoplay
		if ( aspen_option( 'frontpage_slider_autoplay' ) ) {
			$data['slider-autoplay'] = '1';
		}

		// slider autoplay delay
		if ( aspen_option( 'frontpage_slider_autoplay_delay' ) ) {
			$data['slider-autoplay-delay'] = aspen_option( 'frontpage_slider_autoplay_delay' );
		}

		// slides per view
		$style           = aspen_option( 'frontpage_slider_style' );
		$slides_per_view = 1;

		if ( $style == 'two-columns-full' || $style == 'two-columns-normal' ) {
			$slides_per_view = 2;
		} elseif ( $style == 'three-columns-full' || $style == 'three-columns-normal' ) {
			$slides_per_view = 3;
		} elseif ( $style == 'four-columns-full' || $style == 'four-columns-normal' ) {
			$slides_per_view = 4;
		}

		$data['slider-slides-per-view'] = $slides_per_view;

		// space in between
		if ( aspen_option( 'frontpage_slider_spacing' ) ) {
			$data['slider-spacing'] = aspen_option( 'frontpage_slider_spacing' );;
		}


		if ( is_array( $data ) && ! empty ( $data ) ) {
			foreach ( $data as $name => $value ) {
				$output .= ' data-' . esc_attr( $name ) . '="' . esc_attr( $value ) . '"';
			}
		}

		echo apply_filters( 'aspen_feature_slider_data', $output );
	}
}

if ( ! function_exists( 'aspen_is_full_width_slider' ) ) {
	function aspen_is_full_width_slider() {

		$style = aspen_option( 'frontpage_slider_style' );

		$full_width_sliders = array(
			'full-width',
			'two-columns-full',
			'three-columns-full',
			'four-columns-full'
		);

		if ( in_array( $style, $full_width_sliders ) ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'aspen_feature_slider' ) ) {
	function aspen_feature_slider() {

		$cache_suffix = aspen_cache_suffix();

		if ( false === ( $the_query = get_transient( 'aspen_blog_slider' . $cache_suffix ) ) ) {
			$args      = array(
				'posts_per_page' => aspen_option( 'frontpage_slider_posts' ),
				'post_status'    => array( 'publish' ),
				'post_type'      => 'post',
			);
			$the_query = new WP_Query( $args );
			set_transient( 'aspen_blog_slider' . $cache_suffix, $the_query, 1 * HOUR_IN_SECONDS );

			if ( $the_query->post_count > 0 ) {
				$post_ids = wp_list_pluck( $the_query->posts, 'ID' );
				if ( ! empty ( $post_ids ) ) {
					set_transient( 'aspen_blog_slider_exclude' . $cache_suffix, $post_ids, 1 * HOUR_IN_SECONDS );
				}
			}
		}
		if ( $the_query->post_count > 0 ) : ?>
			<?php if ( aspen_is_full_width_slider() ) : ?><div class="aspen-full-width"><?php endif; ?>
			<div id="banner-slider" class="<?php aspen_feature_slider_classes( array(
				'banner-slider',
				'swiper-container'
			) ); ?>"<?php aspen_feature_slider_data(); ?>>
				<div class="swiper-wrapper">
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<div <?php aspen_page_header_tag( 'header', 0, false, array( 'swiper-slide' ) ); ?>>
							<div class="swiper-slide-overlay">
								<?php
								if ( aspen_categorized_blog() ) {
									$categories_list = get_the_category_list();
									if ( $categories_list ) {
										echo apply_filters( 'aspen_categories_list', $categories_list );
									}
								}
								?>
								<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
								<p><?php echo wp_trim_words( get_the_excerpt(), apply_filters( 'aspen_slider_abstract_words', 10 ) ); ?></p>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"
										class="more-link"><?php
									esc_html_e( 'Read more', 'aspen' ) ?></a>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
				<?php if ( aspen_option( 'frontpage_slider_bullets' ) ) : ?>
					<div class="swiper-pagination"></div><?php endif; ?>
				<?php if ( aspen_option( 'frontpage_slider_arrows' ) ) : ?>
					<div class="swiper-button-prev swiper-button-white"></div>
					<div class="swiper-button-next swiper-button-white"></div>
				<?php endif; ?>
			</div>
			<?php if ( aspen_is_full_width_slider() ) : ?></div><?php endif; ?>
		<?php endif;
	}
}


function aspen_home_query( $query ) {

	$cache_suffix = aspen_cache_suffix();

	if ( $query->is_home() && $query->is_main_query() ) {
		if ( aspen_option( 'frontpage_banner_content' ) == 'slider' && aspen_option( 'frontpage_hide_duplicates' ) ) {
			$exclude_ids = get_transient( 'aspen_blog_slider_exclude' . $cache_suffix );
			if ( ! empty ( $exclude_ids ) && is_array( $exclude_ids ) ) {
				$query->set( 'post__not_in', $exclude_ids );
			}
		}
	}
}

add_action( 'pre_get_posts', 'aspen_home_query' );


if ( ! function_exists( 'aspen_gallery_slider' ) ) {
	function aspen_gallery_slider( $images = array() ) {
		?>
		<div class="gallery-slider swiper-container">
			<div class="swiper-wrapper">
				<?php
				$x = 0;
				foreach ( $images as $attachment_id ) {
					if ( $x == 0 ) {
						$currclass = ' class="current-slide"';
					} else {
						$currclass = "";
					}
					$img = wp_get_attachment_image_src( $attachment_id, 'aspen-post-thumbnail-large' );
					echo '<div class="swiper-slide"><img src="' . esc_url( $img[0] ) . '"' . $currclass . '></div>';
					$x ++;
				}
				?>
			</div>
			<div class="swiper-pagination"></div>
			<div class="swiper-button-prev swiper-button-white"></div>
			<div class="swiper-button-next swiper-button-white"></div>
		</div>
		<?php
	}
}


function aspen_clear_slider_cache_on_status_change( $new_status, $old_status, $post ) {
	if ( $new_status != $old_status ) {
		aspen_clear_slider_caches();
	}
}

add_action( 'transition_post_status', 'aspen_clear_slider_cache_on_status_change', 10, 3 );


function aspen_clear_slider_cache_on_post_update( $post_ID, $post_after, $post_before ) {
	aspen_clear_slider_caches();
}

add_action( 'post_updated', 'aspen_clear_slider_cache_on_post_update', 10, 3 );


function aspen_clear_slider_cache_on_mods_update( $value, $old_value ) {
	if ( $value != $old_value ) {
		aspen_clear_slider_caches();
	}

	return $value;
}

add_filter( 'pre_set_theme_mod_aspen_frontpage_slider_posts', 'aspen_clear_slider_cache_on_mods_update', 10, 2 );
add_filter( 'pre_set_theme_mod_aspen_frontpage_hide_duplicates', 'aspen_clear_slider_cache_on_mods_update', 10, 2 );


function aspen_clear_slider_cache_on_theme_switch() {
	aspen_clear_slider_caches();
}

add_action( 'after_switch_theme', 'aspen_clear_slider_cache_on_theme_switch' );


function aspen_clear_slider_caches() {

	$languages = apply_filters( 'wpml_active_languages', null, 'orderby=id' ); // check if WPML is active and get list of languages

	/* generic cache */
	delete_transient( 'aspen_blog_slider' );
	delete_transient( 'aspen_blog_slider_exclude' );

	/* language-dependent cache */
	if ( is_array ( $languages ) && ! empty ( $languages ) ) {
		foreach ( $languages as $suffix => $data ) {
			delete_transient( 'aspen_blog_slider_' . $suffix );
			delete_transient( 'aspen_blog_slider_exclude_' . $suffix );
		}
	}

}


/*
 * Footer
 */

if ( ! function_exists( 'aspen_print_footer_copyright' ) ) {
	function aspen_print_footer_copyright( $classes = "" ) {
		/*
		 * Initialize framework
		 */
		$copyright = aspen_option( 'copyright' );
		$copyright = apply_filters( 'aspen_footer_copyright', $copyright );
		echo wp_kses_post( $copyright );
	}
}
add_filter( 'aspen_print_footer_copyright', 'aspen_print_footer_copyright' );

if ( ! function_exists( 'aspen_footer' ) ) {
	function aspen_footer( $classes = "" ) {
		$style = aspen_option( 'footer_style' );
		aspen_footer_widgets();
		get_template_part( 'template-parts/footer/footer-style', $style );
	}
}

if ( ! function_exists( 'aspen_footer_widgets' ) ) {
	function aspen_footer_widgets() {

		if ( is_active_sidebar( 'aspen-instagram-bar' ) ) {
			?>
			<aside id="footer-instagram">
				<div class="footer-instagram-inner">
					<?php
					dynamic_sidebar( 'aspen-instagram-bar' );
					?>
				</div>
			</aside>
			<?php
		}


		if ( is_active_sidebar( 'aspen-footer' ) && ! aspen_option( 'hide_footer_widgets' ) ) {
			?>
			<aside id="footer-widgets">
				<div class="footer-widgets-inner">
					<?php
					dynamic_sidebar( 'aspen-footer' );
					?>
				</div>
			</aside>
			<?php
		}


	}
}


/**
 * Promo widgets
 */

if ( ! function_exists( 'aspen_promo_widgets' ) ) {
	function aspen_promo_widgets() {

		if ( ! is_front_page() ) {
			return;
		}

		if ( is_active_sidebar( 'aspen-promo' ) ) {
			?>
			<aside id="promo-area">
				<div id="promo-area-inner">
					<?php
					dynamic_sidebar( 'aspen-promo' );
					?>
				</div>
			</aside>
			<?php
		}
	}
}


/**
 * Renders custom HTML
 */

if ( ! function_exists( 'aspen_nav_widgets' ) ) {
	function aspen_nav_widgets() {
		$html = aspen_option( 'header_custom_html' );
		$html = trim ( $html);
		if ( ! empty ( $html ) ) {
			?>
			<section id="nav-html">
				<?php echo do_shortcode( wp_kses_post( $html ) ); ?>
			</section>
			<?php
		}
	}
}


/*
 * Misc Blog
 */

if ( ! function_exists( 'aspen_has_page_header_banner' ) ) {
	function aspen_has_page_header_banner() {

		// single posts and pages

		if ( is_single() || is_page() ) {
			return false;
		}


		// category banner

		if ( is_category() ) {
			$cat             = get_query_var( 'cat' );
			$category_object = get_category( $cat );
			$category_id     = $category_object->term_id;
			$file            = get_term_meta( $category_id, $key = 'ps_category_header_image', $single = true );
			if ( $file ) {
				$id = $file['id'];
			} else {
				$id = aspen_option( 'blog_header_image' );
			}

			if ( $id ) {
				$thumb_url = wp_get_attachment_image_src( $id, 'full', false );

				if ( $thumb_url ) {
					return true;
				} else {
					return false;
				}
			}
		}

		// woocommerce category

		if ( function_exists( 'is_product_category' ) && is_product_category() ) {
			$category_id = get_queried_object_id();
			$file        = get_term_meta( $category_id, $key = 'ps_category_header_image', $single = true );

			if ( $file ) {
				$id = $file['id'];

				if ( $id ) {

					$thumb_url = wp_get_attachment_image_src( $id, 'full', false );

					if ( $thumb_url ) {
						return true;
					} else {
						return false;
					}

				}
			}
		}


		// woocommerce front/index

		if ( function_exists( 'is_shop' ) && is_shop() ) {
			$id = aspen_option( 'woocommerce_default_header_image' );

			if ( $id ) {

				$thumb_url = wp_get_attachment_image_src( $id, 'full', false );

				if ( $thumb_url ) {
					return true;
				} else {
					return false;
				}

			}
		}

		// woocommerce single product

		if ( function_exists( 'is_woocommerce' ) && is_product() ) {
			return false;
		}


		// front page

		if ( is_front_page() ) {
			$front_banner_type = aspen_option( 'frontpage_banner_content' );
			if ( $front_banner_type == 'image' || $front_banner_type == 'slider' ) {
				return true;
			} else {
				return false;
			}
		}


		// post index

		if ( is_search() || is_home() ) {
			$id = aspen_option( 'blog_header_image' );

			if ( $id ) {
				$thumb_url = wp_get_attachment_image_src( $id, 'thumbnail-size', true );

				return true;
			} else {
				return false;
			}
		}


	}
}


/**
 * Renders page header
 */

if ( ! function_exists( 'aspen_page_header_tag' ) ) {
	function aspen_page_header_tag( $where = 'default', $id = 0, $style_tag_only = false, $add_classes = array() ) {
		$background = false;
		switch ( $where ) {

			case 'default':
				$id = aspen_option( 'blog_header_image' );
				if ( $id ) {
					$thumb_url  = wp_get_attachment_image_src( $id, 'thumbnail-size', true );
					$thumb_url  = $thumb_url[0];
					$background = 'style="background-image: url(' . esc_url( $thumb_url ) . ');"';
				}
				break;

			case 'category':
				if ( is_category() ) {
					$cat             = get_query_var( 'cat' );
					$category_object = get_category( $cat );
					$category_id     = $category_object->term_id;
					$file            = get_term_meta( $category_id, $key = 'ps_category_header_image', $single = true );
					if ( $file ) {
						$id = $file['id'];
					} else {
						$id = aspen_option( 'blog_header_image' );
					}

					if ( $id ) {
						$thumb_url  = wp_get_attachment_image_src( $id, 'thumbnail-size', true );
						$thumb_url  = $thumb_url[0];
						$background = 'style="background-image: url(' . esc_url( $thumb_url ) . ');"';
					}
				}
				break;

			case 'product_category':
				if ( is_product_category() ) {

					$category_id = get_queried_object_id();
					$file        = get_term_meta( $category_id, $key = 'ps_category_header_image', $single = true );

					if ( $file ) {
						$id = $file['id'];

						if ( $id ) {

							$thumb_url = wp_get_attachment_image_src( $id, 'full', false );

							if ( $thumb_url ) {
								$thumb_url  = wp_get_attachment_image_src( $id, 'full', true );
								$thumb_url  = $thumb_url[0];
								$background = 'style="background-image: url(' . esc_url( $thumb_url ) . ');"';
							} else {
								return;
							}

						}
					}
				}
				break;

			case 'shop':
				if ( function_exists( 'is_shop' ) && is_shop() ) {
					$id = aspen_option( 'woocommerce_default_header_image' );

					if ( $id ) {

						$thumb_url = wp_get_attachment_image_src( $id, 'full', false );

						if ( $thumb_url ) {
							$thumb_url  = wp_get_attachment_image_src( $id, 'full', true );
							$thumb_url  = $thumb_url[0];
							$background = 'style="background-image: url(' . esc_url( $thumb_url ) . ');"';
						} else {
							return;
						}

					}
				}
				break;

			case 'header':
				if ( has_post_thumbnail() ) {
					if ( $id == 0 ) {
						$id = get_the_ID();
					}
					$thumb_id = get_post_thumbnail_id( $id );
					if ( $thumb_id ) {
						$thumb_url  = wp_get_attachment_image_src( $thumb_id, 'thumbnail-size', true );
						$thumb_url  = $thumb_url[0];
						$background = 'style="background-image: url(' . esc_url( $thumb_url ) . ');"';
					}
				}
				break;

			case 'front':
				if ( ! $id ) {
					$id = aspen_option( 'blog_header_image' );
				}

				if ( $id ) {
					$thumb_url  = wp_get_attachment_image_src( $id, 'thumbnail-size', true );
					$thumb_url  = $thumb_url[0];
					$background = 'style="background-image: url(' . esc_url( $thumb_url ) . ');"';
				}
				break;

		}

		if ( $style_tag_only == true ) {
			if ( $background ) {
				return ' ' . $background;
			}
		} else {

			$classes = implode( ' ', $add_classes );
			if ( ! empty  ( $add_classes ) > 0 ) {
				$classes = $classes . ' ';
			}

			if ( $background ) {
				$tag = ' class="' . $classes . 'blog-header has-banner-background" ' . $background;
			} else {
				$tag = ' class="' . $classes . 'blog-header no-banner-background"';
			}

			echo apply_filters( 'aspen_header_tag_' . $where, $tag );
		}
	}
}


/**
 * Renders featured image
 */

if ( ! function_exists( 'aspen_featured_image' ) ) {
	function aspen_featured_image() {
		if ( has_post_thumbnail() ) {
			echo '<figure class="featured-image">';
			the_post_thumbnail( 'aspen-post-thumbnail-large' );
			echo '</figure>';
		}
	}
}


if ( ! function_exists( 'aspen_featured_image_inline' ) ) {
	function aspen_featured_image_inline() {
		$background = false;
		if ( has_post_thumbnail() ) {
			$id       = get_the_ID();
			$thumb_id = get_post_thumbnail_id( $id );
			if ( $thumb_id ) {
				$thumb_url  = wp_get_attachment_image_src( $thumb_id, 'thumbnail-size', true );
				$thumb_url  = $thumb_url[0];
				$background = 'style="background-image: url(' . esc_url( $thumb_url ) . ');"';
			}
		}

		if ( $background ) {
			echo apply_filters( 'aspen_featured_image_inline', $background );
		}

	}
}


/**
 * Renders tags
 */

if ( ! function_exists( 'aspen_tags' ) ) {
	function aspen_tags() {
		$posttags = get_the_tags();
		if ( $posttags ) {
			echo '<ul id="post-tags">';
			foreach ( $posttags as $tag ) {
				echo '<li><a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" rel="tag">' . esc_html( $tag->name ) . '</a></li>';
			}
			echo '</ul>';
		}
	}
}


/**
 * Renders author box
 */

if ( ! function_exists( 'aspen_author_info' ) ) {
	function aspen_author_info( $position = "footer" ) {
		$description = get_the_author_meta( 'description' );
		if ( ! empty ( $description ) ) :
			?>
			<<?php if ( $position == "footer" ) : ?>footer<?php else : ?>aside<?php endif; ?> id="author-info">
				<div class="row">
					<?php
					$aspen_avatar = get_avatar( get_the_author_meta( 'user_email' ), '100' );
					if ( $aspen_avatar ) {
						echo '<div class="author-left">' . $aspen_avatar . '</div>';
						echo '<div class="author-right">';
					}
					?>
					<h2><?php the_author_posts_link(); ?></h2>
					<p><?php the_author_meta( 'description' ); ?></p>
					<!--Start of Author Social Icons-->
					<?php if ( function_exists( 'aspen_features_author_social' ) ) {
						aspen_features_author_social();
					} ?>
					<!--End of Author Social Icons-->
					<?php
					if ( $aspen_avatar ) {
						echo '</div>';
					};
					?>
				</div>
			</<?php if ( $position == "footer" ) : ?>footer<?php else : ?>aside<?php endif; ?>>
		<?php
		else:
			if ( $position != "footer" ) :
				?>
				<aside id="author-info">
					<div class="row">
						<?php
						$aspen_avatar = get_avatar( get_the_author_meta( 'user_email' ), '100' );
						if ( $aspen_avatar ) {
							echo '<div class="author-left">' . $aspen_avatar . '</div>';
							echo '<div class="author-right">';
						}
						?>
						<h2><?php the_author_posts_link(); ?></h2>
						<!--Start of Author Social Icons-->
						<?php if ( function_exists( 'aspen_features_author_social' ) ) {
							aspen_features_author_social();
						} ?>
						<!--End of Author Social Icons-->
						<?php
						if ( $aspen_avatar ) {
							echo '</div>';
						};
						?>
					</div>
				</aside>
			<?php
			endif;
		endif;
	}
}


/**
 * Renders post prev/next navigation
 */

if ( ! function_exists( 'aspen_post_navigation' ) ) {
	function aspen_post_navigation() {
		$prev = get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( $prev && $next ) {
			$both = 'pagination-multiple-items';
		} else {
			$both = 'pagination-one-item';
		}

		?>
		<!--Start of Pagination Single Post-->
		<div id="pagination-single" class="<?php echo esc_attr( $both ) ?>">
			<?php if ( ! empty ( $prev ) ) : ?>
				<?php previous_post_link( '%link', '<div class="pagination-overlay"><span>' . esc_html__( 'Previous Post', 'aspen' ) . '</span><h4>%title</h4></div>' ); ?>
			<?php endif; ?>
			<?php if ( ! empty ( $next ) ) : ?>
				<?php next_post_link( '%link', '<div class="pagination-overlay"><span>' . esc_html__( 'Next Post', 'aspen' ) . '</span><h4>%title</h4></div>' ); ?>
			<?php endif; ?>
		</div>
		<!--End of Pagination Single Post-->
		<?php
	}
}


/**
 * Renders post prev/next navigation
 */

if ( ! function_exists( 'aspen_page_navigation' ) ) {
	function aspen_page_navigation() {
		global $wp_query;
		$big   = 999999999; // need an unlikely integer
		$links = paginate_links( array(
			'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'    => '?paged=%#%',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $wp_query->max_num_pages,
			'type'      => 'list',
			'prev_text' => esc_html__( 'Previous', 'aspen' ),
			'next_text' => esc_html__( 'Next', 'aspen' ),
		) );

		?>
		<?php if ( $links ) : ?>
			<!--Start of Pagination-->
			<div id="pagination-category">
				<?php echo apply_filters( 'aspen_page_navigation', $links ); ?>
			</div>
			<!--End of Pagination-->
		<?php endif; ?>
		<?php
	}
}


/**
 * Related Posts Function, derived from Bones framework, modified
 */

if ( ! function_exists( 'aspen_related_posts' ) ) {
	function aspen_related_posts() {
		global $post;
		$tags = wp_get_post_tags( $post->ID );
		if ( $tags ) {
			$tag_arr = '';
			foreach ( $tags as $tag ) {
				$tag_arr .= $tag->slug . ',';
			}
			$args          = array(
				//'tag'          => $tag_arr,
				'numberposts'  => 3,
				'post__not_in' => array( $post->ID )
			);
			$related_posts = get_posts( $args );
			if ( $related_posts ) {
				echo '<aside id="similar-posts" class="clearfix">';
				echo '<h3 class="blog-section-title">' . esc_html__( 'You May Also Like', 'aspen' ) . '</h3>';
				echo '<ul>';
				foreach ( $related_posts as $post ) : setup_postdata( $post );
					$rel_format = get_post_format();
					if ( false === $rel_format ) {
						$rel_format = 'standard';
					}
					?>
					<li class="col-3">
						<a <?php post_class( array(
							'entry-unrelated',
							'format-' . $rel_format
						) ); ?> href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
							<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
								echo '<span class="blog-post-image">';
								the_post_thumbnail( 'post-thumbnail-medium' );
								echo '</span>';
							} else {
								echo '<span class="blog-post-image"></span>';
							}
							?>
							<h4><?php the_title(); ?></h4>
							<span class="blog-post-date"><time class="entry-date updated" datetime="<?php the_time( 'F jS, Y' ) ?>"><?php the_time( 'F jS, Y' ) ?></time></span>
						</a>
					</li>
				<?php endforeach;
				echo '</ul></aside>';
			}
		}
		wp_reset_postdata();
	}
}


/*
 * Classes and other hooks/filters to render templates
 */

if ( ! function_exists( 'aspen_post_grid_section_attrs' ) ) {
	function aspen_post_grid_section_attrs( $layout ) {
		$this_layout = $layout;
		$layouts     = array( 'masonry' => 'masonry', 'grid' => 'grid' );
		if ( ! empty ( $layout ) && key_exists( $layout, $layouts ) ) {
			if ( $this_layout == "grid" ) {
				// nothing to do
			} elseif ( $this_layout == "masonry" ) {
				return 'data-columns';
			}
		} else {
			return '';
		}
	}
}

if ( ! function_exists( 'aspen_post_grid_classes' ) ) {
	function aspen_post_grid_classes( $layout, $classes = array() ) {
		$layouts = array( 'masonry', 'grid' );
		if ( in_array( $layout, $layouts ) ) {
			$classes[] = 'post-grid';

			// columns
			$columns = aspen_option( 'blog_grid_columns' );
			if ( $columns ) {
				$classes[] = 'post-columns-' . $columns;
			}

			// gutter-padding
			$padding = aspen_option( 'blog_grid_spacing' );
			if ( $padding ) {
				$classes[] = 'item-padding-' . $padding;
			}

		}

		return implode( $classes, ' ' );
	}
}

if ( ! function_exists( 'aspen_post_classes' ) ) {
	function aspen_post_classes( $classes = array() ) {
		if ( has_post_thumbnail() ) {
			$classes[] = 'has-post-thumbnail';
		} else {
			$classes[] = 'no-post-thumbnail';
		}

		global $wp_query;
		$classes[] = "post-item-" . $wp_query->current_post;

		return $classes;
	}
}
add_filter( 'post_class', 'aspen_post_classes' );
add_filter( 'body_class', 'aspen_post_classes' );


function aspen_first_post_class( $classes ) {
	global $wp_query;
	if ( 0 != $wp_query->current_post ) {
		$classes[] = 'blog-post-summary-grid';
	}

	return $classes;
}

add_filter( 'post_class', 'aspen_first_post_class' );


if ( ! function_exists( 'aspen_post_meta' ) ) {
	function aspen_post_meta( $key ) {
		$shapingrain = ShapingRainFramework::getInstance( 'aspen' );
		$value       = $shapingrain->getOption( $key, get_the_ID() );

		return $value;
	}
}


/**
 * Renders primary category
 */

if ( ! function_exists( 'aspen_primary_category' ) ) {

	function aspen_primary_category( $useCatLink ) {
		// adapted from http://www.joshuawinn.com/using-yoasts-primary-category-in-wordpress-theme/

		$category   = get_the_category();
		$useCatLink = true;
		$out        = '';

		// If post has a category assigned.
		if ( $category ) {
			$category_display = '';
			$category_link    = '';
			if ( class_exists( 'WPSEO_Primary_Term' ) ) {
				// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
				$wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
				$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
				$term               = get_term( $wpseo_primary_term );
				if ( is_wp_error( $term ) ) {
					// Default to first category (not Yoast) if an error is returned
					$category_display = $category[0]->name;
					$category_link    = get_category_link( $category[0]->term_id );
				} else {
					// Yoast Primary category
					$category_display = $term->name;
					$category_link    = get_category_link( $term->term_id );
				}
			} else {
				// Default, display the first category in WP's list of assigned categories
				$category_display = $category[0]->name;
				$category_link    = get_category_link( $category[0]->term_id );
			}

			// Display category
			if ( ! empty( $category_display ) ) {
				if ( $useCatLink == true && ! empty( $category_link ) ) {
					$out .= ' <span class="post-category">';
					$out .= '<a href="' . esc_url( $category_link ) . '">' . esc_html( $category_display ) . '</a>';
					$out .= '</span>';
				} else {
					$out .= ' <span class="post-category">' . esc_html( $category_display ) . '</span>';
				}
			}

		}

		return $out;
	}
}


/**
 * Renders excerpt
 */

if ( ! function_exists( 'aspen_excerpt_intro' ) ) {
	function aspen_excerpt_intro() {
		$title = trim( get_the_title() );
		$title = strip_tags( $title );
		if ( ! empty ( $title ) ) {
			echo '<div class="blog-post-letter">' . substr( $title, 0, 1 ) . '</div>';
		}
	}
}


/**
 * Renders (mobile) menu
 */

add_filter( 'wp_nav_menu_items', 'aspen_add_meta_items_to_menu', 10, 2 );
if ( ! function_exists( 'aspen_add_meta_items_to_menu' ) ) {
	function aspen_add_meta_items_to_menu( $items, $args ) {
		if ( $args->theme_location == 'aspen-mobile' ) {
			$items .= '<li>' . aspen_search_mobile() . '</li>';
			$items .= '<li>' . aspen_social_icons( 'mobile', false ) . '</li>';
		}

		return $items;
	}
}


if ( ! function_exists( 'aspen_menu_trigger' ) ) {
	function aspen_menu_trigger() {
		echo '<button id="show-mobile" class="nav-button nav-button-trigger">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
		</button>';
	}

	;
}


