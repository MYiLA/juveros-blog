<?php
/**
 * Navigation style template to be used in header
 *
 * @package aspen
 */
?>
<!--Start of Header Sidebar Push-->
<div id="header-sidebar-push" class="sidebar-menu cbp-spmenu-vertical cbp-spmenu-left row-menu">

	<!--Start of MainMenu-->
	<?php
	if ( has_nav_menu( 'aspen-primary' ) ) {
		wp_nav_menu( array( 'theme_location' => 'aspen-primary', 'container' => 'nav', 'container_id' => 'main-navigation', 'container_class' => 'cbp-spmenu-vertical' ) );
	}
	?>
	<!--End of MainMenu-->

	<?php aspen_nav_widgets(); ?>

</div>
<!--End of Header Sidebar Push-->

<!--Start of Site Header-->
<header id="site-header" class="header-align-left">
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

					<!--Search-->
                    <?php aspen_search(); ?>
                    <!--End of Search-->

                    <!--Start of Social Media-->
                    <?php aspen_social_icons(); ?>
                    <!--End of Social Media-->

                    <!--Push Navigation-->
                    <button id="navleftpush" class="nav-button">
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