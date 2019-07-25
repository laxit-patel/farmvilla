<?php
/**
 * Page settings metabox in pro.
 *
 * @package Hestia
 */

/**
 * Class Hestia_Metabox_Addon
 */
class Hestia_Metabox_Addon extends Hestia_Metabox_Main {

	/**
	 * Add controls.
	 */
	public function add_controls() {
		parent::add_controls();

		$control_settings = array(
			'label'           => esc_html__( 'Header Layout', 'hestia-pro' ),
			'choices'         => array(
				'default'      => array(
					'url' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqBAMAAACsf7WzAAAAD1BMVEU+yP/////Y9P/G7//V1dUbjhlcAAAAW0lEQVR4Ae3SAQmAYAyE0V9NMDCBCQxh/0wKGGCAIJ7vC3DA28ZvkjRVo49vzVujoeYFbF15i32pu4CtlCTVc+Vu2VqPRi9ssWfPnj179uzZs2fPnj179uwzt07LZ+4ImOW7JwAAAABJRU5ErkJggg==',
				),
				'no-content'   => array(
					'url' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqBAMAAACsf7WzAAAAElBMVEU+yP////88SFhjbXl1fonV1dUUDrn8AAAAXElEQVR4Ae3SMQ2AYAyEUSwAYOC3gAJE4N8KCztNKEPT9wm44eUmSZL0b3NeXbeWEaj41noEet/yCVs+cW7jqfjW12ztV6D8Lfbs2bNnz549e/bs2bNnz559060bqAJ8azq5sAYAAAAASUVORK5CYII=',
				),
				'classic-blog' => array(
					'url' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqBAMAAACsf7WzAAAAElBMVEX///88SFhjbXl1fok+yP/V1dWks4cUAAAAXElEQVR4Ae3SMQ2AQBBE0QNAwFlAASKwgH8rNNSwCdfs5j0BU/xMo6ypByTfmveAxmd7Wz5xLP2Rf4tf1jPAli1btl7YsmWL7QoYuoX22lelvfbaa6892mufifbcjgr1IbRYbwEAAAAASUVORK5CYII=',
				),
			),
			'active_callback' => array( $this, 'header_layout_meta_callback' ),
			'default'         => $this->get_header_default_value(),
		);

		$this->add_control(
			new Hestia_Metabox_Radio_Image(
				'hestia_header_layout',
				2,
				$control_settings
			)
		);
	}

	/**
	 * Get default value for header layout.
	 *
	 * @return string
	 */
	private function get_header_default_value() {

		if ( empty( $_GET['post'] ) ) {
			return '';
		}

		$page_id = (int) $_GET['post'];

		$post_type = get_post_type( $page_id );
		if ( 'jetpack-portfolio' === $post_type ) {
			return 'default';
		}

		if ( class_exists( 'WooCommerce' ) ) {
			$shop_id = get_option( 'woocommerce_shop_page_id' );
			if ( ! empty( $shop_id ) && $page_id === (int) $shop_id ) {
				return 'default';
			}

			$cart_id = get_option( 'woocommerce_cart_page_id' );
			if ( ! empty( $cart_id ) && $page_id === (int) $cart_id ) {
				return 'no-content';
			}

			$checkout_id = get_option( 'woocommerce_checkout_page_id' );
			if ( ! empty( $checkout_id ) && $page_id === (int) $checkout_id ) {
				return 'no-content';
			}
		}

		if ( 'page' === get_option( 'show_on_front' ) ) {
			if ( get_option( 'page_for_posts' ) == $page_id ) {
				return 'default';
			}
		}

		return get_theme_mod( 'hestia_header_layout', 'default' );

	}

	/**
	 * Function that decide if sidebar metabox should be shown.
	 *
	 * @return bool
	 */
	public function header_layout_meta_callback() {
		if ( $this->is_sections_front_page() ) {
			return false;
		}

		global $post;

		if ( empty( $post ) ) {
			return false;
		}

		$post_type = get_post_type( $post->ID );
		if ( 'jetpack-portfolio' === $post_type ) {
			return true;
		}

		return $this->is_allowed_template( $post->ID );
	}

	/**
	 * Detect if is a page with sidebar template
	 *
	 * @param string $post_id Post id.
	 *
	 * @return bool
	 */
	protected function is_allowed_template( $post_id ) {
		$allowed_templates = array(
			'default',
			'page-templates/template-fullwidth.php',
			'page-templates/template-page-sidebar.php',
		);

		$page_template = get_post_meta( $post_id, '_wp_page_template', true );
		if ( empty( $page_template ) ) {
			return true;
		}

		return in_array( $page_template, $allowed_templates );
	}
}
