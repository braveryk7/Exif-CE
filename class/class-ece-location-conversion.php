<?php
/**
 * Exif CE GPS location conversion class.
 *
 * @author Ken-chan
 * @package WordPress
 * @subpackage Exif CE
 * @since 0.0.1
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'You do not have access rights.' );
}

/**
 * Convert location.
 */
class Ece_Location_Conversion {
	/**
	 * North, South, East, West.
	 *
	 * @var string
	 */
	private $direction;

	/**
	 * GPS data.
	 *
	 * @var int
	 */
	private $gps;

	/**
	 * Constructer.
	 *
	 * @param string $direction Direction.
	 * @param array  $gps GPS data.
	 */
	public function __construct( string $direction, array $gps ) {
		$this->direction = $direction;
		$this->gps       = $gps;
	}

	/**
	 * Exif GPS data conversion.
	 */
	public function conversion_exif() {
		$return_data = $this->convert_float( $this->gps[0] ) + ( $this->convert_float( $this->gps[1] ) / 60 ) + ( $this->convert_float( $this->gps[2] ) / 3600 );

		return 'S' === $this->direction || 'W' === $this->direction ? $return_data * -1 : $return_data;
	}

	/**
	 * Convert to decimal.
	 *
	 * @param string $str GPS location.
	 */
	private function convert_float( $str ) {
		$split_str = explode( '/', $str );
		return isset( $split_str[1] ) ? $split_str[0] / $split_str[1] : $split_str;
	}
}
