<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


class ShapingRainFrameworkAdminPage {

	private $defaultSettings = array(
		'name'       => '',
		// Name of the menu item
		'title'      => '',
		// Title displayed on the top of the admin panel
		'parent'     => null,
		// id of parent, if blank, then this is a top level menu
		'id'         => '',
		// Unique ID of the menu item
		'capability' => 'manage_options',
		// User role
		'icon'       => 'dashicons-admin-generic',
		// Menu icon for top level menus only http://melchoyce.github.io/dashicons/
		'position'   => null,
		// Menu position. Can be used for both top and sub level menus
		'use_form'   => true,
		// If false, options will not be wrapped in a form
		'desc'       => '',
		// Description displayed below the title
	);

	public $settings;
	public $options = array();
	public $tabs = array();
	public $owner;

	public $panelID;

	private $activeTab = null;
	private static $idsUsed = array();

	function __construct( $settings, $owner ) {
		$this->owner = $owner;

		if ( ! is_admin() ) {
			return;
		}

		$this->settings = array_merge( $this->defaultSettings, $settings );
		// $this->options = $options;
		if ( empty( $this->settings['name'] ) ) {
			return;
		}

		if ( empty( $this->settings['title'] ) ) {
			$this->settings['title'] = $this->settings['name'];
		}

		if ( empty( $this->settings['id'] ) ) {
			$prefix = '';
			if ( ! empty( $this->settings['parent'] ) ) {
				$prefix = str_replace( ' ', '-', trim( strtolower( $this->settings['parent'] ) ) ) . '-';
			}
			$this->settings['id'] = $prefix . str_replace( ' ', '-', trim( strtolower( $this->settings['name'] ) ) );
			$this->settings['id'] = str_replace( '&', '-', $this->settings['id'] );
		}

		// make sure all our IDs are unique
		$suffix = '';
		while ( in_array( $this->settings['id'] . $suffix, self::$idsUsed ) ) {
			if ( $suffix == '' ) {
				$suffix = 2;
			} else {
				$suffix ++;
			}
		}
		$this->settings['id'] .= $suffix;

		// keep track of all IDs used
		self::$idsUsed[] = $this->settings['id'];

		$priority = - 1;
		if ( $this->settings['parent'] ) {
			$priority = intval( $this->settings['position'] );
		}

		add_action( 'admin_menu', array( $this, 'register' ), $priority );
	}

	public function createAdminPanel( $settings ) {
		$settings['parent'] = $this->settings['id'];

		return $this->owner->createAdminPanel( $settings );
	}

	public function createSampleContentPage( $settings ) {
		$settings['parent'] = $this->settings['id'];

		return $this->owner->createSampleContentPage( $settings );
	}

	public function register() {
		// Parent menu
		if ( empty( $this->settings['parent'] ) ) {
			$this->panelID = add_menu_page( $this->settings['name'],
				$this->settings['title'],
				$this->settings['capability'],
				$this->settings['id'],
				array( $this, 'createAdminPage' ),
				$this->settings['icon'],
				$this->settings['position'] );
			// Sub menu
		} else {
			$this->panelID = add_submenu_page( $this->settings['parent'],
				$this->settings['name'],
				$this->settings['title'],
				$this->settings['capability'],
				$this->settings['id'],
				array( $this, 'createAdminPage' ) );
		}

		add_action( 'load-' . $this->panelID, array( $this, 'saveOptions' ) );

		add_action( 'load-' . $this->panelID, array( $this, 'addShapingRainCredit' ) );
	}


	public function addShapingRainCredit() {
		add_filter( 'admin_footer_text', array( $this, 'addShapingRainCreditText' ) );
	}


	public function addShapingRainCreditText() {
		return __( "<em>Options Page Created with <a href='http://shapingrainframework.net?utm_source=admin&utm_medium=admin footer'>ShapingRain Framework</a></em>", TF_I18NDOMAIN );
	}


	public function getOptionNamespace() {
		return $this->owner->optionNamespace;
	}


	public function save_single_option( $option ) {
		if ( empty( $option->settings['id'] ) ) {
			return;
		}

		if ( isset( $_POST[ $this->getOptionNamespace() . '_' . $option->settings['id'] ] ) ) {
			$value = $_POST[ $this->getOptionNamespace() . '_' . $option->settings['id'] ];
		} else {
			$value = '';
		}

		$option->setValue( $value );
	}


	public function saveOptions() {
		if ( ! $this->verifySecurity() ) {
			return;
		}

		$message   = '';
		$activeTab = $this->getActiveTab();

		/*
		 *  Save
		 */

		if ( $_POST['action'] == 'save' ) {

			// we are in a tab
			if ( ! empty( $activeTab ) ) {
				foreach ( $activeTab->options as $option ) {
					$this->save_single_option( $option );

					if ( ! empty( $option->options ) ) {
						foreach ( $option->options as $group_option ) {
							$this->save_single_option( $group_option );
						}
					}
				}
			}

			foreach ( $this->options as $option ) {
				$this->save_single_option( $option );

				if ( ! empty( $option->options ) ) {
					foreach ( $option->options as $group_option ) {
						$this->save_single_option( $group_option );
					}
				}
			}

			// Hook 'sr_pre_save_options_{namespace}' - action pre-saving
			/**
			 * Fired right before options are saved.
			 *
			 * @since 1.0
			 *
			 * @param ShapingRainFrameworkAdminPage|ShapingRainFrameworkCustomizer|ShapingRainFrameworkMetaBox $this The container currently being saved.
			 */
			$namespace = $this->getOptionNamespace();
			do_action( "sr_pre_save_options_{$namespace}", $this );
			do_action( "sr_pre_save_admin_{$namespace}", $this, $activeTab, $this->options );

			$this->owner->saveInternalAdminPageOptions();

			do_action( 'sr_save_admin_' . $this->getOptionNamespace(), $this, $activeTab, $this->options );

			$message = 'saved';

			/*
			* Reset
			*/

		} else if ( $_POST['action'] == 'reset' ) {

			// we are in a tab
			if ( ! empty( $activeTab ) ) {
				foreach ( $activeTab->options as $option ) {

					if ( ! empty( $option->options ) ) {
						foreach ( $option->options as $group_option ) {

							if ( ! empty( $group_option->settings['id'] ) ) {
								$group_option->setValue( $group_option->settings['default'] );
							}
						}
					}

					if ( empty( $option->settings['id'] ) ) {
						continue;
					}

					$option->setValue( $option->settings['default'] );
				}
			}

			foreach ( $this->options as $option ) {

				if ( ! empty( $option->options ) ) {
					foreach ( $option->options as $group_option ) {

						if ( ! empty( $group_option->settings['id'] ) ) {
							$group_option->setValue( $group_option->settings['default'] );
						}
					}
				}

				if ( empty( $option->settings['id'] ) ) {
					continue;
				}

				$option->setValue( $option->settings['default'] );
			}

			// Hook 'sr_pre_reset_options_{namespace}' - action pre-saving
			do_action( 'sr_pre_reset_options_' . $this->getOptionNamespace(), $this );
			do_action( 'sr_pre_reset_admin_' . $this->getOptionNamespace(), $this, $activeTab, $this->options );

			$this->owner->saveInternalAdminPageOptions();

			do_action( 'sr_reset_admin_' . $this->getOptionNamespace(), $this, $activeTab, $this->options );

			$message = 'reset';
		}

		/*
		 * Import Demo Settings
		 */

		else if ( $_POST['action'] == 'import_demo_settings' ) {

			// theme prefix
			$theme = apply_filters( 'sr_options_export_theme', 'sr_default' );

			// image import cache
			$image_cache = get_option( $theme . '_' . 'image_cache' );
			if ( ! $image_cache ) {
				$image_cache = array();
			}

			// get field from which to get selected preset
			$import_select_field = apply_filters( 'sr_demo_import_select_field', 'theme_demo_content_select' );
			$selected_demo       = $_POST[ $import_select_field ];

			// get field from which to get widget import select option
			$import_widgets_field = apply_filters( 'sr_demo_import_widgets_field', 'theme_demo_import_widgets' );
			if ( isset ( $_REQUEST[ $import_widgets_field ] ) ) {
				$import_widgets = true;
			} else {
				$import_widgets = false;
			}

			// get settings from php serialized export and unserialize data
			$settings = include (get_template_directory() . '/lib/demo-settings/' . $selected_demo . '.php' );
			$settings = json_decode( $settings, true );

			// prepare for image handling
			$mods_with_images = array(); // array that holds the keys of any of the theme's customizer mods that use images
			$mods_with_images = apply_filters( 'sr_mods_with_images', $mods_with_images );

			$widgets_with_images = array(); // array that holds the keys and fields of widgets containing images
			$widgets_with_images = apply_filters( 'sr_widgets_with_images', $widgets_with_images );

			// import images if they don't currently exist in the media library from a previous import
			$repo_url = apply_filters( 'sr_options_export_theme_repo', 'https://repository.shapingrain.com/default' );

			// image import
			if ( ! empty ( $settings['images'] ) ) { // if import packages contains images

				$images = $settings['images'];

				$get_image = false;

				foreach ( $images as $image_original_id => $meta ) {

					if ( ! empty ( $image_cache[ $image_original_id ] ) ) { // we have previously imported this image
						// check whether this previously imported image still exists
						if ( wp_attachment_is_image( $image_cache[ $image_original_id ] ) ) {
							// do nothing, the image has been imported previously and is already there
							$get_image = false;
						} else {
							// the image was imported previously but has since been deleted, so get it again
							$get_image = true;
						}
					} else {
						$get_image = true;
					}

					if ( $get_image ) { // only get new image and process if necessary (doesn't exist)
						$file     = $meta['file'];
						$file_url = trailingslashit( $repo_url ) . $file;

						// compile meta information to be inserted into database
						$post_data = array(
							'post_title'               => $meta['wp_meta']['title'],
							'post_excerpt'             => $meta['wp_meta']['caption'],
							'post_content'             => $meta['wp_meta']['description'],
							'_wp_attachment_image_alt' => $meta['wp_meta']['alt']
						);

						// attach downloaded image to media library database and update meta data

						$new_image = sr_sideload_image( $file_url, null, $post_data );

						// if new image has been added successfully, add it to import image cache for this time
						if ( $new_image ) {
							$image_new_id                      = $new_image->attachment_id;
							$image_cache[ $image_original_id ] = $image_new_id;
						}
					}

				}

				// update image cache in database
				update_option( $theme . '_' . 'image_cache', $image_cache );
			}


			// customizer import
			if ( ! empty ( $settings['customizer'] ) ) { // if customizer settings exist in import package

				// get a new framework instance
				$framework = ShapingRainFramework::getInstance( $this->getOptionNamespace() );

				// loop through settings in import file and write each setting
				foreach ( $settings['customizer'] as $option_key => $option_value ) {

					if ( in_array( $option_key, $mods_with_images ) ) { // this option contains an image that needs to be associated
						if ( isset ( $image_cache[ $option_value ] ) ) {
							$option_value = $image_cache[ $option_value ]; // get new image id and replace original value with it
						}
					}

					// update theme option
					$framework->setOption( $option_key, $option_value );

				}
			}

			// widget import
			if ( $import_widgets ) {
				if ( ! empty ( $settings['widgets'] ) && ! empty ( $widgets_with_images ) ) { // if customizer settings exist in import package
					SR_Widget_Import::clear_widgets();
					$widgets = $settings['widgets']; // get list of exported sidebars and widgets
					foreach ( $widgets_with_images as $widget_slug => $widgets_options ) { // loop through possible widgets with images
						if ( ! empty ( $widgets[1][ $widget_slug ] ) ) { // if a widget containing images exists in the import
							foreach ( $widgets[1][ $widget_slug ] as $w_id => $w_options ) { // loop through instances of widgets in import
								if ( is_numeric( $w_id ) && ! empty ( $widgets_options ) ) {
									foreach ( $widgets_options as $widget_option_name ) { // loop through individual options
										if ( ! empty ( $w_options[ $widget_option_name ] ) ) { // if this option contains image
											$old_value = $w_options[ $widget_option_name ]; // get old option value (image ID)
											if ( ! empty ( $image_cache[ $old_value ] ) ) { // if image is in image cache
												$new_value                                                  = $image_cache[ $old_value ]; // get new option value (image ID) from cache
												$widgets[1][ $widget_slug ][ $w_id ][ $widget_option_name ] = $new_value; // assign new option
											}
										}
									}
								}
							}
						}
					}

					$import_widgets = SR_Widget_Import::parse_import_data( $widgets );
				}

				$message = 'import';
			}
		}


		/*
		 * Redirect to prevent refresh saving
		 */

		// urlencode to allow special characters in the url

		$url       = wp_get_referer();
		$activeTab = $this->getActiveTab();
		$url       = add_query_arg( 'page', urlencode( $this->settings['id'] ), $url );
		if ( ! empty( $activeTab ) ) {
			$url = add_query_arg( 'tab', urlencode( $activeTab->settings['id'] ), $url );
		}
		if ( ! empty( $message ) ) {
			$url = add_query_arg( 'message', $message, $url );
		}

		do_action( 'sr_admin_options_saved_' . $this->getOptionNamespace() );

		wp_redirect( esc_url_raw( $url ) );
	}

	private function verifySecurity() {
		if ( empty( $_POST ) || empty( $_POST['action'] ) ) {
			return false;
		}

		$screen = get_current_screen();
		if ( $screen->id != $this->panelID ) {
			return false;
		}

		if ( ! current_user_can( $this->settings['capability'] ) ) {
			return false;
		}

		if ( ! check_admin_referer( $this->settings['id'], TF . '_nonce' ) ) {
			return false;
		}

		return true;
	}

	public function getActiveTab() {
		if ( ! count( $this->tabs ) ) {
			return '';
		}
		if ( ! empty( $this->activeTab ) ) {
			return $this->activeTab;
		}

		if ( empty( $_GET['tab'] ) ) {
			$this->activeTab = $this->tabs[0];

			return $this->activeTab;
		}

		foreach ( $this->tabs as $tab ) {
			if ( $tab->settings['id'] == $_GET['tab'] ) {
				$this->activeTab = $tab;

				return $this->activeTab;
			}
		}

		$this->activeTab = $this->tabs[0];

		return $this->activeTab;
	}

	public function createAdminPage() {
		do_action( 'sr_admin_page_before' );
		do_action( 'sr_admin_page_before_' . $this->getOptionNamespace() );

		?>
		<div class="wrap">
			<h2><?php echo $this->settings['title'] ?></h2>
			<?php
			if ( ! empty( $this->settings['desc'] ) ) {
				?><p class='description'><?php echo $this->settings['desc'] ?></p><?php
			}
			?>

			<div class='shapingrain-framework-panel-wrap'>
				<?php

				do_action( 'sr_admin_page_start' );
				do_action( 'sr_admin_page_start_' . $this->getOptionNamespace() );

				if ( count( $this->tabs ) ) :
					?>
					<h2 class="nav-tab-wrapper">
						<?php

						do_action( 'sr_admin_page_tab_start' );
						do_action( 'sr_admin_page_tab_start_' . $this->getOptionNamespace() );

						foreach ( $this->tabs as $tab ) {
							$tab->displayTab();
						}

						do_action( 'sr_admin_page_tab_end' );
						do_action( 'sr_admin_page_tab_end_' . $this->getOptionNamespace() );

						?>
					</h2>
				<?php
				endif;

				?>
				<div class='options-container'>
					<?php

					// Display notification if we did something
					if ( ! empty( $_GET['message'] ) ) {
						if ( $_GET['message'] == 'saved' ) {
							echo ShapingRainFrameworkAdminNotification::formNotification( __( 'Settings saved.', TF_I18NDOMAIN ), esc_html( $_GET['message'] ) );
						} else if ( $_GET['message'] == 'reset' ) {
							echo ShapingRainFrameworkAdminNotification::formNotification( __( 'Settings reset to default.', TF_I18NDOMAIN ), esc_html( $_GET['message'] ) );
						} else if ( $_GET['message'] == 'import') {
							echo ShapingRainFrameworkAdminNotification::formNotification( __( 'Settings have been imported successfully.', TF_I18NDOMAIN ), esc_html( $_GET['message'] ) );
						}
					}

					if ( $this->settings['use_form'] ) :
					?>
					<form method='post'>
						<?php
						endif;

						if ( $this->settings['use_form'] ) {
							// security
							wp_nonce_field( $this->settings['id'], TF . '_nonce' );
						}

						?>
						<table class='form-table'>
							<tbody>
							<?php

							do_action( 'sr_admin_page_table_start' );
							do_action( 'sr_admin_page_table_start_' . $this->getOptionNamespace() );

							$activeTab = $this->getActiveTab();
							if ( ! empty( $activeTab ) ) {

								if ( ! empty( $activeTab->settings['desc'] ) ) {
									?><p class='description'><?php echo $activeTab->settings['desc'] ?></p><?php
								}

								$activeTab->displayOptions();
							}

							foreach ( $this->options as $option ) {
								$option->display();
							}

							do_action( 'sr_admin_page_table_end' );
							do_action( 'sr_admin_page_table_end_' . $this->getOptionNamespace() );

							?>
							</tbody>
						</table>
						<?php

						if ( $this->settings['use_form'] ) :
						?>
					</form>
				<?php
				endif;

				// Reset form. We use JS to trigger a reset from other buttons within the main form
				// This is used by class-option-save.php
				if ( $this->settings['use_form'] ) :
					?>
					<form method='post' id='tf-reset-form'>
						<?php
						// security
						wp_nonce_field( $this->settings['id'], TF . '_nonce' );
						?>
						<input type='hidden' name='action' value='reset' />
					</form>
				<?php
				endif;

				do_action( 'sr_admin_page_end' );
				do_action( 'sr_admin_page_end_' . $this->getOptionNamespace() );

				?>
					<div class='options-container'>
					</div>
				</div>
			</div>
		</div>
		<?php

		do_action( 'sr_admin_page_after' );
		do_action( 'sr_admin_page_after_' . $this->getOptionNamespace() );
	}

	public function createTab( $settings ) {
		$obj          = new ShapingRainFrameworkAdminTab( $settings, $this );
		$this->tabs[] = $obj;

		do_action( 'sr_admin_tab_created_' . $this->getOptionNamespace(), $obj );

		return $obj;
	}

	public function createOption( $settings ) {
		if ( ! apply_filters( 'sr_create_option_continue_' . $this->getOptionNamespace(), true, $settings ) ) {
			return null;
		}

		$obj             = ShapingRainFrameworkOption::factory( $settings, $this );
		$this->options[] = $obj;

		do_action( 'sr_create_option_' . $this->getOptionNamespace(), $obj );

		return $obj;
	}
}
