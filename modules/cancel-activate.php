<?php
/**
 * Cancel activate.
 *
 * @author Ken-chan
 * @package WordPress
 * @subpackage Exif CE
 * @since 1.0.3
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'You do not have access rights.' );
}

/**
 * Return error message.
 */
function cancel_activate() {
	?>
<div class="error">
	<p><?php esc_html_e( '[Plugin error] Exif CE: Cechk & Eliminate has been stopped because the PHP version is old.', 'exif-ce' ); ?></p>
	<p>
		<?php esc_html_e( 'Exif CE: Cechk & Eliminate requires at least PHP 7.3.0 or later.', 'exif-ce' ); ?>
		<?php esc_html_e( 'Please upgrade PHP.', 'exif-ce' ); ?>
	</p>
	<p>
		<?php esc_html_e( 'Current PHP version:', 'exif-ce' ); ?>
		<?php echo PHP_VERSION; ?>
	</p>
</div>
	<?php
}
