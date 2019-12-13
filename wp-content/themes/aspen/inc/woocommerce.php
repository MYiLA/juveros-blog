<?php
/*
 * Aspen
 * WooCommerce Integration
 */

function aspen_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'aspen_woocommerce_support' );


if ( ! function_exists( ( 'aspen_woocommerce_enqueue_scripts' ) ) ) {
	function aspen_woocommerce_enqueue_scripts() {
		wp_register_style( 'aspen-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css', array( 'aspen-style' ), ASPEN_THEME_VERSION );
		wp_enqueue_style( 'aspen-woocommerce' );
	}
}

add_action( 'wp_enqueue_scripts', 'aspen_woocommerce_enqueue_scripts' );


function aspen_woocommerce_override_page_title() {
	return false;
}

add_filter( 'woocommerce_show_page_title', 'aspen_woocommerce_override_page_title' );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


function aspen_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );        // Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );         // Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation

	return $enqueue_styles;
}

add_filter( 'woocommerce_enqueue_styles', 'aspen_dequeue_styles' );


function aspen_woocommerce_init_sidebars() {
	register_sidebar( array(
		'name'          => esc_html__( 'WooCommerce Sidebar', 'aspen' ),
		'description'   => esc_html__( 'This sidebar is displayed on all WooCommerce pages.', 'aspen' ),
		'id'            => 'aspen-woocommerce-sidebar',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );
}

add_action( 'widgets_init', 'aspen_woocommerce_init_sidebars' );


if ( ! function_exists( 'aspen_woocommerce_loop_columns' ) ) {
	function aspen_woocommerce_loop_columns() {
		return 3; // 3 products per row
	}
}

add_filter( 'loop_shop_columns', 'aspen_woocommerce_loop_columns' );


if ( ! function_exists( 'aspen_woocommerce_template_loop_product_title' ) ) {
	function aspen_woocommerce_template_loop_product_title() {
		echo '<h3 class="woocommerce-loop-product__title">' . get_the_title() . '</h3>';
	}
}

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'aspen_woocommerce_template_loop_product_title', 10 );


function aspen_loop_shop_per_page( $amount ) {
	$amount = aspen_option( 'woocommerce_per_page' );
	if ( $amount < 3 ) {
		$amount = 3;
	}

	return $amount;
}

add_filter( 'loop_shop_per_page', 'aspen_loop_shop_per_page', 20 );


function aspen_woocommerce_related_products_args( $args ) {
	$args['posts_per_page'] = 3;
	$args['columns']        = 3;

	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'aspen_woocommerce_related_products_args' );


function aspen_display_sold_out_loop_woocommerce() {
	global $product;

	if ( ! $product->is_in_stock() ) {
		echo '<span class="soldout">' . esc_html__( 'SOLD OUT', 'aspen' ) . '</span>';
	}
}

add_action( 'woocommerce_before_shop_loop_item_title', 'aspen_display_sold_out_loop_woocommerce' );


function aspen_woocommerce_before_content() {
	?>
	<!--Start of Main Content-->
	<main id="site-content">

	<?php if ( is_shop() || is_product_category() || is_product_taxonomy() ) : ?>
		<!--WooCommerce Header-->
		<div class="aspen-full-width">
			<div<?php if ( is_shop() ) {
				aspen_page_header_tag( 'shop' );
			} else {
				aspen_page_header_tag( 'product_category' );
			} ?>>
				<div class="blog-header-inner">
					<div class="blog-header-content">
						<?php
						if ( is_shop() ) {

							echo '<h1>';
							woocommerce_page_title();
							echo '</h1>';

						} elseif ( is_product_category() ) {

							echo '<h1>';
							single_term_title();
							echo '</h1>';

							aspen_woocommerce_archive_description();

						} elseif ( is_product_taxonomy() ) {

							echo '<h1>';
							single_term_title();
							echo '</h1>';

						} else {
							the_title( '<h1>', '</h1>' );
						}

						woocommerce_breadcrumb();

						?>
					</div>
				</div>
			</div>
		</div>
		<!--End of WooCommerce Header-->
	<?php endif; ?>

	<div class="entry-content col-3-4">
	<?php
}

add_action( 'woocommerce_before_main_content', 'aspen_woocommerce_before_content' );


function aspen_woocommerce_after_content() {
	?>
	</div><!-- .entry-content -->

	<?php
	if ( ! aspen_option( 'woocommerce_hide_sidebar' ) && ( is_active_sidebar( 'aspen-woocommerce-sidebar' ) || is_active_sidebar( 'aspen-sidebar' ) ) ) {
		if ( aspen_is_woocommerce() ) {
			if ( is_active_sidebar( 'aspen-woocommerce-sidebar' ) ) {
				echo '<div id="sidebar" class="widget-area col-4" role="complementary">';
				aspen_get_sidebar( 'aspen-woocommerce-sidebar' );
				echo '</div>';
			} else {
				aspen_get_sidebar();
			}
		} else {
			aspen_get_sidebar();
		}
	}
	?>

	</main>
	<?php
}

add_action( 'woocommerce_after_main_content', 'aspen_woocommerce_after_content' );


if ( ! function_exists( 'woocommerce_breadcrumb' ) ) {
	function woocommerce_breadcrumb( $args = array() ) {
		$args = array(
			'delimiter'   => '',
			'wrap_before' => '<div id="breadcrumb"><ul>',
			'wrap_after'  => '</ul></div>',
			'before'      => '<li>',
			'after'       => '</li>',
			'home'        => get_bloginfo( 'name' )
		);

		$breadcrumbs = new WC_Breadcrumb();


		if ( $args['home'] ) {
			$breadcrumbs->add_crumb( $args['home'], esc_url( home_url( '/' ) ) );
		}

		if ( is_product_category() || is_product() ) {
			$breadcrumbs->add_crumb( get_the_title( wc_get_page_id( 'shop' ) ), get_permalink( wc_get_page_id( 'shop' ) ) );
		}


		$args['breadcrumb'] = $breadcrumbs->generate();
		wc_get_template( 'global/breadcrumb.php', $args );
	}
}


function aspen_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'aspen' ); ?>" <?php if ( $woocommerce->cart->cart_contents_count > 0 ) : ?>class="header-cart-notempty"<?php endif; ?> id="header-cart-trigger">
		<?php if ( $woocommerce->cart->cart_contents_count > 0 ) : ?>
			<span id="header-cart-total"><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?></span><?php endif; ?>
		<i class="fa fa-shopping-cart fa-1x"></i>
	</a>
	<?php

	$fragments['a#header-cart-trigger'] = ob_get_clean();

	if ( ! empty ( $_REQUEST['product_id'] ) ) {
		$product_id = $_REQUEST['product_id'];
		if ( is_numeric( $product_id ) ) {
			$_pf                                                           = new WC_Product_Factory();
			$_product                                                      = $_pf->get_product( $product_id );
			$fragments['#header-cart-notification span.cart-notification'] = '<span class="cart-notification">&quot;' . $_product->get_title() . '&quot; ' . esc_html__( 'has been added to the cart.', 'aspen' ) . '</span>';
		}
	}

	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'aspen_woocommerce_header_add_to_cart_fragment' );


function aspen_cart() {
	?>
	<?php if ( function_exists( 'is_woocommerce' ) ) : ?>
		<?php global $woocommerce; ?>
		<!--Start of WooCommerce Cart-->
		<div id="header-cart" class="collapsed">
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'aspen' ); ?>" <?php if ( $woocommerce->cart->cart_contents_count > 0 ) : ?>class="header-cart-notempty"<?php endif; ?> id="header-cart-trigger">
				<?php if ( $woocommerce->cart->cart_contents_count > 0 ) : ?>
					<span id="header-cart-total"><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?></span><?php endif; ?>
				<i class="fa fa-shopping-cart fa-1x"></i>
			</a>
			<?php the_widget( 'WC_Widget_Cart' ); ?>
		</div>
		<div id="header-cart-notification" class="collapsed">
			<span class="cart-notification"></span>
		</div>
		<!--End of WooCommerce Cart-->
		<?php do_action( 'aspen_header_after_cart' ); ?>
	<?php endif; ?>
	<?php
}


function aspen_woocommerce_cart_to_shop_link( $wccm_after_checkout ) {
	?>
	<a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" id="back-to-shop"><?php esc_html_e( 'Back to Shop', 'aspen' ) ?></a>
	<?php
}

add_filter( 'woocommerce_after_cart', 'aspen_woocommerce_cart_to_shop_link', 10, 1 );


remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );


function aspen_woocommerce_archive_description() {
	if ( is_product_taxonomy() && 0 === absint( get_query_var( 'paged' ) ) ) {
		$term = get_queried_object();

		if ( $term && ! empty( $term->description ) ) {
			echo '<p class="woocommerce-category-description">' . esc_html( $term->description ) . '</p>'; // WPCS: XSS ok.
		}
	}
}


function aspen_woocommerce_rename_tabs( $tabs ) {
	$tabs['additional_information']['title'] = esc_html__( 'Details', 'aspen' );
	return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'aspen_woocommerce_rename_tabs', 98 );
