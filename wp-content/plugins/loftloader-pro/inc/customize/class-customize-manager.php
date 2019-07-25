<?php
/**
 * LoftLoader related customization api classes
 *
 * @package   LoftLoader Pro
 * @link	  http://www.loftocean.com/
 * @author	  Suihai Huang from Loft.Ocean Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 0 );
}

if ( ! class_exists( 'LoftLoader_Pro_Customize_Manager' ) ) {
	class LoftLoader_Pro_Customize_Manager {
		public function __construct() {
			$this->includes();

			add_action( 'customize_controls_init', 					array( $this, 'remove_sections' ), 1000 );
			add_action( 'customize_controls_enqueue_scripts', 		array( $this, 'add_customize_scripts'), 1 );
			add_action( 'customize_preview_init', 					array( $this, 'add_preview_script' ) );
			// Remove scripts and styles
			add_action( 'customize_controls_enqueue_scripts', 		array( $this, 'remove_scripts' ), 100000 );
			add_action( 'customize_controls_print_styles', 			array( $this, 'remove_scripts' ), 100000 );
			add_action( 'customize_controls_print_scripts', 		array( $this, 'remove_scripts' ), 100000 );
			add_action( 'customize_controls_print_footer_scripts', 	array( $this, 'remove_scripts' ), 100000 );
		}
		/**
		* Load configuration files
		*/
		private function includes() {
			$config_dir = LOFTLOADERPRO_INC . 'customize/configs/';

			require_once $config_dir . 'google-fonts.php';
			require_once $config_dir . 'main.php';
			require_once $config_dir . 'range.php';
			require_once $config_dir . 'background.php';
			require_once $config_dir . 'loader.php';
			require_once $config_dir . 'progress.php';
			require_once $config_dir . 'message.php';
			require_once $config_dir . 'more.php';
			require_once $config_dir . 'advanced.php';
		}
		/**
		* Enqueue scripts for customize.php page
		*/
		public function add_customize_scripts() {
			$asset_uri = LOFTLOADERPRO_ASSETS_URI;
			$asset_ver = LOFTLOADERPRO_ASSET_VERSION;
			$customize_js_dep = array( 'jquery', 'wp-color-picker', 'jquery-ui-slider', 'customize-controls', 'loftloader-shortcode-generator' );

			wp_enqueue_script( 'loftloader-shortcode-generator', $asset_uri . 'js/shortcode-generator.min.js', array( 'jquery' ), $asset_ver );
			wp_register_script( 'loftloader-customize', $asset_uri . 'js/customize.min.js', $customize_js_dep, $asset_ver );
			// Change the site title in string "You are customizing ..."
			wp_localize_script( 'loftloader-customize', 'loftloader_i18n', array( 'name' => esc_html__( 'LoftLoader Pro', 'loftloader-pro' ) ) );
			wp_enqueue_script( 'loftloader-customize' );

			wp_enqueue_style( 'loftloader-ui', $asset_uri . 'css/jquery-ui.css', array(), $asset_ver );
			wp_enqueue_style( 'loftloader-customize', $asset_uri . 'css/loftloader-settings.min.css', array(), $asset_ver );
		}
		/**
		* Remove scripts and styles from theme currently used to avoid layout issues
		*/
		public function remove_scripts() {
			global $wp_scripts, $wp_styles;
			foreach ( $wp_scripts->registered as $h => $o ) { 
				if ( false !== strpos( $o->src, 'wp-content/themes' ) ) {
					wp_dequeue_script( $h );
				}
			};
			foreach ( $wp_styles->registered as $h => $o ) { 
				if ( false !== strpos( $o->src, 'wp-content/themes' ) ) {
					wp_dequeue_style( $h );
				}
			};
		}
		/**
		* Enqueue scripts for customize preview
		*/
		public function add_preview_script() {
			$asset_uri = LOFTLOADERPRO_ASSETS_URI;
			$asset_ver = LOFTLOADERPRO_ASSET_VERSION;

			wp_register_script( 'loftloader-preview', $asset_uri . 'js/preview.js', array( 'jquery', 'customize-preview' ), $asset_ver, true );
			wp_localize_script( 'loftloader-preview', 'loftloader_pro', array( 'preview' => 'on' ) );
			wp_enqueue_script( 'loftloader-preview' );
			wp_enqueue_style( 'loftloader-preview-style', $asset_uri . 'css/loftloader-preview.min.css', array( 'loftloader-style'), $asset_ver );
		}
		/**
		* Remove sectioin except loftloader
		*/
		public function remove_sections() {
			global $wp_customize; 
			// Remove none loftloader pro top containers
			foreach ( $wp_customize->containers() as $id => $container ) {
				if ( $container instanceof WP_Customize_Panel ) {
					( false === strpos($id, 'loftloader_pro_') ) ? $wp_customize->remove_panel( $id ) : '';
				} else if ( $container instanceof WP_Customize_Section ) {
					( false === strpos($id, 'loftloader_pro_') ) ? $wp_customize->remove_section( $id ) : '';
				}
			}
			// Remove none loftloader pro controls
			foreach ( $wp_customize->controls() as $id => $control ) {
				( false === strpos($id, 'loftloader_') ) ? $wp_customize->remove_control( $id ) : '';
			}
			// Remove none loftloader pro settings
			foreach ( $wp_customize->settings() as $id => $setting ) {
				( false === strpos($id, 'loftloader_') ) ? $wp_customize->remove_setting( $id ) : '';
			}
		}
	}
	new LoftLoader_Pro_Customize_Manager();
}
