<?php
/**
* WP metabox for any page if gutenberg is not enabled
*/
if ( ! class_exists( 'LoftLoaderPro_Any_Page_MetaBox' ) ) {
	class LoftLoaderPro_Any_Page_MetaBox {
		/**
		* construct function
		*/
		public function __construct() {
			add_action( 'add_meta_boxes', 	array( $this, 'register_meta_boxes' ) );
			add_action( 'save_post', 		array( $this, 'save_meta' ), 10, 3 );
		}
		/*
		* Register loftloader shortcode meta box
		*/
		public function register_meta_boxes() {
			add_meta_box( 
				'loftloader_pro_any_page_meta', 
				esc_html__( 'LoftLoader Pro Any Page Shortcode', 'loftloader-pro' ), 
				array( $this, 'metabox_callback' ), 
				'page', 
				'advanced',
				'high',
				array(
					'__block_editor_compatible_meta_box' => true,
					'__back_compat_meta_box' => true
				)
			);
		}
		/*
		* Show meta box html
		*/
		public function metabox_callback( $post ) {
			$shortcode = get_post_meta( $post->ID, 'loftloader_pro_page_shortcode', true );
			$show_once = get_post_meta( $post->ID, 'loftloader_pro_show_once', true );

			$html  = sprintf(
				'<p><input type="checkbox" name="loftloader_pro_show_once" id="loftloader-pro-show-once" value="once"%s /><label for="loftloader-pro-show-once">%s</label></p>',
				( $show_once === 'on' ) ? ' checked' : '',
				esc_html__( 'Display the preloader on the page only once during a visitor session', 'loftloader-pro' )
			);
			$html .= '<textarea name="loftloader_pro_page_shortcode" style="width: 100%;" rows="4">' . str_replace( '/\\"/g', '\\\\"', $shortcode ) . '</textarea>';
			$html .= '<input type="hidden" name="loftloader_pro_any_page_nonce" value="' . wp_create_nonce( 'loftloader_pro_any_page_nonce' ) . '" />';

			echo $html;
		}
		/*
		* Save loftloader shortcode meta
		*/
		public function save_meta( $post_id, $post, $update ) {
			if ( empty( $update ) || ! in_array( $post->post_type, array( 'page' ) ) || empty( $_REQUEST['loftloader_pro_any_page_nonce'] ) || ! empty( $_REQUEST['loftloader_pro_gutenberg_enabled'] ) ) {
				return '';
			} 
			if ( current_user_can( 'edit_post', $post_id ) ) {
				update_post_meta( $post_id, 'loftloader_pro_page_shortcode', sanitize_text_field( $_REQUEST['loftloader_pro_page_shortcode'] ) );
				update_post_meta( $post_id, 'loftloader_pro_show_once', ( isset( $_REQUEST['loftloader_pro_show_once'] ) ? 'on' : '' ) );
			}
			return $post_id;
		}
	}
	new LoftLoaderPro_Any_Page_MetaBox();
}