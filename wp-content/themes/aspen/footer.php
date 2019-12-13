<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aspen
 */
?>


<!--Start of Site Footer-->
<?php aspen_footer(); ?>
<!--End of Site Footer-->

</div>
<!--End of Site-->


<?php if ( ! aspen_option( 'footer_hide_scroll_up' ) ) : ?>
	<a href="#" class="scroll-up"><span><?php esc_html_e( 'Scroll up', 'aspen' ); ?></span></a>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
