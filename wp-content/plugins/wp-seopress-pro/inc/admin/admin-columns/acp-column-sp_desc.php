<?php
defined( 'ABSPATH' ) or die( 'Please don&rsquo;t call the plugin directly. Thanks :)' );

class ACP_Column_sp_desc extends AC_Column_sp_desc
	implements \ACP\Editing\Editable, \ACP\Sorting\Sortable, \ACP\Export\Exportable {

	public function editing() {
		return new ACP_Editing_Model_sp_desc( $this );
	}

	public function sorting() {
		return new ACP_Sorting_Model_sp_desc( $this );
	}

	public function export() {
		return new ACP_Export_Model_sp_desc( $this );
	}

}

/**
 * Editing class. Adds editing functionality to the column.
 */
class ACP_Editing_Model_sp_desc extends \ACP\Editing\Model {

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
		update_post_meta($id, '_seopress_titles_desc', esc_html($value));
	}

}

/**
 * Sorting class. Adds sorting functionality to the column.
 */
class ACP_Sorting_Model_sp_desc extends \ACP\Sorting\Model {

	/**
	 * (Optional) Put all the sorting logic here. You can remove this function if you want to sort by raw value only.
	 *
	 * @return array
	 */
	public function get_sorting_vars() {
		$values = array();

		foreach ( $this->strategy->get_results() as $id ) {

			$value = $this->column->get_raw_value( $id );

			$values[ $id ] = $value;
		}

		return array(
			'ids' => $this->sort( $values ),
		);

	}

}

/**
 * Export class. Adds export functionality to the column.
 */
class ACP_Export_Model_sp_desc extends \ACP\Export\Model {

	public function get_value( $id ) {

		$value = $this->column->get_raw_value( $id );

		return $value;
	}

}