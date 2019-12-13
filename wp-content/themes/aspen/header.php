<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aspen
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php aspen_search_header(); ?>

<?php
if ( has_nav_menu( 'aspen-mobile' ) ) {
	aspen_menu_trigger();
	wp_nav_menu( array(
		'theme_location'  => 'aspen-mobile',
		'container'       => 'nav',
		'container_id'    => 'mobile-navigation-container',
		'container_class' => 'hidden',
		'menu_id'         => 'mobile-navigation',
		'menu_class'      => 'sm sm-aspen'
	) );
}
?>

<!--Start of Site-->
<div id="site-wrapper">

<?php aspen_header(); ?>