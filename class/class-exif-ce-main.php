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
		add_action( 'admin_menu', [ $this, 'add_ece_menu' ] );
	}

	/**
	 * Insert Admin menu > Tools.
	 */
	public function add_ece_menu() {
		add_management_page(
			__( 'Exif CE', 'exif-ce' ),
			__( 'Exif CE', 'exif-ce' ),
			'manage_options',
			'exif-ce',
			[ 'Ece_Admin_Page', 'admin_page' ],
		);
	}
}
