<?php
/**
 * Plugin Name: Exif CE: Cechk & Eliminate
 * Plugin URI:  https://www.braveryk7.com/
 * Description: A plugin that allows you to check, eliminate, and manage Exif information for images.
 * Version:     0.0.1
 * Author:      Ken-chan
 * Author URI:  https://twitter.com/braveryk7
 * Text Domain: exif-ce
 * Domain Path: /languages
 * License:     GPL2
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

require_once __DIR__ . '/class/class-ece-judgment-php-version.php';

$require_php_version  = '7.3.0';
$get_php_version_bool = new ECE_Judgment_Php_Version();
if ( false === $get_php_version_bool->judgment( $require_php_version ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
	if ( is_plugin_active( plugin_basename( __FILE__ ) ) ) {
		if ( is_admin() ) {
			require_once __DIR__ . '/modules/cancel-activate.php';
			cancel_activate();
		}
		deactivate_plugins( plugin_basename( __FILE__ ) );
	} else {
		echo '<p>' . esc_html_e( 'Exif CE: Cechk & Eliminate requires at least PHP 7.3.0 or later.', 'exif-ce' ) . esc_html_e( 'Please upgrade PHP.', 'exif-ce' ) . '</p>';
		exit;
	}
} elseif ( true === $get_php_version_bool->judgment( $require_php_version ) ) {
	require_once __DIR__ . '/class/class-exif-ce-main.php';
	$exif_ce_main = new Exif_Ce_Main();
}
