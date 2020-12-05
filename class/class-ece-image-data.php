<?php
/**
 * Exif CE admin page class.
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
 * Image data.
 */
class Ece_Image_Data {
	/**
	 * ID.
	 *
	 * @var int
	 */
	private $id;

	/**
	 * File name.
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Image URL.
	 *
	 * @var string
	 */
	private $image;

	/**
	 * Post date.
	 *
	 * @var string
	 */
	private $date;

	/**
	 * Exif.
	 *
	 * @var array
	 */
	private $exif;

	/**
	 * Getter -> ID.
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Getter -> File name.
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * Getter -> Image URL.
	 */
	public function get_image() {
		return $this->image;
	}

	/**
	 * Getter -> Date.
	 */
	public function get_date() {
		return $this->date;
	}

	/**
	 * Getter -> Exif.
	 */
	public function get_exif() {
		return $this->exif;
	}

	/**
	 * Construct.
	 *
	 * @param int    $id ID.
	 * @param string $name File name.
	 * @param string $image Image URL.
	 * @param string $date Add date.
	 * @param array  $exif Exif date.
	 */
	public function __construct( int $id, string $name, string $image, string $date, array $exif ) {
		$this->id    = $id;
		$this->name  = $name;
		$this->image = $image;
		$this->date  = $date;
		$this->exif  = $exif;
	}
}
