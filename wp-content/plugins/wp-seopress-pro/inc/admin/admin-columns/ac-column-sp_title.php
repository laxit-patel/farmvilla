<?php
defined( 'ABSPATH' ) or die( 'Please don&rsquo;t call the plugin directly. Thanks :)' );

class AC_Column_sp_title extends \AC\Column {

	public function __construct() {

		// Identifier, pick an unique name. Single word, no spaces. Underscores allowed.
		$this->set_type( 'column-sp_title' );

		// Default column label.
		$this->set_label( __( 'Meta title', 'wp-seopress-pro' ) );
	}

	/**
	 * Returns the display value for the column.
	 *
	 * @param int $id ID
	 * @return string Value
	 */
	public function get_value( $post_id ) {

		// get raw value
		$value = $this->get_raw_value( $post_id );

		// optionally you can change the display of the value. In this example we added a post link.
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

		// put all the column logic here to retrieve the value you need
		// For example: $value = get_post_meta( $post_id, '_my_custom_field_example', true );

		$value = esc_html(get_post_meta( $post_id, '_seopress_titles_title', true ));

		return $value;
	}
}