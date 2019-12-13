<?php
/**
 * Custom functions that define how the header is rendered.
 *
 * @package aspen
 */

if ( ! function_exists( 'aspen_body_classes' ) ) {
	function aspen_body_classes( $classes ) {
		/*
		 * Adds a class of group-blog to blogs with more than 1 published author.
		 */
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		/*
		 * Adds supporting classes to identify the content type
		 */
		if ( function_exists('has_blocks' ) && is_single() ) {
			if ( has_blocks() ) {
				$classes[] = 'has-blocks';
			} else {
				$classes[] = 'no-blocks';
			}
		}

		/*
		 * Add additional body classes
		 */
		$header_style = aspen_option( 'header_navigation_style' );
		$classes[] = 'header-style-' . $header_style;

		$design = aspen_option( 'global_design_type' );
		$classes[] = 'design-' . $design;


		/*
		 * Add additional header classes
		 */

		if ( has_nav_menu( 'aspen-primary' ) ) {
			$classes[] = 'has-menu';
		} else {
			$classes[] = 'no-menu';
		}

		$classes[] = 'header-align-' . aspen_option( 'header_menu_alignment' );

		$transparentHeaders = array( "one", "two", "three" );
		$stickyHeaders      = array( "one", "two", "three", "five", "six", "seven", "eight" );

		if ( in_array( $header_style, $stickyHeaders ) ) {
			if ( aspen_option( 'header_sticky' ) ) {
				$classes[] = 'header-sticky';
			}
		}

		if ( aspen_option( 'header_sticky_mobile' ) ) {
			$classes[] = 'mobile-sticky';
		}

		if ( in_array( $header_style, $transparentHeaders ) ) {
			if ( aspen_option( 'header_transparent' ) ) {
				if ( ! is_single() ) {
					$classes[] = 'header-transparent';
				} else {
					$classes[] = 'header-solid';
				}
			} else {
				$classes[] = 'header-solid';
			}
		} else {
			$classes[] = 'header-solid';
		}

		if ( aspen_option( 'header_full_width' ) ) {
			$classes[] = 'header-full-width';
		}

		if ( aspen_option( 'header_capitalized' ) ) {
			$classes[] = 'header-capitalized';
		}

		if ( aspen_option ( 'blog_feature_first_post' ) ) {
			$classes[] = 'feature-first-post';
		}

		/*
		 * Comments
		 */

		if ( ! aspen_show_comments_count() ) {
			$classes[] = 'archive-no-comments-count';
		}

		/*
		 * Add classes for blog
		 */
		if ( is_archive() || is_home() ) {
			$classes[] = 'blog-style-' . aspen_option( 'blog_layout' );
			$classes[] = 'blog-align-' . aspen_option( 'blog_layout_alignment' );
		}

		/*
		 * Add banner classes
		 */

		if ( is_front_page() || is_home() ) { // is front page
			$classes[] = 'banner-type-' . aspen_option( 'frontpage_banner_content' );

			if ( aspen_option ( 'frontpage_banner_content') == 'slider' ) { // banner content: slider
				$classes[] = 'slider-style-' . aspen_option( 'frontpage_slider_style' );
			}

			if ( aspen_option( 'frontpage_banner_content' ) == 'image' ) { // banner content: image
				$classes[] = 'image-style-' . aspen_option( 'frontpage_banner_background_style' );
			}
		}

		if ( aspen_has_page_header_banner() ) {
			$classes[] = 'has-banner-background';
		} else {
			$classes[] = 'no-banner-background';

			if ( isset ($classes['header-transparent'] ) ) {
				unset ( $classes['header-transparent'] );
			}
			$classes[] = 'header-solid';
		}

		if ( function_exists( 'is_woocommerce') && is_product() ) {
			$classes[] = "no-banner";
		}

		if ( aspen_option( 'frontpage_no_filters' ) ) {
			$classes[] = 'hero-no-filters';
		}

		/*
		 * Special classes for header types
		 */
		if ( $header_style == 'six' ) {
			$classes[] = 'sidebar-menu-push';
		}



		/*
		 * Logo
		 */
		$image_id_primary   = aspen_option( 'logo_image' );
		$image_id_secondary = aspen_option( 'logo_image_secondary' );
		$image_id_mobile    = aspen_option( 'logo_image_mobile' );

		if ( $image_id_primary || $image_id_secondary ) {
			$classes[] = 'has-logo';
		} else {
			$classes[] = 'no-logo';
		}

		if ( $image_id_primary ) {
			$classes[] = 'has-logo-primary';
		}

		if ( $image_id_secondary ) {
			$classes[] = 'has-logo-secondary';
		}

		if ( $image_id_mobile ) {
			$classes[] = 'has-logo-mobile';
		}

		/*
		 * Use of a sidebar
		 */

		if ( function_exists('is_woocommerce' ) && is_woocommerce() ) {

			if ( ! aspen_option( 'woocommerce_hide_sidebar' ) && ( is_active_sidebar( 'aspen-woocommerce-sidebar' ) || is_active_sidebar( 'aspen-sidebar' ) ) ) {
				$classes[] = 'has-sidebar';
				$position = aspen_option( 'sidebar_position' );
				$classes[] = 'sidebar-position-' . $position;
			} else {
				$classes[] = 'no-sidebar';
			}

		} else {

			if ( is_page() ) {

				$sidebar = false;


				if ( is_active_sidebar( 'aspen-sidebar' ) ) {


					if ( in_array( 'page-template-page-sidebar-right', $classes ) ) {
						$sidebar = 'right';
					}

					if ( in_array( 'page-template-page-sidebar-left', $classes ) ) {
						$sidebar = 'left';
					}


					if ( $sidebar ) {

						$classes[] = 'has-sidebar';
						$classes[] = 'sidebar-position-' . $sidebar;

					} else {

						$classes[] = 'no-sidebar';

					}

				} else {

					$classes[] = 'no-sidebar';

				}

			} else {

				if ( is_active_sidebar( 'aspen-sidebar' ) && ! aspen_option( 'hide_sidebar' ) ) {

					$classes[] = 'has-sidebar';
					$position  = aspen_option( 'sidebar_position' );
					$classes[] = 'sidebar-position-' . $position;

				} else {

					$classes[] = 'no-sidebar';

				}

			}
		}



		/*
		 * Footer
		 */

		if ( aspen_option( 'footer_full_width' ) ) {
			$classes[] = 'footer-full-width';
		}

		if ( aspen_option( 'footer_style' ) == 'plain' ) {
			$classes[] = 'footer-plain';
		}


		/*
		 * WooCommerce
		 */
		if ( in_array( 'woocommerce', $classes ) || in_array( 'woocommerce-page', $classes ) ) {
			$is_woocommerce = true;
		} else {
			$is_woocommerce = false;
		}

		if ( $is_woocommerce ) {
			$classes[] = 'woocommerce-columns-' . aspen_option( 'woocommerce_grid_columns', 3 );
			$classes[] = 'woocommerce-padding-' . aspen_option( 'woocommerce_grid_spacing', 15 );
		}


		/*
		 * Exceptions for certain banner options
		 */

		if ( is_front_page() && aspen_option ( 'frontpage_banner_content' ) == 'slider' ) {
			if ( aspen_option( 'frontpage_slider_style' ) != 'full-width' ) {
				unset ( $classes['header-transparent'] );
				$classes = array_diff( $classes, array( "header-transparent" ) );
			}
		}

		if ( is_front_page() && aspen_option( 'frontpage_banner_content' ) == 'image' ) {
			if ( aspen_option( 'frontpage_banner_background_style' ) != 'full-width' ) {
				unset ( $classes['header-transparent'] );
				$classes = array_diff( $classes, array( "header-transparent" ) );
			}
		}


		return $classes;
	}
}
add_filter( 'body_class', 'aspen_body_classes' );



if ( ! function_exists( 'aspen_get_blog_layout' ) ) {
	function aspen_get_blog_layout() {
		return aspen_option( 'blog_layout' );
	}
}