<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package aspen
 */

if ( ! function_exists( 'aspen_esc_html' ) ) {
	function aspen_esc_html( $contents, $allowed_html = false, $decode_entities = false ) {
		if ( $decode_entities ) {
			$contents = html_entity_decode( $contents );
		}
		if ( ! $allowed_html ) {
			$allowed_html = array(
				'a'      => array(
					'href'   => array(),
					'target' => array(),
					'title'  => array(),
					'id'     => array(),
					'class'  => array(),
					'rel'    => array()
				),
				'img'    => array(
					'src'   => array(),
					'title' => array(),
					'alt'   => array(),
					'id'    => array(),
					'class' => array(),
					'rel'   => array()
				),
				'iframe' => array(
					'id'           => array(),
					'class'        => array(),
					'align'        => array(),
					'frameborder'  => array(),
					'height'       => array(),
					'logdesc'      => array(),
					'marginheight' => array(),
					'marginwidth'  => array(),
					'name'         => array(),
					'sandbox'      => array(),
					'scrolling'    => array(),
					'src'          => array(),
					'srcdoc'       => array(),
					'width'        => array()
				),
				'input'  => array(
					'id'             => array(),
					'class'          => array(),
					'accept'         => array(),
					'align'          => array(),
					'alt'            => array(),
					'autocomplete'   => array(),
					'autofocus'      => array(),
					'checked'        => array(),
					'disabled'       => array(),
					'form'           => array(),
					'formaction'     => array(),
					'formenctype'    => array(),
					'formmethod'     => array(),
					'formnovalidate' => array(),
					'formtarget'     => array(),
					'height'         => array(),
					'list'           => array(),
					'max'            => array(),
					'maxlength'      => array(),
					'min'            => array(),
					'multiple'       => array(),
					'name'           => array(),
					'pattern'        => array(),
					'placeholder'    => array(),
					'readonly'       => array(),
					'required'       => array(),
					'size'           => array(),
					'src'            => array(),
					'step'           => array(),
					'type'           => array(),
					'value'          => array(),
					'width'          => array(),
					'onclick'        => array()
				),
				'button' => array(
					'id'             => array(),
					'class'          => array(),
					'autofocus'      => array(),
					'disabled'       => array(),
					'form'           => array(),
					'formaction'     => array(),
					'formenctype'    => array(),
					'formmethod'     => array(),
					'formnovalidate' => array(),
					'formtarget'     => array(),
					'name'           => array(),
					'type'           => array(),
					'value'          => array(),
					'onclick'        => array()
				),
				'form'   => array(
					'accept'         => array(),
					'accept-charset' => array(),
					'action'         => array(),
					'autocomplete'   => array(),
					'enctype'        => array(),
					'method'         => array(),
					'name'           => array(),
					'novalidate'     => array(),
					'target'         => array()
				),
				'div'    => array(
					'id'    => array(),
					'class' => array()
				),
				'br'     => array(),
				'em'     => array(),
				'strong' => array(),
				'code'   => array(
					'title' => array(),
					'class' => array(),
					'id'    => array()
				),
				'span'   => array(
					'id'    => array(),
					'class' => array()
				),
				'b'      => array(
					'id'    => array(),
					'class' => array()
				),
				'i'      => array(
					'id'    => array(),
					'class' => array()
				),
				'p'      => array(
					'id'    => array(),
					'class' => array()
				),
				'time'   => array(
					'class'    => array(),
					'datetime' => array()
				),
			);
		}

		return wp_kses( $contents, $allowed_html );
	}
}

/*
 * Check whether certain information should be rendered
 */

if ( ! function_exists( 'aspen_show_author' ) ) {
	function aspen_show_author( $single = false ) {
		if ( $single ) {
			$show = aspen_option( 'blog_single_show_author' );
		} else {
			$show = aspen_option( 'blog_show_author' );
		}
		if ( $show ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'aspen_show_categories' ) ) {
	function aspen_show_categories( $single = false ) {
		if ( $single ) {
			$show = aspen_option( 'blog_single_show_categories' );
		} else {
			$show = aspen_option( 'blog_show_categories' );
		}
		if ( $show ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'aspen_show_date' ) ) {
	function aspen_show_date( $single = false ) {
		if ( $single ) {
			$show = aspen_option( 'blog_single_show_date' );
		} else {
			$show = aspen_option( 'blog_show_date' );
		}
		if ( $show ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'aspen_show_comments_count' ) ) {
	function aspen_show_comments_count( $single = false ) {
		if ( $single ) {
			$show = true;
		} else {
			$show = aspen_option( 'blog_show_comments_count' );
		}
		if ( $show ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'aspen_show_tags' ) ) {
	function aspen_show_tags( $single = false ) {
		$show = aspen_option( 'blog_single_show_tags' );
		if ( $show ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'aspen_show_author_box' ) ) {
	function aspen_show_author_box( $single = false ) {
		$show = aspen_option( 'blog_single_show_author_box' );
		if ( $show ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'aspen_show_related' ) ) {
	function aspen_show_related( $single = false ) {
		$show = aspen_option( 'blog_single_show_related' );
		if ( $show ) {
			return true;
		} else {
			return false;
		}
	}
}

/*
 * Get first gallery images from content
 */
if ( ! function_exists( 'aspen_get_gallery' ) ) {
	function inbound_get_gallery( $content ) {
		$pattern = get_shortcode_regex();
		if ( preg_match_all( '/' . $pattern . '/s', $content, $matches )
		     && array_key_exists( 2, $matches )
		     && in_array( 'gallery', $matches[2] )
		) {
			$keys = array_keys( $matches[2], 'gallery' );
			if ( $keys && is_array( $keys ) ) {
				foreach ( $keys as $key ) {
					$atts = shortcode_parse_atts( $matches[3][ $key ] );
					if ( $atts && is_array( $atts ) ) {
						if ( array_key_exists( 'ids', $atts ) ) {
							$images = explode( ',', $atts['ids'] );
							if ( is_array( $images ) && count( $images ) > 0 ) {
								return $images;
							} else {
								return false;
							}
						}
					}
				}
			}
		}
	}
}

if ( ! function_exists( 'aspen_filter_widget' ) ) {
	function aspen_filter_widget( $output = '', $args = null, $instance = null ) {
		return apply_filters( 'aspen_filter_widget', $output, $args, $instance );
	}
}
