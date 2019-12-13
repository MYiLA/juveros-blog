<?php

/* Hook to admin menu */
add_action( 'admin_menu', 'aspen_theme_register_theme_welcome_page' );

/**
 * Theme Settings/About Page
 *
 * @uses add_theme_page()
 * @link https://developer.wordpress.org/reference/functions/add_theme_page/
 */
function aspen_theme_register_theme_welcome_page() {
	add_theme_page(
		$page_title = __( 'Welcome to Aspen', 'aspen' ),
		$menu_title = __( 'Aspen Theme Setup', 'aspen' ),
		$capability = 'edit_theme_options',
		$menu_slug = 'aspen-welcome',
		$cb_function = 'aspen_theme_welcome_page'
	);

	add_submenu_page( 'aspen-welcome', __( 'Import Aspen Demo Posts', 'aspen' ), __( 'Import Aspen Demo Posts', 'aspen' ),
		'edit_theme_options', 'aspen-welcome-xml-import', 'aspen_theme_xml_import_page' );


}

/**
 * Settings Page Callback
 */
function aspen_theme_xml_import_page() {
	?>

	<div class="wrap about-wrap" id="setup-container">

		<div class="changelog">
			<h1><?php esc_html_e( 'Import of Demo Posts into Aspen', 'aspen' ); ?></h1>
		</div>

		<div id="setup-welcome">

			<div id="setup-theme" class="setup-theme-block-wrapper">

				<p class="setup-theme-block-notice info"><?php esc_html_e( 'Demo posts are useful if you want to get a feel for what your blog would look with posts, if you are starting from scratch. If you already have an existing blog, you probably do not want to import these posts.', 'aspen' ); ?></p>

				<h3><?php esc_html_e( '1. Locate the demo set you want to import', 'aspen' ); ?></h3>

				<p>
					<?php esc_html_e( 'The theme ships with 8 sets of demo posts matching our public preview site. They are contained in the "Demo_Content" folder of the "All files and documentation" archive that you can download from themeforest. Each demo XML file is named after the respective demo on our preview site, e.g. "aspen.tech-demo.xml"', 'aspen' ); ?>
				</p>

				<p>
					<?php esc_html_e( 'Each file contains demo posts, matching categories and associated images. Menus are not imported. None of your existing content will be removed or altered.', 'aspen' ); ?>
				</p>

				<h3><?php esc_html_e( '2. Open the WordPress import tool', 'aspen' ); ?></h3>

				<p>
					<?php esc_html_e( 'WordPress has a built-in tool to import post content. You can find it under Tools > Import in your WordPress backend.', 'aspen' ); ?>
				</p>

				<p>
					<a href="<?php echo esc_url( admin_url( 'import.php' ) ); ?>" class="button button-primary button-hero" target="_blank"><?php esc_html_e( "Open the WordPress Import Tool", 'aspen' ); ?></a>
				</p>

				<p>
					<?php esc_html_e( 'From there, you can select the "Run Importer" option for WordPress, at the end of the page.', 'aspen' ); ?>
				</p>

				<h3><?php esc_html_e( '3. Upload the XML file', 'aspen' ); ?></h3>

				<p>
					<?php esc_html_e( 'Select the XML file you have chosen to import and click on the "Upload file and import" button.', 'aspen' ); ?>
				</p>

				<h3><?php esc_html_e( '4. Finish the import', 'aspen' ); ?></h3>

				<p>
					<?php esc_html_e( 'In the next step, you can optionally select an existing user that you want imported posts to be associated with.', 'aspen' ); ?>
				</p>

				<p>
					<?php esc_html_e( 'We also recommend that you check the "Download and import file attachments" option to ensure that all images, including featured images, are imported.', 'aspen' ); ?>
				</p>

				<p>
					<?php esc_html_e( 'Once you have made all your selections, click on "Import" to complete the import process.', 'aspen' ); ?>
				</p>


			</div>


		</div>

	</div>


	<?php
}


function aspen_theme_welcome_page() {
	?>
	<div class="wrap about-wrap" id="setup-container">

		<div class="changelog">
			<h1><?php esc_html_e( 'Welcome to Aspen', 'aspen' ); ?></h1>
			<h2><?php esc_html_e( 'Before you can use your site with Aspen, we need to set up a few things.', 'aspen' ); ?></h2>
		</div>

		<div id="setup-welcome">

			<div id="setup-theme" class="setup-theme-block-wrapper">
				<h3><?php esc_html_e( 'Installation and Activation of Required Plugins', 'aspen' ); ?></h3>
				<p>
					<?php esc_html_e( 'Aspen requires two plug-ins to provide all the customization options and features.', 'aspen' ); ?>
				</p>
				<div class="setup-theme-block">
					<h4>
						<?php if ( class_exists( 'ShapingRainFramework' ) ) : ?>
							<span class="dashicons dashicons-yes green"></span> <?php esc_html_e( 'ShapingRain Framework', 'aspen' ); ?>
							<em><?php esc_html_e( '(already installed and activated)', 'aspen' ); ?></em>
						<?php else: ?>
							<span class="dashicons dashicons-no red"></span> <?php esc_html_e( 'ShapingRain Framework', 'aspen' ); ?>
							<em><?php esc_html_e( '(not active)', 'aspen' ); ?></em>
						<?php endif; ?>
					</h4>
				</div>
				<div class="setup-theme-block">
					<h4>
						<?php if ( defined( 'ASPEN_FEATURES_PLUGIN_URL' ) ) : ?>
							<span class="dashicons dashicons-yes green"></span> <?php esc_html_e( 'Aspen Feature Pack', 'aspen' ); ?>
							<em><?php esc_html_e( '(already installed and activated)', 'aspen' ); ?></em>
						<?php else: ?>
							<span class="dashicons dashicons-no red"></span> <?php esc_html_e( 'Aspen Feature Pack', 'aspen' ); ?>
							<em><?php esc_html_e( '(not active)', 'aspen' ); ?></em>
						<?php endif; ?>
					</h4>

					<?php if ( class_exists( 'ShapingRainFramework' ) && defined( 'ASPEN_FEATURES_PLUGIN_URL' ) ) : ?>
						<p class="setup-theme-block-notice info"><?php esc_html_e( 'You have installed and activated all necessary plug-ins. The theme is ready to be used!', 'aspen' ); ?></p>
					<?php else: ?>
						<a href="<?php echo esc_url( add_query_arg( array(
							'page' => 'aspen-install-plugins',
							'from' => 'aspen-welcome'
						), admin_url( 'themes.php' ) ) ); ?>" class="button button-primary button-hero" target="_blank"><?php esc_html_e( "Install and Activate Plug-ins", 'aspen' ); ?></a>
					<?php endif; ?>

				</div>
			</div>


			<div id="import-demos" class="setup-theme-block-wrapper">
				<h3><?php esc_html_e( 'Demo Content and Customization', 'aspen' ); ?></h3>

				<div class="setup-theme-block">
					<h4><?php esc_html_e( 'Demo Layout and Design Settings (Presets)', 'aspen' ); ?></h4>
					<p class="setup-theme-block-description"><?php esc_html_e( 'The theme comes with easy-to-import demo settings that set up your site like the respective demo site. Any existing blog content (posts, categories, menus) will not touched by the demo import.', 'aspen' ); ?></p>

					<?php if ( class_exists( 'ShapingRainFramework' ) && defined( 'ASPEN_FEATURES_PLUGIN_URL' ) ) : ?>
						<a href="<?php echo esc_url( add_query_arg( array(
							'page' => 'theme-settings',
							'tab'  => 'demo-settings'
						), admin_url( 'admin.php' ) ) ); ?>" class="button button-primary button-hero"><?php esc_html_e( "Import Demo Settings", 'aspen' ); ?></a>
					<?php else: ?>
						<p class="setup-theme-block-notice warning"><?php esc_html_e( 'In order to import the demo content, you need to install and activate the required plug-ins first. If you have already done that, you can refresh this page.', 'aspen' ); ?></p>
					<?php endif; ?>
				</div>

				<div class="setup-theme-block">
					<h4><?php esc_html_e( 'Demo Posts', 'aspen' ); ?></h4>
					<p class="setup-theme-block-description"><?php esc_html_e( 'Optionally, if you would like to also fill your blog with demo posts, you can import the WordPress XML export files that ship with the theme in the main package. This step is not recommended if you have an existing blog. It results in your site being filled with categories, posts and matching images that you may have to delete manually before adding your own content.', 'aspen' ); ?></p>

					<a href="<?php echo esc_url( add_query_arg( array(
						'page' => 'aspen-welcome-xml-import',
						'from' => 'aspen-welcome'
					), admin_url( 'admin.php' ) ) ); ?>" class="button button-secondary button-hero"><?php esc_html_e( "How to Import Demo Posts", 'aspen' ); ?></a>


				</div>

			</div>

			<div id="get-help" class="setup-theme-block-wrapper">

				<h3><?php esc_html_e( 'Customer Service and Documentation', 'aspen' ); ?></h3>

				<div class="setup-theme-block" id="block-get-help">
					<h4><?php esc_html_e( 'Get Help', 'aspen' ); ?></h4>
					<p class="setup-theme-block-description"><?php esc_html_e( 'Your purchase comes with 6 months of customer support. If you have any questions or need any help at all while working with Aspen and making the theme your own, please get in touch. We are always happy to help.', 'aspen' ); ?></p>
					<a href="https://shapingrain.com/support/" class="button button-secondary button-hero" target="_blank"><?php esc_html_e( "Contact Customer Support", 'aspen' ); ?></a>
				</div>

				<div class="setup-theme-block" id="block-documentation">
					<h4><?php esc_html_e( 'Documentation', 'aspen' ); ?></h4>
					<p class="setup-theme-block-description"><?php esc_html_e( 'Aspen comes with a comprehensive, illustrated user guide and additional documentation to help you get the most out of the theme. You can download all documentation or take it from the main theme package which you can download from themeforest.', 'aspen' ); ?></p>
					<a href="https://drive.google.com/drive/folders/1Z3QC1PQiRlxUsbxktnhHDzSFkk0A7ErN" class="button button-secondary button-hero" target="_blank"><?php esc_html_e( "Download the Documentation", 'aspen' ); ?></a>
				</div>

			</div>


		</div>

	</div>

	<?php
}

/**
 * Redirect on theme activation
 */
add_action( 'admin_init', 'aspen_theme_activation_redirect' );


/**
 * Redirect to "Install Plugins" page on activation
 */
function aspen_theme_activation_redirect() {
	global $pagenow;
	if ( "themes.php" == $pagenow && is_admin() && isset( $_GET['activated'] ) ) {
		wp_redirect( esc_url_raw( add_query_arg( 'page', 'aspen-welcome', admin_url( 'themes.php' ) ) ) );
	}
}

