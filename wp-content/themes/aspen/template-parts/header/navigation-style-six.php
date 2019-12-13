<?php
/**
 * Navigation style template to be used in header
 *
 * @package aspen
 */
?>

<!--Start of Site Header-->
<header id="site-header">
	<!--Start of Site Header Inner-->
	<div id="site-header-inner">

		<!--Start of Header Bottom-->
		<div id="header-bottom" class="navigation-elements row-menu">
            <div id="header-bottom-inner">
                <!--Start of Logo-->
                <div id="logo">
                    <?php aspen_header_logo(); ?>
                    <?php aspen_header_title(); ?>
                    <?php aspen_header_tagline(); ?>
                </div>
                <!--End of Logo-->

                <!--Start of Header Icons-->
                <aside id="header-icons">
	                <?php if ( function_exists( 'aspen_cart' ) ) {
		                aspen_cart();
	                } ?>
					<?php aspen_search(); ?>

                    <!--Push Navigation-->
                    <button id="show-top" class="nav-button">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <!--End of Push Navigation-->

                </aside>
                <!--End of Header Icons-->
            </div>
		</div>
		<!--End of Header Bottom-->
	</div>
	<!--End of Site Header Inner-->
</header>
<!--End of Site Header-->


<!--Start of Header FullScreen-->
<div id="header-fullscreen" class="cbp-spmenu cbp-spmenu-top">
	<div id="header-fullscreen-content">
		<!--Start of Navigation-->
		<?php
		if ( has_nav_menu( 'aspen-primary' ) ) {
			wp_nav_menu( array( 'theme_location' => 'aspen-primary', 'container' => 'nav', 'container_id' => 'main-navigation' ) );
		}
		?>
		<!--End of Navigation-->

		<?php aspen_social_icons(); ?>
	</div>
</div>
<!--End of Header FullScreen-->
