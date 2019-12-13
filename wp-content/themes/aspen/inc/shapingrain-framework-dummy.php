<?php
/*
 * Skeleton functions to emulate options framework plug-in if it is not present
 */
if ( ! class_exists( 'ShapingRainFramework' ) ) {

	add_action( 'init', 'aspen_framework_create_options_init' );
	function aspen_framework_create_options_init( $args ) {
		do_action( 'shapingrain_framework_create_options' ); // call framework plug-in init function
	}


	class ShapingRainFramework {

		private static $instances = array();
		public $optionNamespace;
		public $settings = array();
		private $emulated;


		function __construct( $optionNamespace ) {

			// We're only emulating the framework
			$this->emulated = true;

			do_action( 'shapingrain_framework_init', $this );

		}

		public static function isDummy() {
			return true;
		}


		public static function getInstance( $optionNamespace ) {

			$newInstance       = new ShapingRainFramework( $optionNamespace );
			self::$instances[] = $newInstance;

			return $newInstance;
		}

		public function getOption( $optionName, $postID = null ) {
			return false;
		}

		public function createContainer( $settings ) {
			return $this;
		}

		public function createOption( $settings ) {
			if ( ! empty ( $settings ['default'] ) ) {
				$key = $settings['id'];
			} else {
				return false;
			}

			if ( ! empty ( $settings ['default'] ) ) {
				$default = $settings['default'];
			} else {
				$default = false;
			}

			aspen_set_option( $key, $default );
		}


		public function createMetaBox( $settings ) {
			return $this->createContainer( $settings );
		}

		public function createTab( $settings ) {
			return $this->createContainer( $settings );
		}

		public function createCSS( $css ) {
			return '';
		}

		public function createAdminCSS ( $css ) {
			return '';
		}

	}
}
