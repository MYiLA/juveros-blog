<?php
/*
 * ShapingRain Framework options
 */

add_action( 'shapingrain_framework_create_options', 'aspen_create_options' );

/**
 * Initialize ShapingRain Options Framework & options here
 */
function aspen_create_options() {

	$srf = ShapingRainFramework::getInstance( 'aspen' );


	/**
	 * Create a Theme Customizer panel where we can edit some options.
	 * You should put options here that change the look of your theme.
	 */


	/*
	 * Site Identity
	 */

	$section = $srf->createContainer( array(
		'type' => 'customizer',
		'id'   => 'title_tagline',
	) );

	$section->createOption( array(
		'name' => esc_html__( 'Primary Logo', 'aspen' ),
		'id'   => 'logo_image',
		'type' => 'upload',
		'desc' => esc_html__( 'Upload your primary logo image here.', 'aspen' )
	) );

	$section->createOption( array(
		'name' => esc_html__( 'Secondary Logo', 'aspen' ),
		'id'   => 'logo_image_secondary',
		'type' => 'upload',
		'desc' => esc_html__( 'Upload your secondary logo image here, used for sticky headers in scroll mode.', 'aspen' )
	) );

	$section->createOption( array(
		'name' => esc_html__( 'Mobile Logo', 'aspen' ),
		'id'   => 'logo_image_mobile',
		'type' => 'upload',
		'desc' => esc_html__( 'Upload your mobile logo here. This logo replaces your primary and secondary logos on mobile devices, if uploaded.', 'aspen' )
	) );

	/*
	 * Sidebar and widget areas
     */

	$section = $srf->createContainer( array(
		'type' => 'customizer',
		'id'   => 'sidebar-widgets-aspen-sidebar',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Sidebar Position', 'aspen' ),
		'id'      => 'sidebar_position',
		'type'    => 'select',
		'options' => array(
			'left'  => esc_html__( 'Left', 'aspen' ),
			'right' => esc_html__( 'Right', 'aspen' ),
		),
		'default' => 'right',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Always hide this sidebar', 'aspen' ),
		'id'      => 'hide_sidebar',
		'type'    => 'checkbox',
		'default' => false,
	) );

	$section = $srf->createContainer( array(
		'type' => 'customizer',
		'id'   => 'sidebar-widgets-aspen-footer',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Always hide this widget area', 'aspen' ),
		'id'      => 'hide_footer_widgets',
		'type'    => 'checkbox',
		'default' => false,
	) );


	/*
	 * Static Front Page
	 */
	$section = $srf->createContainer( array(
		'type' => 'customizer',
		'id'   => 'static_front_page',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Hero Content', 'aspen' ),
		'id'      => 'frontpage_banner_content',
		'type'    => 'select',
		'desc'    => esc_html__( 'Select which content you would like to display in the banner.', 'aspen' ),
		'options' => array(
			'none'   => esc_html__( 'None', 'aspen' ),
			'image'  => esc_html__( 'Image', 'aspen' ),
			'slider' => esc_html__( 'Slider', 'aspen' ),
			'html' => esc_html__( 'HTML/Shortcode', 'aspen' ),
		),
		'default' => 'none',
	) );

	$section->createOption( array(
		'name'    => 'Custom HTML Block',
		'id'      => 'frontpage_banner_html',
		'type'    => 'textarea',
		'desc'    => "This HTML code is rendered instead of any of the theme's built-in hero content types. This allows for embedding a custom slider, or any other full-screen hero content.",
		'is_code' => true,
	) );


	$section->createOption( array(
		'name'    => esc_html__( 'Slider Style', 'aspen' ),
		'id'      => 'frontpage_slider_style',
		'type'    => 'select',
		'options' => array(
			'full-width'           => esc_html__( 'Full Width', 'aspen' ),
			'normal-width'         => esc_html__( 'Normal Width', 'aspen' ),
			'wide'                 => esc_html__( 'Wide', 'aspen' ),
			'two-columns-full'     => esc_html__( '2 Columns/Full Width', 'aspen' ),
			'two-columns-normal'   => esc_html__( '2 Columns/Normal Width', 'aspen' ),
			'three-columns-full'   => esc_html__( '3 Columns/Full Width', 'aspen' ),
			'three-columns-normal' => esc_html__( '3 Columns/Normal Width', 'aspen' ),
			'four-columns-full'    => esc_html__( '4 Columns/Full Width', 'aspen' ),
			'four-columns-normal'  => esc_html__( '4 Columns/Normal Width', 'aspen' ),
		),
		'default' => 'full-width',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Space between slides', 'aspen' ),
		'id'      => 'frontpage_slider_spacing',
		'type'    => 'number',
		'min'     => 0,
		'max'     => 50,
		'unit'    => 'px',
		'step'    => 1,
		'default' => '0',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Amount of posts to display in slider', 'aspen' ),
		'id'      => 'frontpage_slider_posts',
		'type'    => 'number',
		'min'     => 1,
		'max'     => 15,
		'unit'    => ' posts',
		'step'    => 1,
		'default' => '5',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Hide posts shown in slider from posts in index', 'aspen' ),
		'id'      => 'frontpage_hide_duplicates',
		'type'    => 'checkbox',
		'default' => true,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Display Slider Arrows', 'aspen' ),
		'id'      => 'frontpage_slider_arrows',
		'type'    => 'checkbox',
		'default' => true,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Display Slider Bullets', 'aspen' ),
		'id'      => 'frontpage_slider_bullets',
		'type'    => 'checkbox',
		'default' => true,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Slider Transition', 'aspen' ),
		'id'      => 'frontpage_slider_transition',
		'type'    => 'select',
		'options' => array(
			'slide'     => esc_html__( 'Slide', 'aspen' ),
			'fade'      => esc_html__( 'Fade', 'aspen' ),
			'cube'      => esc_html__( 'Cube', 'aspen' ),
			'coverflow' => esc_html__( 'Coverflow', 'aspen' ),
			'flip'      => esc_html__( 'Flip', 'aspen' ),
		),
		'default' => 'slide',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Slider Autoplay', 'aspen' ),
		'id'      => 'frontpage_slider_autoplay',
		'type'    => 'checkbox',
		'default' => true,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Slider Autoplay Delay', 'aspen' ),
		'id'      => 'frontpage_slider_autoplay_delay',
		'type'    => 'number',
		'min'     => 1000,
		'max'     => 15000,
		'unit'    => ' ms',
		'step'    => 100,
		'default' => '1500',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Hero Image Style', 'aspen' ),
		'id'      => 'frontpage_banner_background_style',
		'type'    => 'select',
		'options' => array(
			'full-width'   => esc_html__( 'Full Width', 'aspen' ),
			'normal-width' => esc_html__( 'Normal Width', 'aspen' ),
			'wide'         => esc_html__( 'Wide', 'aspen' ),
		),
		'default' => 'full-width',
	) );

	$section->createOption( array(
		'name' => esc_html__( 'Hero Image', 'aspen' ),
		'id'   => 'frontpage_banner_background',
		'type' => 'upload'
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Do not apply image filters', 'aspen' ),
		'id'      => 'frontpage_no_filters',
		'desc'    => esc_html__( 'The theme adds a gray filter to images on which we display text. This option deactivates that filter.', 'aspen' ),
		'type'    => 'checkbox',
		'default' => false,
	) );

	$section->createOption( array(
		'name' => esc_html__( 'Hero Headline', 'aspen' ),
		'id'   => 'frontpage_banner_headline',
		'type' => 'text',
	) );

	$section->createOption( array(
		'name' => esc_html__( 'Hero Sub Headline', 'aspen' ),
		'id'   => 'frontpage_banner_sub_headline',
		'type' => 'text',
	) );



	/*
	 * Layout & Design
	 */
	$section = $srf->createContainer( array(
		'type' => 'customizer',
		'id'   => 'layout_design',
		'name' => esc_html__( 'Layout and Design', 'aspen' ),
		'desc' => esc_html__( 'These are global settings affecting the overall layout and design.', 'aspen' ),
	) );

	$section->createOption( array(
		'name' => esc_html__( 'Layout', 'aspen' ),
		'type' => 'heading',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Design', 'aspen' ),
		'id'      => 'global_design_type',
		'type'    => 'select',
		'options' => array(
			'default' => esc_html__( 'Default', 'aspen' ),
			'boxed'   => esc_html__( 'Boxed', 'aspen' ),
		),
		'default' => 'default',
	) );


	/*
	 * Header
	 */

	$section = $srf->createContainer( array(
		'type' => 'customizer',
		'name' => esc_html__( 'Header', 'aspen' ),
		'desc' => esc_html__( 'The header contains the main navigation, your logo and site title etc.', 'aspen' )
	) );

	$section->createOption( array(
		'name' => esc_html__( 'Layout', 'aspen' ),
		'type' => 'heading',
	) );

	/* Layout */

	$section->createOption( array(
		'name'    => esc_html__( 'Navigation Style', 'aspen' ),
		'id'      => 'header_navigation_style',
		'type'    => 'select-image',
		'options' => array(
			'one'   => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/header_1.png',
				'label' => esc_html__( 'One', 'aspen' )
			),
			'two'   => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/header_2.png',
				'label' => esc_html__( 'Two', 'aspen' )
			),
			'three' => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/header_3.png',
				'label' => esc_html__( 'Three', 'aspen' )
			),
			'four'  => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/header_4.png',
				'label' => esc_html__( 'Four', 'aspen' )
			),
			'five'  => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/header_5.png',
				'label' => esc_html__( 'Five', 'aspen' )
			),
			'six'   => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/header_6.png',
				'label' => esc_html__( 'Six', 'aspen' )
			),
			'seven' => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/header_7.png',
				'label' => esc_html__( 'Seven', 'aspen' )
			),
			'eight' => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/header_8.png',
				'label' => esc_html__( 'Eight', 'aspen' )
			),
		),
		'default' => 'one',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Full Width', 'aspen' ),
		'id'      => 'header_full_width',
		'type'    => 'checkbox',
		'default' => false,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Capitalized (Upper Case)', 'aspen' ),
		'id'      => 'header_capitalized',
		'type'    => 'checkbox',
		'default' => false,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Menu Alignment', 'aspen' ),
		'id'      => 'header_menu_alignment',
		'type'    => 'select',
		'options' => array(
			'left'   => esc_html__( 'Left', 'aspen' ),
			'center' => esc_html__( 'Center', 'aspen' ),
			'right'  => esc_html__( 'Right', 'aspen' ),
		),
		'default' => 'left',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Sticky Header', 'aspen' ),
		'id'      => 'header_sticky',
		'type'    => 'checkbox',
		'default' => true,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Mobile Sticky Header', 'aspen' ),
		'id'      => 'header_sticky_mobile',
		'type'    => 'checkbox',
		'default' => false,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Transparent Header', 'aspen' ),
		'id'      => 'header_transparent',
		'type'    => 'checkbox',
		'default' => true,
	) );


	$section->createOption( array(
		'name'    => esc_html__( 'Hide Site Title', 'aspen' ),
		'id'      => 'header_hide_title',
		'type'    => 'checkbox',
		'default' => false,
	) );


	$section->createOption( array(
		'name'    => esc_html__( 'Hide Tagline', 'aspen' ),
		'id'      => 'header_hide_tagline',
		'type'    => 'checkbox',
		'default' => true,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Hide Search', 'aspen' ),
		'id'      => 'header_hide_search',
		'type'    => 'checkbox',
		'default' => false,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Hide Social Icons', 'aspen' ),
		'id'      => 'header_hide_social',
		'type'    => 'checkbox',
		'default' => false,
	) );

	$section->createOption( array(
		'name'    => 'Custom HTML Block',
		'id'      => 'header_custom_html',
		'type'    => 'textarea',
		'desc'    => 'This HTML code is used for some header styles to place additional content underneath the menu.',
		'is_code' => true,
	) );


	/*
	 * Footer
	 */

	$section = $srf->createContainer( array(
		'type' => 'customizer',
		'name' => esc_html__( 'Footer', 'aspen' ),
		'desc' => esc_html__( 'The footer and sub footer are items displayed at the very bottom of every page.', 'aspen' )
	) );

	$section->createOption( array(
		'name' => esc_html__( 'Footer', 'aspen' ),
		'type' => 'heading',
	) );

	/* Layout */

	$section->createOption( array(
		'name'    => esc_html__( 'Footer Style', 'aspen' ),
		'id'      => 'footer_style',
		'type'    => 'select-image',
		'options' => array(
			'social-right'    => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/footer_social_right.png',
				'label' => esc_html__( 'Social Icons Right', 'aspen' )
			),
			'social-top'      => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/footer_social_top.png',
				'label' => esc_html__( 'Social Icons Top', 'aspen' )
			),
			'social-bottom'   => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/footer_social_bottom.png',
				'label' => esc_html__( 'Social Icons Bottom', 'aspen' )
			),
			'social-centered' => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/footer_social_centered.png',
				'label' => esc_html__( 'Social Icons Centered', 'aspen' )
			),
			'plain' => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/footer_plain.png',
				'label' => esc_html__( 'No Social Icons', 'aspen' )
			),
		),
		'default' => 'plain',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Full Width', 'aspen' ),
		'id'      => 'footer_full_width',
		'type'    => 'checkbox',
		'default' => false,
	) );


	$section->createOption( array(
		'name'    => esc_html__( 'Hide Social Icons', 'aspen' ),
		'id'      => 'footer_hide_social',
		'type'    => 'checkbox',
		'default' => false,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Hide Scroll-Up Button', 'aspen' ),
		'id'      => 'footer_hide_scroll_up',
		'type'    => 'checkbox',
		'default' => false,
	) );


	$section->createOption( array(
			'name'    => esc_html__( 'Copyright/Footer Text', 'aspen' ),
			'id'      => 'copyright',
			'type'    => 'textarea',
			'desc'    => esc_html__( 'Enter your copyright/footer notice text here.', 'aspen' ),
			'is_code' => true,
			'default' => sprintf(
				esc_html( __( '&copy; Copyright %1$s by %2$s', 'aspen' ) ),
				date( 'Y' ),
				get_bloginfo( 'name' )
			)
		)
	);


	/*
	 * Blog
	 */

	$section = $srf->createContainer( array(
		'type' => 'customizer',
		'name' => esc_html__( 'Blog', 'aspen' ),
		'desc' => esc_html__( 'This section contains settings that affect the blog index, archive and single post pages.', 'aspen' )
	) );

	$section->createOption( array(
		'name' => esc_html__( 'Banner', 'aspen' ),
		'type' => 'heading',
	) );

	$section->createOption( array(
		'name' => esc_html__( 'Default Banner Image', 'aspen' ),
		'id'   => 'blog_header_image',
		'type' => 'upload',
		'desc' => esc_html__( 'Upload a banner image here. This setting can be overwritten by images assigned to categories or individual posts.', 'aspen' )
	) );

	$section->createOption( array(
		'name' => esc_html__( 'Index and Archive', 'aspen' ),
		'type' => 'heading',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Layout', 'aspen' ),
		'id'      => 'blog_layout',
		'type'    => 'select-image',
		'desc'    => 'Select a layout to be used to display posts on index and archive pages.',
		'options' => array(
			'standard' => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/blog_standard.png',
				'label' => esc_html__( 'Standard', 'aspen' )
			),
			'journal'  => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/blog_journal.png',
				'label' => esc_html__( 'Journal', 'aspen' )
			),
			'grid'     => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/blog_grid.png',
				'label' => esc_html__( 'Grid', 'aspen' )
			),
			'masonry'  => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/blog_masonry.png',
				'label' => esc_html__( 'Masonry', 'aspen' )
			),
			'split'    => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/blog_split.png',
				'label' => esc_html__( 'Split', 'aspen' )
			),
			'minimal'  => array(
				'image' => get_template_directory_uri() . '/assets/images/admin/blog_minimal.png',
				'label' => esc_html__( 'Minimal', 'aspen' )
			),
		),
		'default' => 'standard',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Columns', 'aspen' ),
		'id'      => 'blog_grid_columns',
		'type'    => 'number',
		'min'     => 2,
		'max'     => 5,
		'default' => 3
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Spacing', 'aspen' ),
		'id'      => 'blog_grid_spacing',
		'type'    => 'number',
		'min'     => 0,
		'max'     => 25,
		'unit'    => 'px',
		'step'    => 5,
		'default' => 0
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Alignment', 'aspen' ),
		'id'      => 'blog_layout_alignment',
		'type'    => 'select',
		'options' => array(
			'left'   => esc_html__( 'Left', 'aspen' ),
			'center' => esc_html__( 'Center', 'aspen' ),
			'right'  => esc_html__( 'Right', 'aspen' ),
		),
		'default' => 'center',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Excerpt Length', 'aspen' ),
		'id'      => 'blog_excerpt_length',
		'type'    => 'number',
		'unit'    => 'words',
		'min'     => 5,
		'max'     => 100,
		'default' => 20
	) );


	$section->createOption( array(
		'name'    => esc_html__( 'Feature First Post', 'aspen' ),
		'id'      => 'blog_feature_first_post',
		'type'    => 'checkbox',
		'default' => false,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Show Breadcrumb', 'aspen' ),
		'id'      => 'blog_show_breadcrumb',
		'type'    => 'checkbox',
		'default' => true,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Show Categories', 'aspen' ),
		'id'      => 'blog_show_categories',
		'type'    => 'checkbox',
		'desc'    => 'Display category names, if categories are assigned.',
		'default' => true,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Show Date', 'aspen' ),
		'id'      => 'blog_show_date',
		'type'    => 'checkbox',
		'default' => true,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Show Author', 'aspen' ),
		'id'      => 'blog_show_author',
		'type'    => 'checkbox',
		'default' => true,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Show # of Comments', 'aspen' ),
		'id'      => 'blog_show_comments_count',
		'type'    => 'checkbox',
		'default' => true,
	) );

	$section->createOption( array(
		'name' => esc_html__( 'Single Posts', 'aspen' ),
		'type' => 'heading',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Show Categories', 'aspen' ),
		'id'      => 'blog_single_show_categories',
		'type'    => 'checkbox',
		'desc'    => 'Display category names, if categories are assigned.',
		'default' => true,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Show Date', 'aspen' ),
		'id'      => 'blog_single_show_date',
		'type'    => 'checkbox',
		'default' => true,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Show Author', 'aspen' ),
		'id'      => 'blog_single_show_author',
		'type'    => 'checkbox',
		'default' => true,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Show Tags', 'aspen' ),
		'id'      => 'blog_single_show_tags',
		'type'    => 'checkbox',
		'default' => true,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Show Author Box', 'aspen' ),
		'id'      => 'blog_single_show_author_box',
		'type'    => 'checkbox',
		'desc'    => 'When this option is checked, a box containing information about the author, including social icons, will be displayed under each post.',
		'default' => true,
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Show Related Posts', 'aspen' ),
		'id'      => 'blog_single_show_related',
		'type'    => 'checkbox',
		'default' => true,
	) );

	do_action( 'aspen_after_blog_options', $section );


	if ( class_exists( 'WooCommerce' ) ) {

		$section = $srf->createContainer( array(
			'type' => 'customizer',
			'name' => esc_html__( 'WooCommerce', 'aspen' ),
			'id'   => 'woocommerce_product_catalog'
		) );

		$section->createOption( array(
			'name'    => esc_html__( 'Amount of products per page', 'aspen' ),
			'id'      => 'woocommerce_per_page',
			'type'    => 'number',
			'min'     => 3,
			'max'     => 50,
			'unit'    => ' products',
			'step'    => 1,
			'default' => '10',
		) );

		$section->createOption( array(
			'name'    => esc_html__( 'Amount of columns', 'aspen' ),
			'id'      => 'woocommerce_grid_columns',
			'type'    => 'number',
			'min'     => 2,
			'max'     => 5,
			'unit'    => ' columns',
			'step'    => 1,
			'default' => '3',
		) );

		$section->createOption( array(
			'name'    => esc_html__( 'Spacing between columns', 'aspen' ),
			'id'      => 'woocommerce_grid_spacing',
			'type'    => 'number',
			'min'     => 5,
			'max'     => 25,
			'unit'    => 'px',
			'step'    => 5,
			'default' => '15',
		) );

		$section->createOption( array(
			'name'    => esc_html__( 'Hide sidebar', 'aspen' ),
			'id'      => 'woocommerce_hide_sidebar',
			'type'    => 'checkbox',
			'default' => false,
		) );

		$section->createOption( array(
			'name' => esc_html__( 'Default Header Image', 'aspen' ),
			'id'   => 'woocommerce_default_header_image',
			'type' => 'upload'
		) );

	}


	/*
	 * Typography
	 */
	$section = $srf->createContainer( array(
		'name' => esc_html__( 'Typography', 'aspen' ),
		'type' => 'customizer',
	) );

	$section->createOption( array(
		'name' => esc_html__( 'Global Colors', 'aspen' ),
		'type' => 'heading',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Link Color', 'aspen' ),
		'id'      => 'global_link_color',
		'type'    => 'color',
		'default' => '#cdb689',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Link Hover Color', 'aspen' ),
		'id'      => 'global_link_hover_color',
		'type'    => 'color',
		'default' => '#cdb689',
	) );

	$section->createOption( array(
		'name' => esc_html__( 'Fonts', 'aspen' ),
		'type' => 'heading',
	) );

	$section->createOption( array(
		'name'                => esc_html__( 'Body', 'aspen' ),
		'id'                  => 'typography_body',
		'type'                => 'font',
		'show_letter_spacing' => false,
		'show_text_transform' => false,
		'show_text_shadow'    => false,
		'show_font_variant'   => false,
		'default'             => array(
			'font-family'    => 'Open Sans',
			'color'          => '#222222',
			'font-size'      => '15px',
			'font-weight'    => 'inherit',
			'font-style'     => 'normal',
			'line-height'    => '1.6em',
			'letter-spacing' => 'normal',
			'text-transform' => 'none',
			'font-variant'   => 'normal',
			'font-type'      => 'google'
		)
	) );

	$section->createOption( array(
		'name'                => esc_html__( 'Logo', 'aspen' ),
		'id'                  => 'typography_logo',
		'type'                => 'font',
		'show_letter_spacing' => false,
		'show_text_transform' => false,
		'show_text_shadow'    => false,
		'show_font_variant'   => false,
		'default'             => array(
			'font-family'    => 'Open Sans',
			'color'          => '#333333',
			'font-size'      => '20px',
			'font-weight'    => '700',
			'font-style'     => 'normal',
			'line-height'    => '1.5em',
			'letter-spacing' => 'normal',
			'text-transform' => 'none',
			'font-variant'   => 'normal',
			'font-type'      => 'google'
		)
	) );

	$section->createOption( array(
		'name'                => esc_html__( 'Tagline', 'aspen' ),
		'id'                  => 'typography_tagline',
		'type'                => 'font',
		'show_letter_spacing' => false,
		'show_text_transform' => false,
		'show_text_shadow'    => false,
		'show_font_variant'   => false,
		'default'             => array(
			'font-family'    => 'Open Sans',
			'color'          => '#222222',
			'font-size'      => '15px',
			'font-weight'    => 'inherit',
			'font-style'     => 'normal',
			'line-height'    => '1.6em',
			'letter-spacing' => 'normal',
			'text-transform' => 'none',
			'font-variant'   => 'normal',
			'font-type'      => 'google'
		)
	) );

	$section->createOption( array(
		'name'                => esc_html__( 'Main Navigation', 'aspen' ),
		'id'                  => 'typography_navigation',
		'type'                => 'font',
		'show_letter_spacing' => false,
		'show_text_transform' => false,
		'show_text_shadow'    => false,
		'show_line_height'    => false,
		'show_font_variant'   => false,
		'default'             => array(
			'font-family'    => 'Open Sans',
			'color'          => '#333333',
			'font-size'      => '14px',
			'font-weight'    => 'normal',
			'font-style'     => 'normal',
			'line-height'    => '1.6em',
			'letter-spacing' => 'normal',
			'text-transform' => 'none',
			'font-variant'   => 'normal',
			'font-type'      => 'google'
		)
	) );

	$section->createOption( array(
		'name'                => esc_html__( 'H1 Headline', 'aspen' ),
		'id'                  => 'typography_h1',
		'type'                => 'font',
		'show_letter_spacing' => false,
		'show_text_transform' => false,
		'show_text_shadow'    => false,
		'show_font_variant'   => false,
		'default'             => array(
			'font-family'    => 'Playfair Display',
			'color'          => '#222222',
			'font-size'      => '50px',
			'font-weight'    => 'inherit',
			'font-style'     => 'normal',
			'line-height'    => '1.3em',
			'letter-spacing' => 'normal',
			'text-transform' => 'none',
			'font-variant'   => 'normal',
			'font-type'      => 'google'
		)
	) );

	$section->createOption( array(
		'name'                => esc_html__( 'H2 Headline', 'aspen' ),
		'id'                  => 'typography_h2',
		'type'                => 'font',
		'show_letter_spacing' => false,
		'show_text_transform' => false,
		'show_text_shadow'    => false,
		'show_font_variant'   => false,
		'default'             => array(
			'font-family'    => 'Playfair Display',
			'color'          => '#222222',
			'font-size'      => '34px',
			'font-weight'    => 'inherit',
			'font-style'     => 'normal',
			'line-height'    => '1.3em',
			'letter-spacing' => 'normal',
			'text-transform' => 'none',
			'font-variant'   => 'normal',
			'font-type'      => 'google'
		)
	) );

	$section->createOption( array(
		'name'                => esc_html__( 'H3 Headline', 'aspen' ),
		'id'                  => 'typography_h3',
		'type'                => 'font',
		'show_letter_spacing' => false,
		'show_text_transform' => false,
		'show_text_shadow'    => false,
		'show_font_variant'   => false,
		'default'             => array(
			'font-family'    => 'Playfair Display',
			'color'          => '#222222',
			'font-size'      => '24px',
			'font-weight'    => 'inherit',
			'font-style'     => 'normal',
			'line-height'    => '1.5em',
			'letter-spacing' => 'normal',
			'text-transform' => 'none',
			'font-variant'   => 'normal',
			'font-type'      => 'google'
		)
	) );

	$section->createOption( array(
		'name'                => esc_html__( 'H4 Headline', 'aspen' ),
		'id'                  => 'typography_h4',
		'type'                => 'font',
		'show_letter_spacing' => false,
		'show_text_transform' => false,
		'show_text_shadow'    => false,
		'show_font_variant'   => false,
		'default'             => array(
			'font-family'    => 'Open Sans',
			'color'          => '#222222',
			'font-size'      => '18px',
			'font-weight'    => 'bold',
			'font-style'     => 'normal',
			'line-height'    => '1.5em',
			'letter-spacing' => 'normal',
			'text-transform' => 'none',
			'font-variant'   => 'normal',
			'font-type'      => 'google'
		)
	) );

	$section->createOption( array(
		'name'                => esc_html__( 'H5 Headline', 'aspen' ),
		'id'                  => 'typography_h5',
		'type'                => 'font',
		'show_letter_spacing' => false,
		'show_text_transform' => false,
		'show_text_shadow'    => false,
		'show_font_variant'   => false,
		'default'             => array(
			'font-family'    => 'Open Sans',
			'color'          => '#222222',
			'font-size'      => '16px',
			'font-weight'    => 'inherit',
			'font-style'     => 'normal',
			'line-height'    => '1.5em',
			'letter-spacing' => 'normal',
			'text-transform' => 'none',
			'font-variant'   => 'normal',
			'font-type'      => 'google'
		)
	) );

	$section->createOption( array(
		'name'                => esc_html__( 'H6 Headline', 'aspen' ),
		'id'                  => 'typography_h6',
		'type'                => 'font',
		'show_letter_spacing' => false,
		'show_text_transform' => false,
		'show_text_shadow'    => false,
		'show_font_variant'   => false,
		'default'             => array(
			'font-family'    => 'Open Sans',
			'color'          => '#222222',
			'font-size'      => '13px',
			'font-weight'    => 'inherit',
			'font-style'     => 'normal',
			'line-height'    => '1.5em',
			'letter-spacing' => 'normal',
			'text-transform' => 'none',
			'font-variant'   => 'normal',
			'font-type'      => 'google'
		)
	) );

	$section->createOption( array(
		'name'                => esc_html__( 'Quotes', 'aspen' ),
		'id'                  => 'typography_quotes',
		'type'                => 'font',
		'show_letter_spacing' => false,
		'show_text_transform' => false,
		'show_text_shadow'    => false,
		'show_font_variant'   => false,
		'default'             => array(
			'font-family'    => 'Playfair Display',
			'color'          => '#222222',
			'font-size'      => '28px',
			'font-weight'    => 'normal',
			'font-style'     => 'italic',
			'line-height'    => '1.5em',
			'letter-spacing' => 'normal',
			'text-transform' => 'none',
			'font-variant'   => 'normal',
			'font-type'      => 'google'
		)
	) );

	$section->createOption( array(
		'name'                => esc_html__( 'Page Titles', 'aspen' ),
		'id'                  => 'typography_page_title',
		'type'                => 'font',
		'show_letter_spacing' => false,
		'show_text_transform' => false,
		'show_text_shadow'    => false,
		'show_font_variant'   => false,
		'default'             => array(
			'font-family'    => 'Playfair Display',
			'color'          => '#222222',
			'font-size'      => '50px',
			'font-weight'    => 'inherit',
			'font-style'     => 'normal',
			'line-height'    => '1.5em',
			'letter-spacing' => 'normal',
			'text-transform' => 'none',
			'font-variant'   => 'normal',
			'font-type'      => 'google'
		)
	) );

	$section->createOption( array(
		'name'                => esc_html__( 'Widget Titles', 'aspen' ),
		'id'                  => 'typography_widget_title',
		'type'                => 'font',
		'show_letter_spacing' => false,
		'show_text_transform' => false,
		'show_text_shadow'    => false,
		'show_font_variant'   => false,
		'default'             => array(
			'font-family'    => 'Open Sans',
			'color'          => '#222222',
			'font-size'      => '14px',
			'font-weight'    => '700',
			'font-style'     => 'normal',
			'line-height'    => '1.5em',
			'letter-spacing' => 'normal',
			'text-transform' => 'none',
			'font-variant'   => 'normal',
			'font-type'      => 'google'
		)
	) );

	$section->createOption( array(
		'name'                => esc_html__( 'Footer', 'aspen' ),
		'id'                  => 'typography_footer',
		'type'                => 'font',
		'show_letter_spacing' => false,
		'show_text_transform' => false,
		'show_text_shadow'    => false,
		'show_font_variant'   => false,
		'default'             => array(
			'font-family'    => 'Open Sans',
			'color'          => '#999999',
			'font-size'      => '12px',
			'font-weight'    => 'inherit',
			'font-style'     => 'normal',
			'line-height'    => '1.5em',
			'letter-spacing' => 'normal',
			'text-transform' => 'none',
			'font-variant'   => 'normal',
			'font-type'      => 'google'
		)
	) );


	/**
	 * Custom CSS
	 */


	/* Frontend CSS */

	$srf->createCSS( '

body, input[type=text], textarea, input[type=email], input[type=password], input[type=tel], input[type=url], input[type=search], input[type=date], .wpcf7 select, .tagcloud a,
#footer-widgets .tagcloud a, input[type="submit"], button[type="submit"], #wp-calendar caption, .description p,
.blog-style-grid #blog-posts-overview .blog-post-summary blockquote p, .blog-style-masonry #blog-posts-overview .blog-post-summary blockquote p,
.blog-style-split #blog-posts-overview .blog-post-summary blockquote p, .pagination-overlay h4, #similar-posts h4, .gform_description, .gform_wrapper .top_label .gfield_label,
.gfield input, .gfield textarea, .gfield select, blockquote footer cite, blockquote cite, .nav-button, .close, .fullscreen-menu-open #header-search a.search-trigger, #comments .comment-list .comment blockquote p,
#respond h3#reply-title small, .wp-block-latest-comments__comment-excerpt p
{
	font-family: $typography_body-font-family;
	font-size: $typography_body-font-size;
	font-weight: $typography_body-font-weight;
	font-style: $typography_body-font-style;
	line-height: $typography_body-line-height;
	color: $typography_body-color;
}

.wp-block-pullquote cite, .wp-block-pullquote footer, .wp-block-pullquote__citation, .wp-block-quote.is-large cite, .wp-block-quote.is-large footer, .wp-block-quote.is-style-large cite, .wp-block-quote.is-style-large footer, .wp-block-quote cite, .wp-block-quote footer, .wp-block-quote__citation,
.wp-block-pullquote cite, .wp-block-pullquote footer, .wp-block-pullquote__citation {
font-size: $typography_body-font-size!important;
}

#logo h1, .header-transparent.has-banner-background #site-header .shrink-sticky #logo h1 {
	font-family: $typography_logo-font-family;
	font-size: $typography_logo-font-size;
	font-weight: $typography_logo-font-weight;
	font-style: $typography_logo-font-style;
	line-height: $typography_logo-line-height;
	color: $typography_logo-color;
}

#logo h2, .header-transparent.has-banner-background #site-header .shrink-sticky #logo h2 {
	font-family: $typography_tagline-font-family;
	font-size: $typography_tagline-font-size;
	font-weight: $typography_tagline-font-weight;
	font-style: $typography_tagline-font-style;
	line-height: $typography_tagline-line-height;
	color: $typography_tagline-color;
}

#header-bottom nav li a, #header-bottom nav li ul.sub-menu li a,
.header-transparent.has-banner-background #site-header .sub-menu a,
.header-transparent.banner-type-slider.slider-style-full-width.has-banner-background #site-header .sub-menu a,
.header-style-five #header-sidebar-push .cbp-spmenu-vertical a, .header-style-six #header-fullscreen.cbp-spmenu a,
#header-sidebar #main-navigation a, .blog.header-style-one.header-transparent.header-solid #site-header .sub-menu a,
.blog.header-style-two.header-transparent.header-solid #site-header .sub-menu a, .blog.header-style-three.header-transparent.header-solid #site-header .sub-menu a
{
	font-family: $typography_navigation-font-family;
	font-size: $typography_navigation-font-size;
	font-weight: $typography_navigation-font-weight;
	font-style: $typography_navigation-font-style;
	line-height: $typography_navigation-line-height;
	color: $typography_navigation-color;
}

h1, #comments .comment-list .comment h1 {
	font-family: $typography_h1-font-family;
	font-size: $typography_h1-font-size;
	font-weight: $typography_h1-font-weight;
	font-style: $typography_h1-font-style;
	line-height: $typography_h1-line-height;
	color: $typography_h1-color;
}

h2, #comments .comment-list .comment  h2, .blog-post-summary h2 {
	font-family: $typography_h2-font-family;
	font-size: $typography_h2-font-size;
	font-weight: $typography_h2-font-weight;
	font-style: $typography_h2-font-style;
	line-height: $typography_h2-line-height;
	color: $typography_h2-color;
}

.blog-post-letter {
font-family: $typography_h2-font-family;
}

.blog-post-summary h2 a {
    color: $typography_h2-color;
}

h3, #comments .comment-list .comment  h3, .blog-post-summary-content h3 {
	font-family: $typography_h3-font-family;
	font-size: $typography_h3-font-size;
	font-weight: $typography_h3-font-weight;
	font-style: $typography_h3-font-style;
	line-height: $typography_h3-line-height;
	color: $typography_h3-color;
}

.blog-post-summary h3 a {
    color: $typography_h2-color;
}

h4, #comments .comment-list .comment  h4 {
	font-family: $typography_h4-font-family;
	font-size: $typography_h4-font-size;
	font-weight: $typography_h4-font-weight;
	font-style: $typography_h4-font-style;
	line-height: $typography_h4-line-height;
	color: $typography_h4-color;
}

h5, #comments .comment-list .comment  h5 {
	font-family: $typography_h5-font-family;
	font-size: $typography_h5-font-size;
	font-weight: $typography_h5-font-weight;
	font-style: $typography_h5-font-style;
	line-height: $typography_h5-line-height;
	color: $typography_h5-color;
}

h6, #comments .comment-list .comment  h6 {
	font-family: $typography_h6-font-family;
	font-size: $typography_h6-font-size;
	font-weight: $typography_h6-font-weight;
	font-style: $typography_h6-font-style;
	line-height: $typography_h6-line-height;
	color: $typography_h6-color;
}

.single-post .blog-content .col-3-4 blockquote,  .blog-style-journal .blog-post-summary-journal blockquote, .page article.page blockquote,
.blog-style-minimal .blog-post-summary .quote p, blockquote p, a blockquote p
{
	font-family: $typography_quotes-font-family;
	font-size: $typography_quotes-font-size;
	font-weight: $typography_quotes-font-weight;
	font-style: $typography_quotes-font-style;
	line-height: $typography_quotes-line-height;
	color: $typography_quotes-color;
}

h3.widget-title, h3.blog-section-title, #comments h3, .woocommerce-Tabs-panel h2, .related.products h2, span#reply-title, h3.widget-title a {
	font-family: $typography_widget_title-font-family;
	font-size: $typography_widget_title-font-size;
	font-weight: $typography_widget_title-font-weight;
	font-style: $typography_widget_title-font-style;
	line-height: $typography_widget_title-line-height;
	color: $typography_widget_title-color;
}

#site-footer, #site-footer a {
	font-family: $typography_footer-font-family;
	font-size: $typography_footer-font-size;
	font-weight: $typography_footer-font-weight;
	font-style: $typography_footer-font-style;
	line-height: $typography_footer-line-height;
	color: $typography_footer-color;
}

.header-transparent.has-banner-background.fullscreen-menu-open #site-header #header-icons .nav-button span,
.header-transparent.has-banner-background #site-header #header-bottom.shrink-sticky #header-icons .nav-button span,
.nav-button span, .close span, .banner-type-slider .nav-button.open span, #header-bottom.shrink-sticky .nav-button span,
.woocommerce-mini-cart__buttons a.wc-forward, .products .product .soldout, .product .soldout, .header-transparent.has-banner-background #site-header #header-icons .nav-button span,
.header-transparent.has-banner-background #site-header #header-icons .nav-button .close span, .banner-type-slider #show-mobile.nav-button span,
.banner-type-slider .nav-button span, .header-transparent.has-banner-background #show-mobile span
{
	background: $typography_body-color;
}

#site-header a,  .swiper-slide-overlay a.more-link:hover, .aspen-recent-posts ul li a, #footer-widgets .aspen-recent-posts ul li a, .aspen-recent-comments ul li a, #footer-widgets .aspen-recent-comments ul li a,
.woocommerce-tabs a, #pagination-category a, .woocommerce-pagination a,  .comment_name a, .comment_name, .header-style-five.header-transparent.header-solid #header-icons a,
  .header-style-six.header-transparent.header-solid #header-icons a,  .widget_archive a, .widget_categories a, .widget_pages a, .widget_meta a, .widget_nav_menu a,
   #footer-widgets .widget_archive a, #footer-widgets .widget_categories a, #footer-widgets .widget_pages a, #footer-widgets .widget_meta a, #footer-widgets .widget_nav_menu a
   {
	color: $typography_body-color;
}

#header-bottom.shrink-sticky nav li a, #site-header #header-bottom.shrink-sticky a, #header-cart .widget_shopping_cart_content ul.cart_list li a,
#header-cart .woocommerce-mini-cart__total.total, .header-style-seven.banner-type-slider #site-header #header-bottom.shrink-sticky #header-cart .widget_shopping_cart_content ul.cart_list li a,
 h3.widget-title a
 {
	color: $typography_body-color!important;
}

#main-navigation a:before {
	border-color: $typography_body-color;
}

a, #sidebar a:hover, #footer-widgets a, #site-footer a:hover, #footer-widgets a:hover, #footer-widgets ul li a, #similar-posts a:hover h4, .gallery-categories a:hover, .blog .blog-post-summary-content h3 a:hover, #blog-posts-overview h3 a:hover,
.blog-post-summary h2 a:hover, #pagination-category a:hover, #pagination-category span.current, .blog-post-meta a:hover, .single-format-quote .blog-header-content footer,
.blog-post-category a, #post-tags a:hover, .aspen-recent-comments a .comment-author, .header-style-four #site-header #site-header-inner #nav-html  a, .header-style-five.header-solid #header-sidebar-push #nav-html  a,
.header-style-six #header-fullscreen-content a:hover, .aspen-bio-block .social-icons a:hover, #sidebar .widget .aspen-bio-block ul.social-icons li a:hover, #sidebar .aspen-recent-posts .post-category a, #footer-widgets .widget .aspen-bio-block ul.social-icons li a:hover, #footer-widgets .aspen-recent-posts .post-category a,
.woocommerce-MyAccount-navigation .is-active a, .header-style-one.header-solid #site-header #site-header-inner a:hover, .header-style-two.header-solid #site-header #site-header-inner a:hover, .header-style-three.header-solid #site-header #site-header-inner a:hover, #footer-widgets .aspen-recent-posts ul li a:hover, #footer-widgets .aspen-recent-comments ul li a:hover,
.header-style-four #site-header #site-header-inner a:hover, .header-style-five #header-sidebar-push a:hover, .header-style-six.header-transparent.has-banner-background #site-header #main-navigation a:hover, #site-header #main-navigation .sub-menu a:hover,
#site-header .shrink-sticky.shrink #main-navigation .sub-menu a:hover, .woocommerce-pagination span.current,  .woocommerce-pagination a:hover, .single-product p.price,
a.more-link:hover, a.blog-read-more:hover, .blog-post-summary .social-icons a:hover, #blog-post-bottom-meta .social-icons a:hover, #author-info .social-icons a:hover, #pagination-single a h4,
.products .product a.add_to_cart_button:hover, .products .product a.ajax_add_to_cart:hover, .products .product a:hover, #site-wrapper .products .product .product-options a.button.add_to_cart_button:hover, #site-wrapper .products .product .product-options a.button.ajax_add_to_cart:hover,
.header-style-eight #header-box-bottom a:hover, .header-style-eight #header-box-top a:hover, .header-style-five.header-transparent.header-solid #header-icons a:hover,
.header-style-six.header-transparent.header-solid #header-icons a:hover, #site-wrapper .products .product .product-options a.button.product_type_simple:hover,
 .widget_archive a:hover, .widget_categories a:hover, .widget_pages a:hover, .widget_meta a:hover, .widget_nav_menu a:hover
{
	color: $global_link_color;
}

#header-bottom.shrink-sticky nav li a:hover, #site-header #header-bottom.shrink-sticky a:hover, .header-style-seven #header-box-top a:hover, .header-style-seven #header-box-top #header-search a.search-trigger:hover,
.current-menu-item > a, #header-bottom.shrink-sticky nav li.current-menu-item > a, #site-header #header-bottom.shrink-sticky li.current-menu-item > a,
.wp-block a
 {
	color: $global_link_color!important;
}

.header-style-one #main-navigation .sub-menu, .header-style-two #main-navigation .sub-menu,
.header-style-three #main-navigation .sub-menu, .header-style-seven #main-navigation .sub-menu,
.header-style-eight #main-navigation .sub-menu, a.more-link span:before, .blog-style-split a.more-link span:before,
.blog-style-minimal a.more-link span:before, input[type=text]:focus, textarea:focus, input[type=email]:focus, input[type=password]:focus, input[type=tel]:focus, input[type=url]:focus,
input[type=search]:focus, input[type=date]:focus, #header-cart-notification, #header-cart .widget_shopping_cart_content, .single-post .blog-content .col-3-4 blockquote.wp-block-quote.is-style-large {
	border-color: $global_link_color;
}

.blog-post-link .link p:after, .blog-post-link .link:before,
h3.widget-title:after, h3.blog-section-title:after, #comments h3:after, .woocommerce-Tabs-panel h2:after, .related.products h2:after, span#reply-title:after,
[class*="slider-style-two-columns-"] #banner-slider a.more-link:before, [class*="slider-style-three-columns-"] #banner-slider a.more-link:before,
[class*="slider-style-four-columns-"] #banner-slider a.more-link:before, .single-post .blog-content .col-3-4 blockquote:before, .single-post .blog-content .col-3-4 blockquote:after,
.blog-style-journal .blog-post-summary-journal blockquote:before, .blog-style-journal .blog-post-summary-journal blockquote:after, .page article.page blockquote:before,
.page article.page blockquote:after, .wpcf7 [type="submit"]:hover, #header-cart-total, input[type="submit"], .gform_footer [type="submit"], .widget_mc4wp_form_widget input[type="submit"],
.place-order button, button, .button, .widget_categories li .children li:before, .widget_pages li .children li:before, .widget_nav_menu li .sub-menu li:before
{
	background: $global_link_color;
}

.no-post-thumbnail .blog-grid-content .blog-post-image, .products .product .onsale, .single .onsale, .single_add_to_cart_button, .woocommerce-mini-cart__buttons a.checkout,
.widget_price_filter .price_slider_amount .button, .woocommerce-message a, .wc-proceed-to-checkout a, .shop_table .actions .coupon input[type="submit"],
input#place_order, .woocommerce-account input[type="submit"], .place-order button#place_order, .widget_search form:after, .widget_product_search form:after, .no-results.not-found form:after,
.woocommerce-form-login.login button[type="submit"], .woocommerce-form-coupon button[type="submit"]
{
	background: $global_link_color!important; /*Background comes from Main Link Color*/
	color: #fff!important;
}

.no-post-thumbnail .blog-grid-content .blog-post-image a, .woocommerce-mini-cart__buttons a.wc-forward {
	color: #fff!important;
}

a:hover  {
	color: $global_link_hover_color;
}


#site-wrapper input[type="submit"]:hover, #respond input[type="submit"]:hover, .gform_footer [type="submit"]:hover, #site-wrapper .widget_mc4wp_form_widget input[type="submit"]:hover,
.place-order button:hover, #site-wrapper button:hover, #site-wrapper .button:hover, #site-wrapper button[type="submit"]:hover, .woocommerce-mini-cart__buttons a.checkout:hover,
.widget_price_filter .price_slider_amount .button:hover, .place-order button#place_order:hover, .shop_table .actions .coupon input[type="submit"]:hover
 {
	background: $global_link_hover_color!important;
	color: #fff;
}

#site-wrapper .products .product .product-options a.button.add_to_cart_button:hover, #site-wrapper .products .product .product-options a.button.ajax_add_to_cart:hover, #site-wrapper .products .product .product-options a.button.product_type_simple:hover {
    background:none!important;
}

		'
	);


	/* Backend CSS */

	$srf->createAdminCSS ('


.editor-rich-text p, .editor-styles-wrapper, .editor-styles-wrapper p, .mce-content-body .font-sans-serif, .wp-block-gallery .blocks-gallery-image figcaption, .wp-block-gallery .blocks-gallery-item figcaption, .editor-styles-wrapper {
	font-family: $typography_body-font-family;
	font-size: $typography_body-font-size!important;
	font-weight: $typography_body-font-weight;
	font-style: $typography_body-font-style;
	line-height: $typography_body-line-height!important;
	color: $typography_body-color;
}

/* Page, Post Title */

	.edit-post-layout .editor-post-title textarea {
        font-family: $typography_h1-font-family;
        font-size: $typography_h1-font-size;
        font-weight: $typography_h1-font-weight;
        font-style: $typography_h1-font-style;
        line-height: $typography_h1-line-height;
        color: $typography_h1-color;
    }

 /* Blockquote */

 .wp-block-quote:after, .wp-block-quote:before, .wp-block-freeform.block-library-rich-text__tinymce blockquote:before, .wp-block-freeform.block-library-rich-text__tinymce blockquote:after {
 	background: $global_link_color;
 }

.wp-block-quote .editor-rich-text p, .wp-block-quote .editor-rich-text p, .wp-block-pullquote p, .wp-block-pullquote blockquote>.block-library-pullquote__content .editor-rich-text__tinymce[data-is-empty=true]::before, .wp-block-pullquote blockquote>.editor-rich-text p {
	font-family: $typography_quotes-font-family!important;
	font-size: $typography_quotes-font-size!important;
	font-weight: $typography_quotes-font-weight;
	font-style: $typography_quotes-font-style;
	line-height: $typography_quotes-line-height!important;
	color: $typography_quotes-color;
}

blockquote.wp-block-quote cite, blockquote.wp-block-quote cite, .wp-block-quote__citation, .wp-block-pullquote .wp-block-pullquote__citation  {
	font-family: $typography_body-font-family;
	font-size: $typography_body-font-size!important;
	font-weight: $typography_body-font-weight;
	font-style: $typography_body-font-style;
	line-height: $typography_body-line-height!important;
}

.wp-block-quote.is-style-large {
border-color: $global_link_color!important;
}

.wp-block-quote.is-large cite, .wp-block-quote.is-large footer, .wp-block-quote.is-style-large cite, .wp-block-quote.is-style-large footer, .wp-block-quote cite, .wp-block-quote footer, .wp-block-quote__citation,
 .wp-block-pullquote cite, .wp-block-pullquote footer, .wp-block-pullquote__citation
 {
 font-size: $typography_body-font-size!important;
 }


/* Headings */

.wp-block-heading h1, .mce-content-body h1 {
	font-family: $typography_h1-font-family;
	font-size: $typography_h1-font-size;
	font-weight: $typography_h1-font-weight;
	font-style: $typography_h1-font-style;
	line-height: $typography_h1-line-height;
	color: $typography_h1-color;
}

.wp-block-heading h2, .mce-content-body h2 {
	font-family: $typography_h2-font-family;
	font-size: $typography_h2-font-size;
	font-weight: $typography_h2-font-weight;
	font-style: $typography_h2-font-style;
	line-height: $typography_h2-line-height;
	color: $typography_h2-color;
}

.wp-block-heading h3, .mce-content-body h3 {
	font-family: $typography_h3-font-family;
	font-size: $typography_h3-font-size;
	font-weight: $typography_h3-font-weight;
	font-style: $typography_h3-font-style;
	line-height: $typography_h3-line-height;
	color: $typography_h3-color;
}

.wp-block-heading h4, .mce-content-body h4 {
	font-family: $typography_h4-font-family;
	font-size: $typography_h4-font-size;
	font-weight: $typography_h4-font-weight;
	font-style: $typography_h4-font-style;
	line-height: $typography_h4-line-height;
	color: $typography_h4-color;
}

.wp-block-heading h5, .mce-content-body h5 {
	font-family: $typography_h5-font-family;
	font-size: $typography_h5-font-size;
	font-weight: $typography_h5-font-weight;
	font-style: $typography_h5-font-style;
	line-height: $typography_h5-line-height;
	color: $typography_h5-color;
}

.wp-block-heading h6, .mce-content-body h6 {
	font-family: $typography_h6-font-family;
	font-size: $typography_h6-font-size;
	font-weight: $typography_h6-font-weight;
	font-style: $typography_h6-font-style;
	line-height: $typography_h6-line-height;
	color: $typography_h6-color;
}

/* Link Styles */

.editor-rich-text__tinymce a, .wp-block a, .wp-block-freeform.block-library-rich-text__tinymce a, .wp-block-freeform.block-library-rich-text__tinymce blockquote a {
color: $global_link_color;
}



	');


	/*************************************************************
	 * Meta Boxes
	 ************************************************************/


	/*
	 * Quote
	 */
	$layout = $srf->createMetaBox(
		array(
			'name'      => esc_html__( 'Quote Options', 'aspen' ),
			'post_type' => 'post',
			'priority'  => 'default',
			'id'        => 'post_format_quote_options'
		)
	);

	$layout->createOption( array(
		'name'    => esc_html__( 'Quote Text', 'aspen' ),
		'id'      => 'post_format_quote_text',
		'type'    => 'textarea',
		'default' => ''
	) );

	$layout->createOption( array(
		'name'    => esc_html__( 'Name', 'aspen' ),
		'id'      => 'post_format_quote_name',
		'type'    => 'text',
		'size'    => 'large',
		'default' => ''
	) );

	/*
    * Link
    */
	$layout = $srf->createMetaBox(
		array(
			'name'      => esc_html__( 'Link Options', 'aspen' ),
			'post_type' => 'post',
			'priority'  => 'default',
			'id'        => 'post_format_link_options'
		)
	);

	$layout->createOption( array(
		'name'    => esc_html__( 'Link URL', 'aspen' ),
		'id'      => 'post_format_link_url',
		'type'    => 'text',
		'size'    => 'large',
		'default' => ''
	) );

	$layout->createOption( array(
		'name'    => esc_html__( 'Link Text', 'aspen' ),
		'id'      => 'post_format_link_text',
		'type'    => 'text',
		'size'    => 'large',
		'default' => ''
	) );


	/*
	 * Video
	 */
	$layout = $srf->createMetaBox(
		array(
			'name'      => esc_html__( 'Video Options', 'aspen' ),
			'post_type' => 'post',
			'priority'  => 'default',
			'id'        => 'post_format_video_options'
		)
	);

	$layout->createOption( array(
		'name'    => esc_html__( 'Video Embed Code', 'aspen' ),
		'id'      => 'post_format_video_code',
		'type'    => 'textarea',
		'default' => ''
	) );


	/**
	 * Create an admin panel & tabs
	 * You should put options here that do not change the look of your theme
	 */

	$adminPanel = $srf->createContainer( array(
		'name' => __( 'Theme Settings', 'aspen' ),
		'type' => 'admin-page'
	) );

	/*
	 * About
	 */

	$supportTab = $adminPanel->createTab( array(
		'name' => esc_html__( 'About', 'aspen' ),
	) );

	$supportTab->createOption( array(
		'name'  => esc_html__( 'About Aspen', 'aspen' ),
		'class' => 'super-heading',
		'tag'   => 'h2',
		'type'  => 'heading',
	) );

	$supportTab->createOption( array(
		'type'     => 'custom-template',
		'template' => 'support'
	) );

	$supportTab->createOption( array(
		'type' => 'save',
	) );


	/*
	 * Social Media
	 */

	$socialTab = $adminPanel->createTab( array(
		'name' => esc_html__( 'Social Media', 'aspen' ),
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Social Media Integration', 'aspen' ),
		'class' => 'super-heading',
		'tag'   => 'h2',
		'type'  => 'heading',
	) );

	$socialTab->createOption( array(
		'name' => esc_html__( 'Social Icons in Header and Footer', 'aspen' ),
		'type' => 'heading',
	) );

	$socialTab->createOption( array(
		'name'           => esc_html__( 'Social Services', 'aspen' ),
		'id'             => 'social_icons',
		'type'           => 'sortable',
		'visible_button' => true,
		'desc'           => esc_html__( 'Here you can activate, deactivate and re-order the social services you would like to display in your header or footer.', 'aspen' ),
		'options'        => array(
			'twitter'    => esc_html__( 'Twitter', 'aspen' ),
			'facebook'   => esc_html__( 'Facebook', 'aspen' ),
			'google'     => esc_html__( 'Google+', 'aspen' ),
			'pinterest'  => esc_html__( 'Pinterest', 'aspen' ),
			'instagram'  => esc_html__( 'Instagram', 'aspen' ),
			'youtube'    => esc_html__( 'YouTube', 'aspen' ),
			'linkedin'   => esc_html__( 'LinkedIn', 'aspen' ),
			'flickr'     => esc_html__( 'Flickr', 'aspen' ),
			'tumblr'     => esc_html__( 'Tumblr', 'aspen' ),
			'foursquare' => esc_html__( 'Foursquare', 'aspen' ),
			'vimeo'      => esc_html__( 'Vimeo', 'aspen' ),
			'lastfm'     => esc_html__( 'last.fm', 'aspen' ),
			'soundcloud' => esc_html__( 'Soundcloud', 'aspen' ),
			'yelp'       => esc_html__( 'Yelp', 'aspen' ),
			'slideshare' => esc_html__( 'Slideshare', 'aspen' ),
			'dribbble'   => esc_html__( 'Dribbble', 'aspen' ),
			'behance'    => esc_html__( 'Behance', 'aspen' ),
			'github'     => esc_html__( 'GitHub', 'aspen' ),
			'reddit'     => esc_html__( 'Reddit', 'aspen' ),
			'weibo'      => esc_html__( 'Weibo', 'aspen' ),
			'deviantart' => esc_html__( 'DeviantArt', 'aspen' ),
			'skype'      => esc_html__( 'Skype', 'aspen' ),
			'spotify'    => esc_html__( 'Spotify', 'aspen' ),
			'xing'       => esc_html__( 'Xing', 'aspen' ),
			'vine'       => esc_html__( 'Vine', 'aspen' ),
			'digg'       => esc_html__( 'Digg', 'aspen' )
		)
	) );


	$socialTab->createOption( array(
		'name'    => esc_html__( 'Twitter URL', 'aspen' ),
		'id'      => 'social_icons_twitter',
		'type'    => 'text',
		'size'    => 'large',
		'class'   => 'social-url',
		'default' => '#'
	) );

	$socialTab->createOption( array(
		'name'    => esc_html__( 'Facebook URL', 'aspen' ),
		'id'      => 'social_icons_facebook',
		'type'    => 'text',
		'size'    => 'large',
		'class'   => 'social-url',
		'default' => '#'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Google+ URL', 'aspen' ),
		'id'    => 'social_icons_google',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Pinterest URL', 'aspen' ),
		'id'    => 'social_icons_pinterest',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'    => esc_html__( 'Instagram URL', 'aspen' ),
		'id'      => 'social_icons_instagram',
		'type'    => 'text',
		'size'    => 'large',
		'class'   => 'social-url',
		'default' => '#'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'YouTube URL', 'aspen' ),
		'id'    => 'social_icons_youtube',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'LinkedIn URL', 'aspen' ),
		'id'    => 'social_icons_linkedin',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Flickr URL', 'aspen' ),
		'id'    => 'social_icons_flickr',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Tumblr URL', 'aspen' ),
		'id'    => 'social_icons_tumblr',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Foursquare URL', 'aspen' ),
		'id'    => 'social_icons_foursquare',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Vimeo URL', 'aspen' ),
		'id'    => 'social_icons_vimeo',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'last.fm URL', 'aspen' ),
		'id'    => 'social_icons_lastfm',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Soundcloud URL', 'aspen' ),
		'id'    => 'social_icons_soundcloud',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Yelp URL', 'aspen' ),
		'id'    => 'social_icons_yelp',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Slideshare URL', 'aspen' ),
		'id'    => 'social_icons_slideshare',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Dribbble URL', 'aspen' ),
		'id'    => 'social_icons_dribbble',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Behance URL', 'aspen' ),
		'id'    => 'social_icons_behance',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'GitHub URL', 'aspen' ),
		'id'    => 'social_icons_github',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Reddit URL', 'aspen' ),
		'id'    => 'social_icons_reddit',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Weibo URL', 'aspen' ),
		'id'    => 'social_icons_weibo',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'DeviantArt URL', 'aspen' ),
		'id'    => 'social_icons_deviantart',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Skype URL', 'aspen' ),
		'id'    => 'social_icons_skype',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Spotify URL', 'aspen' ),
		'id'    => 'social_icons_spotify',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Xing URL', 'aspen' ),
		'id'    => 'social_icons_xing',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Vine URL', 'aspen' ),
		'id'    => 'social_icons_vine',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );

	$socialTab->createOption( array(
		'name'  => esc_html__( 'Digg URL', 'aspen' ),
		'id'    => 'social_icons_digg',
		'type'  => 'text',
		'size'  => 'large',
		'class' => 'social-url'
	) );


	do_action( 'aspen_after_social_links', $socialTab );


	$socialTab->createOption( array(
		'type' => 'save',
	) );


	/*
	 * Demo Content & Presets
	 */

	$demoTab = $adminPanel->createTab( array(
		'name' => esc_html__( 'Demo Settings', 'aspen' ),
	) );

	$demoTab->createOption( array(
		'name'  => esc_html__( 'Demo Settings', 'aspen' ),
		'class' => 'super-heading',
		'tag'   => 'h2',
		'type'  => 'heading',
	) );

	$sr_demo_sets = array();
	$sr_demo_sets = apply_filters( 'sr_demo_sets', $sr_demo_sets );

	$demoTab->createOption( array(
		'name'    => esc_html__( 'Presets', 'aspen' ),
		'id'      => 'demo_content_select',
		'type'    => 'select-image',
		'options' => $sr_demo_sets,
		'default' => apply_filters( 'sr_default_demo_set', 'default' ),
	) );

	$demoTab->createOption( array(
		'name'    => esc_html__( 'Clear and Import Widgets', 'aspen' ),
		'desc'    => esc_html__( 'Clear widgets from all current sidebars and import widgets associated with preset', 'aspen' ),
		'id'      => 'demo_import_widgets',
		'type'    => 'checkbox',
		'default' => true,
	) );


	$demoTab->createOption( array(
		'type'      => 'save',
		'action'    => 'import_demo_settings',
		'save'      => esc_html__( 'Import Demo Settings', 'aspen' ),
		'use_reset' => false
	) );


	add_action( 'in_admin_footer', 'aspen_remove_admin_footer_text', 999999999999 );

}

function aspen_remove_admin_footer_text() {
	global $wp_filter;
	$hook = "admin_footer_text";
	if ( empty( $hook ) || ! isset( $wp_filter[ $hook ] ) ) {
		return;
	}
	unset( $wp_filter[ $hook ] );
}


/*
 * Export and Import Filters for Demo Data
 */

add_filter( 'sr_options_export_prefix', 'sr_options_export_prefix', 1 );
function sr_options_export_prefix( $prefix = "" ) {
	$prefix = "sr_";

	return $prefix;
}

add_filter( 'sr_options_export_theme', 'sr_options_export_theme', 1 );
function sr_options_export_theme( $prefix = "" ) {
	$prefix = "aspen";

	return $prefix;
}

add_filter( 'sr_options_export_theme_repo', 'sr_options_export_theme_repo', 1 );
function sr_options_export_theme_repo( $url = "" ) {
	$url = "http://repository.shapingrain.com/aspen";

	return $url;
}


add_filter( 'sr_mods_with_images', 'sr_mods_with_images', 1 );
function sr_mods_with_images( $mods = array() ) {
	$mods[] = 'logo_image';
	$mods[] = 'logo_image_secondary';
	$mods[] = 'logo_image_mobile';
	$mods[] = 'frontpage_banner_background';
	$mods[] = 'blog_header_image';
	$mods[] = 'woocommerce_default_header_image';

	return $mods;
}

add_filter( 'sr_widgets_with_images', 'sr_widgets_with_images', 1 );
function sr_widgets_with_images( $widgets = array() ) {

	$widgets['aspen-promo-item'] = array(
		'image'
	);

	$widgets['aspen-about-me'] = array(
		'avatar',
		'header_background',
		'signature'
	);

	return $widgets;
}


add_filter( 'sr_demo_sets', 'sr_demo_sets', 1 );
function sr_demo_sets( $sets = array() ) {

	$sets['import-aspen-main_demo'] = array(
		'image' => get_template_directory_uri() . '/assets/images/admin/demo_main.png',
		'label' => esc_html__( 'Main Demo', 'aspen' )
	);

	$sets['import-aspen-travel_demo'] = array(
		'image' => get_template_directory_uri() . '/assets/images/admin/demo_travel.png',
		'label' => esc_html__( 'Travel Demo', 'aspen' )
	);

	$sets['import-aspen-journalist_demo'] = array(
		'image' => get_template_directory_uri() . '/assets/images/admin/demo_journalist.png',
		'label' => esc_html__( 'Journalist Demo', 'aspen' )
	);

	$sets['import-aspen-food_demo'] = array(
		'image' => get_template_directory_uri() . '/assets/images/admin/demo_food.png',
		'label' => esc_html__( 'Food Demo', 'aspen' )
	);

	$sets['import-aspen-family_demo'] = array(
		'image' => get_template_directory_uri() . '/assets/images/admin/demo_family.png',
		'label' => esc_html__( 'Family Demo', 'aspen' )
	);

	$sets['import-aspen-fitness_demo'] = array(
		'image' => get_template_directory_uri() . '/assets/images/admin/demo_fitness.png',
		'label' => esc_html__( 'Fitness Demo', 'aspen' )
	);

	$sets['import-aspen-fashion_demo'] = array(
		'image' => get_template_directory_uri() . '/assets/images/admin/demo_fashion.png',
		'label' => esc_html__( 'Fashion Demo', 'aspen' )
	);

	$sets['import-aspen-tech_demo'] = array(
		'image' => get_template_directory_uri() . '/assets/images/admin/demo_tech.png',
		'label' => esc_html__( 'Tech Demo', 'aspen' )
	);

	return $sets;
}

add_filter( 'sr_default_demo_set', 'sr_default_demo_set', 1 );
function sr_default_demo_set( $default = '' ) {
	$default = 'import-aspen-main_demo';

	return $default;
}

add_filter( 'sr_demo_import_select_field', 'sr_demo_import_select_field', 1 );
function sr_demo_import_select_field( $default = '' ) {
	$default = 'aspen_demo_content_select';

	return $default;
}

add_filter( 'sr_demo_import_widgets_field', 'sr_demo_import_widgets_field', 1 );
function sr_demo_import_widgets_field( $default = '' ) {
	$default = 'aspen_demo_import_widgets';

	return $default;
}


