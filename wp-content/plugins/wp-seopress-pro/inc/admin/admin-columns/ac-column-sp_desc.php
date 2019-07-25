<?php
defined( 'ABSPATH' ) or die( 'Please don&rsquo;t call the plugin directly. Thanks :)' );

class AC_Column_sp_desc extends \AC\Column {

	public function __construct() {

		$this->set_type( 'column-sp_desc' );

		$this->set_label( __( 'Meta description', 'wp-seopress-pro' ) );
	}

	/**
	 * Returns the display value for the column.
	 *
	 * @param int $id ID
	 * @return string Value
	 */
	public function get_value( $post_id ) {

		$value = $this->get_raw_value( $post_id );

		$value = esc_html($value);

		return $value;
	}

	/**
	 * Get the raw, underlying value for the column
	 * Not suitable for direct display, use get_value() for that
	 * This value will be used by 'inline-edit' and get_value().
	 *
	 * @param int $id ID
	 * @return mixed Value
	 */
	public function get_raw_value( $post_id ) {

		$value = esc_html(get_post_meta( $post_id, '_seopress_titles_desc', true ));

		return $value;
	}
}