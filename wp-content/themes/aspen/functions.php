<?php
/**
 * Aspen functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package aspen
 */


/**
 * Global Variables for use in functions
 */
global $aspen_sidebars; /* holds a cached and pre-processed version of active sidebars */
global $aspen_widgets_row_count; /* widget counts to automatically re-size widgetized areas */
global $aspen_widgets_count; /*internal counters for handling custom widgetized areas */
global $aspen_widgets_type_count;
global $aspen_last_widget_id; /* simple counter */
global $aspen_post_content; /* pre-rendered, pre-processed page and post content */
global $aspen_styles; /* dynamic css */
global $aspen_options; /* options cache */

/**
 * Global Constants
 */
if ( ! defined( 'ASPEN_DEBUG_MODE' ) ) {
	define( 'ASPEN_DEBUG_MODE', false );
}


if ( ! defined( 'ASPEN_THEME_VERSION' ) ) {
	if ( is_child_theme() ) {
		$style_parent_theme = wp_get_theme( get_template() );
		$version            = $style_parent_theme->get( 'Version' );
	} else {
		$style_parent_theme = wp_get_theme();
		$version            = $style_parent_theme->get( 'Version' );
	}
	define( 'ASPEN_THEME_VERSION', $version );
}

/**
 * Third Party Libraries and Additional Theme Features
 */
require get_template_directory() . '/inc/template-tags.php'; /* Custom template tags for this theme. */
require get_template_directory() . '/inc/extras.php'; /* Custom functions that act independently of the theme templates. */
require get_template_directory() . '/inc/customizer.php'; /* Customizer additions. */

require get_template_directory() . '/inc/header.php'; /* Header and navigation */
require get_template_directory() . '/lib/tax-meta-class/tax-meta-class.php'; /* Custom Taxonomy Classes */
require get_template_directory() . '/inc/tax-options.php';

require_once( get_template_directory() . '/lib/tgmpa-class/class-tgm-plugin-activation.php' );
require_once( get_template_directory() . '/inc/shapingrain-framework-checker.php' );

if ( class_exists( 'ShapingRainFrameworkOption' ) ) {
	require_once( get_template_directory() . '/inc/shapingrain-framework-controls.php' );
}

require get_template_directory() . '/shapingrain-options.php'; /* Load ShapingRain Framework options */


if ( function_exists( 'is_woocommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php'; /* WooCommerce integration */
}

require get_template_directory() . '/inc/welcome.php'; /* welcome page */

add_action( 'after_setup_theme', 'aspen_check_framework' );
function aspen_check_framework() {
	if ( ! class_exists( 'ShapingRainFramework' ) && ! is_admin() ) {
		/* Load ShapingRain Framework dummy for default values */
		require get_template_directory() . '/inc/shapingrain-framework-dummy.php';
	}
}


if ( ! function_exists( 'aspen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function aspen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'aspen', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );


		/*
		 * Image sizes
		 */
		add_image_size( 'aspen-post-thumbnail-large', 1200, 600, true );
		add_image_size( 'aspen-post-thumbnail-medium', 900, 474, true );
		add_image_size( 'aspen-post-thumbnail-split', 900, 900, true );
		add_image_size( 'aspen-post-thumbnail-tiny', 120, 92, true );


		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'aspen-primary' => esc_html__( 'Primary Menu', 'aspen' ),
			'aspen-mobile'  => esc_html__( 'Mobile Menu', 'aspen' ),
			'aspen-footer'  => esc_html__( 'Footer Menu', 'aspen' ),
		) );


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'gallery',
			'video',
			'quote',
			'link',
		) );

		/* Not supported as features provided by theme's profiles feature */
		if ( defined( 'CUSTOM_THEME_SUPPORT' ) ) {
			add_theme_support( "custom-header", array() );
			add_theme_support( "custom-background", array() );
		}

		/*
		 * Gutenberg-specific items
		 */
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );

	}
endif; // aspen_setup
add_action( 'after_setup_theme', 'aspen_setup' );


if ( ! function_exists( 'aspen_add_editor_styles' ) ) {
	function aspen_add_editor_styles() {
		add_editor_style( 'editor-style.css' );
	}
}
add_action( 'admin_init', 'aspen_add_editor_styles' );


function aspen_modify_nav_menu_args( $args ) {
	if ( 'aspen-primary' == $args['theme_location'] ) {
		$args['link_before'] = '<span>';
		$args['link_after']  = '</span>';
	}

	if ( 'aspen-footer' == $args['theme_location'] ) {
		$args['depth'] = 1;
	}

	return $args;
}

add_filter( 'wp_nav_menu_args', 'aspen_modify_nav_menu_args' );


function aspen_link_pages( $link ) {
	if ( ctype_digit( $link ) ) {
		return '<span class="current">' . $link . '</span>';
	} else {
		return '<span>' . $link . '</span>';
	}
}

add_filter( 'wp_link_pages_link', 'aspen_link_pages' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aspen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'aspen_content_width', 640 );
}

add_action( 'after_setup_theme', 'aspen_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aspen_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'aspen' ),
		'id'            => 'aspen-sidebar',
		'description'   => esc_html__( 'This is the main sidebar. It is rendered on all pages that support the sidebar, including the blog and its archives.', 'aspen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'aspen' ),
		'id'            => 'aspen-footer',
		'description'   => esc_html__( 'Widgets placed in this sidebar will be rendered as part of the footer. Each widget is placed in a separate column.', 'aspen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Instagram Bar', 'aspen' ),
		'id'            => 'aspen-instagram-bar',
		'description'   => esc_html__( 'This full-width widget area is rendered at the bottom of the page. It is meant to place the Instagram widget.', 'aspen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Promo Widgets', 'aspen' ),
		'id'            => 'aspen-promo',
		'description'   => esc_html__( 'This specialized widgetized area is designed to render the promo widgets on the front page only.', 'aspen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );


}

add_action( 'widgets_init', 'aspen_widgets_init' );


/**
 * Initialize and retrieve sidebar content
 */
if ( ! function_exists( 'aspen_init_sidebars' ) ) {
	function aspen_init_sidebars() {
		global $aspen_sidebars;
		global $wp_registered_sidebars;

		if ( is_page() ) {
			return;
		}

		$sidebars_in_wrapper = array(
			'aspen-sidebar'
		);

		if ( is_array( $wp_registered_sidebars ) && count( $wp_registered_sidebars ) > 0 ) {
			foreach ( $wp_registered_sidebars as $sidebar ) {
				$id = $sidebar['id'];
				if ( is_active_sidebar( $id ) ) {
					ob_start();
					if ( in_array( $id, $sidebars_in_wrapper ) ) {
						get_sidebar();
					} else {
						dynamic_sidebar( $id );
					}
					$aspen_sidebars[ $id ] = ob_get_clean();
				}
			}
		}
	}
}
if ( ! is_admin() ) {
	add_action( 'wp', 'aspen_init_sidebars', 11 );
}


if ( ! function_exists( 'aspen_get_sidebar' ) ) {
	function aspen_get_sidebar( $slug = "aspen-sidebar" ) {
		global $aspen_sidebars;
		if ( isset( $aspen_sidebars[ $slug ] ) ) {
			echo apply_filters( 'aspen_sidebar_output', $aspen_sidebars[ $slug ] );
		} else {
			return false;
		}
	}
}

function aspen_get_widget_instance( $id ) {
	/* adapted from https://wordpress.stackexchange.com/questions/170619/how-to-retrive-widget-title-data */
	$wdgtvar  = 'widget_' . _get_widget_id_base( $id );
	$idvar    = _get_widget_id_base( $id );
	$instance = get_option( $wdgtvar );
	$idbs     = str_replace( $idvar . '-', '', $id );
	return $instance[ $idbs ];
}

if ( ! function_exists( 'aspen_count_widgets' ) ) {
	function aspen_count_widgets( $sidebar_id ) {
		global $_wp_sidebars_widgets;
		global $widgets_total_count;

		if ( ! empty ( $widgets_total_count [ $sidebar_id ] ) ) {
			return $widgets_total_count [ $sidebar_id ];
		}

		if ( empty( $_wp_sidebars_widgets ) ) :
			$_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
		endif;

		$sidebars_widgets = $_wp_sidebars_widgets;

		$widgets_count = 0;

		$current_lang = apply_filters( 'wpml_current_language', null ); /* WPML compatibility */

		if ( ! empty ( $current_lang ) ) { // WPML active and languages set

			foreach ( $sidebars_widgets[ $sidebar_id ] as $id ) {

				$widget_instance = aspen_get_widget_instance( $id );

				/* get WPML language from widget instance */
				if ( ! empty ( $widget_instance['wpml_language'] ) ) {
					$this_lang = $widget_instance['wpml_language'];
				} else {
					$this_lang = 'all';
				}

				/* increase widget count if current language matches widget language */
				if ( $this_lang == 'all' || $this_lang == $current_lang ) {
					$widgets_count ++;
				}


			}
			$widgets_total_count [ $sidebar_id ] = $widgets_count;

			return $widgets_count;

		} else { // WPML not active or no languages returned

			$widgets_count                       = count( $sidebars_widgets[ $sidebar_id ] );
			$widgets_total_count [ $sidebar_id ] = $widgets_count;

			return $widgets_count;

		}

	}
}

if ( ! function_exists( 'aspen_add_classes_to_widgets' ) ) {
	function aspen_add_classes_to_widgets( $params ) {

		$horizontal_widgets = array(
			'aspen-footer',
			'aspen-instagram-bar',
			'aspen-promo',
		);

		$this_id = $params[0]['id'];    // current widget area id

		$custom_widget_cols = apply_filters( 'aspen_horizontal_widgets_columns', false, $this_id ); // fixed cols defined in filter?

		if ( $custom_widget_cols ) {
			$widget_cols = $custom_widget_cols; // use value from filter
		} else {
			$widget_cols = aspen_count_widgets( $this_id ); // count widgets and auto-assign number of columns
		}

		if ( in_array( $this_id, $horizontal_widgets ) ) { // horizontal widgets only
			$before_widget = $params[0]['before_widget'];
			$before_widget              = str_replace( 'class="', 'class="widget-container col-' . $widget_cols . ' ', $before_widget );
			$params[0]['before_widget'] = $before_widget;
		} else {
			return $params; // just return parameters
		}

		return $params;
	}
}
if ( ! is_admin() ) {
	add_filter( 'dynamic_sidebar_params', 'aspen_add_classes_to_widgets' );
}



function aspen_has_page_sidebar() {

	if ( ! is_page() ) {
		return false;
	}

	if ( is_active_sidebar( 'aspen-sidebar' ) ) {

		$sidebar = false;

		if ( substr_count( get_page_template_slug(), 'sidebar-right' ) > 0 ) {
			$sidebar = 'right';
		}

		if ( substr_count( get_page_template_slug(), 'sidebar-left' ) > 0 ) {
			$sidebar = 'left';
		}

		return $sidebar;

	}
}


/**
 * Enqueue scripts and styles.
 */
function aspen_scripts() {
	/*
	 * Styles
	 */
	wp_enqueue_style( 'aspen-style', get_stylesheet_uri() );
	wp_enqueue_style( 'aspen-fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );

	if ( ! class_exists( 'ShapingRainFrameworkPlugin' ) ) {
		wp_enqueue_style( 'aspen-temp', get_template_directory_uri() . '/assets/css/temp.css' );

		wp_enqueue_style( 'aspen-font-opensans', '//fonts.googleapis.com/css?family=Open+Sans%3Ainherit%2C700%2C400%2C500&#038;subset=latin%2Clatin-ext', false );
		wp_enqueue_style( 'aspen-font-playfair-display', '//fonts.googleapis.com/css?family=Playfair+Display%3Ainherit%2C400italic%2C400&#038;subset=latin%2Clatin-ext', false );
	}

	/*
	 * Scripts
	 */

	wp_enqueue_script( 'aspen-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'aspen-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'smartmenus', get_template_directory_uri() . '/assets/js/jquery.smartmenus.min.js', array( 'jquery' ), '20170911', true );

	wp_enqueue_script( 'salvattore', get_template_directory_uri() . '/assets/js/salvattore.min.js', array( 'jquery' ), '20170905', true );

	wp_enqueue_script( 'imagesloaded' );

	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'simplelightbox', get_template_directory_uri() . '/assets/js/simplelightbox.min.js', array( 'jquery' ) );

	wp_enqueue_script( 'featherlight', get_template_directory_uri() . '/assets/js/featherlight-pack.min.js', array( 'jquery' ) );

	wp_enqueue_script( 'aspen-init-scripts', get_template_directory_uri() . '/assets/js/aspen.js', array(
		'jquery',
		'smartmenus',
		'imagesloaded'
	), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', 'aspen_scripts' );


function aspen_admin_scripts( $hook ) {
	wp_register_style( 'aspen-admin', get_template_directory_uri() . '/assets/css/admin-style.css', false, '1.0.0' );
	wp_enqueue_style( 'aspen-admin' );


	if ( 'post.php' == $hook || 'post-new.php' == $hook || 'widgets.php' == $hook || 'customize.php' == $hook ) {

		global $current_screen;
		if ( ! empty ( $current_screen ) && method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) {
			// only for Gutenberg pages, if Gutenberg is active
			wp_enqueue_script( 'aspen-admin-gutenberg', get_template_directory_uri() . '/assets/js/editor-gutenberg.js', array(
				'jquery'
			) );
		} else {
			// only for non-Gutenberg pages, or if Gutenberg is inactive
			wp_enqueue_script( 'aspen-admin-classic', get_template_directory_uri() . '/assets/js/editor-classic.js', array(
				'jquery'
			) );
		}

	}
}

add_action( 'admin_enqueue_scripts', 'aspen_admin_scripts', 999 );


/**
 * Enqueue block editor style
 */
function aspen_gutenberg_editor_styles() {
	wp_enqueue_style( 'aspen-block-editor', get_theme_file_uri( '/assets/css/style-editor.css' ), false, null, 'all' );

	if ( ! class_exists( 'ShapingRainFrameworkPlugin' ) ) {
		/* If framework is missing, use default fonts instead of those dynamically generated from user's settings */
		wp_enqueue_style( 'aspen-font-opensans', '//fonts.googleapis.com/css?family=Open+Sans%3Ainherit%2C700%2C400%2C500&#038;subset=latin%2Clatin-ext', false );
		wp_enqueue_style( 'aspen-font-playfair-display', '//fonts.googleapis.com/css?family=Playfair+Display%3Ainherit%2C400italic%2C400&#038;subset=latin%2Clatin-ext', false );
	}

}

add_action( 'enqueue_block_editor_assets', 'aspen_gutenberg_editor_styles' );


/**
 * Additional styling for block editor if framework is active and user-defined dynamic CSS needs to be rendered
 */
function aspen_gutenberg_dynamic_css() {
	if ( class_exists( 'ShapingRainFramework' ) && class_exists( 'ShapingRainFrameworkCSS' ) ) { /* This only makes sense if the Framework is active */
		$srf = ShapingRainFramework::getInstance( 'aspen' );
		$css = $srf->generateAdminCSS();
		if ( ! empty ( $css) ) {
			wp_add_inline_style( 'aspen-block-editor', $css );
		}
	}
}

add_action( 'admin_enqueue_scripts', 'aspen_gutenberg_dynamic_css', 1);


/**
 * Add Customizer-specific code
 */
function aspen_customize_controls_js() {
	wp_enqueue_script( 'aspen_customizer_control', get_template_directory_uri() . '/assets/js/customizer-controls.js', array(
		'customize-controls',
		'jquery'
	), null, true );
}

add_action( 'customize_controls_enqueue_scripts', 'aspen_customize_controls_js' );


/**
 * Return option from given array, or default
 */
if ( ! function_exists( 'aspen_array_option' ) ) {
	function aspen_array_option( $key = '', $instance, $default = false ) {
		if ( isset( $instance[ $key ] ) ) {
			$content = $instance[ $key ];

			return $content;
		} else {
			return $default;
		}
	}
}

/**
 * Check if this is a blog page
 */
function aspen_is_blog() {
	global $post;
	$posttype = get_post_type( $post );

	return ( ( ( is_archive() ) || ( is_author() ) || ( is_category() ) || ( is_home() ) || ( is_single() ) || ( is_tag() ) ) && ( $posttype == 'post' ) ) ? true : false;
}

/**
 * Check if this is a WooCommerce page
 */
function aspen_is_woocommerce( $body_classes = array() ) {

	if ( ! function_exists( 'is_woocommerce' ) ) {
		return false;
	}

	if ( is_woocommerce() || is_product() || is_product_category() || is_product_taxonomy() || is_product_tag() ) {
		return true;
	}

	$is_woocommerce = false; // we need to capture extensions etc. as well, so built-in WC function not enough

	if ( count( $body_classes ) == 0 ) {
		$body_classes = (array) get_body_class();
	}

	if ( in_array( 'woocommerce', $body_classes ) || in_array( 'woocommerce-page', $body_classes ) ) {
		$is_woocommerce = true;
	}

	return $is_woocommerce;

}


/**
 * Retrieve option from database or options cache
 */
function aspen_option( $key = '' ) {
	global $aspen_options;

	if ( ASPEN_DEBUG_MODE ) {
		if ( isset ( $_REQUEST[ $key ] ) ) {
			return $_REQUEST[ $key ];
		}
	}

	if ( isset ( $aspen_options[ $key ] ) ) {
		return $aspen_options[ $key ];
	} else {
		if ( class_exists( 'ShapingRainFramework' ) ) {
			$shapingrain           = ShapingRainFramework::getInstance( 'aspen' );
			$value                 = $shapingrain->getOption( $key );
			$aspen_options[ $key ] = $value;

			return $value;
		} else {
			$aspen_options[ $key ] = false;

			return false;
		}
	}

}

/**
 * Temporarily set an option during runtime
 */
function aspen_set_option( $key, $value ) {
	global $aspen_options;
	$aspen_options [ $key ] = $value;
}


/**
 * Change excerpt length to match design
 */
if ( ! function_exists( 'aspen_custom_excerpt_length' ) ) {
	function aspen_custom_excerpt_length( $length ) {
		$custom_length = aspen_option('blog_excerpt_length');
		if ( empty ( $custom_length ) ) {

			if ( $length === 0 ) {
				$length = 20;
			}

			$custom_length = $length;
		}

		return $custom_length;
	}
}
add_filter( 'excerpt_length', 'aspen_custom_excerpt_length', 999 );

/*
 * Embed container for non-Gutenberg blocks
 */
function aspen_embed_html( $html, $url = '', $attr = array(), $post_ID = 0 ) {

	$classes = array();
	$classes[] = 'embed-container';

	if ( ! empty ( $url ) ) {
		$video_providers = array(
			'animoto.com' => 'animoto',
			'blip.tv' => 'blip',
			'collegehumor.com' => 'collegehumor',
			'dailymotion.com' => 'dailymotion',
			'funnyordie.com' => 'funnyordie',
			'hulu.com' => 'hulu',
			'ted.com' => 'ted',
			'videopress.com' => 'videopress',
			'vimeo.com' => 'vimeo',
			'vine.com' => 'vine',
			'wordpress.tv' => 'wordpresstv',
			'youtube.com' => 'youtube',
			'youtu.be' => 'youtube'
		);

		foreach ( $video_providers as $provider => $slug ) {
			if ( substr_count( $url, $provider) > 0 ) {
				$classes[] = 'embed-video';
				$classes[] = 'embed-' . $slug;
				break;
			}
		}
	}

	return '<div class="' . implode(' ', $classes ) . '">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'aspen_embed_html', 10, 4 );


function aspen_embed_video_html( $html ) {
	return '<div class="embed-container embed-video">' . $html . '</div>';
}
add_filter( 'video_embed_html', 'aspen_embed_video_html' );

function aspen_cache_suffix () {
	$cache_suffix = '';
	$current_lang = apply_filters( 'wpml_current_language', null ); /* WPML compatibility */
	if ( ! empty ( $current_lang ) ) {
		$cache_suffix = '_' . $current_lang;
	}
	return $cache_suffix;
}