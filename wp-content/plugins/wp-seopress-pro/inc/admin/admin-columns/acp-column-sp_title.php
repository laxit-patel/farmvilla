<?php
defined( 'ABSPATH' ) or die( 'Please don&rsquo;t call the plugin directly. Thanks :)' );

class ACP_Column_sp_title extends AC_Column_sp_title
	implements \ACP\Editing\Editable, \ACP\Sorting\Sortable, \ACP\Export\Exportable {

	public function editing() {
		return new ACP_Editing_Model_sp_title( $this );
	}

	public function sorting() {
		return new ACP_Sorting_Model_sp_title( $this );
	}

	public function export() {
		return new ACP_Export_Model_sp_title( $this );
	}

}

/**
 * Editing class. Adds editing functionality to the column.
 */
class ACP_Editing_Model_sp_title extends \ACP\Editing\Model {

	/**
	 * Editing view settings
	 *
	 * @return array Editable settings
	 */
	public function get_view_settings() {

		// available types: text, textarea, media, float, togglable, select, select2_dropdown and select2_tags
		$settings = array(
			'type' => 'text',
		);

		return $settings;
	}

	/**
	 * Saves the value after using inline-edit
	 *
	 * @param int $id Object ID
	 * @param mixed $value Value to be saved
	 */
	public function save( $id, $value ) {

		// Store the value that has been entered with inline-edit
		// For example: update_post_meta( $id, '_my_custom_field_example', $value );
		update_post_meta($id, '_seopress_titles_title', esc_html($value));

	}

}

/**
 * Sorting class. Adds sorting functionality to the column.
 */
class ACP_Sorting_Model_sp_title extends \ACP\Sorting\Model {

	/**
	 * (Optional) Put all the sorting logic here. You can remove this function if you want to sort by raw value only.
	 *
	 * @return array
	 */
	public function get_sorting_vars() {
		$values = array();

		// Loops through all the available post/user/comment id's
		foreach ( $this->strategy->get_results() as $id ) {

			// Start editing here.

			// Put all the column logic here to retrieve the value you need
			// For example: $value = get_post_meta( $id, '_my_custom_field_example', true );

			$value = $this->column->get_raw_value( $id );

			// Stop editing.

			$values[ $id ] = $value;
		}

		// Sorts the array and return all id's to the main query
		return array(
			'ids' => $this->sort( $values ),
		);

	}

}

/**
 * Export class. Adds export functionality to the column.
 */
class ACP_Export_Model_sp_title extends \ACP\Export\Model {

	public function get_value( $id ) {

		// Start editing here.

		// Add the value you would like to be exported.
		// For example: $value = get_post_meta( $id, '_my_custom_field_example', true );

		$value = $this->column->get_raw_value( $id );

		// Stop editing.

		return $value;
	}

}