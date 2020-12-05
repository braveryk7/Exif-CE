<?php
/**
 * Exif CE Main class.
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
 * Exif CE main class.
 */
class Exif_Ce_Main {
	/**
	 * WordPress Hook.
	 */
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'image_lists' ] );
	}

	/**
	 * Insert Admin menu > Tools.
	 */
	public function image_lists() {
		require_once __DIR__ . '/class-ece-image-list-table.php';
		$table = new Ece_Image_List_Table();
		add_management_page(
			__( 'Exif CE', 'exif-ce' ),
			__( 'Exif CE', 'exif-ce' ),
			'manage_options',
			'exif-ce',
			function() use ( $table ) {
				?>
				<div class="wrap">
					<h1>Exif CE</h1>
					<p>Exif情報が付与されている画像が表示されています（Exif情報が無い画像、pngやgif等のExif情報を持てない画像は表示されません）</p>
					<p>GPS欄に緯度と経度が表示されている場合、撮影した地点が簡単に分かってしまいます。</p>
					<p>意図せず撮影地点が記録されている場合、画像からExif情報を削除してください。</p>
					<?php $table->prepare_items(); ?>
					<?php $table->display(); ?>
				</div>
				<?php
			}
		);
	}
}
