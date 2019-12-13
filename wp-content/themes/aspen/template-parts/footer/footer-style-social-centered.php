<?php
/**
 * Footer style template to be used in footer
 *
 * @package aspen
 */
?>
<footer id="site-footer" class="footer-style-social-center clearfix">
	<div class="row-menu">

		<div class="col-3">
			<!--Start of Footer Navigation-->
			<?php
			if ( has_nav_menu( 'aspen-footer' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'aspen-footer',
					'container'      => 'nav',
					'container_id'   => 'footer-navigation'
				) );
			}
			?>
			<!--End of Footer Navigation-->
		</div>

		<div class="col-3">
			<!--Start of Social Icons-->
			<?php aspen_social_icons( 'footer' ); ?>
			<!--End of Social Icons-->
		</div>

		<div class="col-3">
			<!--Start of Footer Text-->
			<p>
				<?php do_action( 'aspen_print_footer_copyright' ); ?>
			</p>
			<!--End of Footer Text-->
		</div>
	</div>
</footer>
