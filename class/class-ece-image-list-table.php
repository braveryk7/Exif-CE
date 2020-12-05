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
 * Admin page image list.
 */
class Ece_Image_List_Table extends WP_List_Table {
	/**
	 * Construct.
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Set List array.
	 */
	public function prepare_items() {
		require_once __DIR__ . '/class-ece-get-image.php';
		$info        = Ece_Get_Image::return_image_data();
		$this->items = $info->get_items();
	}

	/**
	 * Get columns data.
	 */
	public function get_columns() {
		return [
			'cb'   => 'チェックボックス',
			'id'   => 'ID',
			'exif' => 'Exif',
			'gps'  => 'GPS',
			'date' => '日付',
		];
	}

	/**
	 * Return oneline.
	 *
	 * @param array $item Image array.
	 */
	public function single_row( $item ) {
		require_once __DIR__ . '/class-ece-location-conversion.php';
		$latitude  = new Ece_Location_Conversion( $item->get_exif()['GPSLatitudeRef'], $item->get_exif()['GPSLatitude'] );
		$ns        = $latitude->conversion_exif();
		$longitude = new Ece_Location_Conversion( $item->get_exif()['GPSLongitudeRef'], $item->get_exif()['GPSLongitude'] );
		$ew        = $longitude->conversion_exif();
		list($columns, $hidden, $sortable, $primary) = $this->get_column_info();

		$id = $item->get_id();
		?>
		<tr>
			<td><input type="checkbox" name="checked[]" value="<?php echo esc_html( $id ); ?>"/></td>
			<td class="title column-title has-row-actions column-primary">
				<strong class="has-media-icon">
					<span class="media-icon image-icon">
						<img width="60" height="60" src="<?php echo esc_attr( $item->get_image() ); ?>" class="attachment-60x60 size-60x60" loading="lazy">
					</span>
					<?php echo esc_html( $item->get_name() ); ?>
				</strong>
				<p class="filename">
					<span class="screen-reader-text">ファイル名: </span>
					<?php echo esc_html( $item->get_exif()['FileName'] ); ?>
				</p>
			</td>
			<td>
				<p>使用機材：<?php echo esc_html( $item->get_exif()['Model'] ); ?></p>
				<p>撮影日時：<?php echo esc_html( gmdate( 'Y年n月j日 G時i分s秒', strtotime( $item->get_exif()['DateTime'] ) ) ); ?></p>
			</td>
			<td>
				<p>緯度：<?php echo esc_html( $ns ); ?></p>
				<p>経度：<?php echo esc_html( $ew ); ?></p>
			</td>
			<td>
				<p><?php echo esc_html( gmdate( 'Y年n月j日', strtotime( $item->get_date() ) ) ); ?></p>
			</td>
		</tr>
		<?php
	}
}
