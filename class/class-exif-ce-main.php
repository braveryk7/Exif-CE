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
				echo '<div class="wrap">';
				echo '<h1>Exif CE</h1>';
				$table->prepare_items();
				$table->display();
				echo '</div>';
			}
		);
	}
}
