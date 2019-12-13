<?php
/**
 * Taxonomy Options
 */

if ( is_admin() ) {
	/*
	* prefix of meta keys, optional
	*/
	$prefix = 'ps_';
	/*
	* configure your meta box
	*/
	$config = array(
		'id'             => 'ps_category_header',
		// meta box id, unique per meta box
		'title'          => esc_html__( 'Category Header', 'aspen' ),
		// meta box title
		'pages'          => array( 'category', 'product_cat' ),
		// taxonomy name, accept categories, post_tag and custom taxonomies
		'context'        => 'normal',
		// where the meta box appear: normal (default), advanced, side; optional
		'fields'         => array(),
		// list of meta fields (can be added by field arrays)
		'local_images'   => true,
		// Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => true
		//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);


	/*
	* Initiate your meta box
	*/
	$my_meta = new SR_Tax_Meta_Class( $config );

	/*
	* Add fields to your meta box
	*/

	$my_meta->addImage(
		'ps_category_header_image',
		array(
			'name' => esc_html__( 'Header Image', 'aspen' ),
			'desc' => esc_html__( 'Upload an image to be used in the header for this category. It will also be used for posts that have this category set as the primary category if no featured image is used.', 'aspen' )
		)
	);

	//Finish Meta Box Declaration
	$my_meta->Finish();
}