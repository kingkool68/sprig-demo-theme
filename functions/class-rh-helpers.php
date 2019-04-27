<?php
/**
 * Helper functions that do various things
 */
class RH_Helpers {

	/**
	 * Get an instance of this class
	 */
	public static function get_instance() {
		static $instance = null;
		if ( null === $instance ) {
			$instance = new static();
		}
		return $instance;
	}

	/**
	 * Calculate various formats for a given date
	 *
	 * @param  string $date The date to convert to other formats
	 * @return object       The date in other formats
	 */
	public static function get_date_values( $date = '' ) {
		$date = strtotime( $date );
		return (object) array(
			'machine_date'     => date( DATE_W3C, $date ),
			'display_date'     => date( get_option( 'date_format' ), $date ),
			'display_time'     => date( get_option( 'time_format' ), $date ),
			'display_datetime' => date( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), $date ),
		);
	}
}
RH_Helpers::get_instance();
