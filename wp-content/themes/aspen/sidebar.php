<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aspen
 */

if ( ! is_active_sidebar( 'aspen-sidebar' ) ||  aspen_option( 'hide_sidebar' ) ) {
	return;
}
?>

<div id="sidebar" class="widget-area col-4" role="complementary">
	<?php if ( is_active_sidebar( 'aspen-sidebar' ) && ! aspen_option( 'hide_sidebar' ) ) : ?>
		<?php dynamic_sidebar( 'aspen-sidebar' ); ?>
	<?php endif; ?>
</div>

