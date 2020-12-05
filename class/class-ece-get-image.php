<?php
/**
 * Exif CE get image data.
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
 * Get image data.
 */
class Ece_Get_Image {
	/**
	 * Type.
	 *
	 * @var string
	 */
	private $type;

	/**
	 * Items.
	 *
	 * @var array
	 */
	private $items;

	/**
	 * Getter -> items.
	 */
	public function get_items() {
		return $this->items;
	}

	/**
	 * Construct.
	 *
	 * @param string $type type.
	 * @param array  $items Image array.
	 */
	public function __construct( string $type, array $items ) {
		$this->type  = $type;
		$this->items = $items;
	}

	/**
	 * Return image data array.
	 */
	public static function return_image_data() {
		require_once __DIR__ . '/class-ece-image-data.php';
		$images      = get_posts( 'post_type=attachment' );
		$regex_url   = get_site_url() . '/';
		$return_data = [];
		foreach ( $images as $image ) {
			$image_path = ABSPATH . str_replace( $regex_url, '', $image->guid );
			if ( 'image/jpeg' === (string) mime_content_type( $image_path ) ) {
				$exif_data = exif_read_data( $image_path );
				if ( false !== $exif_data && isset( $exif_data['GPSLatitude'] ) ) {
					$return_data[] = new Ece_Image_Data(
						$image->ID,
						$image->post_title,
						$image->guid,
						$image->post_date,
						$exif_data,
					);
				}
			}
		}
		return new Ece_Get_Image(
			'Exif Images',
			$return_data,
		);
	}
}
