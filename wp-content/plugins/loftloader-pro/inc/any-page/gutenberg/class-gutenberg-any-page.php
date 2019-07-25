<?php
/**
* Gutenberg Manager class
*/

if ( ! class_exists( 'LoftLoaderPro_Gutenberg_Any_Page' ) ) {
	class LoftLoaderPro_Gutenberg_Any_Page {
		/**
		* Array of post meta name list 
		*/
		public $page_meta_list = array(
			'loftloader_pro_show_once' => 'string',
			'loftloader_pro_page_shortcode' => 'string'
		);
		/**
		* Construct function
		*/
		public function __construct() {
			add_action( 'rest_api_init', array( $this, 'api_update_post_meta' ) );
			add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_editor_assets' ) );
			$this->register_metas();
		}
		/**
		* Enqueue editor assets
		*/
		public function enqueue_editor_assets() {
			switch ( $this->get_current_post_type() ) {
				case 'page':
					wp_enqueue_script(
						'loftloader-pro-gutenberg-any-page-script',
						LOFTLOADERPRO_URI. 'inc/any-page/gutenberg/plugin.js',
						array( 'wp-blocks', 'wp-element', 'wp-i18n' ), 
						LOFTLOADERPRO_ASSET_VERSION, 
						true
					);
					break;
			}
		}
		/**
		* Register metas for gutenberg
		*/
		public function register_metas() {
			foreach( $this->page_meta_list as $id => $type ) {
				register_meta( 'post', $id, array(
					'auth_callback' => array( $this, 'permission_check' ),
					'show_in_rest' 	=> true,
					'single' 		=> true,
					'type' 			=> $type
				) );
			}
		}
		/**
		* Check permission for meta registration
		*/
		public function permission_check( $arg1, $meta_name, $post_id ) {
			return current_user_can( 'edit_post', $post_id );
		}
		/**
		* Update post metas from gutenberg
		*/
		public function api_update_post_meta() {
			register_rest_route(
				'loftloaderpro/v2', '/update-meta', array(
					'methods'  => 'POST',
					'callback' => array( $this, 'update_callback' ),
					'args'	 => array(
						'id' => array(
							'sanitize_callback' => 'absint',
						)
					)
				)
			);
		}
		/**
		 * Hello Gutenberg REST API Callback for Gutenberg
		 */
		function update_callback( $data ) {
			$post_id = $data['id'];
			switch ( get_post_type( $post_id ) ) {
				case 'page':
					$meta_names = array_keys( $this->page_meta_list );
					break;
				default: 
					$meta_names = array();
			}
			foreach( $meta_names as $meta_name ) {
				update_post_meta( $post_id, $meta_name, $data[ $meta_name ] );
			}
			return true;
		}
		/**
		* Get current post type
		* @return mix post type string or boolean false
		*/
		protected function get_current_post_type() {
			global $post;
			if ( is_admin() && ! empty( $post ) && ! empty( $post->post_type ) ) {	
				return $post->post_type;
			} else {
				return false;
			}
		}
	}
	function llp_init_gutenberg_any_page() {
		new LoftLoaderPro_Gutenberg_Any_Page();
	}
	add_action( 'init', 'llp_init_gutenberg_any_page' );
}