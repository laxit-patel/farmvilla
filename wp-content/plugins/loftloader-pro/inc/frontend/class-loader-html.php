<?php
// Not allowed by directly accessing.
if ( ! defined( 'ABSPATH' ) ) {
	die( 0 );
}

if ( ! class_exists( 'LoftLoader_Pro_Frontend_Loader_HTML' ) ) {
	/**
	 * @since version 1.1.9
	 */
	class LoftLoader_Pro_Frontend_Loader_HTML {
		private $bg_type 	= ''; // Loader background type
		private $type 		= ''; // Loader type
		private $ending 	= ''; // Loader screen end effect
		public function __construct() {
			add_action( 'loftloader_pro_init_front', array( $this, 'init_front' ), 1 );
		}
		/**
		* Run after loader enable testing passed
		*/
		public function init_front() {
			$this->init();
			add_filter( 'loftloader_pro_loader_classes', 	array( $this, 'mobile_loader_class' ) );
			// Register cache callback filters
			add_filter( 'loftloader_pro_modify_html', 		array( $this, 'inject_loader_html' ) );
		}
		/**
		* Initialize global settings
		*/
		private function init() {
			$this->type 	= llp_get_loader_setting( 'loftloader_animation' );
			$this->bg_type 	= llp_get_loader_setting( 'loftloader_bgfilltype' );
			$this->ending 	= llp_get_loader_setting( 'loftloader_pro_bg_animation' );
		}
		/**
		* Inject loader html right after open <body> tag
		*
		* @param string original html string
		* @return string modified html string
		*/
		public function inject_loader_html( $origin ) {
			$origin = $this->modify_html_tag( $origin );

			$regexp ='/(<body[^>]*>)/i';
			$split = preg_split( $regexp, $origin, 3, PREG_SPLIT_DELIM_CAPTURE );
			if ( is_array( $split ) && ( count( $split ) >= 3 ) ) { 
				$is_customize_preview 	= is_customize_preview();
				$number 				= $is_customize_preview ? 100 : 0;
				$bg_image 				= llp_check_image_url( llp_get_loader_setting( 'loftloader_pro_bg_image' ) );
				$bg_image_class 		= $this->get_image_bg_class();
				$loader_bg_html 		= $this->check_mobile() ? '<div class="loader-bg-half"></div><div class="loader-bg-half"></div>' : '';

				$img 				= llp_check_image_url( llp_get_loader_setting( 'loftloader_customimg' ) );
				$html 				= sprintf( '<div id="loftloader-wrapper"%s%s><div class="loader-inner">', $this->loader_classes(), $this->loader_attributes() );
				$progress_type 		= llp_get_loader_setting( 'loftloader_progress' );
				$bar_load_inner 	= ( 'bar-number' == $progress_type ) ? sprintf( '<span class="load-count">%s%s</span>', $number, '%' ) : '';
				$bar_position 		= llp_get_loader_setting( 'loftloader_barposition' );
				$message 			= $this->get_message( $is_customize_preview );
				$message_position 	= $this->get_message_position();

				$html .= ( 'top' === $message_position ) ? $message : ''; // If message position == top

				// If progress with percentage and message, wrap the loader and percentage
				$html .= ( ( $progress_type == 'number' ) && !empty( $message ) ) ? '<div class="with-percentage">' : '';

				/***** Loader html start *****/
				$html .= '<div id="loader">';
				if ( ! empty( $img ) ) {
					// <!-- Only  image loading need the span with background -->
					if ( in_array( $this->type, array( 'imgloading' ) ) ) {
						$html .= $this->get_loader_type_loading_bg_image( $img );
					}
					if ( in_array( $this->type, array( 'frame', 'imgloading', 'imgrotating', 'imgbouncing', 'imgstatic', 'imgfading' ) ) ) {
						$html .= sprintf( '<img src="%s">', $img );
					}
				}

				// <!-- Image rotating/bouncing/imgloading: no need the span below -->
				$html .= in_array( $this->type, array( 'imgrotating', 'imgbouncing', 'imgloading', 'imgfading' ) ) ? '' : '<span></span>';
				$html .= '</div>'; 
				/***** Loader html end  ******/

				$html .= ( ( 'middle' === $message_position ) && ( 'none' === $progress_type ) ) ? $message : ''; // if message position == middle

				/***** Progress html start *****/
				//<!-- percentage html code put here, no matter which position selected -->
				$percentage_position 	= ( 'middle' == llp_get_loader_setting('loftloader_percentageposition') ) ? ' middle' : '';
				$percentage_layer 		= ( 'front' == llp_get_loader_setting('loftloader_progresslayer') ) ? ' front' : '';
				$bar_init 				= $is_customize_preview ? '' : ' style="transform: scaleX(0);"';
				if ( 'number' == llp_get_loader_setting( 'loftloader_progress' ) ) {
					if ( ( 'middle' === $message_position ) && ( '' == $percentage_position ) ) { 
						$html .= $message;
					}
					$html .= sprintf(
						'<span class="percentage%s%s">%s%s</span>',
						$percentage_position,
						$percentage_layer,
						$number,
						'%'
					);
				}

				// End the wrap for loader with percentage and message
				$html .= ( ( 'number' == $progress_type ) && !empty( $message ) ) ? '</div>' : '';

				//<!-- when it is a progress bar, and choose middle, then put the html code here. -->
				$html .= ( in_array( $progress_type, array( 'bar', 'bar-number' ) ) && ( 'middle' == $bar_position ) ) ? sprintf(
					'%s<span class="bar"><span class="load"%s></span>%s</span>',
					( 'middle' === $message_position ) ? $message : '',
					$bar_init,
					$bar_load_inner
				) : '';
				/****** Progress html end *****/

				$html .= ( 'bottom' === $message_position ) ? $message : ''; // if message position == bottom
				$html .= '</div>';
				$html .= ( in_array( $progress_type, array( 'bar', 'bar-number' ) ) && in_array( $bar_position, array( 'top', 'bottom' ) ) ) ? sprintf(
					'<span class="bar %s"><span class="load"%s></span>%s</span>',
					$bar_position,
					$bar_init,
					$bar_load_inner
				) : '';
				/***** Loader background html ***/
				if ( in_array( $this->bg_type, array( 'solid', 'image' ) ) ) {
					$html .= sprintf( '<div class="loader-bg%s">%s</div>', $bg_image_class, $loader_bg_html );
				} 
				/***** Loader close button *******/
				if ( ! is_customize_preview() ) {
					$close_description = llp_get_loader_setting( 'loftloader_pro_show_close_tip' );
					$html .= sprintf(
						'<div class="loader-close-button" style="display: none;"><span class="screen-reader-text">%s</span>%s</div>',
						esc_html__( 'Close', 'loftloader-pro' ),
						empty( $close_description ) ? '' : sprintf( '<span class="close-des">%s</span>', $close_description )
					);
				}
				$html .= '</div>';

				return $split[0] . $split[1] . $html . implode( '', array_slice( $split, 2 ) );
			} else {
				return $origin;
			}
		}
		/**
		* Add class to loader wrapper if needed
		* 
		* @param array class list
		* @return array class list
		*/
		public function mobile_loader_class( $classes = array() ) {
			if ( $this->check_mobile() ) { 
				array_push( $classes, 'mobile' );
			}
			return $classes;
		}
		/**
		* Helper function to check if currently is mobile
		*
		* @return boolean
		*/
		private function check_mobile() {
			$ending = $this->ending;
			$repeat = llp_get_loader_setting( 'loftloader_pro_bg_image_repeat' );
			if ( ( $this->bg_type == 'image' ) && ( $this->test_firefox() || wp_is_mobile() ) ) {
				if ( in_array( $ending, array( 'split-reveal-v', 'split-reveal-h' ) ) ) {
					return true;
				} elseif ( in_array( $ending, array( 'split-h', 'split-v', 'split-diagonally-h', 'split-diagonally-v' ) ) && ( $repeat != 'tile' ) ) {
					return true;
				}
			}
			return false;
		}
		/**
		* Helper function to test if current visit is from firefox
		*
		* @return boolean
		*/
		private function test_firefox() {
			if ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
				$u_agent = $_SERVER['HTTP_USER_AGENT']; 
				return preg_match( '/Firefox/i', $u_agent );
			}
			return false;
		}
		/**
		* Get classes for loftloader wrap
		*
		* @return string html class attribute
		*/
		private function loader_classes() {
			$classes 	= array();
			$directions = array( '2d' => 'twod', '3d-y' => 'threed-y', '3d-x' => 'threed-x' );
			$type 		= sprintf( 'loftloader-%s', $this->type );
			$ending 	= $this->ending;
			switch( $ending ) {
				case 'split-reveal-v':
					$ending = 'split-h split-reveal-v';
					break;
				case 'split-reveal-h':
					$ending = 'split-v split-reveal-h';
					break;
				case 'split-diagonally-v':
					$ending = 'split-v split-diagonally';
					break;
				case 'split-diagonally-h':
					$ending = 'split-h split-diagonally';
					break;
			}
			array_push( $classes, sprintf( 'end-%s', $ending ) );
			array_push( $classes, $type );
			// For loader type image bouncing
			if ( 'imgbouncing' === $this->type ) { 
				if ( 'on' == llp_get_loader_setting( 'loftloader_bouncerolling' ) ) {
					array_push( $classes, 'loftloader-rolling' );
				}
				if ( is_customize_preview() ) {
					array_push( $classes, 'runshadow' );
				}
			}
			// If set the progress
			if ( 'none' !== llp_get_loader_setting( 'loftloader_progress' ) ) {
				array_push( $classes, 'loftloader-progress' );
			}
			// If set to loop for specific loader types
			if ( in_array( $type, array( 'loftloader-imgloading', 'loftloader-rainbow', 'loftloader-circlefilling', 'loftloader-waterfilling', 'loftloader-petals' ) ) ) {
				array_push( $classes, sprintf( 'loftloader-%s', llp_get_loader_setting( 'loftloader_looping' ) ) );
			}
			// For loader type crossing
			if ( in_array( $type, array( 'loftloader-crossing' ) ) ) {
				array_push( $classes, sprintf( 'loftloader-blendmode-%s', llp_get_loader_setting( 'loftloader_blendmode' ) ) );
			}
			// For loader type image loading
			if ( in_array( $type, array( 'loftloader-imgloading' ) ) ) { 
				$img_load_direction = llp_get_loader_setting( 'loftloader_loaddirection' );
				array_push( $classes, sprintf( 'imgloading-%s',  $img_load_direction ) );
				if ( 'vertical' == $img_load_direction ) {
					array_push( $classes, llp_get_loader_setting( 'loftloader_custom_image_loading_vertical_direction' ) );
				}
			}
			// For loader type image rotating
			if ( in_array( $type, array( 'loftloader-imgrotating' ) ) ){
				$img_rotate_direction = llp_get_loader_setting( 'loftloader_rotatedirection' );
				$img_rotate_2d = llp_get_loader_setting( 'loftloader_rotation_2d' ); 
				array_push( $classes, $directions[ $img_rotate_direction ] );
				array_push( $classes, llp_get_loader_setting( 'loftloader_rotate_curve' ) );
				if ( ( '2d' == $img_rotate_direction ) && ! empty( $img_rotate_2d ) ) {
					array_push( $classes, $img_rotate_2d );
				}
			}
			// Inner Elements Animation
			$entrance_animation = llp_get_loader_setting( 'loftloader_pro_inner_elements_entrance_animation' );
			$exit_animation		= llp_get_loader_setting( 'loftloader_pro_inner_elements_exit_animation' );
			if ( ! empty( $entrance_animation ) ) {
				array_push( $classes, $entrance_animation );
			}
			if ( ! empty( $exit_animation ) ) {
				array_push( $classes, $exit_animation );
			}
			// Run filters if any changes from other plugins or theme currently used
			$classes = array_filter( $classes, function( $val ) { return ! empty( $val ) && ( 'false' !== $val ); } );
 			$classes = apply_filters( 'loftloader_pro_loader_classes', $classes );
 			// Returen the class attribute
			return empty( $classes ) ? '' : sprintf( ' class="%s"', implode( ' ', $classes ) );
		}
		/**
		* Get loader wrapper attributes
		*
		* @return string
		*/
		private function loader_attributes() {
			$attrs = '';
			$load_time = llp_get_loader_setting( 'loftloader_pro_load_time' );
			$load_time = number_format( $load_time, 1, '.', '' );
			if ( ! empty( $load_time ) && is_numeric( $load_time ) ) {
				$attrs .= sprintf( ' data-load-time="%s"', ( $load_time * 1000 ) );
			}
			$show_close_time = llp_get_loader_setting( 'loftloader_pro_show_close_timer' );
			$show_close_time = number_format( $show_close_time, 0, '.', '' );
			$attrs .= sprintf( ' data-show-close-time="%s"', esc_js( esc_attr( $show_close_time * 1000 ) ) );
			return apply_filters( 'loftloader_pro_loader_attributes', $attrs );
		}
		/**
		* Modify attributes of open <html> tag if needed
		*
		* @param html string the original html
		* @return html string the modified html string
		*/
		private function modify_html_tag( $html ) {
			if ( ! empty( $html ) ) {
				$regexp_html ='/(<html[^>]*)/i';
				$split = preg_split( $regexp_html, $html, 0, PREG_SPLIT_DELIM_CAPTURE );
				if ( is_array( $split ) && ( count( $split ) >= 3 ) ) {
					for( $i = 1; $i < ( count( $split ) - 1 ); $i = ( $i + 2 ) ) { 
						$current_html = $split[ $i ];
						if ( ! empty( $current_html ) ) {
							$regexp_class ='/class\s*=\s*["\']([^"\']*)["\']/i';
							$attrs = preg_split( $regexp_class, $current_html, 3, PREG_SPLIT_DELIM_CAPTURE );
							if ( is_array( $attrs ) && ( count( $attrs ) == 3 ) ) {
								$exist_class = empty( $attrs[1] ) ? array() : explode( ' ', $attrs[1] );
								// Add no-js class name to <html> if currently not set
								in_array( 'no-js', $exist_class ) ? '' : array_push( $exist_class, 'no-js' );

								$classes = sprintf( 'class="%s"', implode( ' ', $exist_class ) );
								$attrs = $attrs[0] . $classes . $attrs[2];
							} else{
								$attrs = sprintf( '%s class="no-js"', $current_html );
							}
							$split[ $i ] = $attrs;
						}
					}
					$html = implode( '', $split );
				}
			}
			return $html;
		}
		/**
		* Get background class list for image background
		*/
		private function get_image_bg_class() {
			$class = array();
			$bg_image = llp_get_loader_setting( 'loftloader_pro_bg_image' );
			if ( ( 'image' == $this->bg_type ) && !empty( $bg_image ) ) { 
				if ( 'tile' == llp_get_loader_setting( 'loftloader_pro_bg_image_repeat') ){
					array_push( $class, 'bg-img pattern' );
				} else {
					if ( 'contain' == llp_get_loader_setting( 'loftloader_pro_bg_image_size' ) ) {
						array_push( $class, 'bg-contain' );
					} 
					array_push( $class, 'bg-img' );
					array_push( $class, 'full' );
				}
			}
			return empty( $class ) ? '' : sprintf( ' %s', implode(' ', $class ) );
		}
		/**
		* Background image for loader type loading with custom image
		*
		* @param url image url
		* @return string html
		*/
		private function get_loader_type_loading_bg_image( $image ) {
			return sprintf(
				'<div class="imgloading-container"><span style="background-image: url(%s); display: none !important;"></span></div>',
				$image
			);
		}
		/**
		* Get loader message position
		*/
		private function get_message_position() {
			$progress_type 			= llp_get_loader_setting( 'loftloader_progress' );
			$percentage_position 	= llp_get_loader_setting( 'loftloader_percentageposition' );
			$bar_position 			= llp_get_loader_setting( 'loftloader_barposition' );
			$message_position 		= llp_get_loader_setting( 'loftloader_pro_message_position' );

			if ( ( ('bar' === $progress_type ) && ( 'middle' === $bar_position ) )
				|| ( ( 'number' === $progress_type ) && ( 'below' === $percentage_position ) ) ) {
				return $message_position;
			} else {
				return ( 'middle' === $message_position ) ? 'bottom' : $message_position;
			}
		}
		/**
		* Get message text
		*/
		protected function get_message( $is_customize_preview ) {
			$raw_message = '';
			if ( 'on' == llp_get_loader_setting( 'loftloader_pro_enable_random_message_text' ) ) {
				$messages = trim( llp_get_loader_setting( 'loftloader_pro_random_message_text' ) );
				if ( ! empty( $messages ) ) {
					if ( 'on' == llp_get_loader_setting( 'loftloader_pro_render_random_message_by_js' ) ) {
						return '<div class="loader-message">&nbsp;</div>';
					} else {
						$raw_message = llp_get_random_message();
						return empty( $raw_message ) && ! $is_customize_preview ? '' : sprintf( 
							'<div class="loader-message">%s</div>', 
							llp_sanitize_message_text( $raw_message ) 
						);
					}

				} else {
					return $is_customize_preview ? '<div class="loader-message"></div>' : '';
				}
			} else {
				$raw_message = llp_get_loader_setting( 'loftloader_pro_message_text' );
				return empty( $raw_message ) && ! $is_customize_preview ? '' : sprintf( 
					'<div class="loader-message">%s</div>', 
					llp_sanitize_message_text( $raw_message ) 
				);
			}
		}
	}
	new LoftLoader_Pro_Frontend_Loader_HTML();
}