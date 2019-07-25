<?php
if ( ! class_exists( 'LoftLoaderPro_Any_Page_Filter' ) ) {
	class LoftLoaderPro_Any_Page_Filter {
		private $defaults = array(); 
		private $page_settings = array();
		private $page_enabled = false;
		private $page_id = false;
		private $is_customize = false;
		public function __construct() {
			add_filter( 'loftloader_pro_loader_enabled', 		array( $this, 'loader_enabled' ), 100 );
			add_filter( 'loftloader_pro_get_loader_setting', 	array( $this, 'get_loader_setting' ), 10, 2 );
			add_action( 'loftloader_pro_settings', 				array( $this, 'loader_settings' ) );
		}
		/**
		* @description get the plugin settings
		*/
		public function loader_settings() { 
			global $wp_customize, $llp_defaults;
			$this->is_customize = isset( $wp_customize ) ? true : false;
			if ( ( ( is_front_page() || is_home() ) && ( 'page' == get_option( 'show_on_front', false ) ) ) || is_page() ) {
				$page = get_queried_object();
				if ( ( false !== $atts = $this->get_loader_attributes( $page->ID ) ) ) {
					$this->page_id = $page->ID;
					add_filter( 'loftloader_pro_custom_styles_in_file', array( $this, 'custom_styles_in_file' ) );
					if ( isset( $atts['loftloader_pro_message_text'] ) ) {
						$atts['loftloader_pro_message_text'] = base64_decode( $atts['loftloader_pro_message_text'] );
					}
					if ( isset( $atts['loftloader_pro_random_message_text'] ) ) {
						$atts['loftloader_pro_random_message_text'] = base64_decode( $atts['loftloader_pro_random_message_text'] );
					}
					if ( isset( $atts['loftloader_pro_show_close_tip'] ) ) {
						$atts['loftloader_pro_show_close_tip'] = base64_decode( $atts['loftloader_pro_show_close_tip'] );
					}
					$this->page_settings = array_merge( $llp_defaults, $atts );
					$this->page_enabled = ( 'on' == $atts['loftloader_pro_main_switch'] );
				}
			}
		}
		/**
		* @description helper function to get shortcode attributes
		*/
		private function get_loader_attributes( $page_id ) {
			$loader = get_post_meta( $page_id, 'loftloader_pro_page_shortcode', true );
			$loader = trim( $loader );
			if ( ! empty( $loader ) ) {
				$loader = substr( $loader, 1, -1 );
				return shortcode_parse_atts( $loader );
			}
			return false;
		}
		/**
		* Helper function to test whether show loftloader
		* @return boolean return true if loftloader enabled and display on current page, otherwise false
		*/
		public function loader_enabled( $enabled ) {
			if ( ! $this->is_customize && $this->page_id ) {
				$cookie_name = 'loftloader_pro_any_page_id_' . $this->page_id;
				if ( $this->page_enabled ) {
					$once = get_post_meta( $this->page_id, 'loftloader_pro_show_once', true );
					if ( 'on' == $once ) {
						if ( ! empty( $_COOKIE[$cookie_name] ) && ( 'on' == $_COOKIE[$cookie_name] ) ) {
							return false;
						} else {
							llp_set_cookie( $cookie_name, 'on' );
							return true;
						}
					}
				}
			}
			return $enabled;
		}
		public function custom_styles_in_file( $in_file ) {
			return is_customize_preview() ? $in_file : false;
		}
		/**
		* Helper function get setting option
		*/
		public function get_loader_setting( $setting_value, $setting_id ) {
			return ( $this->page_enabled && ! $this->is_customize && isset( $this->page_settings[$setting_id] ) ) ? 
				$this->page_settings[$setting_id] : 
				$setting_value;
		}
	}
}