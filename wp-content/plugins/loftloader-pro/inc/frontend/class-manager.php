<?php
// Not allowed by directly accessing.
if ( ! defined( 'ABSPATH' ) ) {
	die( 0 );
}

if ( ! class_exists( 'LoftLoader_Pro_Frontend_Manager' ) ) {
	/**
	 * @since version 1.0
	 */
	class LoftLoader_Pro_Frontend_Manager {
		protected $enabled_session 		= false;
		protected $disable_page_scroll 	= false;
		public function __construct() {
			$this->includes();

			add_action( 'wp', 								array( $this, 'init' ) );
			add_action( 'wp_loaded',						array( $this, 'start_cache' ) );
			add_filter( 'loftloader_pro_loader_enabled', 	array( $this, 'loader_enabled' ) );
			add_filter( 'loftloader_pro_loader_attributes', array( $this, 'add_loader_wrapper_attributes' ) );
		}
		/**
		* Start cache for outputing
		*/
		public function start_cache() {
			// Only for front view 
			if ( ! is_admin() ) {
				// Start cache the output with callback function
				ob_start( array( $this, 'modify_html' ) );
			}
		}
		/**
		* Will be called when flush cache
		*
		* @param string cached string
		* @return string modified cached string 
		*/
		public function modify_html( $html ) { 
			return apply_filters( 'loftloader_pro_modify_html', $html );
		}
		/**
		* Include files required
		*/
		protected function includes() {
			$inc = LOFTLOADERPRO_INC . 'frontend/';
			require_once $inc . 'class-custom-styles.php';
			require_once $inc . 'class-loader-html.php';
		}
		/**
		* Initialize loader
		*/
		public function init() {
			// Initialize any page settings if needed 
			do_action( 'loftloader_pro_settings' );

			// Only run if loader enabled and on frontend
			if ( ! is_admin() && apply_filters( 'loftloader_pro_loader_enabled', false ) ) {
				add_action( 'template_redirect', 	array( $this, 'init_front' ), 100000 );
				add_action( 'wp_enqueue_scripts', 	array( $this, 'enqueue_scripts' ) );
				add_filter( 'body_class',			array( $this, 'check_disable_page_scrolling' ) );
				add_filter( 'loftloader_pro_modify_html', array( $this, 'fix_no_js' ), 5 );
			}
		}
		/**
		* Initialize loader front 
		*/
		public function init_front() {
			// Set the page scroll while loading setting
			$this->disable_page_scroll = llp_module_enabled( 'loftloader_pro_disable_page_scrolling' ) && !is_customize_preview();
			// Roll the front related functions
			do_action( 'loftloader_pro_init_front' );
		}
		/**
		* Check if enable the option disbale page scroll while loading, if so add class to <body>
		*
		* @param array class list
		* @return array refined class list
		*/
		public function check_disable_page_scrolling( $class ) {
			// If page scroll while loading is disabled, add the class to <body>
			if ( $this->disable_page_scroll ) {
				array_push( $class, 'loftloader-disable-scrolling' );
			}
			return $class;
		}
		/**
		 * @description enqueue the scripts and styles for front end
		 */
		public function enqueue_scripts() {
			$asset_uri = LOFTLOADERPRO_ASSETS_URI;
			$asset_ver = LOFTLOADERPRO_ASSET_VERSION;
			// Register the require jquery plugin
			wp_register_script( 'jquery-waitforimages', $asset_uri . 'js/jquery.waitforimages.min.js', array( 'jquery' ), $asset_ver, true );
			// Enqueue the main loader javascript
			wp_register_script( 'loftloader-front-main', $asset_uri . 'js/loftloader.min.js', array( 'jquery-waitforimages' ), $asset_ver, true );
			$list = llp_get_random_message_list();
			if ( llp_module_enabled( 'loftloader_pro_enable_random_message_text' ) && llp_module_enabled( 'loftloader_pro_render_random_message_by_js' ) && ! empty( $list ) ) {
				wp_localize_script( 'loftloader-front-main', 'loftloaderRandomMessage', $list );
			}
			wp_enqueue_script( 'loftloader-front-main' );
			// Enqueue the main loader style file
			wp_enqueue_style( 'loftloader-style', $asset_uri . 'css/loftloader.min.css', array(), $asset_ver );

			$enable_message_google_font = llp_module_enabled( 'loftloader_pro_message_enable_google_font' );
			$enable_progress_google_font = llp_module_enabled( 'loftloader_pro_progress_number_enable_google_font' );
			if ( $enable_progress_google_font || $enable_message_google_font ) {
				// Enqueue the google font if needed
				$google_font 	= array();
				$number_font 	= llp_get_loader_setting( 'loftloader_pro_progress_number_font_family' );
				$message_font 	= llp_get_loader_setting( 'loftloader_pro_message_font_family' );
				if ( $enable_progress_google_font && ! empty( $number_font ) ) {
					$google_font[] = str_replace( ' ', '+', $number_font ) . ':100,200,300,400,500,600,700,800';
				}
				if ( $enable_message_google_font && ! empty( $message_font ) ) {
					$google_font[] = str_replace( ' ', '+', $message_font ) . ':100,200,300,400,500,600,700,800';
				}
				if ( ! empty( $google_font ) ) {
					$fonts_url = add_query_arg( array(
						'family' => urlencode( implode( '|', array_unique( $google_font ) ) ),
					), 'https://fonts.googleapis.com/css' );

					wp_enqueue_style( 'loftloader-google-font', $fonts_url, array(), $asset_ver );
				}
			}
		}
		/**
		* @description add javascript to head as early as possiable to remove no-js classname from <html>
		*/
		public function fix_no_js( $html ) {
			if ( ! empty( $html ) ) {
				$regexp_html ='/(<head[^>]*>)/i';
				$split = preg_split( $regexp_html, $html, 2, PREG_SPLIT_DELIM_CAPTURE ); 
				if ( is_array( $split ) && ( count( $split ) == 3 ) ) {
					// Not show the loader if javascript is disabled
					$inline = '<noscript><style>#loftloader-wrapper { display: none !important; }</style></noscript>';
					// Add page scroll while loading disabled related inline styles
					if ( $this->disable_page_scroll ){
						$inline .= '<style> html.js body.loftloader-disable-scrolling { overflow: hidden !important; max-height: 100vh !important; height: 100%; position: fixed !important; width: 100% } </style>';
						$inline .= '<style id="loftloader-pro-always-show-scrollbar"> html.js { overflow-y: scroll !important; } </style>';
					}
					// Add insite transition related inline styles
					if ( $this->test_insite_transition() ) {
						$styles  = $this->get_html_styles();
						$inline .= empty( $styles ) ? '' : llp_generate_style( 'loftloader-page-smooth-transition-bg', sprintf( 'html.js { %s }', $styles ) );
					}
					// Test if javascript enabled as soon as poosiable
					$inline .= "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";

					$split[1] .= $inline;
					$html = implode( '', $split );
				}
			}
			return $html;
		}
		/**
		* Test whether show loftloader
		* @return boolean return true if loftloader enabled and display on current page, otherwise false
		*/
		public function loader_enabled() {
			if ( ( 'on' == llp_get_loader_setting( 'loftloader_pro_main_switch') ) && $this->device_test() ) { 
				$this->check_cookies();
				$queried = get_queried_object();
				$range = llp_get_loader_setting( 'loftloader_pro_show_range' ); 
				// Home only + once per session
				if ( ( $range === 'homepage-once' ) && is_front_page() && $this->once_test( 'homepage') ) {
	    			$_SESSION['loftloader-pro-homepage-visited'] = true; 
					return true;
				} else if ( ( $range === 'once' ) && $this->once_test() ) { // Once per session
					$_SESSION['loftloader-pro-visited'] = true; 
					return true;
				} else if ( $range == 'post_types' ) { // Sitewide - selected post types
					$types = ( array )llp_get_loader_setting( 'loftloader_pro_post_types' );
					return empty( $types ) || !is_singular( $types );
				} else if ( $range == 'selected_post_types' ) { // Selected post types
					$types = (array) llp_get_loader_setting( 'loftloader_pro_selected_post_types' );
					return ! empty( $types ) && is_singular( $types );
				} else if ( ( $range === 'sitewide' ) 
					|| ( ( $range === 'all' ) && ( (  $this->is_singles( $queried ) && ( $queried->post_type == 'page' ) ) || is_home() || $this->is_woocommerce_shop() ) ) 
					|| ( ( $range === 'homepage' ) && is_front_page() ) ) { // Sitewide || all pages || homepage only

					return true;
				} else if ( $range === 'handpick' ) { // Handpick
					$pages = llp_get_loader_setting( 'loftloader_pro_hand_pick_pages' );
					// Support woocommerce shop page
					return ( $this->is_singles( $queried ) && in_array( $queried->ID, $pages ) ) 
						|| ( $this->is_woocommerce_shop() && in_array( wc_get_page_id( 'shop' ), $pages ) );
				}
			}
		}
		/**
		* Add insite transition attributes to loader wrapper
		*
		* @param string original attributes
		* @return string modified attributes
		*/
		public function add_loader_wrapper_attributes( $attrs ) {
			if ( $this->test_insite_transition() ) {
				$exclude = llp_get_loader_setting( 'loftloader_pro_exclude_from_page_transition' );
				$attrs 	.= ' data-insite-transition="on"';
				$attrs 	.= ' data-site-url="' . esc_url( get_site_url() ) . '"';

				if ( ! empty( $exclude ) ) {
					$attrs .= sprintf( ' data-insite-transition-excluded="%s"', esc_attr( esc_attr( $exclude ) ) );
				}
			}
			return $attrs;
		}
		/**
		* Set cookies if once per session enabled
		*/
		protected function check_cookies() { 
			$range = esc_attr( llp_get_loader_setting( 'loftloader_pro_show_range', true ) );
			$onces = array( 'homepage-once', 'once' );
			if ( in_array( $range, $onces ) && !is_customize_preview() ) {
				if ( ( 'homepage-once' == $range ) && is_front_page() ) {
					llp_set_cookie( 'loftloader_pro_homepage_once_per_session_visited', 'on' );
					$this->enabled_session = true;
				} else if ( 'once' == $range ){
					llp_set_cookie( 'loftloader_pro_once_per_session_visited', 'on' );
					$this->enabled_session = true;
				}
			}
		}
		/**
		* Test current settings for once per session
		* @return boolean, return false if visited, otherwise true
		*/
		protected function once_test( $id = '' ) {
			if ( $this->enabled_session ) {
				$cookie_id = ( 'homepage' == $id ) ? 'loftloader_pro_homepage_once_per_session_visited' : 'loftloader_pro_once_per_session_visited';
				return empty( $_COOKIE[ $cookie_id ] ) || ( 'on' != $_COOKIE[ $cookie_id] );
			} else {
				return true;
			}
		}
		/**
		* Test current device and check whether to show loftloader
		* @return boolean
		*/
		protected function device_test() {
			// Always return true when in customizer page.
			if ( is_customize_preview() ) { 
				return true; 
			}

			$device = llp_get_loader_setting( 'loftloader_pro_device' );
			$is_mobile = wp_is_mobile();
			switch ( $device ) {
				case 'all':
					return true;
				case 'notmobile':
					return !$is_mobile;
				case 'mobileonly':
					return $is_mobile;
				defaults:
					return false;
			}
		}
		/**
		* Check if enable insite page transition
		* @return boolean
		*/
		protected function test_insite_transition() {
			return llp_module_enabled( 'loftloader_pro_insite_transition' ) 
				&& ( 'none' != llp_get_loader_setting( 'loftloader_bgfilltype') )
				&& ! in_array( llp_get_loader_setting( 'loftloader_pro_show_range'), array( 'once', 'homepage-once' ) );
			
		}
		/**
		* Get initial styles for <html>
		*/
		protected function get_html_styles() {
			$bg_type 				= llp_get_loader_setting( 'loftloader_bgfilltype' );
			$gradient_angel 		= llp_get_loader_setting( 'loftloader_pro_bg_gradient_angel' );
			$gradient_start_color 	= llp_get_loader_setting( 'loftloader_pro_bg_gradient_start_color' );
			$gradient_end_color 	= llp_get_loader_setting( 'loftloader_pro_bg_gradient_end_color' );
			$image_url 				= llp_get_loader_setting( 'loftloader_pro_bg_image' );
			$styles 				= sprintf( 'background-color: %s;', llp_get_loader_setting( 'loftloader_pro_bg_color' ) );

			switch ( $bg_type ) {
				case 'solid':
					if ( llp_module_enabled( 'loftloader_pro_bg_gradient' ) ) {
						$gradient 	= sprintf( '(%sdeg, %s, %s);', $gradient_angel, $gradient_start_color, $gradient_end_color );
						$prefix 	= array( '-webkit-linear-gradient', '-o-linear-gradient', '-moz-linear-gradient', 'linear-gradient' );
						foreach( $prefix as $p ) {
							$styles	.= sprintf( ' background-image: %s%s', $p, $gradient );
						}
					}
					break;
				case 'image':
					if ( ! empty( $image_url ) ) {
						$styles .= sprintf( ' background-image: url(%s);', esc_url( $image_url ) );
					}
					break;
			}
			return $styles;
		}
		/**
		* Test is woocommerce shop page
		*/
		protected function is_woocommerce_shop() {
			if ( function_exists( 'is_shop' ) ) {
				$page_id = wc_get_page_id( 'shop' );
				return !empty( $page_id ) && ( $page_id !== -1 ) && is_shop();
			}

			return false;
		}
		/**
		* Test if current request is for single page not archive page
		* @param mix 
		* @return boolean
		*/
		protected function is_singles( $query ) {
			return is_object( $query ) && ( 'WP_Post' == get_class( $query ) );
		}
	}
	new LoftLoader_Pro_Frontend_Manager();
}